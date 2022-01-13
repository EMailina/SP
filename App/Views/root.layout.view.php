<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Domov</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ad2dfad92d.js" crossorigin="anonymous"></script>

    <link rel="icon" href="public/Obrazky/logoS.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/css.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>




</head>
<body>
<header>
    <!--<a href="#" class="logo"><img src="images/logo1.png"></a>-->
    <a href="?c=home" class="logo"></a>
    <a href="?c=home" class="logoName">Malina Design</a>
    <!--<div class="menuToggle"></div>-->
    <div class="menuIcon" id="menuIcon" onclick="menu()">
        <i class="fas fa-bars"></i>
    </div>
    <ul class="navigation">
        <li><a class="<?= !isset($_GET['c'])||$_GET['c'] == "home"?"aktivne":"" ?>" href="?c=home"> <!--class="aktivne"-->Domov</a></li>
        <li><a class="<?= isset($_GET['c'])?$_GET['c'] == "about"?"aktivne":"":"" ?>" href="?c=about&a=about">O nás</a></li>
        <li><a class="<?= isset($_GET['c'])?$_GET['c'] == "portfolio"&&isset($_GET['a'])?$_GET['a'] == "portfolio"||$_GET['a']== "ukazkaProjektu"?"aktivne":"":"":"" ?>" href="?c=portfolio&a=portfolio">Portfólio</a></li>
        <?php if (\App\Auth::isLogged()){?>
            <li><a class="<?= isset($_GET['c'])?$_GET['c'] == "portfolio"&&isset($_GET['a'])?$_GET['a'] != "portfolio"&&$_GET['a'] != "ukazkaProjektu"?"aktivne":"":"":"" ?>" href="?c=portfolio&a=moje">Moje</a></li>
        <?php } ?>
        <!--<li><a href="">Pre firmy</a></li>-->
        <li><a  class="<?= isset($_GET['c'])?$_GET['c'] == "contact"?"aktivne":"":"" ?>" href="?c=contact&a=contact">Kontakt</a></li>
        <?php if (\App\Auth::isLogged()){?>
            <li><a class="moj-link" href="?c=auth&a=logout">Logout</a></li>

        <?php } else { ?>
            <li><a class="<?= isset($_GET['c'])?$_GET['c'] == "auth"?"aktivne":"":"" ?>" href="<?= \App\Config\Configuration::LOGIN_URL ?>">Login</a></li>

        <?php } ?>
    </ul>
    <script src="public/scripty.js" ></script>
    <script src="public/jquery.js" ></script>
    <script src="public/komentare.js" ></script>
</header>
<?= $contentHTML ?>



<footer class="footer-body">
    <div class="footer-left">
        <h2> Malina Design</h2>
        <p class="footer-links">

            <a href="?c=home">Domov</a> |
            <a href="?c=about&a=about">O nás</a> |
            <a href="?c=portfolio&a=portfolio">Portfólio</a> |
            <!-- <a href="">Pre firmy</a> -->
            <a href="?c=contact&a=contact">Kontakt</a>
        </p>
        <p class="footer-company-name">Copyright © 2021 Malina Design All rights reserved</p>
    </div>
    <div class="footer-center">
        <div>
            <i class="fa fa-map-marker"></i>
            <p>Mariánske námestie, 010 01 Žilina</p>
        </div>

        <div>
            <i class="fa fa-phone"></i>
            <p>+421 917 777 666</p>
        </div>
        <div>
            <i class="fa fa-envelope"></i>
            <p>erik55.malina@gmail.com</p>
        </div>
    </div>

    <div class="footer-right">
        <p class="footer-company-about">
            Kontaktujte
            Malina Designje nová a stále populárnejšia forma grafiky a dizajnu na Slovensku aj v
            zahraničí.
        </p>
        <div class="footer-icons">
            <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://www.instagram.com/em_design.er/?hl=sk" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>
            <a href="https://twitter.com/?lang=sk" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="https://www.youtube.com/?gl=SK&tab=w1" target="_blank"><i class="fa fa-youtube"></i></a>
        </div>
        <?php if(!\App\Auth::isLogged()){?>

        <a href="<?= \App\Config\Configuration::LOGIN_URL ?>" class="mbtn">Prihláste sa</a>
        <?php }else { ?>
            <a href="?c=auth&a=updateProfileForm" class="mbtn"><?= \App\Auth::getName() ?></a>
         <?php }?>
    </div>


</footer>
</body>
</html>

