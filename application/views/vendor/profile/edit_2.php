<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 2/26/15
 * Time: 11:56 AM
 */
$this->load->view('vendor/general/header2');
$vendor_logo = base_url()."images/vendor/{$vendor['profile']->id}/{$vendor['info']->vendor_logo}";
$img = "images/vendor/{$vendor['info']->vendor_id}/{$vendor['info']->vendor_logo}"; 
?>
	<div class="container content profile">
		<div class="row">
<?php $this->load->view('vendor/general/sidebar');?>
			<div class="col-md-9 col-sm-12">
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" 
						 class="tab-pane <?php echo empty($sidebar)||$sidebar=='profile'?'active':'';?>" 
						 id="profil">
						<h2 class="block-title text-uppercase">PROFIL PENYELENGGARA</h2>
						<form class="form-horizontal" 
							  role="form" action="<?php echo base_url();?>vendor/profile/update_profile" 
							  method="post" 
							  id="form-1" 
							  enctype="multipart/form-data">
							<div class="form-group">
								<label for="emailpenyelenggara" class="col-sm-4 control-label">Email Penyelenggara</label>
								<div class="col-sm-8">
									<input type="email" 
										   class="form-control" 
										   id="emailpenyelenggara" 
										   placeholder="Email" 
										   value="<?php echo $vendor['profile']->email;?>"
										   disabled="disabled"
										   name="email" />
									<input type="checkbox" 
										   name="show_email"
										   value="yes"
										   <?php echo 
									$vendor['profile']->show_phone==1?'checked="checked"':'';?>/> 
									Tampilkan email di halaman profile anda
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="password" class="col-sm-4 control-label">Password Akun</label>
								<div class="col-sm-8">
									<input type="password" 
										   class="form-control" 
										   id="password" 
										   name="password"
										   placeholder="Rewrite Password" />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="namapenyelenggara" class="col-sm-4 control-label">Nama Penyelenggara</label>
								<div class="col-sm-8">
									<input type="text" 
										   class="form-control" 
										   id="namapenyelenggara" 
										   name="name"
										   value="<?php echo $vendor['profile']->name;?>"
										   placeholder="Nama"
                                           <?php if($autofocus=='profile') echo "autofocus"; ?>
                                        >
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="notelepon" class="col-sm-4 control-label">No. Telp</label>
								<div class="col-sm-8">
									<input type="text" 
										   class="form-control" 
										   id="notelepon" 
										   name="main_phone"
										   value="<?php echo $vendor['profile']->main_phone;?>"
										   placeholder="Nomor Telepon">
									<input type="checkbox" 
										   name="show_phone"
										   value="yes"
										   <?php echo 
									$vendor['profile']->show_phone==1?'checked="checked"':'';?>/> 
									Tampilkan nomor telepon di halaman profile anda
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="alamat" class="col-sm-4 control-label">Alamat</label>
								<div class="col-sm-8">
									<textarea class="form-control" 
											  placeholder="Alamat" 
											  rows="5"
											  name="address"><?php echo 
										$vendor['profile']->address;?></textarea><br />
									<span>
										<input type="checkbox" 
											   name="show_address"
											   value="yes"
											   <?php echo 
										$vendor['profile']->show_address==1?'checked="checked"':'';?>/> 
										Tampilkan alamat di halaman profile anda
									</span>
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="deskipsi" class="col-sm-4 control-label">Deskripsi penyelenggara</label>
								<div class="col-sm-8">
									<textarea class="form-control" 
											  placeholder="Deskripsi Penyelenggara" 
											  name="vendor_description"
											  rows="3"><?php echo $vendor['info']->vendor_description;?></textarea>
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="logo" class="col-sm-4 control-label">Logo organisasi</label>
								<div class="col-sm-8">
									<img class="img-responsive"
										 src="<?php echo base_url().(empty($vendor['info']->vendor_logo)?'images/default_profile_image.png':$img);?>" />
									<input type="file" id="vendor_logo" name="vendor_logo" />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8 submit-form">
									<button type="submit" class="btn btn-default main-button register">Simpan</button>
									<button type="reset" class="btn btn-default cancel">Reset</button>
								</div>
							</div>
						</form>
				
						<h4 class="review-title">
							<a name="socmed" id="socmed">
							Social Media
							</a>
						</h4>
				
						<form class="form-horizontal" 
							  role="form" 
							  action="<?php echo base_url();?>vendor/profile/update_socmed" 
							  method="post" 
							  id="form-socmed" 
							  enctype="application/x-www-form-urlencoded">
							<div class="form-group">
								<label for="facebook" class="col-sm-4 control-label">
									Facebook&nbsp;&nbsp;http://facebook.com/
								</label>
								<div class="col-sm-8">
									<input type="text" 
										   class="form-control" 
										   id="facebook" name="socmed_fb"
										   value="<?php echo empty($socmed->facebook)?'':$socmed->facebook;?>"
										   placeholder="Facebook"
                                           <?php if($autofocus=='socmed') echo "autofocus"; ?>
                                        />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="twitter" class="col-sm-4 control-label">Twitter @</label>
								<div class="col-sm-8">
									<input type="text" 
										   class="form-control" 
										   id="twitter" 
										   name="socmed_tw"
										   value="<?php echo empty($socmed->twitter)?'':$socmed->twitter;?>"
										   placeholder="Twitter" />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="instagram" class="col-sm-4 control-label">Instagram  http://instagram.com/</label>
								<div class="col-sm-8">
									<input type="text" 
										   class="form-control" 
										   id="instagram" 
										   name="socmed_ig"
										   value="<?php echo empty($socmed->instagram)?'':$socmed->instagram;?>"
										   placeholder="Instagram" />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="pinterest" class="col-sm-4 control-label">Pinterest</label>
								<div class="col-sm-8">
									<input type="text" 
										   class="form-control" 
										   id="pinterest"
										   name="socmed_pt"
										   value="<?php echo empty($socmed->pinterest)?'':$socmed->pinterest;?>"
										   placeholder="Pinterest" />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8 submit-form">
									<button type="submit" class="btn btn-default main-button register">Simpan</button>
									<button type="reset" class="btn btn-default cancel">Reset</button>
								</div>
							</div>
						</form>
				
					</div><!-- profil -->
					<div role="tabpanel" 
						 class="tab-pane <?php echo empty($sidebar)||$sidebar=='penanggungjawab'?'active':'';?>" 
						 id="reponsible">
						<h2 class="block-title text-uppercase">
							Penanggungjawab penyelenggara
                            <span class="info">* Data tidak bisa diakses secara umum</span>
                        </h2>
<?php /*
                        <div class="info col-md-12">
                            <span class="copy-icon">
                                <a href="<?php echo base_url();?>vendor/profile/copy">
=======
                            <div class="info">
                                <span>* Data tidak bisa diakses secara umum</span>
                                <span class="info"><a href="<?php echo base_url();?>vendor/profile/copy_profile_to_info">
>>>>>>> 7a808d34557d311eb82a11f250abb290bc7df66c
                                    <i class="fa fa-files-o fa-3"></i>
                                    Klik di sini jika data penyelenggara dan penanggungjawab adalah sama
                                </a>
<<<<<<< HEAD
                            </span>
                        </div>

=======
                                 </span>
                            </div>
                        </h2>
>>>>>>> 7a808d34557d311eb82a11f250abb290bc7df66c

 // */ ?>
                        <form class="form-horizontal"
							  role="form" 
							  action="<?php echo base_url();?>vendor/profile/update_info" 
							  method="post" 
							  id="form-2" 
							  enctype="multipart/form-data">
							<div class="form-group">
								<label for="nama" class="col-sm-4 control-label">Nama</label>
								<div class="col-sm-8">
									<input type="text" 
										   class="form-control" 
										   id="nama" 
										   name="contact_person_name" 
										   value="<?php echo $vendor['info']->contact_person_name;?>" 
										   placeholder="Nama"
                                           <?php if($autofocus=="penanggungjawab") echo "autofocus"; ?>
                                        />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="notelepon" class="col-sm-4 control-label">No. Telp</label>
								<div class="col-sm-8">
									<input type="text" 
										   id="notelepon" 
										   name="contact_person_phone" 
										   class="form-control" 
										   value="<?php echo $vendor['info']->contact_person_phone;?>" 
										   placeholder="Nomor Telepon" />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="nohp" class="col-sm-4 control-label">No. HP</label>
								<div class="col-sm-8">
									<input type="text" 
										   id="nohp" 
										   name="contact_person_mobile" 
										   class="form-control" 
										   value="<?php echo $vendor['info']->contact_person_mobile;?>" 
										   placeholder="Nomor HP"
                                           <?php if($autofocus=='nohp') echo "autofocus"; ?>
                                        />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="email" class="col-sm-4 control-label">Email</label>
								<div class="col-sm-8">
									<input type="email" 
										   name="contact_person_email" 
										   class="form-control" 
										   value="<?php echo $vendor['info']->contact_person_email;?>" 
										   placeholder="Email" />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8 submit-form">
									<button type="submit" class="btn btn-default main-button register">Simpan</button>
									<button type="reset" class="btn btn-default cancel">Reset</button>
								</div>
							</div>
						</form>
				
						<h4 class="review-title">
							<a name="rekbank" id="rekbank">
								Rekening Bank
							</a>
						</h4>
				
						<form class="form-horizontal" 
							  role="form" 
							  action="<?php echo base_url();?>vendor/profile/update_account" 
							  method="post" 
							  id="form-bank" 
							  enctype="application/x-www-form-urlencoded">
							<div class="form-group">
								<label for="Seo" class="col-sm-4 control-label">Bank</label>
								<div class="col-sm-8">
									<select class="form-control" name="account_bank" id="bank_select">
<?php
	foreach($bank_list as $bank):
?>
										<option <?php echo !empty($bank_account->bank_id) && $bank_account->bank_id==$bank->bank_id?'selected="selected"':''; ?> value="<?php echo $bank->bank_id;?>"><?php echo $bank->bank_title; ?></option>
<?php
	endforeach;
?>
										<option <?php echo ($bank_account->bank_id)==='0'?'selected':''?> value="x">Rekening bank lain</option>
									</select>
									<input type="text" 
										   name="bank_new" 
										   value="" 
										   class="form-control" 
										   id="bank_new" 
										   style="display: none;" 
										   placeholder="Bila nama bank tidak terdapat dalam list diatas dapat ditambah disini" />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="norekening" class="col-sm-4 control-label">No. Rekening</label>
								<div class="col-sm-8">
									<input type="text" 
										   id="norekening" 
										   name="account_number" 
										   class="form-control" 
										   value="<?php echo empty($bank_account->no_rek)?'':$bank_account->no_rek;?>" 
										   placeholder="Nomor Rekening"
                                           <?php if($autofocus=="rekbank") echo "autofocus"; ?>
                                        />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="nama pemilik" class="col-sm-4 control-label">Nama pemilik rekening</label>
								<div class="col-sm-8">
									<input type="text" 
										   name="account_name" 
										   class="form-control" 
										   value="<?php echo empty($bank_account->atasnama)?'':$bank_account->atasnama;?>" 
										   placeholder="Nama pemilik" />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<label for="cabang" class="col-sm-4 control-label">Cabang</label>
								<div class="col-sm-8">
									<input type="text" 
										   name="account_branch" 
										   class="form-control" 
										   value="<?php echo empty($bank_account->cabang)?'':$bank_account->cabang;?>" 
										   placeholder="Cabang" />
								</div>
							</div><!-- form-group -->
							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-8 submit-form">
									<button type="submit" class="btn btn-default main-button register">Simpan</button>
									<button type="reset" class="btn btn-default cancel">Reset</button>
								</div>
							</div>
						</form>
					</div><!-- <reponsible></reponsible> -->
				</div>
			</div>
		</div>
	</div> <!-- /container -->

<script type="application/javascript">
    $(document).ready(function(){
        $('#bank_select').change(function(e){
            if($(this).val() == 'x') {
                $('#bank_new').show().focus();
            } else {
                $('#bank_new').hide();
            }
        });
        $('#bank_select').change();
    });
    if (document.getElementById('vendor_individu').checked) {

    }
</script>
<?php
$this->load->view('vendor/general/footer2');
