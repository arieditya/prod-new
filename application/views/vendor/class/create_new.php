<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/10/14
 * Time: 11:21 AM
 * Proj: private-development
 */
$this->load->view('vendor/general/header');
?>
<div class="row list-orange">
	<div class="col-md-offset-2 col-md-8">
		<ul class="nav nav-pills">
			<li class="sub-menu-btn"><a href="<?php echo base_url().'vendor/profile/edit'?>">Profil Anda</a></li>
			<li class="sub-menu-btn"><a href="<?php echo base_url().'vendor/kelas/daftar'?>">Kelas Anda</a></li>
			<li class="sub-menu-btn-active"><a href="<?php echo base_url().'vendor/kelas/baru'?>">Tambah Kelas</a></li>
			<li class="pull-right bottom-10 bold"><img src="<?php echo base_url().'images/phone-2.png';?>" width="20px"/>&nbsp;021-92000-3040</li>
		</ul>
	</div>
</div>
	<div class="row padbottom-40 bg-all">
		<div class="col-md-offset-2 col-md-8 top-40 bg-section shadow">
			<h2 class="pink">Pendaftaran Kelas Baru</h2>
			<form class="form-horizontal" action="<?php echo base_url();?>vendor/kelas/submit_new" method="post">
				<div class="form-group">
					<label class="col-md-4 control-label">Nama kelas</label>
					<div class="col-md-8">
						<input class="form-control" id="class_name" type="text" name="class_nama" placeholder="Nama dari kelas yang akan diselenggarakan" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">SEO Friendly URL</label>
					<div class="col-md-8">
						<input class="form-control" tabindex="-1" id="class_uri" type="text" name="class_uri" placeholder="Biarkan terisi secara automatis bila Anda ragu" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Tentang kelas</label>
					<div class="col-md-8">
						<textarea class="form-control" name="class_deskripsi" rows="5"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Tarif per pertemuan</label>
					<div class="col-md-8">
						<input class="form-control" type="number" name="class_harga" placeholder="Masukkan angka saja, mis: 50000. 0 jika kelas gratis" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Jumlah Minimal Peserta</label>
					<div class="col-md-8">
						<input class="form-control" type="number" name="class_peserta_min" placeholder="Minimal jumlah peserta dalam kelas" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Jumlah Maksimal Peserta</label>
					<div class="col-md-8">
						<input class="form-control" type="number" name="class_peserta_max" placeholder="Maksimal jumlah peserta dalam kelas" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Kategori</label>
					<div class="col-md-8">
						<select class="form-control" name="class_category">
							<option>-- Pilih kategori --</option>
<?php
	if($categories->num_rows() > 0):
		foreach($categories->result() as $category):
?>
							<option value="<?php echo $category->id?>"><?php echo ucwords($category->category_name);?></option>
<?php
		endforeach;
	endif;
?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Level yang Diajarkan</label>
					<div class="col-md-8">
						<select class="form-control" name="class_level">
							<option>-- Pilih tingkat --</option>
<?php
	if($levels->num_rows() > 0):
		foreach($levels->result() as $level):
?>
							<option value="<?php echo $level->id?>"><?php echo ucwords($level->nama);?></option>
<?php
		endforeach;
	endif;
?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Alamat</label>
					<div class="col-md-8">
						<textarea class="form-control" name="class_lokasi" rows="5"></textarea>
					</div>
				</div>
				<div class="form-group has-feedback">
					<label class="col-md-4 control-label">Peta Lokasi</label>
					<div class="col-md-4">
						<input class="form-control" type="text" id="class_map_search" name="maps" placeholder="Masukkan area / lokasi" />
						<a href="#" class="manage-icon pos-icon" id="btn_search_maps">
							<i class="glyphicon glyphicon-search"></i>
						</a>
						<input id="class_maps" class="form-control" readonly="readonly" type="text" name="class_peta" placeholder="" style="margin-top: 5px;" />
					</div>
					<div class="col-md-4">
						<img id="img_preview" src="https://maps.googleapis.com/maps/api/staticmap?size=160x100&maptype=roadmap" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Tipe Kelas</label>
					<div class="col-md-8">
<?php /*/ ?>
						<label class="checkbox-inline">
							<input type="checkbox" name="class_paket" value="ya" /> <span>Ya, ini adalah kelas paket!</span>
						</label>
						<br />
						<small>Apakah kelas ini adalah kelas paket? Jika ya, beri tanda centang berikut ini<br />
(Untuk menyelesaikan kelas ini, akan butuh lebih dari 1x pertemuan)<br />
</small>
<?php // */ ?>
						<div class="radio">
							<label>
								<input type="radio" name="class_paket" value="single" /> <span>Hanya satu sesi <a href="#" title="Kelas yang hanya diadakan satu kali saja" class="tooltip">?</a></span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="class_paket" value="series" checked="checked" /> <span>Kelas Berseri <a href="#" title="Kelas yang dibuat dalam beberapa sesi dan akan berkelanjutan" class="tooltip">?</a></span>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="class_paket" value="package" /> <span>Satu Paket <a href="#" title="Kelas yang terdiri dari beberapa sesi namun harus diikuti semua sesinya oleh murid" class="tooltip">?</a></span>
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-offset-4 col-md-8 top-20">
					<button class="btn btn-success btn-lg">Simpan</button>&nbsp;&nbsp;
					<button class="btn btn-danger btn-sm">Batal</button>
				</div>
				<div class="bottom-30"></div>
			</form>
		</div>
	</div>
<script type="application/javascript" >
	$(document).ready(function(){
		$('#class_name').blur(function(){
			$.get('<?php echo base_url();?>vendor/kelas/generate_uri', {title: $(this).val()})
					.success(function(data){
						console.log(data);
						if(data.status == 'OK') {
							$('#class_uri').val(data.data.uri);
						}
					});
		});
		$('input[type=number]').keydown(function(e){
			if(
					( e.keyCode < 48 || e.keyCode > 57 )
					&& !(
						false
						|| e.keyCode == 8 // backspace
						|| e.keyCode == 9 // tabs
						|| e.keyCode == 17 // ctrl
						|| e.keyCode == 18 // alt
						|| e.keyCode == 33 // pgup
						|| e.keyCode == 34 // pgdn
						|| e.keyCode == 35 // end
						|| e.keyCode == 36 // home
						|| e.keyCode == 37 // left
						|| e.keyCode == 38 // up
						|| e.keyCode == 39 // right
						|| e.keyCode == 40 // down
						|| e.keyCode == 45 // ins
						|| e.keyCode == 46 // delete
					)
			) return false;
		});
	});
</script>
<?php
$this->load->view('vendor/general/footer');
