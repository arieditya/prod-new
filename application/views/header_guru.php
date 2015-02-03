<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Ruangguru :: Belajar apapun dari siapapun</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <link rel="icon" type="image/png" href="<?php echo base_url();?>images/favicon.png"/> 
        <link href='http://fonts.googleapis.com/css?family=Fauna+One' rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/orbit-1.2.3.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/default.css" />
        <?php if (isset($css)){foreach($css as $value){?>
            <link rel="stylesheet" href="<?php echo base_url(); ?>css/<?php echo $value;?>.css" />
        <?php }}?>
        <script type="text/javascript">var base_url="<?php echo base_url();?>";</script>
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery-migrate-1.2.1.min.js"></script>
    </head>
    <body>
        <script type="text/javascript">
            function searchClick(obj){
                if($(obj).val()=='masukkan nama guru'){
                    $(obj).val("");
                }
            }
        </script>
        <div id="main-con">
            <div id="header">
                <div id="header-wrap">
                    <div id="header-top">
                        <div id="header-top-wrap">
                            <div class="search-wrap">
                                <div class="search-box">
                                <form>
                                    <input type="text" name="search" id="search-input" value="masukkan nama guru" onclick="searchClick(this)"/>
                                    <input id="search-button" type="image" src="<?php echo base_url();?>images/search-button.png" />
                                </form>
                                    </div>
                            </div>
                            <div class="welcome-account">
                                Selamat datang, <a href="<?php echo base_url();?>guru" class="account-nama"><?php echo $this->session->userdata('guru_nama');?></a>!&nbsp;&nbsp;&nbsp; | <a href="<?php echo base_url();?>guru/logout">Logout</a>
                            </div>
                        </div>
                    </div>
                    <div id="header-bottom">
                        <div class="blank" style="height:10px;"></div>
                        <div id="header-bottom-wrap">
                            <div class="header-logo-guru">
                                <div>
                                    <a href="<?php echo base_url();?>">
                                        <img style="height:100px;" src="<?php echo base_url(); ?>images/header-logo.png" />
                                    </a>
                                </div>
                                <div class="header-tagline">
                                    "Belajar apapun dari siapapun"
                                </div>
                            </div>
                            <div class="header-nav">
                                <a href="<?php echo base_url(); ?>kontak_kami">
                                    <div class="nav-wrap">
                                        <p>KONTAK KAMI</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url(); ?>bantuan">
                                    <div class="nav-wrap">
                                        <p>BANTUAN</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url(); ?>blog">
                                    <div class="nav-wrap">
                                        <p>BLOG</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="nav-wrap">
                                        <p>RANKING</p>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="nav-wrap">
                                        <p>MURID</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url(); ?>guru/request">
                                    <div class="nav-wrap">
                                        <p>REQUEST</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url(); ?>guru">
                                    <div class="nav-wrap">
                                        <p>AKUN SAYA</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>