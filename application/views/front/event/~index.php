<<<<<<< .
<html>
<head>
<title>Ruangguru.com</title>
<meta name="description" content="Butuh guru privat untuk bimbingan belajar pelajaranmu? Ruangguru punya banyak guru kursus berpengalaman yang bisa kamu request berdasarkan posisi, rate, dan lainnya." />
<link rel="canonical" href="http://www.ruangguru.com/cari_guru" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.alerts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/cariguru.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
     $(document).ready(function(){
        update_matpel();
        update_provinsi();
    }); 
    
    $(document).ready(function(){
		$("#registrasi-event-form").validationEngine('attach');
	}); 
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
    <div class="blank" style="height:20px;"></div>
    <div id="event-detail">
        <div id="cariguru-header"><?php //print_r($this->session->userdata);?>
            <div id="event-header-wrap">
                <h2><span class="text-20">OPEN HOUSE RUANGGURU.COM - HQ</span></h2>
            </div>
        </div>
        <div id="event-content">
		    <div class="blank" style="height:20px"></div>
		    <p class="text-14 left">Sejak memperoleh investasi dari <a href="http://www.techinasia.com/indonesia-jakarta-ruangguru-belva-devara-iman-usman-east-ventures-seed-funding-investment/" class="normal-link" target="_blank">East Ventures</a>, Ruangguru.com telah berkembang dengan signifikan. Kini Ruangguru.com telah didukung oleh 5000+ guru yang tersebar di berbagai daerah di Indonesia. Kami juga akan segera meluncurkan beberapa produk serta fitur baru di website. Tidak ketinggalan, Ruangguru.com kini juga telah memiliki Ruangguru.com HQ yang akan menjadi pusat aktivitas belajar dan mengajar bagi anggota komunitas Ruangguru.</p>
		    <p class="text-14 left">Untuk itu, kami ingin berbagi informasi gembira ini kepada Anda - pengguna loyal Ruangguru.com - dengan mengundang Anda untuk hadir dalam:</p>
		    <p class="text-14 center bold">
				Open House<br/>
				Ruangguru.com HQ
		    </p>
		    <img src="<?php echo base_url().'images/OH putih file kecil C.jpg';?>"/>
		    <p class="text-14 left">Semua upaya ini kami lakukan sebagai bentuk komitmen kami untuk mendukung aktivitas belajar dan mengajar Anda di Ruangguru. Kami ucapkan terima kasih atas segala dukungan yang telah diberikan.</p>
		    <p class="text-14 left">Sampai jumpa di Ruangguru.com HQ tanggal 21 Oktober 2014 nanti!</p>
		    <p class="text-14 left">
				Salam,<br/><br/>
				Community Relations<br/>
				Ruangguru.com
		    </p>
		    <div class="blank" style="height:40px"></div>
		    <p class="left bold">FORM REGISTRASI OPEN HOUSE RUANGGURU HQ</p>
		    <form id="registrasi-event-form" class="guru-form" action="<?php //echo base_url();?>event/registrasi" method="post">
                    <table cellpadding="5">
                        <tr>
                            <td style="width: 250px;" class="left text-14">Nama<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="nama" name="nama" type="text" class="validate[required] text"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="left text-14">No. Telepon<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="telp" name="telp" type="text" class="validate[required,custom[onlyNumberSp]] text" />
                            </td>
                        </tr>
                        <tr>
                            <td class="left text-14">Email<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="email" name="email" type="text" class="validate[required,custom[email]]  text" />
                            </td>
                        </tr>
				    <tr>
                            <td class="left text-14">Institusi</td>
                            <td>
                                <input id="institusi" name="institusi" type="text" class="text" />
                            </td>
                        </tr>
				    <tr>
                            <td class="left text-14">Terdaftar di Ruangguru sebagai</td>
                            <td>
                                <input class="radio" name="rg_status" type="radio" value="1" checked/> <span class="text-13">Guru</span>
                                <input class="radio" name="rg_status" type="radio" value="2"/> <span class="text-13">Murid</span>
                                <input class="radio" name="rg_status" type="radio" value="3"/> <span class="text-13">Duta</span>
                                <input class="radio" name="rg_status" type="radio" value="4"/> <span class="text-13">Umum</span>
                            </td>
                        </tr>
				    <tr>
                            <td class="left text-14">Apakah Anda ingin mengikuti Coaching Clinic?</td>
                            <td class="left">&nbsp;&nbsp;&nbsp;
                                <input class="radio" name="coaching" type="radio" value="1" checked/> <span class="text-13">Ya</span>
                                <input class="radio" name="coaching" type="radio" value="0"/> <span class="text-13">Tidak</span>
                            </td>
                        </tr>
				    <tr>
						<td class="text-12 left" colspan="2"><span class="red-notif">*</span> Wajib diisi</td>
				    </tr>
				    	<tr>
						<td class="text-12 left" colspan="2"><span class="red-notif">**</span> Coaching Clinic terbatas untuk 30 orang</td>
				    </tr>
				    <tr>
                            <td colspan="2">
                                <p class="left text-14">Masukkan kode keamanan yang tertera dibawah ini<span class="red-notif text-16"> *</span></p>
                                <p>
                                    <?php echo $this->recaptcha->get_html();?>
                                </p>
                            </td>
                        </tr>
				    <tr>
						<td class="left"><input type="image" src="<?php echo base_url();?>images/daftar-button-big.png"/></td>
				    </tr>
                    </table>
                </form>
	    </div>
	</div>
	<div class="blank" style="height:40px"></div>
 </div>
</body>
=======
<html>
<head>
<title>Ruangguru.com</title>
<meta name="description" content="Butuh guru privat untuk bimbingan belajar pelajaranmu? Ruangguru punya banyak guru kursus berpengalaman yang bisa kamu request berdasarkan posisi, rate, dan lainnya." />
<link rel="canonical" href="http://www.ruangguru.com/cari_guru" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.alerts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/cariguru.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
     $(document).ready(function(){
        update_matpel();
        update_provinsi();
    }); 
    
    $(document).ready(function(){
		$("#registrasi-event-form").validationEngine('attach');
	}); 
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
    <div class="blank" style="height:20px;"></div>
    <div id="event-detail">
        <div id="cariguru-header"><?php //print_r($this->session->userdata);?>
            <div id="event-header-wrap">
                <h2><span class="text-20">OPEN HOUSE RUANGGURU.COM - HQ</span></h2>
            </div>
        </div>
        <div id="event-content">
		    <div class="blank" style="height:20px"></div>
		    <p class="text-13 left">Sejak memperoleh investasi dari <a href="http://east.vc/" class="normal-link" target="_blank">East Ventures</a>, Ruangguru.com telah berkembang dengan signifikan. Kini Ruangguru.com telah didukung oleh 5000+ guru yang tersebar di berbagai daerah di Indonesia. Kami juga akan segera meluncurkan beberapa produk serta fitur baru di website. Tidak ketinggalan, Ruangguru.com kini juga telah memiliki Ruangguru.com HQ yang akan menjadi pusat aktivitas belajar dan mengajar bagi anggota komunitas Ruangguru.</p>
		    <p class="text-14 left">Untuk itu, kami ingin berbagi informasi gembira ini kepada Anda - pengguna loyal Ruangguru.com - dengan mengundang Anda untuk hadir dalam:</p>
		    <p class="text-14 center bold">
				Open House<br/>
				Ruangguru.com HQ
		    </p>
		    <img src="<?php echo base_url().'images/OH putih file kecil C.jpg';?>"/>
		    <p class="text-13 left">Semua upaya ini kami lakukan sebagai bentuk komitmen kami untuk mendukung aktivitas belajar dan mengajar Anda di Ruangguru. Kami ucapkan terima kasih atas segala dukungan yang telah diberikan.</p>
		    <p class="text-13 left">Sampai jumpa di Ruangguru.com HQ tanggal 21 Oktober 2014 nanti!</p>
		    <p class="text-13 left">RSVP:  Silahkan isikan form registrasi di bawah ini</p>
		    <p class="text-13 left">Pendaftaran paling lambat tanggal 17 Oktober 2014</p>
		    <p class="text-13 left">
				Salam,<br/><br/>
				Community Relations<br/>
				Ruangguru.com
		    </p>
		    <div class="blank" style="height:40px"></div>
		    <p class="left bold">FORM REGISTRASI OPEN HOUSE RUANGGURU HQ</p>
		    <form id="registrasi-event-form" class="guru-form" action="<?php echo base_url();?>event/registrasi" method="post">
                    <table cellpadding="5">
                        <tr>
                            <td style="width: 250px;" class="left text-14">Nama<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="nama" name="nama" type="text" class="validate[required] text"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="left text-14">No. Telepon<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="telp" name="telp" type="text" class="validate[required,custom[onlyNumberSp]] text" />
                            </td>
                        </tr>
                        <tr>
                            <td class="left text-14">Email<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="email" name="email" type="text" class="validate[required,custom[email]]  text" />
                            </td>
                        </tr>
				    <tr>
                            <td class="left text-14">Institusi</td>
                            <td>
                                <input id="institusi" name="institusi" type="text" class="text" />
                            </td>
                        </tr>
				    <tr>
                            <td class="left text-14">Terdaftar di Ruangguru sebagai</td>
                            <td>
                                <input class="radio" name="rg_status" type="radio" value="1" checked/> <span class="text-13">Guru</span>
                                <input class="radio" name="rg_status" type="radio" value="2"/> <span class="text-13">Murid</span>
                                <input class="radio" name="rg_status" type="radio" value="3"/> <span class="text-13">Duta</span>
                                <input class="radio" name="rg_status" type="radio" value="4"/> <span class="text-13">Umum</span>
                            </td>
                        </tr>
				    <tr>
                            <td class="left text-14">Apakah Anda ingin mengikuti Coaching Clinic?</td>
                            <td class="left">&nbsp;&nbsp;&nbsp;
                                <input class="radio" name="coaching" type="radio" value="1" checked/> <span class="text-13">Ya</span>
                                <input class="radio" name="coaching" type="radio" value="0"/> <span class="text-13">Tidak</span>
                            </td>
                        </tr>
				    <tr>
						<td class="text-12 left" colspan="2"><span class="red-notif">*</span> Wajib diisi</td>
				    </tr>
				    	<tr>
						<td class="text-12 left" colspan="2"><span class="red-notif">**</span> Coaching Clinic terbatas untuk 30 orang</td>
				    </tr>
				    <tr>
                            <td colspan="2">
                                <p class="left text-14">Masukkan kode keamanan yang tertera dibawah ini<span class="red-notif text-16"> *</span></p>
                                <p>
                                    <?php echo $this->recaptcha->get_html();?>
                                </p>
                            </td>
                        </tr>
				    <tr>
						<td class="left"><input type="image" src="<?php echo base_url();?>images/daftar-button-big.png"/></td>
				    </tr>
                    </table>
                </form>
	    </div>
	</div>
	<div class="blank" style="height:40px"></div>
 </div>
</body>
>>>>>>> .r88
</html>