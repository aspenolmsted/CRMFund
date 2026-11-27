<?php

namespace Alliance\Module\CrmfundDonate\Site\Dispatcher;

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Joomla\CMS\Session\Session;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    protected function getLayoutData(): array
    {
        $data = parent::getLayoutData();
        $params = $data['params'];
        $app = Factory::getApplication();
        $input = $app->input;

        $helper = $this->getHelperFactory()->getHelper('CrmFundHelper');

        $data['confirmation'] = null;
        $data['errorMessage'] = null;
        $data['fundInfo'] = $helper->getFundDisplayInfo($params);

        if ($input->getMethod() === 'POST' && $input->getInt('crmfund_module_id') === (int) $this->module->id) {
            if (!Session::checkToken()) {
                $data['errorMessage'] = 'Invalid security token. Please refresh and try again.';
                return $data;
            }

            try {
                $amount = (float) $input->post->getString('custom_amount', '');
                if ($amount <= 0) {
                    $amount = (float) $input->post->getString('preset_amount', '0');
                }

                $payload = array(
                    'amount'       => $amount,
                    'first_name'   => $input->post->getString('first_name', ''),
                    'last_name'    => $input->post->getString('last_name', ''),
                    'email'        => $input->post->getString('email', ''),
                    'phone'        => $input->post->getString('phone', ''),
                    'tribute'      => $input->post->getString('tribute', ''),
                    'is_recurring' => $input->post->getInt('is_recurring', 0),
                );

                $data['confirmation'] = $helper->submitDonation($params, $payload);

                $redirectUrl = trim((string) $params->get('payment_redirect_url', ''));
                if ($redirectUrl !== '') {
                    $sep = (strpos($redirectUrl, '?') === false) ? '?' : '&';
                    $app->redirect($redirectUrl . $sep . 'donation_id=' . urlencode($data['confirmation']['id']) . '&amount=' . urlencode((string) $amount));
                }
            } catch (\Throwable $e) {
                $data['errorMessage'] = $e->getMessage();
            }
        }

        return $data;
    }
}