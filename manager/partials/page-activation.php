<?php
    $data = $_POST;
    if (isset($data['submit'])) {
        $update = R::findOne('options', 'id=?', [1]);
        $update->api_key = $data['apikey'];
        $update->serial_number = $data['serialnum'];
        R::store($update);
        echo '<meta http-equiv="refresh" content="0; URL=/manager/index.php?page=activation">';
    }

    if ($api->{'api_key'} == get_option('api_key') && $api->{'serial_number'} == get_option('serial_number')) {
        $apikey_message = get_translate('Activated', 'Активировано');
        $apil_class = ' registered';
    } else {
        $apikey_message = get_translate('Unactivated', 'Не Активировано');
        $apil_class = get_translate(' unregistered', ' unregistered unregistered_ru');
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="pageTitle"><?php echo get_translate('App Activation', 'Активация Приложения'); ?><span class="apiLabel<?php echo $apil_class; ?>"><?php echo $apikey_message; ?></span></h1>
        </div>
        <div class="col-md-6 col-card">
            <div class="newsSection card">
                <div class="queryTable table">
                    <form action="" method="post">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo get_translate('API Key', 'API Ключ'); ?></th>
                                    <th scope="col"><?php echo get_translate('Serial Number', 'Серийный Номер'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input class="input" type="text" name="apikey" value="<?php echo get_option('api_key'); ?>" placeholder="Intake API Key">
                                    </td>
                                    <td>
                                        <input class="input" type="text" name="serialnum" value="<?php echo get_option('serial_number'); ?>" placeholder="Intake Serial Number">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="aboutPlan">
                            <p>
                                <strong><?php echo get_translate('Your Plan', 'Ваш Тариф'); ?>:</strong><span><?php echo $api->{'plan'}; ?></span>
                            </p>
                            <p>
                                <strong><?php echo get_translate('Registration Email', 'Регистрационный Email'); ?>:</strong><span><?php echo $api->{'email'}; ?></span>
                            </p>
                            <p>
                                <strong><?php echo get_translate('Expiration date', 'Дата Истечения'); ?>:</strong><span><?php echo date('F d Y', strtotime($api->{'expiration'})); ?></span>
                            </p>
                        </div>
                        <div class="tableSubmit">
                            <button type="submit" class="button" name="submit"><?php echo get_translate('Refresh', 'Обновить'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
