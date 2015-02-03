<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>Ruangguru :: Belajar apapun dari siapapun</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <link rel="icon" type="image/png" href="<?php echo base_url();?>images/favicon.png"/> 
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/comingsoon.css?v=1" />
        <script type="text/javascript">
            function input(obj){
                if(obj.value == 'Masukkan alamat email Anda'){
                    obj.value = '';
                }
            }
            function update(obj){
                if(obj.value==''){
                    obj.value = 'Masukkan alamat email Anda';
                }
            }
        </script>
    </head>
    <body>
        <div id="main-con">
            <div class="blank" style="height: 50px;"></div>
            <div id="logo-wrapper">
                <!--
                <div id="logo">
                    <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/comingsoon-logo.png"/></a>
                </div>
                <div id="social">
                    <p class="title">Follow Ruangguru.com di:</p>
                    <div class="facebook">
                        <a target="_blank" href="http://www.facebook.com/pages/Ruangguru/192206364209400">
                            <img src="<?php echo base_url();?>images/facebook.png"/>
                        </a>
                    </div>
                    <div class="twitter">
                        <a target="_blank" href="http://www.twitter.com/ruangguru">
                            <img src="<?php echo base_url();?>images/twitter.png"/>
                        </a>
                    </div>
                </div>
                -->
                <div id="video">
                    <iframe id="ytplayer" type="text/html" width="640" height="390" src="http://www.youtube.com/embed/CNoD5xEMYfU?autoplay=0&origin=http://www.ruangguru.com" frameborder="0"></iframe>
                </div>
                <div class="blank" style="height: 10px;"></div>
                <div id="social-hor">
                    <div class="facebook center">
                        <a target="_blank" href="http://www.facebook.com/pages/Ruangguru/192206364209400"><img src="<?php echo base_url();?>images/facebook.png"/></a>
                        <a target="_blank" href="http://www.twitter.com/ruangguru"><img src="<?php echo base_url();?>images/twitter.png"/></a>
                    </div>
                </div>
            </div>
            <div class="blank" style="height: 10px;"></div>
            <?php if($page=="home"):?>
            <div id="comingsoon-title">
                <p>Konsep kreatif yang menawarkan sumber inspirasi dan ilmu akan segera hadir untuk para guru dan murid Indonesia.</p>
            </div>
            <div id="daftar-title">
                <p>Daftarkan email Anda untuk mendapatkan berita terbaru mengenai perkembangan dan launching Ruangguru.com</p>
            </div>
            <div id="daftar-wrapper">
                <div id="daftar-box">
                    <form action="<?php echo base_url();?>main/submit_email" method="post">
                        <div id="daftar-box-input">
                            <input type="email" name="email" value="Masukkan alamat email Anda" onchange="update(this)" onclick="input(this)"/>
                        </div>
                        <div id="daftar-box-submit">
                            <input type="image" src="<?php echo base_url();?>images/daftar-comingsoon-button.png"/>
                        </div>
                    </form>
                </div>
                <div id="daftar-comment">
                    <p>*Jangan khawatir, kerahasiaan email Anda aman bersama kami.</p>
                </div>
            </div>
            <?php elseif($page=="success"):?>
            <div id="comingsoon-title">
                <p>Terima kasih, kami akan segera mengirimkan email kepada anda ketika Ruangguru.com telah resmi diluncurkan</p>
            </div>
            <?php elseif($page=="failed"):?>
            <div id="comingsoon-title">
                <p>Maaf email anda sudah terdaftar, kami akan segera mengirimkan email kepada anda ketika Ruangguru.com telah resmi diluncurkan</p>
            </div>
            <?php endif;?>
        </div>
    </body>
</html>
