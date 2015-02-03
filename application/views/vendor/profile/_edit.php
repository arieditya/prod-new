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
	<div class="row" style="margin-top: 25px;">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading text-16 bold">PROFIL PENYELENGGARA (Untuk ditampilkan)</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" action="" method="post" id="form-vendor">
						<div class="form-group">
							<label for="email" class="col-md-3 control-label">Email Penyelenggara</label>
							<div class="col-md-9 ">
								<input type="email" name="email" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $vendor['profile']->email;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Nama Penyelenggara</label>
							<div class="col-md-9 ">
								<input type="text" name="name" class="form-control" value="<?php echo $vendor['profile']->name;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Telp. Penyelenggara</label>
							<div class="col-md-9 ">
								<input type="text" name="main_phone" class="form-control" value="<?php echo $vendor['profile']->main_phone;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="name" class="col-md-3 control-label">Alamat Penyelenggara</label>
							<div class="col-md-9 ">
								<textarea class="form-control" name="address"><?php echo $vendor['profile']->address;?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="col-md-3 control-label">Password Akun</label>
							<div class="col-md-9 ">
								<input type="password" class="form-control" name="password" />
							</div>
						</div>
						<div class="form-group">
							<label for="vendor_description" class="col-md-3 control-label">Deskripsi Penyelenggara</label>
							<div class="col-md-9 ">
								<textarea rows="5" class="form-control" name="vendor_description"><?php echo $vendor['info']->vendor_description;?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="vendor_logo" class="col-md-3 control-label">Logo Organisasi</label>
							<div class="col-md-5 ">
								<input name="vendor_logo" type="file" class="form-control" />
							</div>
							<div class="col-md-4 ">
								<img width="250" src="<?php $img = "images/vendor/{$vendor['info']->vendor_id}/{$vendor['info']->vendor_logo}"; echo base_url().(empty($vendor['info']->vendor_logo)?'images/default_profile_image.png':$img);?>" />
								<p class="text-12">* Resolusi terbaik 240 pixel X 150 pixel</p>
							</div>
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<button type="submit" class="btn btn-lg btn-success"  onclick="javascript: return SubmitForm()">Simpan</button>
							<button type="reset	" class="btn btn-sm btn-danger">Reset</button>
						</div>
					</form>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading text-16 bold">INFORMASI TENTANG PENYELENGGARA</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" action="<?php echo base_url();?>vendor/profile/update_info" method="post" enctype="multipart/form-data">
						
						<div class="panel panel-danger">
							<div class="panel-heading bold">Penanggung Jawab Penyelenggara </div>
							<div class="panel-body">
								<div class="form-group">
									<label for="class_room_address" class="col-md-3 control-label">Nama</label>
									<div class="col-md-9 ">
										<input type="text" name="contact_person_name" class="form-control" value="<?php echo $vendor['info']->contact_person_name;?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="class_room_phone" class="col-md-3 control-label">Telepon</label>
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
									<label for="class_room_capacity" class="col-md-3 control-label">Jabatan/Posisi</label>
									<div class="col-md-9 ">
										<input type="email" name="contact_person_jabatan" class="form-control" value="<?php echo $vendor['info']->contact_person_email;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-danger">
							<div class="panel-heading bold">Lokasi </div>
							<div class="panel-body">
								<div class="form-group">
									<label for="class_room_address" class="col-md-3 control-label">Alamat Kelas</label>
									<div class="col-md-9 ">
										<textarea class="form-control" name="class_room_address"><?php echo $vendor['info']->class_room_address;?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="class_room_phone" class="col-md-3 control-label">Telepon</label>
									<div class="col-md-9 ">
										<input type="text" name="class_room_phone" class="form-control" value="<?php echo $vendor['info']->class_room_phone;?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="class_room_capacity" class="col-md-3 control-label">Kapasitas Kelas</label>
									<div class="col-md-9 ">
										<input type="text" name="class_room_capacity" class="form-control" value="<?php echo $vendor['info']->class_room_capacity;?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<button type="submit" class="btn btn-lg btn-success">Simpan</button>
							<button type="reset	" class="btn btn-sm btn-danger">Reset</button>
						</div>
					</form>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading text-16 bold">Rekening Bank</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" action="<?php echo base_url();?>vendor/profile/update_account" method="post">
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
									<option <?php echo ($bank_account->bank_id)==='0'?'selected':''?> value="x">Rekening Bank Lain</option>
								</select>
								<input type="text" name="bank_new" value="<?php echo empty($bank_account->bank_lain)?'':$bank_account->bank_lain; ?>" class="form-control" id="bank_new" style="display: none;" placeholder="Bila nama bank tidak terdapat dalam list diatas dapat ditambah disini" />
							</div>
						</div>
						<div class="form-group">
							<label for="account_number" class="col-md-3 control-label">No. Rekening Bank</label>
							<div class="col-md-9 ">
								<input type="text" name="account_number" class="form-control" value="<?php echo empty($bank_account->no_rek)?'':$bank_account->no_rek;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="account_name" class="col-md-3 control-label">Nama Pemilik Rekening</label>
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
							<button type="submit" class="btn btn-lg btn-success">Simpan</button>
							<button type="reset	" class="btn btn-sm btn-danger">Reset</button>
						</div>
					</form>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading text-16 bold">Social Media</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" action="<?php echo base_url();?>vendor/profile/update_socmed" method="post">
						<div class="form-group">
							<label for="socmed_fb" class="col-md-3 control-label">Facebook</label>
							<div class="col-md-9 input-group">
								<span class="input-group-addon"><strong>http://www.facebook.com/</strong></span>
								<input type="text" name="socmed_fb" class="form-control" value="<?php echo empty($socmed->facebook)?'':$socmed->facebook;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="socmed_tw" class="col-md-3 control-label">Twitter</label>
							<div class="col-md-9 input-group">
								<span class="input-group-addon"><strong>@</strong></span>
								<input type="text" name="socmed_tw" class="form-control" value="<?php echo empty($socmed->facebook)?'':$socmed->twitter;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="socmed_ig" class="col-md-3 control-label">Instagram</label>
							<div class="col-md-9 input-group">
								<span class="input-group-addon"><strong>http://instagram.com/</strong></span>
								<input type="text" name="socmed_ig" class="form-control" value="<?php echo empty($socmed->facebook)?'':$socmed->instagram;?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="socmed_pt" class="col-md-3 control-label">Pinterest</label>
							<div class="col-md-9 input-group">
								<input type="text" name="socmed_pt" class="form-control" value="<?php echo empty($socmed->facebook)?'':$socmed->pinterest;?>" />
							</div>
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<button type="submit" class="btn btn-lg btn-success">Simpan</button>
							<button type="reset	" class="btn btn-sm btn-danger">Reset</button>
						</div>
					</form>
				</div>
			</div>
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
<!-- multi-action-form-->
<script type='text/javascript'>
 function SubmitForm()
{
    document.forms["form-vendor"].action='<?php echo base_url();?>vendor/profile/update_profile';
    document.forms["form-vendor"].submit();
	
    return true;
}
</script>
<?php
$this->load->view('vendor/general/footer');
?>