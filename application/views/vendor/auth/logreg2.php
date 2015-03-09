<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/9/15
 * Time: 5:30 PM
 * Proj: prod-new
 */
	$this->load->view('vendor/general/header2');
?>
	<div class="container content">
		<div class="row">
			<div class="col-sm-6 log-reg">
				<div class="panel panel-default panel-big">
					<div class="panel-heading heading-label">Login</div>
					<div class="panel-body">
						<form class="form-horizontal" 
							  role="form" 
							  action="<?php echo base_url();?>vendor/auth/do_login" 
							  method="post">
							<div class="form-group">
								<label for="email" class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input type="email" 
										   class="form-control" 
										   name="email"
										   id="login_email" 
										   placeholder="Email" />
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-sm-3 control-label">Password</label>
								<div class="col-sm-9">
									<input type="password" 
										   class="form-control" 
										   id="login_password" 
										   name="password" 
										   placeholder="Password" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-3 col-sm-9">
									<div class="checkbox">
										<label>
										  <input type="checkbox"> Remember me
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default main-button register">Login</button>
									<button type="submit" class="btn btn-default cancel">Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div><!-- panel -->
			</div><!-- col-sm-6 -->
			<div class="col-sm-6 log-reg">
				<div class="panel panel-default panel-big panel-yellow">
					<div class="panel-heading heading-label heading-yellow">Daftar</div>
					<div class="panel-body">
						<form class="form-horizontal" 
							  role="form" 
							  action="<?php echo base_url();?>vendor/auth/do_register" 
							  method="post">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input type="email" 
										   name="email"
										   class="form-control" 
										   id="register_email" 
										   placeholder="Email" />
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-sm-3 control-label">Password</label>
								<div class="col-sm-9">
									<input type="password" 
										   class="form-control" 
										   name="password"
										   id="register_password" 
										   placeholder="Password" />
								</div>
							</div>
							<div class="form-group">
								<label for="confirm_password" class="col-sm-3 control-label">Ulangi Password</label>
								<div class="col-sm-9">
									<input type="password" 
										   class="form-control" 
										   name="confirm_password"
										   id="register_confirm_password" 
										   placeholder="Re-enter Password" />
								</div>
							</div>
							<div class="form-group">
								<label for="vendor_name" class="col-sm-3 control-label">Nama</label>
								<div class="col-sm-9">
									<input type="text" 
										   class="form-control" 
										   name="vendor_name" 
										   id="register_vendor_name" 
										   placeholder="Nama Anda atau nama instansi" />
								</div>
							</div>
							<div class="form-group">
								<label for="vendor_phone" class="col-sm-3 control-label">Telp</label>
								<div class="col-sm-9">
									<input type="text" 
										   class="form-control" 
										   id="register_vendor_phone" 
										   name="vendor_phone" 
										   placeholder="contoh: (021) 765 4321" />
								</div>
							</div>
							<div class="form-group">
								<label for="vendor_address" class="col-sm-3 control-label">Alamat</label>
								<div class="col-sm-9">
									<textarea class="form-control" 
											  name="vendor_address"
											  id="register_vendor_address"
											  placeholder="Jl. Tebet Raya No. 32A 
Tebet - Jakarta Pusat" rows="3"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default main-button register">Daftar</button>
									<button type="submit" class="btn btn-default cancel">Reset</button>
								</div>
							</div>
						</form>
					</div><!-- panel-body -->
				</div><!-- panel -->
			</div><!-- col-sm-6 -->
		</div>
	</div> <!-- /container -->
	
<?php
	$this->load->view('vendor/general/footer2');
