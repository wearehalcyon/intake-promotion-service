<div class="dashboardFooter">
    <div class="container-fluid">
        <div class="row footerRow">
            <div class="col-md-9">
				<?php echo get_translate('Copyright by INTAKE Digital &copy ' . date('Y') . ' All rights reserved.', 'Copyright by INTAKE Digital &copy ' . date('Y') . ' Все права защищены.'); ?>
                <br>
                <ul>
                    <li>
                        <a href="https://intakedigital.com/" target="_blank">
							<?php echo get_translate('INTAKE Digital Home', 'INTAKE Digital Главная'); ?>
                        </a>
                    </li>|
                    <li>
                        <a href="https://intakedigital.com/support/" target="_blank">
							<?php echo get_translate('Support', 'Поддержка'); ?>
                        </a>
                    </li>|
                    <li>
                        <a href="https://intakedigital.com/products/" target="_blank">
							<?php echo get_translate('Products', 'Продукты'); ?>
                        </a>
                    </li>|
                    <li>
                        <a href="https://intakedigital.com/privacy-policy/" target="_blank">
							<?php echo get_translate('Privacy Policy', 'Политика Конфиденциальности'); ?>
                        </a>
                    </li>|
                    <li>
                        <a href="https://intakedigital.com/terms-of-use/" target="_blank">
							<?php echo get_translate('Terms Of Use', 'Правила Использования'); ?>
                        </a>
                    </li>|
                    <li>
                        <a href="https://intakedigital.com/updates/" target="_blank">
							<?php echo get_translate('Updates', 'Обновления'); ?>
                        </a>
                    </li>|
                    <li>
                        <a href="https://intakedigital.com/account/" target="_blank">
							<?php echo get_translate('My ID Account', 'Мой ID Аккаунт'); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 text-right">
				<?php echo get_translate('Powered by INTAKE Promotion Service Engine.<br>Current version: ' . get_version() . '<br><a href="https://intakedigital.com/updates/" target="_blank">Check for updates</a>.', 'Работает на INTAKE Promotion Service Engine.<br>Актуальная версия: ' . get_version() . '<br><a href="https://intakedigital.com/updates/" target="_blank">Проверить обновления</a>.'); ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="terminal ui-draggable">
    <span class="close_terminal"></span>
    <div class="terminalCMDs">
        <?php
            $option = R::findOne('options', 'id = ?', [1]);
        ?>
        <p>user:<?php echo $option['site_email']; ?></p>
        <p>logged as: <?php echo $_SESSION['logged_user']->artist_alias; ?></p>
        <p>YourIP:<?php echo $_SERVER['REMOTE_ADDR']; ?></p>
        <p>ServerIP:<?php echo gethostbyname('www.' . str_replace(['/', ':', 'http', 'https'], '', base_url())); ?></p>
        <p>
            <textarea name="terminal_cmds"></textarea>
        </p>
    </div>
</div>
</div>
<div class="mobileNavButton">
    <button class="mobileNB">
        <i class="fas fa-ellipsis-v"></i>
    </button>
</div>
<script src="<?php echo get_assets('jquery/3.4.1/jquery.min', 'script'); ?>"></script>
<script src="<?php echo get_assets('ui.min', 'script'); ?>"></script>
<script src="<?php echo get_assets('canvas', 'script'); ?>"></script>
<script src="<?php echo get_assets('nice-select', 'script'); ?>"></script>
<script src="<?php echo get_assets('dropzone', 'script'); ?>"></script>
<script src="<?php echo get_assets('fancybox.min', 'script'); ?>"></script>
<script src="<?php echo base_url('lib/tinymce/tinymce.min.js'); ?>"></script>
<script src="<?php echo base_url('lib/flat-datepicker/datepicker.js'); ?>"></script>
<?php if ($_GET['type'] == 'campaign' && $_GET['action'] == 'edit') : ?>
    <script src="<?php echo get_assets('wavesurfer', 'script'); ?>"></script>
    <?php if (get_option('app_ui_mode')) : ?>
        <script src="<?php echo get_assets('wavesurfer-player-dark', 'script'); ?>"></script>
    <?php else : ?>
        <script src="<?php echo get_assets('wavesurfer-player', 'script'); ?>"></script>
    <?php endif; ?>
<?php endif; ?>
<?php if ($_GET['type'] == 'statistic' && $_GET['action'] == 'view') : ?>
    <?php if (get_option('app_ui_mode')) : ?>
        <script src="<?php echo get_assets('charts-dark', 'script'); ?>"></script>
    <?php else : ?>
        <script src="<?php echo get_assets('charts', 'script'); ?>"></script>
    <?php endif; ?>
<?php endif; ?>
<?php if (get_option('app_ui_mode')) : ?>
    <script src="<?php echo get_assets('manager-dark', 'script'); ?>"></script>
<?php else : ?>
    <script src="<?php echo get_assets('manager', 'script'); ?>"></script>
<?php endif; ?>
<?php debug_bar(); ?>
</body>
</html>
