<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/8/14
 * Time: 12:56 PM
 * Proj: private-development
 */
if(!empty($is_page) && $is_page === TRUE):
	$this->load->view('vendor/general/header');
else:
?>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/jquery-2.1.1.min.js"></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/vendor-default.css" rel="stylesheet" />
<?php
endif;
$status_warning = $this->session->flashdata('status.warning');
if($status_warning):
?>
	<div class="panel panel-danger" style="margin-top: 10px;">
		<div class="panel-heading">Error!</div>
		<div class="panel-body"><?php echo $status_warning;?></div>
	</div>
<?php
endif;
$status_success = $this->session->flashdata('status.success');
if($status_success):
?>
	<div class="panel panel-success" style="margin-top: 10px;">
		<div class="panel-heading">Alright!</div>
		<div class="panel-body">
			<?php echo $status_success;?><br />
			Now let's wait until we got the login form done... :D
		</div>
	</div>
<?php
endif;
?>
<div class="main-content bg-all padbottom-30">
	<div class="row bottom-40">
		<div class="col-md-offset-2 col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading bold">
					<h1>LOGIN</h1>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" action="<?php echo base_url();?>vendor/auth/do_login" method="POST">
						<div class="form-group">
							<label for="email" class="col-md-2 control-label">Email</label>
							<div class="col-md-10">
								<input type="email" class="form-control" id="login_email" name="email" placeholder="your@email.com" />
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="col-md-2 control-label">Password</label>
							<div class="col-md-10">
								<input type="password" class="form-control" id="login_password" name="password" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-10">
								<button type="submit" class="btn btn-lg btn-success">Login</button>
								<button type="reset" class="btn btn-sm btn-danger">Reset</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h1>DAFTAR</h1>
				</div>
				<div class="panel-body">
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
								<button type="submit" class="btn btn-success btn-lg">Daftar</button>
								<button type="reset" class="btn btn-danger btn-sm">Reset</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
if(!empty($is_page) && $is_page === TRUE)
	$this->load->view('vendor/general/footer');
