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
	<div class="row" style="margin-top: 20px;">
		<div class="col-md-4">
			<h2>Buka kelas</h2>
			<p>
				Buka kelas adalah fitur baru di Ruangguru.
				Anda sebagai guru dapat membuat kelas sesuai dengan mata pelajaran yang Anda kuasai dalam kurun waktu yang singkat. 
				Kelas ini akan terbuka untuk umum dan untuk siapa saja bisa mendaftar untuk mengikuti kelas Anda
			</p>
			<p>
				Anda bisa menampilkan profil Anda sebagai guru ataupun sebagai komunitas/organisasi Anda di kelas yang akan Anda adakan. 
				Silahkan masukkan deskripsi komunitas/organisasi Anda.
			</p>
			<p><a href="#" class="normal-link">Info lebih lanjut</a></p>
			<p><b>Syarat dan Ketentuan</b>
			</p>
		</div>
		<div class="col-md-8">
			<h2>Pendaftaran Kelas Baru</h2>
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
						<input class="form-control" tabindex="-1" id="class_uri" type="text" name="class_uri" placeholder="Biarkan terisi secara automatis bila anda ragu mengenai isinya" />
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
						<input class="form-control" type="number" name="class_harga" placeholder="Masukkan angka saja, mis: 50000. Jika gratis masukkan angka 0" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Alamat kelas</label>
					<div class="col-md-8">
						<textarea class="form-control" name="class_lokasi" rows="5"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Jumlah minimum peserta</label>
					<div class="col-md-8">
						<input class="form-control" type="number" name="class_peserta_min" placeholder="Masukkan estimasi jumlah minimum peserta per kelas. Misal: 2" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Jumlah maksimum peserta</label>
					<div class="col-md-8">
						<input class="form-control" type="number" name="class_peserta_max" placeholder="Masukkan estimasi jumlah peserta per kelas. Misal: 50" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Kategori</label>
					<div class="col-md-8">
						<select class="form-control" name="class_category">
							<option>-- Pilih Kategori --</option>
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
					<label class="col-md-4 control-label">Tingkat keahlian</label>
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
				<div class="form-group has-feedback">
					<label class="col-md-4 control-label">Peta lokasi</label>
					<div class="col-md-4">
						<input class="form-control" type="text" id="class_map_search" name="maps" placeholder="Masukan nama area / lokasi" />
						<button type="button" class="form-control-feedback panel alert-warning" id="btn_search_maps">
							<i class="glyphicon glyphicon-search"></i>
						</button>
						<input id="class_maps" class="form-control" readonly="readonly" type="text" name="class_peta" placeholder="" style="margin-top: 5px;" />
					</div>
					<div class="col-md-4">
						<img id="img_preview" src="https://maps.googleapis.com/maps/api/staticmap?size=250x180&maptype=roadmap" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Kelas paket</label>
					<div class="col-md-8">
						<label class="checkbox-inline">
							<input type="checkbox" name="class_paket" value="ya" /> <span>Ya, ini adalah kelas paket!</span>
						</label>
						<br />
						<small>Apakah kelas ini adalah kelas paket? Jika ya, beri tanda centang berikut ini<br />
(Untuk menyelesaikan kelas ini, akan butuh lebih dari 1x pertemuan)<br />
</small>
					</div>
				</div>
				<div class="col-md-offset-4 col-md-8">
					<button class="btn btn-success btn-lg" >Submit</button>
					<button class="btn btn-danger btn-sm" >Cancel</button>
				</div>
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
?>

