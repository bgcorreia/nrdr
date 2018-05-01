<?php
if (isset($_GET['action'])) {

    if ($_GET['action'] == 'login') {
        $aut = new adminUser();
        $obj = $aut->login($_POST['email'], $_POST['pass']);
        if (is_object($obj)) {
            $_SESSION['USER'] = $obj;
            header("Location: admin.php");
        } else {
            //Usuário ou senha incorretos
            echo "<script> window.error = 'loginError';</script>";
        }
    }else if($_GET['action'] == 'logout'){
        session_destroy();
        header("Location: index.php");
    }

}
