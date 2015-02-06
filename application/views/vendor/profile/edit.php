<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/8/14
 * Time: 10:41 PM
 * Proj: private-development
 */
$this->load->view('vendor/general/header');
?>
<div class="row list-orange">
	<div class="col-md-offset-2 col-md-8">
		<ul class="nav nav-pills">
			<li class="sub-menu-btn-active"><a href="<?php echo base_url().'vendor/profile/edit'?>">Profil Anda</a></li>
			<li class="sub-menu-btn"><a href="<?php echo base_url().'vendor/kelas/daftar'?>">Kelas Anda</a></li>
			<li class="sub-menu-btn"><a href="<?php echo base_url().'vendor/kelas/baru'?>">Tambah Kelas</a></li>
			<li class="pull-right bottom-10 bold"><img src="<?php echo base_url().'images/phone-2.png';?>" width="20px"/>&nbsp;021-92000-3040</li>
		</ul>
	</div>
</div>
	<div class="row padbottom-50 bg-all">
		<div class="col-md-offset-2 col-md-6">
			<ul class="nav nav-tabs-2" role="tablist">
				<li id="profile_selector" class="active"><a href="#profile" role="tab" data-toggle="tab">PROFIL PENYELENGGARA</a></li>
				<li id="profile2_selector"><a href="#profile-2" role="tab" data-toggle="tab">PENANGGUNG JAWAB</a></li>
			</ul>
			<div class="tab-content bg-section">
				<div class="tab-pane active" id="profile">
					<div class="panel-body">
						<form class="form-horizontal" role="form" action="<?php echo base_url();?>vendor/profile/update_profile" method="post" id="form-1">
							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Email penyelenggara</label>
								<div class="col-md-9 ">
									<input type="email" name="email" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $vendor['profile']->email;?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Password akun</label>
								<div class="col-md-9 ">
									<input type="password" class="form-control" name="password" value="1234567890"/>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-3 control-label">Nama penyelenggara</label>
								<div class="col-md-9 ">
									<input type="text" name="name" class="form-control" value="<?php echo $vendor['profile']->name;?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-3 control-label">No. Telp</label>
								<div class="col-md-9 ">
									<input type="text" name="main_phone" class="form-control" value="<?php echo $vendor['profile']->main_phone;?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-md-3 control-label">Alamat</label>
								<div class="col-md-9 ">
									<textarea class="form-control" name="address"><?php echo $vendor['profile']->address;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="vendor_description" class="col-md-3 control-label">Deskripsi penyelenggara</label>
								<div class="col-md-9 ">
									<textarea rows="5" class="form-control" name="vendor_description"><?php echo $vendor['info']->vendor_description;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="vendor_logo" class="col-md-3 control-label">Logo organisasi</label>
								<div class="col-md-5 ">
									<input name="vendor_logo" type="file" class="form-control" />
								</div>
								<div class="col-md-4 ">
									<img width="180" src="<?php $img = "images/vendor/{$vendor['info']->vendor_id}/{$vendor['info']->vendor_logo}"; echo base_url().(empty($vendor['info']->vendor_logo)?'images/default_profile_image.png':$img);?>" />
								</div>
							</div>
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<button type="submit" class="btn btn-lg btn-success">Simpan</button>&nbsp;&nbsp;&nbsp;
							<button type="reset" class="btn btn-sm btn-danger">Reset</button>
						</div>
					</form>
					<form class="form-horizontal" role="form" action="<?php echo base_url();?>vendor/profile/update_socmed" method="post">
						<div class="panel-heading bold pink text-16">Social Media</div>
						<div class="form-group">
							<label for="account_branch" class="col-md-5 control-label">Facebook&nbsp;&nbsp; http://facebook.com/</label>
							<div class="col-md-7 ">
								<input type="text" name="socmed_fb" class="form-control" value="<?php echo empty($socmed->facebook)?'':$socmed->facebook;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="socmed_tw" class="col-md-5 control-label">Twitter&nbsp;&nbsp;@</label>
							<div class="col-md-7">
								<input type="text" name="socmed_tw" class="form-control" value="<?php echo empty($socmed->facebook)?'':$socmed->twitter;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="socmed_ig" class="col-md-5 control-label">Instagram&nbsp;&nbsp;http://instagram.com/</label>
							<div class="col-md-7">
								<input type="text" name="socmed_ig" class="form-control" value="<?php echo empty($socmed->facebook)?'':$socmed->instagram;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="socmed_pt" class="col-md-5 control-label">Pinterest</label>
							<div class="col-md-7">
								<input type="text" name="socmed_pt" class="form-control" value="<?php echo empty($socmed->facebook)?'':$socmed->pinterest;?>" />
							</div>
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<button type="submit" class="btn btn-lg btn-success">Submit</button>&nbsp;&nbsp;&nbsp;
							<button type="reset	" class="btn btn-sm btn-danger">Reset</button>
						</div>
					</form>
				</div>
				</div>
				<div class="tab-pane" id="profile-2">
				<div class="panel-body">
					<form class="form-horizontal" role="form" action="<?php echo base_url();?>vendor/profile/update_info" method="post" id="form-2" enctype="multipart/form-data">
						<div class="panel-heading bold pink text-16">
							Penanggungjawab penyelenggara
							<p class="text-13"><i>* Data tidak bisa diakses secara umum</i></p>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label for="class_room_address" class="col-md-3 control-label">Nama</label>
								<div class="col-md-9 ">
									<input type="text" name="contact_person_name" class="form-control" value="<?php echo $vendor['info']->contact_person_name;?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="class_room_phone" class="col-md-3 control-label">No. Telp</label>
								<div class="col-md-9 ">
									<input type="text" name="contact_person_phone" class="form-control" value="<?php echo $vendor['info']->contact_person_phone;?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="class_room_phone" class="col-md-3 control-label">No. HP</label>
								<div class="col-md-9 ">
									<input type="text" name="contact_person_mobile" class="form-control" value="<?php echo $vendor['info']->contact_person_mobile;?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="class_room_capacity" class="col-md-3 control-label">Email</label>
								<div class="col-md-9 ">
									<input type="email" name="contact_person_email" class="form-control" value="<?php echo $vendor['info']->contact_person_email;?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="class_room_address" class="col-md-3 control-label">Alamat</label>
								<div class="col-md-9 ">
									<textarea class="form-control" name="class_room_address"><?php echo $vendor['info']->class_room_address;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="class_room_phone" class="col-md-3 control-label">No. Telp</label>
								<div class="col-md-9 ">
									<input type="text" name="class_room_phone" class="form-control" value="<?php echo $vendor['info']->class_room_phone;?>" />
								</div>
							</div>
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<button type="submit" class="btn btn-lg btn-success">Simpan</button>&nbsp;&nbsp;&nbsp;
							<button type="reset" class="btn btn-sm btn-danger">Reset</button>
						</div>
					</form>
					<form class="form-horizontal" role="form" action="<?php echo base_url();?>vendor/profile/update_account" method="post">
					<div class="panel-heading bold pink text-16">Rekening Bank</div>
						<div class="form-group">
							<label for="account_bank" class="col-md-3 control-label">Bank</label>
							<div class="col-md-9 ">
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
								<input type="text" name="bank_new" value="<?php echo empty($bank_account->bank_lain)?'':$bank_account->bank_lain; ?>" class="form-control" id="bank_new" style="display: none;" placeholder="Bila nama bank tidak terdapat dalam list diatas dapat ditambah disini" />
							</div>
						</div>
						<div class="form-group">
							<label for="account_number" class="col-md-3 control-label">No. Rekening</label>
							<div class="col-md-9 ">
								<input type="text" name="account_number" class="form-control" value="<?php echo empty($bank_account->no_rek)?'':$bank_account->no_rek;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="account_name" class="col-md-3 control-label">Nama pemilik rekening</label>
							<div class="col-md-9 ">
								<input type="text" name="account_name" class="form-control" value="<?php echo empty($bank_account->atasnama)?'':$bank_account->atasnama;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="account_branch" class="col-md-3 control-label">Cabang</label>
							<div class="col-md-9 ">
								<input type="text" name="account_branch" class="form-control" value="<?php echo empty($bank_account->cabang)?'':$bank_account->cabang;?>" />
							</div>
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<button type="submit" class="btn btn-lg btn-success">Simpan</button>&nbsp;&nbsp;&nbsp;
							<button type="reset	" class="btn btn-sm btn-danger">Reset</button>
						</div>
					</form>
				</div>
				</div>
			</div>
			<div class="bottom-30"></div>
		</div>
	</div>
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
</script>
<?php 
$this->load->view('vendor/general/footer');