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
	$have_bar = FALSE;
	if(!empty($show_filter) && $show_filter || !empty($show_vendor_menu))
		$have_bar = TRUE;
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
	<script type="application/javascript" src="<?php echo base_url().'.'?>/assets/js/jquery.cookie.js"></script>
	<script type="application/javascript" src="<?php echo base_url().'.'?>/assets/js/utility.js"></script>
	<script type="application/javascript">
	var base_url = "<?php echo base_url()?>";
	$.cookie.json = true;
	function removeNotification() {
		$('.notification').slideUp();
	}
	var sTO = null;
	$(document).ready(function() {
		$('.fancybox').fancybox();
		if($('.notification').is('.on')) {
			var timeout = $('.notification > div').is('.error')?
					30000:$('.notification > div').is('.warning')?20000:10000;
			sTO = setTimeout('removeNotification()', timeout);
		}
		$('.close-notif').click(function(e){
			e.preventDefault();
			clearTimeout(sTO);
			removeNotification();
		});
	});
	</script>
	<body<?php echo $have_bar?' class="have-bar"':''?>>
<?php
$notice = strlen($this->session->flashdata('status.error'))?'error':
		(strlen($this->session->flashdata('status.warning'))?'warning':
				(strlen($this->session->flashdata('status.notice'))?'notice':''));
?>
	<div class="notification <?php echo !empty($notice)?'on':''?>">
		<div class="<?php echo $notice;?>">
			<div class="message">
				<div class="row">
					<div class="col-sm-7 col-sm-offset-2 col-xs-12">
						<strong id="notification-title">
							<?php echo ucfirst($notice) ;?>
						</strong>
						<span id="notification-message">
							<?php echo $this->session->flashdata('status.'.$notice)?>
						</span>
						<span class="pull-right visible-xs-block close-notif">
							<i class="fa fa-close"></i> Close
						</span>
					</div>
					<div class="col-sm-1 hidden-xs close-notif" style="text-align: right">
						<i class="fa fa-close"></i> Close
					</div>
					<div class="col-sm-offset-4">
					</div>
				</div>
			</div>
		</div>
	</div>

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
	if(empty($is_logged_in) || empty($user['id'])): // Not logged in
?>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown sign-in">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Masuk</a>
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
						<li class="dropdown register">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Daftar</a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="<?php echo base_url()?>murid/registrasi">sbg Murid</a>
								</li>
								<li>
									<a href="<?php echo base_url()?>guru/reg_guru">sbg Guru</a>
								</li>
								<li>
									<a class="fancybox" href="#inline-reg">sbg Vendor</a>
								</li>
							</ul>
						</li>
					</ul>
<!-- Fancy Log -->
			<div id="inline1" style="width:400px;display: none;">
				<p class="text-14 bold">Masuk sebagai Murid</p>
				<form id="login_form_murid" name="login_form_murid" method="post" action="https://ruangguru.com/murid/login_submit">
					<p>
						<label for="login_name">Masuk: </label>
						<input type="email" class="form-control" id="email" name="email" placeholder="emailanda@email.com" />
					</p>
					<p>
						<label for="login_pass">Password: </label>
						<input type="password" class="form-control" id="password" name="password" />
					</p>
					<p>
						<button type="submit" class="btn btn-success btn-lg">Masuk</button>
					</p>
				</form>
			</div>
			<div id="inline2" style="width:400px;display: none;">
				<p class="text-14 bold">Masuk sebagai Vendor</p>
				<form id="login_form" name="login_form" method="post" action="<?php echo base_url().'vendor/auth/do_login';?>">
					<p>
						<label for="login_name">Masuk: </label>
						<input type="email" class="form-control" id="login_email" name="email" placeholder="emailanda@email.com" />
					</p>
					<p>
						<label for="login_pass">Password: </label>
						<input type="password" class="form-control" id="login_password" name="password" />
					</p>
					<p>
						<button type="submit" class="btn btn-success btn-lg">Masuk</button>
					</p>
				</form>
			</div>
			<div id="inline3" style="width:400px;display: none;">
				<p class="text-14 bold">Masuk sebagai Guru</p>
				<form id="login_form_murid" name="login_form_murid" method="post" action="https://ruangguru.com/guru/login_submit">
					<p>
						<label for="login_name">Masuk: </label>
						<input type="email" class="form-control" id="email" name="email" placeholder="emailanda@email.com" />
					</p>
					<p>
						<label for="login_pass">Password: </label>
						<input type="password" class="form-control" id="password" name="password" />
					</p>
					<p>
						<button type="submit" class="btn btn-success btn-lg">Masuk</button>
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
							<button type="reset" class="btn btn-default btn-lg">Reset</button>
						</div>
					</div>
				</form>
			</div>

<?php
	else: // logged in
		switch($user['type']):
			case		'vendor':
				$profile = base_url().'vendor/profile/edit';
				$logout = base_url().'vendor/auth/logout';
				break;
			case		'guru':
				$profile = base_url().'profile';
				$logout = base_url().'guru/logout';
				break;
			case		'murid':
				$profile = base_url().'murid';
				$logout = base_url().'murid/logout';
				break;
		endswitch;
?>
					<ul class="nav navbar-nav navbar-right">
						<li class="user-login">
							Halo, <a href="<?php echo $profile?>">
								<?php echo $user['name'];?>
							</a>
						</li>
						<li class="sign-out">
							<a href="<?php echo $logout;?>">Logout</a>
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
						<ul class="nav nav-pills text-14">
							<li class="title-filter">Filter</li>
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
									<option value="*">Level</option>
<?php
	foreach($header_data['class_level'] as $level):
?>
									<option class="level_check" 
											value="<?php echo $level->id?>"><?php echo $level->name?></option>
<?php 
	endforeach;
?>
								</select>
							</li>
							<li id="prov_list" class="filter-select">
								<select class="form-control propinsi input-sm">
									<option value="*">Provinsi</option>
<?php
	foreach($header_data['provinsi_list'] as $provinsi):
?>
									<option value="<?php echo $provinsi->provinsi_id?>"><?php echo $provinsi->provinsi_title?></option>
<?php 
	endforeach;
?>
								</select>
							</li>
							<li id="tipe_list" class="filter-select">
								<select class="form-control input-sm">
									<option value="*">Tipe Kelas</option>
									<option value="1,2">Paket</option>
									<option value="0">Satu Sesi</option>
								</select>
							</li>
							<li id="harga_list" class="filter-select">
								<select class="form-control kategori input-sm">
									<option value="0">Kategori</option>
<?php
	foreach($header_data['class_category'] as $category):
?>
									<option value="<?php echo $category->id?>"><?php echo $category->category_name?></option>
<?php
	endforeach;
?>
								</select>
							</li>
						</ul>
						<ul class="sort nav text-14">
							
							<li class="title-filter sort-list">Urutan</li>
							<li id="sort_by_list" class="sort-list">
								<select class="form-control input-sm">
									<option value="price">Harga Termurah</option>
									<option value="ongoing">Ongoing Class</option>
									<option value="upcoming">Upcoming Class</option>
									<option value="past">Past Class</option>
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
