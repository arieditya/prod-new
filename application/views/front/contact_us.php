<html>
<head>
<title>Pertanyaan? Keluhan? Kerjasama? Hubungi Ruangguru Disini.</title>
<meta name="description" content="Ada pertanyaan seputar Ruangguru dan mekanisme murid dan guru didalamnya? Atau ingin melakukan kerjasama dengan Ruangguru? Hubungi Tim Ruangguru disini." />
<link rel="canonical" href="http://www.ruangguru.com/kontak_kami" />
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/validation.css" type="text/css" media="all" />
<script>
    $(document).ready(function(){
        $("#contact-us-form").validationEngine('attach');
	   });
</script>
<script type="text/javascript">
    function close_overlay(){
        $("#default-overlay").hide();
        $("#overlayed-content").hide();
    }
</script>

<!--  FBX -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '583152025127396']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=583152025127396&amp;ev=NoScript" /></noscript>


</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="contact-us">
        <table>
            <tr>
                <td>
                    <div id="contact-form">
                        <div id="contact-form-header">
                            <div id="contact-form-header-wrap">
                               <h3><span class="text-20">KONTAK</span></h3>
                            </div>
                        </div>
                        <div id="contact-form-content">
                            <div class="blank" style="height: 20px;"></div>
					   <?php if ($this->session->flashdata('request_notification')): ?>
                                    <div id="contact-red-notif">
                                        <p class="red-notif">
                                            <?php echo $this->session->flashdata('request_notification'); ?>
                                        </p>
                                    </div>
                            <?php endif; ?>
                            <div class="cfc-wrap">
                                <form id="contact-us-form" method="post" action="<?php echo base_url();?>kontak_kami/send_email">
                                    <div class="cfcf-top">
                                        Apabila terdapat pertanyaan seputar Ruangguru, silahkan kirimkan pertanyaan Anda melalui pengisian form di bawah ini.
                                    </div>
                                    <div class="cfcf-cat">
                                        <p class="text-13">Kategori <span class="red-notif">*</span></p>
                                        <p><input type="radio" name="kategori" value="Layanan Konsumen" tabindex="1" checked/> Layanan Konsumen <input type="radio" name="kategori" value="Penawaran Kerjasama" tabindex="2"/> Penawaran Kerjasama <input type="radio" name="kategori" value="Media" tabindex="3"/> Media <input type="radio" name="kategori" value="Lainnya" tabindex="4"/> Lainnya</p><br/>
                                    </div>
                                    <div class="cfcf-detail">
                                        <div class="cfcf-left">
                                            <p class="text-13">Nama <span class="red-notif">*</span></p>
                                            <p><input class="validate[required] text" type="text" name="nama" /></p>
                                            <p class="text-13">Email <span class="red-notif">*</span></p>
                                            <p><input class="validate[required,custom[email]] text" type="text" name="email"/></p>
                                        </div>
                                        <div class="cfcf-right">
                                            <p class="text-13">Telepon <span class="red-notif">*</span> </p>
                                            <p><input class="validate[required,custom[phone]] text" type="text" name="telepon"/></p>
                                            <p class="text-13">Subjek <span class="red-notif">*</span> </p>
                                            <p><input class="validate[required] text" type="text" name="subject"/></p>
                                        </div>
                                    </div>
                                    <div class="cfcf-q">
                                        <p class="text-13">Pesan/ Pertanyaan <span class="red-notif">*</span></p>
                                        <p><textarea name="question" class="validate[required]"></textarea></p>
                                    </div>
                                    <div class="cfcf-chaptcha">
                                        <p>Masukkan kode keamanan yang tertera di bawah ini <span class="red-notif">*</span></p>
                                        <p><?php echo $this->recaptcha->get_html();?></p>
                                    </div>
                                    <div class="cfcf-submit">
                                        <input type="image" src="<?php echo base_url(); ?>images/kirim-button.png"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <?php $this->load->view('front/layout/contact');?>
                    <div class="blank" style="height: 20px;"></div>
                    <div class="social-side-box">
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fruanggurucom&amp;width=300&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false&amp;appId=151390271591966" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:290px;" allowTransparency="true"></iframe>
                    </div>
                    <div class="blank" style="height: 20px;"></div>
                </td>
            </tr>
        </table>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</body>
</html>