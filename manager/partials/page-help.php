<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="pageTitle"><?php echo get_translate('Help', 'Помощь'); ?></h1>
        </div>
        <div class="col-md-12">
            <div class="card">
                <?php if ( $_GET['result'] == 'success' ) : ?>
                    <p class="campaignCreated">
                        <?php echo get_translate('Success!', 'Успешно!'); ?>
                    </p>
                    <p style="display:block;margin-top: 20px;text-align: center;">
                        <?php echo get_translate('Your ticket request (#' . $_GET['ticket'] . ') has been sent successfully! If you completed everything correctly and made no mistakes, we will consider your appeal within 2 business days. If the answer does not occur, check the data you entered, as well as check the active license of your application. If you left the message field empty, this request is will be automatically ignored by the system. Thank you for staying with us.', 'Ваш запрос тикет (#' . $_GET['ticket'] . ') успешно отправлен! Если вы все заполнили правильно, и не допустили ошибок - мы рассмотрим ваше обращение в течении 2х рабочих дней. Если ответа не произойдет, проверьте введенные вами данные, а так же проверьте активную лицензию вашего приложения. Если вы поле сообщения оставили пустым, ваше обращение автоматически проигнорируется системой. Спасибо за то, что остаетесь с нами.'); ?>
                    </p>
                <?php else : ?>
                    <p>
                        <?php echo get_translate('If you need some help, if questions or suggestions you can use form below to contact us.', 'Если вам нужна помощь, если есть вопросы или предложения вы можете использовать форму ниже, чтобы связаться с нами.'); ?>
                    </p>
                    <div class="helpForm">
                        <form action="" method="post">
                            <p class="formControl">
                                <input hidden type="text" name="help_client_email" value="<?php echo get_option('site_email'); ?>">
                            </p>
                            <p class="formControl">
                                <input hidden type="text" name="help_client_api_key" value="<?php echo get_option('api_key'); ?>">
                            </p>
                            <p class="formControl">
                                <input hidden type="text" name="help_client_serial" value="<?php echo get_option('serial_number'); ?>">
                            </p>
                            <p class="formControl">
                                <input type="text" name="help_client_ticket_number" value="Ticket Number: #<?php echo rand(1000,9999); ?>" readonly>
                            </p>
                            <p class="formControl">
                                <select name="help_client_subject" class="select">
                                    <option value="Question">I Have A Question</option>
                                    <option value="Suggestion">I Have A Suggestion</option>
                                    <option value="License">About License</option>
                                    <option value="Another">Another Subject</option>
                                </select>
                            </p>
                            <p class="formControl">
                                <textarea name="help_client_message"></textarea>
                            </p>
                            <p class="formControl">
                                <button type="submit" name="help_client_submit" class="button">
                                    <?php echo get_translate('Send', 'Оправить'); ?>
                                </button>
                            </p>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
