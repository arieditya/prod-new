<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/8/14
 * Time: 1:05 PM
 * Proj: private-development
 */
$is_login = FALSE;
if(!empty($this->data['user']) && $this->data['user']['type'] == 'vendor' && !empty($this->data['user']['id'])) $is_login = TRUE;
?><!DOCTYPE html>
<html>
<head>
	<title>Ruangguru.com<?php echo empty($title)?'':(' - '.$title)?></title>
</head>
<!-- Insert Initial/Loader JS here -->
<link rel="icon" type="image/png" href="<?php echo base_url();?>images/favicon.png" />
<script type="application/javascript" src="<?php echo base_url();?>assets/js/jquery-2.1.1.min.js"></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/vendor-default.css" rel="stylesheet" />
<script type="application/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
<body>
<header class="navbar navbar-fixed-top navbar-blue">
	<div class="container">
		<nav class="navbar-collapse collapse">
			<div class="white-navbar">
				<ul class="nav navbar-nav navbar-right">
					<li id="nav-ph-office">
						<?php if($is_login){ ?><span>Hello, <a href="<?php echo base_url();?>vendor/profile/edit"><strong><?php echo $this->data['user']['name']?></strong></a> | <a href="<?php echo base_url();?>vendor/auth/logout" class="bold">Log out </a>| </span><?php } ?><span class="bold white text-16">021-9200-3040 |&nbsp;</span>
					</li>
					<li id="nav-search">
						<div class="input-group" style="max-width: 250px;">
							<input type="text" placeholder="Masukkan kata kunci pencarian" class="form-control italic text-13" />
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</header>
<!-- export PS1="\[\033[0m\]\[\033[32m\]\u@\h \[\033[0m\]\[\033[33m\]\W\n\$ \[\033[0m\]\[\033[37m\]" --!-->
<header class="navbar navbar-fixed-top navbar-white white-navbar">
	<div class="container">
		<nav class="navbar-collapse collapse">
			<div class="white-navbar">
				<ul class="nav navbar-nav navbar-left">
					<li>
						<img src="<?php echo base_url();?>images/header-logo.png" height="80">
					</li>
					<li>
						<h2><a href="<?php echo base_url();?>vendor/main">Home</a></h2>
					</li>
<?php
	if(!$is_login):
?>
					<li>
						<h2><a href="<?php echo base_url();?>vendor/auth/logreg">Login/Daftar</a></h2>
					</li>
<?php 
	else:
?>
					<li>
						<h2><a href="<?php echo base_url();?>vendor/kelas/baru">Tambah Kelas Baru</a></h2>
					</li>
					<li>
						<h2><a href="<?php echo base_url();?>vendor/kelas/daftar">Daftar Kelas Anda</a></h2>
					</li>
					<li>
						<h2><a href="<?php echo base_url();?>vendor/profile/edit">Profil Anda</a></h2>
					</li>
				</ul>
<?php 
	endif;
?>
				</ul>
			</div>
		</nav>
	</div>
</header>
<div class="grey-navbar">
	<?php //if(){ ?>
	<!--<ul id="step-in-class">
		<li><span class="bg-step">1</span><span class="text-step">Galeri Kelas</span></li>
		<li><span class="bg-step">2</span><span class="text-step">Kelas Pilihan</span></li>
		<li><span class="bg-step">3</span><span class="text-step">Pembayaran</span></li>
	</ul>-->
	<?php //} ?>
</div>
<?php 
//	$large_header = TRUE;
/*
	if(!empty($large_header)): 
?>
<header class="bs-header">

	<div class="container" >
		<img src="<?php echo base_url();?>images/header-logo.png" class="img-responsive" style="height: 100px; display: inline-block;" />
	</div>

</header>
<?php 
	else: 
?>
<header class="sm-header">
	<div class="container">
		<img src="<?php echo base_url();?>images/header-logo.png" class="img-responsive" style="height: 75px; display: inline-block" />
		<h1 style="display: inline-block">ruangguru.com</h1>
	</div>
</header>
<?php 
	endif; 
// */
?>
<!-- Page Container Begin -->
<div class="container">
