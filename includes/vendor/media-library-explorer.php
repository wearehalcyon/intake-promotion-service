<?php
// Root Dir
if ($_GET['page'] == 'media-library' && !$_GET['folder']) {
    $listuserfiles = scandir($_SERVER['DOCUMENT_ROOT'] . '/view/uploads/');
    foreach ( $listuserfiles as $listuserfile ) {
        if ( $listuserfile != '.' && $listuserfile != '..' ) {
            echo '<li>';
                    if (!pathinfo($listuserfile, PATHINFO_EXTENSION)) {
                        echo '<a href="' . base_url('manager/index.php?page=media-library&folder=' . $listuserfile) . '">';
                            echo '<i class="fas fa-folder"></i>';
                            echo '<span class="fileName">' . mb_strimwidth($listuserfile, 0, 30, '...') . '</span>';
                        echo '</a>';
                    } else {
                        echo '<a data-fancybox data-src="' . base_url('view/uploads/' . $listuserfile) . '" href="javascript:;">';
                            echo '<i class="far fa-file file-ext"></i>';
                            echo '<span class="fileName">' . mb_strimwidth($listuserfile, 0, 30, '...') . '</span>';
                        echo '</a>';
                    }
            echo '</li>';
        }
    }
}
// Manager Dir
if ($_GET['folder'] == 'manager') {
    $listuserfiles = scandir($_SERVER['DOCUMENT_ROOT'] . '/view/uploads/manager/');
    foreach ( $listuserfiles as $listuserfile ) {
        if ( $listuserfile != '.' && $listuserfile != '..' ) {
            echo '<li>';
                    if (!pathinfo($listuserfile, PATHINFO_EXTENSION)) {
                        echo '<a href="' . base_url('manager/index.php?page=media-library&folder=' . $listuserfile) . '">';
                            echo '<i class="fas fa-folder"></i>';
                            echo '<span class="fileName">' . mb_strimwidth($listuserfile, 0, 30, '...') . '</span>';
                        echo '</a>';
                    } else {
                        echo '<a data-fancybox data-src="' . base_url('view/uploads/' . $_GET['folder'] . '/' . $listuserfile) . '" href="javascript:;">';
                            echo '<i class="far fa-file file-ext"></i>';
                            echo '<span class="fileName">' . mb_strimwidth($listuserfile, 0, 30, '...') . '</span>';
                        echo '</a>';
                    }
            echo '</li>';
        }
    }
}
// Users Photos
if ($_GET['folder'] == 'users-photos') {
    $listuserfiles = scandir($_SERVER['DOCUMENT_ROOT'] . '/view/uploads/manager/users-photos/');
    foreach ( $listuserfiles as $listuserfile ) {
        if ( $listuserfile != '.' && $listuserfile != '..' ) {
            echo '<li>';
                    if (!pathinfo($listuserfile, PATHINFO_EXTENSION)) {
                        echo '<a href="' . base_url('manager/index.php?page=media-library&folder=' . $listuserfile) . '">';
                            echo '<i class="fas fa-folder"></i>';
                            echo '<span class="fileName">' . mb_strimwidth($listuserfile, 0, 30, '...') . '</span>';
                        echo '</a>';
                    } else {
                        echo '<a data-fancybox data-src="' . base_url('view/uploads/manager/' . $_GET['folder'] . '/' . $listuserfile) . '" href="javascript:;">';
                            echo '<i class="far fa-file file-ext"></i>';
                            echo '<span class="fileName">' . mb_strimwidth($listuserfile, 0, 30, '...') . '</span>';
                        echo '</a>';
                    }
            echo '</li>';
        }
    }
}
