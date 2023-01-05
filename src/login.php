<?php
    session_start();

    if (isset($_SESSION['username'])){
        header('Location: index.php');
      }

    require_once('templates/common.tpl.php');
    require_once('database/connection.php');
    require_once('templates/login_signup.tpl.php');

    output_header(false);
    output_login_form();
    output_footer();

?>