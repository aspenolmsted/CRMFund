<?php

namespace Alliance\Module\CrmfundDonate\Site\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Http\HttpFactory;
use Joomla\Registry\Registry;

class CrmFundHelper
{
    private const DONATION_MODULE = 'fr_Donations';
    private const FUND_ID_FIELD   = 'fund_id';

    private ?string $sessionId = null;

    private function call(Registry $params, string $method, array $restData): array
    {
        $rawUrl = trim((string) $params->get('suitecrm_url', ''));
        $baseUrl = preg_replace('#/(index\.php|service/v4_1/rest\.php)$#i', '', rtrim($rawUrl, '/'));
        if ($baseUrl === '') {
            throw new \RuntimeException('SuiteCRM URL is not configured in the CRMFund module.');
        }

        $endpoint = $baseUrl . '/service/v4_1/rest.php';
        $http = (new HttpFactory())->getHttp();
        $response = $http->post($endpoint, array(
            'method'        => $method,
            'input_type'    => 'JSON',
            'response_type' => 'JSON',
            'rest_data'     => json_encode($restData),
        ));

        if ($response->code !== 200) {
            throw new \RuntimeException('SuiteCRM API HTTP error ' . $response->code . ' at ' . $endpoint);
        }

        $decoded = json_decode((string) $response->body, true);
        if (!is_array($decoded)) {
            throw new \RuntimeException('Invalid JSON response from SuiteCRM.');
        }

        if (isset($decoded['name'], $decoded['number']) && !isset($decoded['id']) && !isset($decoded['entry_list'])) {
            $mod = isset($restData['module_name']) ? ' [' . $restData['module_name'] . ']' : '';
            throw new \RuntimeException('SuiteCRM API error' . $mod . ': ' . ($decoded['description'] ?? $decoded['name']));
        }

        return $decoded;
    }

    private function login(Registry $params): string
    {
        if ($this->sessionId !== null) {
            return $this->sessionId;
        }

        $res = $this->call($params, 'login', array(
            'user_auth' => array(
                'user_name' => (string) $params->get('suitecrm_user', ''),
                'password'  => md5((string) $params->get('suitecrm_password', '')),
            ),
            'application_name' => 'Joomla_CRMFund_Donate',
        ));

        if (empty($res['id'])) {
            throw new \RuntimeException('Failed to authenticate with SuiteCRM.');
        }

        $this->sessionId = (string) $res['id'];
        return $this->sessionId;
    }

    public function getFundDisplayInfo(Registry $params): array
    {
        $fundId = preg_replace('/[^a-zA-Z0-9\-]/', '', (string) $params->get('fund_id', ''));
        $fundName = trim((string) $params->get('fund_display_name', ''));
        $fundDesc = trim((string) $params->get('fund_description', ''));

        return array(
            'id'           => $fundId,
            'name'         => $fundName !== '' ? $fundName : 'Designated Fund',
            'description'  => $fundDesc,
            'goal_amount'  => 0,
            'total_raised' => 0,
        );
    }

    public function findOrCreateDonor(Registry $params, string $firstName, string $lastName, string $email, string $phone = ''): string
    {
        $session = $this->login($params);
        $cleanEmail = trim($email);

        $searchRes = $this->call($params, 'search_by_module', array(
            'session'             => $session,
            'search_string'       => $cleanEmail,
            'modules'             => array('Contacts'),
            'offset'              => 0,
            'max_results'         => 5,
            'assigned_user_id'    => '',
            'select_fields'       => array('id', 'first_name', 'last_name', 'email1'),
            'unified_search_only' => false,
            'favorites'           => false,
        ));

        $entryList = isset($searchRes['entry_list']) ? $searchRes['entry_list'] : array();
        foreach ($entryList as $modBlock) {
            $records = isset($modBlock['records']) ? $modBlock['records'] : array();
            foreach ($records as $rec) {
                $id = isset($rec['id']['value']) ? $rec['id']['value'] : '';
                $recEmail = isset($rec['email1']['value']) ? $rec['email1']['value'] : '';
                if ($id !== '' && strcasecmp($recEmail, $cleanEmail) === 0) {
                    return (string) $id;
                }
            }
        }

        $createRes = $this->call($params, 'set_entry', array(
            'session'         => $session,
            'module_name'     => 'Contacts',
            'name_value_list' => array(
                array('name' => 'first_name', 'value' => trim($firstName)),
                array('name' => 'last_name', 'value' => trim($lastName)),
                array('name' => 'email1', 'value' => $cleanEmail),
                array('name' => 'phone_work', 'value' => trim($phone)),
            ),
        ));

        if (empty($createRes['id'])) {
            throw new \RuntimeException('Unable to create Donor Contact in SuiteCRM.');
        }

        return (string) $createRes['id'];
    }

    public function submitDonation(Registry $params, array $payload): array
    {
        $amount = round((float) ($payload['amount'] ?? 0), 2);
        if ($amount <= 0) {
            throw new \RuntimeException('Please select or enter a valid donation amount.');
        }

        $firstName = trim((string) ($payload['first_name'] ?? ''));
        $lastName  = trim((string) ($payload['last_name'] ?? ''));
        $email     = trim((string) ($payload['email'] ?? ''));

        if ($firstName === '' || $lastName === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \RuntimeException('Please enter your first name, last name, and a valid email address.');
        }

        $fund = $this->getFundDisplayInfo($params);
        $fundId = preg_replace('/[^a-zA-Z0-9\-]/', '', (string) $params->get('fund_id', ''));

        $contactId = $this->findOrCreateDonor($params, $firstName, $lastName, $email, (string) ($payload['phone'] ?? ''));
        $session = $this->login($params);

        $giftTitle = $fund['name'] . ' - ' . $firstName . ' ' . $lastName . ' ($' . number_format($amount, 2) . ')';
        $tributeNote = trim((string) ($payload['tribute'] ?? ''));
        $isRecurring = !empty($payload['is_recurring']);
        $recurringLabel = $isRecurring ? 'Monthly Recurring' : 'One-Time';

        $fields = array(
            array('name' => 'name', 'value' => $giftTitle),
            array('name' => 'amount', 'value' => $amount),
            array('name' => 'donation_date', 'value' => date('Y-m-d')),
            array('name' => 'contact_id', 'value' => $contactId),
            array('name' => 'is_recurring', 'value' => $isRecurring ? 1 : 0),
            array('name' => 'tribute', 'value' => $tributeNote),
            array('name' => 'description', 'value' => 'Frequency: ' . $recurringLabel . ($tributeNote !== '' ? "\nTribute/Note: " . $tributeNote : '')),
        );

        if ($fundId !== '') {
            $fields[] = array('name' => self::FUND_ID_FIELD, 'value' => $fundId);
        }

        $res = $this->call($params, 'set_entry', array(
            'session'         => $session,
            'module_name'     => self::DONATION_MODULE,
            'name_value_list' => $fields,
        ));

        if (empty($res['id'])) {
            throw new \RuntimeException('SuiteCRM failed to record the donation in ' . self::DONATION_MODULE . '.');
        }

        return array(
            'id'        => (string) $res['id'],
            'fund_name' => $fund['name'],
            'amount'    => $amount,
            'donor'     => $firstName . ' ' . $lastName,
            'frequency' => $recurringLabel,
        );
    }
}