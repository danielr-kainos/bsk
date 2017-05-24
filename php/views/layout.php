<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>BSK2017</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <div class="nav-wrapper indigo">
        <a href="index.php" class="brand-logo">BSK 2017</a>
        <a href="#" data-activates="mobile-navbar" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <?php include('views/login_form.php'); ?>
        </ul>
        <ul class="side-nav black" id="mobile-navbar">
            <?php include('views/login_form.php'); ?>
        </ul>
    </div>
</nav>

<main>
    <div class="container">
        <?php require_once($viewPath); ?>
    </div>
</main>

<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
<script type="text/javascript" src="scripts/script.js"></script>
</body>
</html>
