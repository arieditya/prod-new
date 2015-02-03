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
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="application/javascript">
	var base_url = "<?php echo base_url() ?>";
</script>
<script>
	$(document).ready(function() {
		$('.fancybox').fancybox();
	})
</script>
<body>
<header>
				<!--<ul class="nav navbar-nav navbar-right">
					<li id="nav-ph-office">
						<?php //if($is_login){ ?><span>Hello, <a href="<?php //echo base_url();?>vendor/profile/edit"><strong><?php //echo $this->data['user']['name']?></strong></a> | <a href="<?php //echo base_url();?>vendor/auth/logout" class="bold">Log out </a>| </span><?php //} ?><span class="bold white text-16">021-9200-3040 |&nbsp;</span>
					</li>
					<li id="nav-search">
						<div class="input-group" style="max-width: 250px;">
							<input type="text" placeholder="Masukkan kata kunci pencarian" class="form-control italic text-13" />
							<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
						</div>
					</li>
				</ul>-->
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
					<li>
						<h2><a href="<?php echo base_url();?>kelas">Kelas</a></h2>
					</li>
					<li>
						<h2><a href="http://ruangguru.com">Guru Privat</a></h2>
					</li>
					<li>
						<h2><a href="<?php echo base_url();?>faq">Kebijakan</a></h2>
					</li>
					<li>
						<h2><a href="<?php echo base_url();?>kontak">Kontak</a></h2>
					</li>
<?php
	if(!$is_login):
?>
					<li class="pull-right pos-logreg">
						<ul id="nav-reg">
							<li>
								<p><a href="https://ruangguru.com/murid/login" >Daftar</a></p>
								<ul>
									<li><a href="https://ruangguru.com/murid/registrasi">sbg Murid</a></li>
									<li><a href="https://ruangguru.com/guru/reg_guru">sbg Guru</a></li>
									<li><a class="fancybox" href="#inline-reg">sbg Vendor</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="pull-right pos-logreg">
						<ul id="nav">
							<li>
								<p><a href="#">Sign In</a></p>
								<ul>
									<li><a class="fancybox" href="#inline1">sbg Murid</a></li>
									<li><a class="fancybox" href="#inline3">sbg Guru</a></li>
									<li><a class="fancybox" href="#inline2">sbg Vendor</a></li>
								</ul>
							</li>
						</ul>
					</li>
<?php
	else:
?>
					<li class="pull-right">
						<p><a href="<?php echo base_url().'vendor/auth/logout';?>" class="manage-icon text-18 bold">Sign Out</a></p>
					</li>
					<li class="pull-right pos-logreg">
						<h2>Hello,<br/><a href="<?php echo base_url();?>vendor/profile/edit" class="pink"><?php echo $this->data['user']['name'];?></a></h2>
					</li>
<?php
	endif;
?>
				</ul>
			</div>
			<div id="inline1" style="width:400px;display: none;">
				<p class="text-14 bold">Sign In sebagai Murid</p>
				<form id="login_form_murid" name="login_form_murid" method="post" action="https://ruangguru.com/murid/login_submit">
					<p>
						<label for="login_name">Login: </label>
						<input type="email" class="form-control" id="email" name="email" placeholder="emailanda@email.com" />
					</p>
					<p>
						<label for="login_pass">Password: </label>
						<input type="password" class="form-control" id="password" name="password" />
					</p>
					<p>
						<button type="submit" class="btn btn-success btn-lg">Sign In</button>
					</p>
				</form>
			</div>
			<div id="inline2" style="width:400px;display: none;">
				<p class="text-14 bold">Sign In sebagai Vendor</p>
				<form id="login_form" name="login_form" method="post" action="<?php echo base_url().'vendor/auth/do_login';?>">
					<p>
						<label for="login_name">Login: </label>
						<input type="email" class="form-control" id="login_email" name="email" placeholder="emailanda@email.com" />
					</p>
					<p>
						<label for="login_pass">Password: </label>
						<input type="password" class="form-control" id="login_password" name="password" />
					</p>
					<p>
						<button type="submit" class="btn btn-success btn-lg">Sign In</button>
					</p>
				</form>
			</div>
			<div id="inline3" style="width:400px;display: none;">
				<p class="text-14 bold">Sign In sebagai Guru</p>
				<form id="login_form_murid" name="login_form_murid" method="post" action="https://ruangguru.com/guru/login_submit">
					<p>
						<label for="login_name">Login: </label>
						<input type="email" class="form-control" id="email" name="email" placeholder="emailanda@email.com" />
					</p>
					<p>
						<label for="login_pass">Password: </label>
						<input type="password" class="form-control" id="password" name="password" />
					</p>
					<p>
						<button type="submit" class="btn btn-success btn-lg">Sign In</button>
					</p>
				</form>
			</div>
			<div id="inline-reg" class="col-md-4" style="width:500px;display: none;height:100%;overflow-x:hidden;">
				<p class="text-14 bold">Daftar sebagai Vendor</p>
				<form class="form-horizontal" role="form" action="<?php echo base_url();?>vendor/auth/do_register" method="POST">
					<div class="alert alert-danger">* semua field wajib diisi</div>
					<div class="form-group">
						<label for="email" class="col-md-2 control-label">Email</label>
						<div class="col-md-10">
							<input type="email" class="form-control" id="register_email" name="email" placeholder="emailanda@email.com" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-md-2 control-label">Password</label>
						<div class="col-md-10">
							<input type="password" class="form-control" id="register_password" name="password" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label for="confirm_password" class="col-md-2 control-label">Ulangi password</label>
						<div class="col-md-10">
							<input type="password" class="form-control" id="register_confirm_password" name="confirm_password" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label for="vendor_name" class="col-md-2 control-label">Nama</label>
						<div class="col-md-10">
							<input type="text" class="form-control" id="register_vendor_name" name="vendor_name" placeholder="Nama Anda atau nama instansi" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label for="vendor_phone" class="col-md-2 control-label">Telp</label>
						<div class="col-md-10">
							<input type="text" class="form-control" id="register_vendor_phone" name="vendor_phone" placeholder="contoh: (021) 765 4321" required="required" />
						</div>
					</div>
					<div class="form-group">
						<label for="vendor_address" class="col-md-2 control-label">Alamat</label>
						<div class="col-md-10">
							<textarea class="form-control" rows="5" id="register_vendor_address" name="vendor_address" placeholder="Jl. Tebet Raya No. 32A
Tebet - Jakarta Pusat" required="required" ></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn btn-success btn-lg">Daftar</button>&nbsp;&nbsp;
							<button type="reset" class="btn btn-danger btn-sm">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</nav>
	</div>
</header>
<!-- Page Container Begin -->
