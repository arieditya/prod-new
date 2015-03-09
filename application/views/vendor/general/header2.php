<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/26/15
 * Time: 1:56 PM
 * Proj: prod-new
 */
	$logo = 'header-logo.png';
	if(strpos($_SERVER['HTTP_HOST'], 'kelas') !== FALSE )
		$logo = 'kelas-logo-beta.png';
		;

?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="/images/favicon.png">

		<title>Ruang Guru</title>

	<!-- Bootstrap core CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'.'?>/assets/css/bootstrap.new.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'.'?>/assets/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'.'?>/css/jquery.fancybox.css" media="screen"/>

		<!-- Custom styles for this template -->
		<link href="<?php echo base_url().'.'?>/assets/css/style.css" rel="stylesheet">

	</head>
<!--  -->
	<script type="application/javascript" src="<?php echo base_url().'.'?>/assets/js/jquery-2.1.1.min.js"></script>
	<script type="application/javascript" src="<?php echo base_url().'.'?>/assets/js/bootstrap.min.js"></script>
	<script type="application/javascript" src="<?php echo base_url().'.'?>/js/jquery.fancybox.js"></script>
	<script type="application/javascript" src="<?php echo base_url().'.'?>/js/jquery.fancybox-media.js?v=1.0.6"></script>
	<script type="application/javascript" src="<?php echo base_url().'.'?>/assets/js/utility.js"></script>
	<script type="application/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox();
	})
	</script>
	<body class="have-bar">

	<!-- Fixed navbar -->
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="row">
				<div class="navbar-header">
					<a class="navbar-brand visible-xs" href="#">
						<img src="<?php echo base_url().'./images/'.$logo;?>" height="60">
					</a>
<?php if(!empty($show_filter) && $show_filter): ?>
					<button type="button" 
							class="filter-toggle collapsed visible-xs" 
							data-toggle="collapse" 
							data-target="#list-orange" 
							aria-expanded="false" 
							aria-controls="navbar">
						Filter
					</button>
<?php endif; ?>
<?php if(!empty($show_vendor_menu) && in_array($show_vendor_menu, array('profile','class','add_new'))):?>
					<button type="button" 
							class="filter-toggle collapsed visible-xs" 
							data-toggle="collapse" 
							data-target="#list-orange" 
							aria-expanded="false" 
							aria-controls="navbar">
						Menu
					</button>
<?php endif; ?>
					<button type="button" 
							class="navbar-toggle collapsed" 
							data-toggle="collapse" 
							data-target="#navbar" 
							aria-expanded="false" 
							aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand hidden-xs" href="#">
						<img src="<?php echo base_url();?>images/<?php echo $logo;?>" height="60">
					</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<button data-target=".navbar-collapse" 
							data-toggle="collapse" 
							class="close-toggle visible-xs" 
							type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<ul class="nav navbar-nav navbar-left">
						<li><a href="<?php echo base_url()?>cari_guru">Belajar Privat</a></li>
						<li class="active"><a href="http://kelas.ruangguru.com">Kelas Berkelompok</a></li>
						<li><a href="#FAQ">FAQ</a></li>
						<li><a href="#contact">Kontak</a></li>
					</ul>
<?php
	if(empty($is_login) || !$is_login): // Not logged in
?>
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
									<a class="fancybox" href="#inline2">sbg Vendor</a>
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
<!-- Fancy Log -->
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

<?php
	else: // logged in
?>
					<ul class="nav navbar-nav navbar-right">
						<li class="user-login">
							Hello, <a href="<?php echo base_url()?>vendor/profile">kelas</a>
						</li>
						<li class="sign-out">
							<a href="#">Sign Out</a>
						</li>
					</ul>
<?php
	endif;
?>
				</div><!--/.nav-collapse -->
			</div>
		</div>
<?php if(!empty($show_filter) && $show_filter): ?>
		<div class="below-nav">
			<div class="container">
				<div class="row list-orange collapse" id="list-orange">
					<button data-target=".list-orange" 
							data-toggle="collapse" 
							class="close-toggle visible-xs" 
							type="button">
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
								<select class="form-control level input-sm">
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
								<select class="form-control propinsi input-sm">
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
								<select class="form-control kategori input-sm">
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
<?php endif;?>
<?php if(!empty($show_vendor_menu) && in_array($show_vendor_menu, array('profile','class','add_new'))):?>
		<div class="below-nav">
			<div class="container">
			<div class="row list-orange collapse" id="list-orange">
				<button data-target=".list-orange" data-toggle="collapse" class="close-toggle visible-xs" type="button">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="col-sm-12">
					<ul class="nav nav-pills">
						<li>
							<a href="#" class="button-nav-top <?php echo $show_vendor_menu=='profile'?'active':'';?>">
								Profil Anda
							</a>
						</li>
						<li>
							<a href="#" class="button-nav-top <?php echo $show_vendor_menu=='class'?'active':'';?>">
								Kelas Anda
							</a>
						</li>
						<li>
							<a href="#" class="button-nav-top <?php echo $show_vendor_menu=='add_new'?'active':'';?>">
								Tambah Kelas
							</a>
						</li>
					</ul>
					<ul class="sort nav">
						<li class="title-filter sort-list"><i class="fa fa-phone"></i> 021-9200-3040 </li>
					</ul>
				</div>
			</div>
			</div>
		</div><!-- below-nav -->
<?php endif;?>
	</nav>
