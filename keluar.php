<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

    unset($_SESSION['id_user']);
    unset($_SESSION['level']);
    echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
?>