<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 2/26/15
 * Time: 11:56 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Ruang Guru</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.fancybox.css" media="screen"/>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox-media.js?v=1.0.6"></script>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/css/style-kelas.css" rel="stylesheet">

</head>

<body class="have-bar">

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <a class="navbar-brand visible-xs" href="#"><img src="<?php echo base_url();?>images/logo-kelas-2.png" height="60"></a>
                <button type="button" class="filter-toggle collapsed visible-xs" data-toggle="collapse" data-target="#list-orange" aria-expanded="false" aria-controls="navbar">Filter</button>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand hidden-xs" href="#"><img src="<?php echo base_url();?>images/logo-kelas-2.png" height="60"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="close-toggle visible-xs" type="button">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="#">Kelas</a></li>
                    <li><a href="#about">Privat</a></li>
                    <li><a href="#contact">FAQ</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown sign-in">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sign In</a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?php echo base_url();?>murid/registrasi">sbg Murid</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>guru/reg_guru">sbg Guru</a>
                            </li>
                            <li>
                                <a class="fancybox" href="#inline-reg">sbg Vendor</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown register">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Daftar</a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a class="fancybox" href="#inline1">sbg Murid</a>
                            </li>
                            <li>
                                <a class="fancybox" href="#inline3">sbg Guru</a>
                            </li>
                            <li>
                                <a class="fancybox" href="#inline2">sbg Vendor</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</nav>