<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta name="keywords" content="guru, cari guru, guru privat, privat, bimbel, guru les, guru bimbel, bimbingan belajar, tutor, guru tambahan, les, bahasa inggris, guru freelance, freelance, guru part-time, guru honor, pengajar muda, guru anak, guru panggilan, guru berprestasi, pelatih, mahasiswa berprestasi" />
	<meta name="robots" content="noarchive">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>images/favicon.png"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/orbit-1.2.3.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/default.css" />
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 1024px)" href="<?php echo base_url(); ?>css/mobile.css" />
	<?php if (isset($css)){foreach($css as $value){?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/<?php echo $value;?>.css?v=20140218" />
	<?php }}?>
	<script type="text/javascript">var base_url="<?php echo base_url();?>";</script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/bantuan.js"></script>
</head>
<body>

<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5RGCZZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5RGCZZ');</script>
<!-- End Google Tag Manager -->

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
						<form action="<?php echo base_url(); ?>cari_guru/result" method="post">
							<div class="search-wrap-unlogin">
								<input type="text" name="nama" id="search-input" placeholder="Masukkan kata kunci pencarian" class="text-11" onclick="searchClick(this)"/>
							</div>
							<div class="search-wrap-button">
								<input id="search-button" type="image" src="<?php echo base_url();?>images/lup.png" />
							</div>
						</form>
						<?php if($this->session->userdata('is_logged_in')):?>
							<div class="welcome-account">
								Hello, <a href="<?php echo base_url();?>guru" class="account-nama"><?php echo $this->session->userdata('guru_nama');?></a>
								&nbsp;|&nbsp;
								<a href="<?php echo base_url();?>guru/logout" class="white-link bold">Logout |</a>
							</div>
						<?php elseif($this->session->userdata('duta_guru_id')):?>
							<div class="welcome-account">
								Hello, <a href="<?php echo base_url();?>duta_guru" class="account-nama"><?php echo $this->session->userdata('duta_guru_nama');?></a>&nbsp;|&nbsp;<a href="<?php echo base_url();?>duta_guru/logout" class="white-link bold">Logout |</a>
							</div>
						<?php elseif($this->session->userdata('murid_id')):?>
							<div class="welcome-account">
								Hello, <a href="<?php echo base_url();?>murid" class="account-nama"><?php echo $this->session->userdata('murid_nama');?></a>
								&nbsp;|&nbsp;<a href="<?php echo base_url();?>murid/logout" class="white-link bold">Logout |</a>
							</div>
						<?php endif;?>
						<div id="header-phone">021-9200-3040 |</div>
						<!--
						<div class="tweet-button">
							<a href="https://twitter.com/ruangguru" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @ruangguru</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						</div>
						<div class="fblike-button">
							<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.ruangguru.com&amp;send=false&amp;layout=button_count&amp;width=90&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=151390271591966" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe>
						</div>
						-->
					</div>
				</div>
				<div id="header-bottom">
					<div class="blank" style="height:10px;"></div>
					<div id="header-bottom-wrap">
						<div class="header-logo">
							<div>
								<a href="<?php echo base_url();?>">
									<img style="height:80px;" src="<?php echo base_url(); ?>images/header-logo.png" />
								</a>
							</div>
						</div>
						<div class="header-nav">
							<?php if(!$this->session->userdata('is_logged_in')):?>
								<div class="nav-wrap">
									<ul id="nav-reg">
										<li>
											<p><a href="https://ruangguru.com/murid">Daftar</a></p>
											<ul>
												<li><a href="https://ruangguru.com/murid">sbg Murid</a></li>
												<li class="menu-btn-reg"><a href="https://ruangguru.com/guru">sbg Guru</a></li>
												<li><a href="https://ruangguru.com/duta">sbg Duta</a></li>
											</ul>
										</li>
									</ul>
								</div>
								<div class="nav-wrap">
									<ul id="nav">
										<li>
											<p><a href="https://ruangguru.com/murid/login">Masuk</a></p>
											<ul>
												<li><a href="https://ruangguru.com/murid/login">sbg Murid</a></li>
												<li class="menu-btn-reg"><a href="https://ruangguru.com/guru/login">sbg Guru</a></li>
												<li><a href="https://ruangguru.com/duta/login">sbg Duta</a></li>
											</ul>
										</li>
									</ul>
								</div>
							<?php endif;?>
							<?php if($this->session->userdata('is_logged_in')):?>
								<a href="<?php echo base_url(); ?>kontak_kami">
									<div class="nav-wrap">
										<p>&nbsp;</p>
									</div>
								</a>
								<a href="<?php echo base_url(); ?>kontak_kami">
									<div class="nav-wrap">
										<p>&nbsp;</p>
									</div>
								</a>
							<?php endif;?>
							<a href="<?php echo base_url(); ?>kontak_kami">
								<div class="nav-wrap">
									<p>Kontak</p>
								</div>
							</a>
							<a href="<?php echo base_url();?>request_guru">
								<div class="nav-wrap">
									<p style="width:115px !important;">Pesan Guru</p>
								</div>
							</a>
							<a href="<?php echo base_url(); ?>cari_guru">
								<div class="nav-wrap">
									<p>Cari Guru</p>
								</div>
							</a>
							<a href="<?php echo base_url(); ?>tentang">
								<div class="nav-wrap">
									<p>Tentang</p>
								</div>
							</a>
							<a href="<?php echo base_url(); ?>">
								<div class="nav-wrap">
									<p>Home</p>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- GOOGLE ANALYTICS -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-49650255-1', 'ruangguru.com');
			ga('send', 'pageview');

		</script>