<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$modId = (int) $module->id;
$presetsRaw = explode(',', (string) $params->get('preset_amounts', '25,50,100,250,500'));
$presets = array();
foreach ($presetsRaw as $p) {
    $val = (float) trim($p);
    if ($val > 0) {
        $presets[] = $val;
    }
}

$fundName = !empty($fundInfo['name']) ? $fundInfo['name'] : 'Designated Fund';
$fundDesc = !empty($fundInfo['description']) ? $fundInfo['description'] : '';
$goalAmount = (float) ($fundInfo['goal_amount'] ?? 0);
$totalRaised = (float) ($fundInfo['total_raised'] ?? 0);
$pct = ($goalAmount > 0) ? min(100, round(($totalRaised / $goalAmount) * 100)) : 0;
?>
<div class="mod-crmfund-donate" style="max-width: 560px; margin: 0 auto; padding: 22px; background: #ffffff; border: 1px solid #cbd5e1; border-radius: 8px; box-shadow: 0 2px 8px rgba(15, 23, 42, 0.06);">
    <h3 style="margin-top: 0; margin-bottom: 6px; color: #0f172a;">
        <?php echo htmlspecialchars($fundName, ENT_QUOTES, 'UTF-8'); ?>
    </h3>

    <?php if ($fundDesc !== '') : ?>
        <p style="color: #475569; font-size: 14px; margin-bottom: 14px;">
            <?php echo htmlspecialchars($fundDesc, ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <?php if ($goalAmount > 0) : ?>
        <div style="margin-bottom: 16px;">
            <div style="display: flex; justify-content: space-between; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 4px;">
                <span>Raised: $<?php echo number_format($totalRaised, 2); ?></span>
                <span>Goal: $<?php echo number_format($goalAmount, 2); ?> (<?php echo $pct; ?>%)</span>
            </div>
            <div style="width: 100%; height: 10px; background: #e2e8f0; border-radius: 999px; overflow: hidden;">
                <div style="width: <?php echo $pct; ?>%; height: 100%; background: #10b981;"></div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($errorMessage)) : ?>
        <div style="padding: 12px; margin-bottom: 16px; background: #fef2f2; border: 1px solid #ef4444; color: #991b1b; border-radius: 6px; font-size: 14px;">
            <?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($confirmation)) : ?>
        <div style="padding: 16px; margin-bottom: 16px; background: #ecfdf5; border: 1px solid #10b981; color: #065f46; border-radius: 6px;">
            <strong>Thank you, <?php echo htmlspecialchars($confirmation['donor'], ENT_QUOTES, 'UTF-8'); ?>!</strong>
            <p style="margin: 6px 0 0 0; font-size: 14px;">
                Your <?php echo htmlspecialchars($confirmation['frequency'], ENT_QUOTES, 'UTF-8'); ?> gift of
                <strong>$<?php echo number_format((float) $confirmation['amount'], 2); ?></strong> to
                <strong><?php echo htmlspecialchars($confirmation['fund_name'], ENT_QUOTES, 'UTF-8'); ?></strong> has been recorded
                (Ref: <?php echo htmlspecialchars($confirmation['id'], ENT_QUOTES, 'UTF-8'); ?>).
            </p>
        </div>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars(Uri::getInstance()->toString(), ENT_QUOTES, 'UTF-8'); ?>" method="post">
        <div style="margin-bottom: 14px;">
            <label style="display: block; font-weight: 600; margin-bottom: 6px;">Select Gift Amount *</label>
            <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 10px;">
                <?php foreach ($presets as $idx => $amt) : ?>
                    <label style="cursor: pointer; margin: 0;">
                        <input type="radio"
                               name="preset_amount"
                               value="<?php echo $amt; ?>"
                               <?php echo $idx === 1 ? 'checked' : ''; ?>
                               onclick="document.getElementById('custom_amount_<?php echo $modId; ?>').value='';"
                               style="margin-right: 4px;" />
                        <span style="display: inline-block; padding: 6px 12px; border: 1px solid #94a3b8; border-radius: 5px; font-weight: 600;">
                            $<?php echo number_format($amt, 0); ?>
                        </span>
                    </label>
                <?php endforeach; ?>
            </div>
            <input type="number"
                   step="0.01"
                   min="1"
                   name="custom_amount"
                   id="custom_amount_<?php echo $modId; ?>"
                   placeholder="Or enter custom amount ($)"
                   class="form-control"
                   style="width: 100%; padding: 8px;" />
        </div>

        <div style="margin-bottom: 14px;">
            <label style="cursor: pointer; font-size: 14px;">
                <input type="checkbox" name="is_recurring" value="1" style="margin-right: 6px;" />
                Make this a recurring monthly gift
            </label>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
            <div>
                <label for="first_name_<?php echo $modId; ?>" style="font-weight: 600;">First Name *</label>
                <input type="text" name="first_name" id="first_name_<?php echo $modId; ?>" class="form-control" required style="width: 100%; padding: 8px;" />
            </div>
            <div>
                <label for="last_name_<?php echo $modId; ?>" style="font-weight: 600;">Last Name *</label>
                <input type="text" name="last_name" id="last_name_<?php echo $modId; ?>" class="form-control" required style="width: 100%; padding: 8px;" />
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
            <div>
                <label for="email_<?php echo $modId; ?>" style="font-weight: 600;">Email Address *</label>
                <input type="email" name="email" id="email_<?php echo $modId; ?>" class="form-control" required style="width: 100%; padding: 8px;" />
            </div>
            <div>
                <label for="phone_<?php echo $modId; ?>" style="font-weight: 600;">Phone</label>
                <input type="text" name="phone" id="phone_<?php echo $modId; ?>" class="form-control" style="width: 100%; padding: 8px;" />
            </div>
        </div>

        <div style="margin-bottom: 16px;">
            <label for="tribute_<?php echo $modId; ?>" style="font-weight: 600;">In Honor / Memory Of (Optional)</label>
            <input type="text" name="tribute" id="tribute_<?php echo $modId; ?>" class="form-control" style="width: 100%; padding: 8px;" />
        </div>

        <input type="hidden" name="crmfund_module_id" value="<?php echo $modId; ?>" />
        <?php echo HTMLHelper::_('form.token'); ?>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; font-weight: 600;">
            Donate to <?php echo htmlspecialchars($fundName, ENT_QUOTES, 'UTF-8'); ?>
        </button>
    </form>
</div>