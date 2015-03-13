<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 3/3/15
 * Time: 1:49 PM
 */ ?>

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
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <script type="text/javascript" src="js/jquery.fancybox.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="screen"/>
        <script type="text/javascript" src="js/jquery.fancybox-media.js?v=1.0.6"></script>

        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">

    </head>

    <body class="have-bar">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <a class="navbar-brand visible-xs" href="#"><img src="assets/images/logo-kelas-2.png" height="60"></a>
                    <button type="button" class="filter-toggle collapsed visible-xs" data-toggle="collapse" data-target="#list-orange" aria-expanded="false" aria-controls="navbar">Filter</button>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand hidden-xs" href="#"><img src="assets/images/logo-kelas-2.png" height="60"></a>
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
                                    <a href="https://ruangguru.com/murid/registrasi">sbg Murid</a>
                                </li>
                                <li>
                                    <a href="https://ruangguru.com/guru/reg_guru">sbg Guru</a>
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
        <div class="below-nav">
            <div class="container">
            <div class="row list-orange collapse" id="list-orange">
                <button data-target=".list-orange" data-toggle="collapse" class="close-toggle visible-xs" type="button">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="col-sm-12">
                    <ul class="nav nav-pills">
                        <li class="title-filter text-16">Filter</li>
                        <li id="cat_list" class="filter-select">
                            <select class="form-control input-sm">
                                <option value="0">Hari</option>
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                                <option value="5">Jumat</option>
                                <option value="6">Sabtu</option>
                                <option value="7">Minggu</option>
                            </select>
                        </li>
                        <li id="lev_list" class="filter-select">
                            <select class="form-control input-sm level">
                                <option value="0">Level</option>
                                <option value="1" class="level_check level_1">Basic</option>
                                <option value="2" class="level_check level_2">Beginner</option>
                                <option value="3" class="level_check level_3">Intermediate</option>
                                <option value="4" class="level_check level_4">Advance</option>
                                <option value="5" class="level_check level_5">Expert</option>
                                <option value="6" class="level_check level_6">Master</option>
                            </select>
                        </li>
                        <li id="prov_list" class="filter-select">
                            <select class="form-control input-sm propinsi">
                                <option value="0">Provinsi</option>
                            </select>
                        </li>
                        <li id="tipe_list" class="filter-select">
                            <select class="form-control input-sm">
                                <option value="0">Tipe Kelas</option>
                                <option value="0">Paket</option>
                                <option value="0">Satu Sesi</option>
                            </select>
                        </li>
                        <li id="harga_list" class="filter-select">
                            <select class="form-control input-sm kategori">
                                <option value="0">Kategori</option>
                                <option value="1">Bahasa</option>
                                <option value="2">Kewirausahaan</option>
                                <option value="3">Kuliner</option>
                                <option value="4">Olahraga</option>
                                <option value="5">Pelajaran Sekolah</option>
                                <option value="6">Pengembangan Diri</option>
                                <option value="7">Persiapan Tes</option>
                                <option value="8">Seni</option>
                                <option value="9">Lainnya</option>
                            </select>
                        </li>
                    </ul>
                    <ul class="sort nav">

                        <li class="title-filter text-16 sort-list">Urutan</li>
                        <li id="sort_by_list" class="sort-list">
                            <select class="form-control input-sm">
                                <option value="0">Harga Termurah</option>
                                <option value="1">On Going Class</option>
                                <option value="2">Upcoming Class</option>
                                <option value="3">Past Class</option>
                            </select>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </div><!-- below-nav -->
    </nav>


    <div class="container content">
        <div class="row">
            <div class="col-sm-12 block-title-wrap">
                <h3 class="block-title text-center">Kelas Pilihan</h3>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="content-grid diskon">
                    <div class="grid-bottom">
                        <span class="price">Rp 75,000,- /sesi</span>
                        <a href="#"><span class="details">Daftar</span></a>
                        <div class="description">
                            <div class="icon"><i class="fa fa-calendar-o"></i></div>
                            <span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
                        </div><!-- description -->
                        <div class="review">
                            <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                            <span class="tag">kelas ruangguru</span>
                            <div class="rating">
                                <span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> (10 review)</span>
                            </div>
                        </div>
                    </div><!-- grid-bottom -->
                </div> <!-- content-grid -->
            </div><!-- col-md-4 col-sm-6 -->
            <div class="col-md-4 col-sm-6">
                <div class="content-grid">
                    <a href="#">
                        <div class="grid-top" style="background-image: url('assets/images/main_picture.jpg');">
                            <div class="grid-title-wrap">
                                <h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
                            </div><!-- grid-title-wrap -->
                        </div><!-- grid-top -->
                    </a>
                    <div class="grid-bottom">
                        <span class="price">Rp 75,000,- /sesi</span>
                        <a href="#"><span class="details">Daftar</span></a>
                        <div class="description">
                            <div class="icon"><i class="fa fa-calendar-o"></i></div>
                            <span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
                        </div><!-- description -->
                        <div class="review">
                            <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                            <span class="tag">kelas ruangguru</span>
                            <div class="rating">
                                <span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
                            </div>
                        </div>
                    </div><!-- grid-bottom -->
                </div> <!-- content-grid -->
            </div><!-- col-md-4 col-sm-6 -->
            <div class="col-md-4 col-sm-6">
                <div class="content-grid">
                    <a href="#">
                        <div class="grid-top" style="background-image: url('assets/images/main_picture.jpg');">
                            <div class="grid-title-wrap">
                                <h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
                            </div><!-- grid-title-wrap -->
                        </div><!-- grid-top -->
                    </a>
                    <div class="grid-bottom">
                        <span class="price">Rp 75,000,- /sesi</span>
                        <a href="#"><span class="details">Daftar</span></a>
                        <div class="description">
                            <div class="icon"><i class="fa fa-calendar-o"></i></div>
                            <span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
                        </div><!-- description -->
                        <div class="review">
                            <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                            <span class="tag">kelas ruangguru</span>
                            <div class="rating">
                                <span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
                            </div>
                        </div>
                    </div><!-- grid-bottom -->
                </div> <!-- content-grid -->
            </div><!-- col-md-4 col-sm-6 -->
            <div class="col-sm-4 col-sm-offset-4">
                <a href="#" class="main-button text-center">Lihat Semua Kelas</a>
            </div>
        </div>
    </div> <!-- /container -->
    <div class="related">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 block-title-wrap">
                    <h3 class="block-title text-center">Kelas Terbaru</h3>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="content-grid diskon">
                        <a href="#">
                            <div class="grid-top" style="background-image: url('assets/images/main_picture.jpg');">
                                <div class="grid-title-wrap">
                                    <h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
                                </div><!-- grid-title-wrap -->
                                <div class="diskon-label">
                                    <h3>ADA</h3>
                                    <h5>DISKON</h5>
                                </div>
                            </div><!-- grid-top -->
                        </a>
                        <div class="grid-bottom">
                            <span class="price">Rp 75,000,- /sesi</span>
                            <a href="#"><span class="details">Daftar</span></a>
                            <div class="description">
                                <div class="icon"><i class="fa fa-calendar-o"></i></div>
                                <span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
                            </div><!-- description -->
                            <div class="review">
                                <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                                <span class="tag">kelas ruangguru</span>
                                <div class="rating">
                                    <span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
                                </div>
                            </div>
                        </div><!-- grid-bottom -->
                    </div> <!-- content-grid -->
                </div><!-- col-md-4 col-sm-6 -->
                <div class="col-md-4 col-sm-6">
                    <div class="content-grid">
                        <a href="#">
                            <div class="grid-top" style="background-image: url('assets/images/main_picture.jpg');">
                                <div class="grid-title-wrap">
                                    <h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
                                </div><!-- grid-title-wrap -->
                            </div><!-- grid-top -->
                        </a>
                        <div class="grid-bottom">
                            <span class="price">Rp 75,000,- /sesi</span>
                            <a href="#"><span class="details">Daftar</span></a>
                            <div class="description">
                                <div class="icon"><i class="fa fa-calendar-o"></i></div>
                                <span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
                            </div><!-- description -->
                            <div class="review">
                                <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                                <span class="tag">kelas ruangguru</span>
                                <div class="rating">
                                    <span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
                                </div>
                            </div>
                        </div><!-- grid-bottom -->
                    </div> <!-- content-grid -->
                </div><!-- col-md-4 col-sm-6 -->
                <div class="col-md-4 col-sm-6">
                    <div class="content-grid">
                        <a href="#">
                            <div class="grid-top" style="background-image: url('assets/images/main_picture.jpg');">
                                <div class="grid-title-wrap">
                                    <h3 class="grid-title">Training CodeIgniter: Breaking The Frame[works]</h3>
                                </div><!-- grid-title-wrap -->
                            </div><!-- grid-top -->
                        </a>
                        <div class="grid-bottom">
                            <span class="price">Rp 75,000,- /sesi</span>
                            <a href="#"><span class="details">Daftar</span></a>
                            <div class="description">
                                <div class="icon"><i class="fa fa-calendar-o"></i></div>
                                <span class="date"> 08 Mar 2015 | 17.00 - 19.00 WIB <br> dan <a href="#">5 sesi lainnya</a> | Jakarta Selatan</span>
                            </div><!-- description -->
                            <div class="review">
                                <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                                <span class="tag">kelas ruangguru</span>
                                <div class="rating">
                                    <span class="rating-info"> <i class="fa fa-star"></i><b>4.5</b> dari <b>10</b> review</span>
                                </div>
                            </div>
                        </div><!-- grid-bottom -->
                    </div> <!-- content-grid -->
                </div><!-- col-md-4 col-sm-6 -->
                <div class="col-sm-4 col-sm-offset-4">
                    <a href="#" class="main-button text-center">Lihat Semua Kelas</a>
                </div>
            </div>
        </div>
    </div><!-- related -->
    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="footer-label">Ruangguru.com</h4>
                    <p>Ruangguru adalah sebuah website yang menghubungkan calon murid untuk menemukan calon guru yang berkualitas</p>
                </div>
                <div class="col-sm-5">
                    <div class="footer-link">
                        <a href="">Tentang Kami</a> | <a href="lowongan" class="underline bold">Lowongan</a> | <a href="http://ruangguru.tumblr.com" target="_blank" rel='nofollow'>Blog</a> | <a href="kebijakan_privasi" target="_blank">Kebijakan Privasi</a> | <a href="http://indonesianfutureleaders.org/" target="_blank" rel='nofollow'>Mitra</a> | <a href="kontak_kami" target="_blank" rel='nofollow'>Kontak</a>
                    </div>
                    <div id="footer-addr">
                        <p> PT. Ruang Raya Indonesia </p>
                        <p> Jalan Tebet Raya No. 32 A, Jakarta Selatan, Indonesia - 12820 </p>
                        <p> Ph. +62 21 9200 3040 | e. info@ruangguru.com </p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="footer-about-detail">
                        <span id="socmed-icon">
                        <a href="http://www.facebook.com/ruanggurucom" target="_blank" rel='nofollow'><img src="assets/images/fb-icon.png"/></a>&nbsp;<a href="http://www.twitter.com/ruangguru" target="_blank" rel='nofollow'><img src="assets/images/twitter-icon.png"/></a>&nbsp;<a href="http://ruangguru.tumblr.com" target="_blank" rel='nofollow'><img src="assets/images/tumblr-icon.png"/></a>&nbsp;<a href="http://www.instagram.com/ruangguru" target="_blank" rel='nofollow'><img src="assets/images/insta-icon.png"/></a>
                        </span>
                    </div>
                    <div class="footer-copyright">
                        <p class="text-12">
                             &copy; 2014 <a href="http://ruangguru.com/">Ruangguru.com</a>. All rights reserved.
                        </p>
                    </div><!-- footer-copyright -->
                </div>
                <div class="col-sm-6 text-left">
                </div>
                <div class="col-sm-6 text-right">
                </div>
            </div>
        </div>
    </div><!-- footer -->
    <div class="below-footer">
        <div class="container-fluid">
            <div class="row">
                <ul id="seo-footer" class="list-unstyled">
                    <li>
                        <ul>
                            <li class="head">Semua Guru Privat</li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-selatan/">Guru Privat di Jakarta Selatan</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-timur/">Guru Privat di Jakarta Timur</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-pusat/">Guru Privat di Jakarta Pusat</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-barat/">Guru Privat di Jakarta Barat</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-utara/">Guru Privat di Jakarta Utara</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/banten/tangerang-selatan/">Guru Privat di Tangerang Selatan</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/banten/tangerang/">Guru Privat di Tangerang</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/jawa-barat/bekasi/">Guru Privat di Bekasi</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/jawa-barat/depok/">Guru Privat di Depok</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/jawa-barat/bandung/">Guru Privat di Bandung</a>
                                </li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li class="head">Bahasa</li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-selatan/bahasa-inggris/">Guru B. Inggris di Jakarta Selatan</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-timur/bahasa-inggris/">Guru B. Inggris di Jakarta Timur</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-pusat/bahasa-inggris/">Guru B. Inggris di Jakarta Pusat</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-barat/bahasa-inggris/">Guru B. Inggris di Jakarta Barat</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-utara/bahasa-inggris/">Guru B. Inggris di Jakarta Utara</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/bahasa-mandarin/">Guru B. Mandarin di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/bahasa-jerman/">Guru B. Jerman di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/bahasa-jepang/">Guru B. Jepang di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/bahasa-spanyol/">Guru B. Spanyol di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/bahasa-perancis/">Guru B. Perancis di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/bahasa-arab/">Guru B. Arab di Jakarta</a>
                                </li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li class="head">Matematika</li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-selatan/matematika/">Guru Matematika di Jakarta Selatan</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-timur/matematika/">Guru Matematika di Jakarta Timur</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-pusat/matematika/">Guru Matematika di Jakarta Pusat</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-barat/matematika/">Guru Matematika di Jakarta Barat</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/jakarta-utara/matematika/">Guru Matematika di Jakarta Utara</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/banten/tangerang-selatan/matematika/">Guru Matematika di Tangerang Selatan</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/banten/tangerang/matematika/">Guru Matematika di Tangerang</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/jawa-barat/bekasi/matematika/">Guru Matematika di Bekasi</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/jawa-barat/depok/matematika/">Guru Matematika di Depok</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/jawa-barat/bandung/matematika/">Guru Matematika di Bandung</a>
                                </li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li class="head">Keterampilan</li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/piano/">Guru Piano di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/biola/">Guru Biola di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/gitar/">Guru Gitar di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/programming/">Guru Programming di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/web-design/">Guru Web Design di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/photoshop/">Guru Photoshop di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/renang/">Guru Renang di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/basket/">Guru Basket di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/yoga/">Guru Yoga di Jakarta</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/dki-jakarta/mengaji/">Guru Mengaji di Jakarta</a>
                                </li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li class="head">Lainnya</li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/toefl/">TOEFL</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/ielts/">IELTS</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/un-sd/">UN SD</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/un-smp/">UN SMP</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/un-sma/">UN SMA</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/snmptn/">SNMPTN</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/simak-ui/">SIMAK UI</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/a-level/">A-LEVEL</a>
                                </li>
                                <li>
                                    <a class="normal-link" href="https://ruangguru.com/cari/bahasa-indonesia-penutur-asing/">Indonesian for Foreigners</a>
                                </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div><!-- below-footer -->

    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
