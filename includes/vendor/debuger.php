<div class="debugPan">
    <button class="openDebug" type="button" name="button"><i class="fas fa-terminal"></i></button>
    <div class="memoryUsage debugBlock">
        <span class="title">Base URL</span>
        <?php
            echo '<i class="fas fa-link"></i> ' . base_url();
        ?>
    </div>
    <div class="memoryUsage debugBlock">
        <span class="title">Root Directory</span>
        <?php
            echo '<i class="fas fa-folder"></i> ' . $_SERVER['DOCUMENT_ROOT'];
        ?>
    </div>
    <div class="memoryUsage debugBlock">
        <span class="title">Current Working Directory</span>
        <?php
            echo '<i class="fas fa-folder-open"></i> ' . getcwd();
        ?>
    </div>
    <div class="memoryUsage debugBlock">
        <span class="title">Server IP</span>
        <?php
            echo '<i class="fas fa-globe"></i> ' . get_client_ip_server();
        ?>
    </div>
    <div class="memoryUsage debugBlock">
        <span class="title">Your IP</span>
        <?php
            echo '<i class="fas fa-globe"></i> ' . get_client_ip_env();
        ?>
    </div>
    <div class="memoryUsage debugBlock">
        <span class="title">OS Family</span>
        <?php
            if (PHP_OS_FAMILY === 'Windows') {
                echo '<i class="fab fa-windows"></i> ' . PHP_OS_FAMILY;
            }
            if (PHP_OS_FAMILY === 'MacOS') {
                echo '<i class="fab fa-apple"></i> ' . PHP_OS_FAMILY;
            }
            if (PHP_OS_FAMILY === 'Linux') {
                echo '<i class="fab fa-linux"></i> ' . PHP_OS_FAMILY;
            } if (PHP_OS_FAMILY === '') {
                echo 'Unknown operating system';
            }
        ?>
    </div>
    <div class="memoryUsage debugBlock">
        <span class="title">Server</span>
        <?php
            echo '<i class="fas fa-server"></i> ' . $_SERVER["SERVER_SOFTWARE"];
        ?>
    </div>
    <div class="memoryUsage debugBlock">
        <span class="title">PHP Version</span>
        <?php
            echo '<i class="fab fa-php"></i> ' . phpversion();
        ?>
    </div>
    <div class="memoryUsage debugBlock" data-has-sub="true">
        <span class="title">Tables</span>
        <?php
            $listOfTables = R::inspect();
            //var_dump($listOfTables);
            echo '<i class="fas fa-database"></i> ' . count($listOfTables);
        ?>
        <div class="dbSub">
            <ul>
                <?php
                    foreach($listOfTables as $listOfTable) {
                        echo '<li>' . $listOfTable . '</li>';
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="memoryUsage debugBlock cpu">
        <span class="title">CPU Usage</span>
        <span class="cpuNum"></span>
    </div>
    <div class="memoryUsage debugBlock">
        <span class="title">RAM Limit</span>
        <?php
            $memory_limit = ini_get('memory_limit');
            echo '<i class="fas fa-memory"></i> ' . $memory_limit;
        ?>
    </div>
    <div class="memoryUsage debugBlock">
        <span class="title">RAM Usage</span>
        <?php
            $bytes = (memory_get_usage() - $mem_start);
            $kbytes = ((memory_get_usage() - $mem_start) / 1000);
            $mbytes = ((memory_get_usage() - $mem_start) / 1000000);
            echo '<i class="fas fa-memory"></i> ' . round($mbytes, 2) . 'M';
        ?>
    </div>
</div>
