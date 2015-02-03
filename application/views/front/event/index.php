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
                <h2><span class="text-20">Essential Skills Series Vol. 03</span></h2>
            </div>
        </div>
        <div id="event-content">
		    <div class="blank" style="height:20px"></div>
		    <p class="text-14 left">Everybody tells you that an application should be prepared well - either you apply to your dream job, grad school, or exchange program; but nobody tells you how. Everybody tells you that networking is important; but nobody tells you how. Don't worry, because we will. Learn how to: </p>
				<ul class="text-14 left">
					<li>Prepare a winning CV & Cover Letter;</li>
					<li>Improve your networking skill;</li>
					<li>Win an opportunity to work or join Ruangguru.com's first ever Apprentice Program</li>
				</ul>
			<br/>
		    <img src="<?php echo base_url().'images/Poster HiringEvent ITB-03.png';?>" width="900px"/>
			<p class="text-14 left"><span class="underline bold">Speaker:</span><br/>
			<span class="bold">Iman Usman</span><br/>
			CEO of Ruangguru.com<br/>
			<ul class="text-14 left">
				<li>Won National Best Student Award in 2012</li>
				<li>Founded Ruangguru.com; Indonesian Future Leaders; & Indonesian Youth Parliament</li>
				<li>Granted full scholarship at Columbia University</li>
				<li>Granted other scholarship and fellowship to 15+ countries</li>
			</ul>
			</p>
			<p class="left text-14"><span class="bold">When and Where</span><br/>
				Friday, February 13th 2015<br/>
				3pm - 6pm<br/>
				Auditorium SBM ITB, 2nd Floor<br/>
			</p>
			<p class="left text-14"><span class="bold">Info</span><br/>
				<span class="underline blue-text">021-9200-3040</span> | <span class="underline blue-text">event@ruangguru.com</span>
			</p>
		    <div class="blank" style="height:40px"></div>
		    <p class="left bold">Form Registrasi Essential Skills Series Vol. 03</p>
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
						<td class="text-12 left" colspan="2"><span class="red-notif">*</span> Wajib diisi</td>
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
</html>