<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 03/03/2015
 * Time: 05:54 PM
 * Proj: prod-new
 */
$this->load->view('vendor/general/header2');
?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.tagsinput.css" type="text/css" />
<script type="application/javascript" src="<?php echo base_url();?>assets/js/moment.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/jquery.tagsinput.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/ckeditor/adapters/jquery.js" ></script>
<script type="application/javascript">
	var class_type = <?php echo (int)$class->class_paket;?>;
</script>
	<div class="container content kelas vendor">
		<div class="row">
			<div class="col-md-3 col-sm-12">
				<div class="sidebar">
					<div class="profile-image-wrap">
						<img src="<?php echo base_url();?>assets/images/user.png" alt="" class="img-responsive">
						<a href="#"><span class="edit"><i class="fa fa-pencil"></i></span></a>
					</div>
					<h3 class="profile-name text-center">Nama Vendor</h3>

					<div class="progress">
					  <div class="progress-bar progress-bar-warning" 
						   role="progressbar" 
						   aria-valuenow="60" 
						   aria-valuemin="0" 
						   aria-valuemax="100" 
						   style="width: 60%">
						60% 
					  </div>
					</div>

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation">
							<a href="#profil" aria-controls="profil" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Profil</a>
						</li>
						<li role="presentation">
							<a href="#reponsible" aria-controls="reponsible" role="tab" data-toggle="tab"><i class="fa fa-male"></i> Penganggungjawab</a>
						</li>
						<li class="active">
							<a href="#"><i class="fa fa-users"></i> Kelas Anda</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-plus"></i> Tambah Kelas</a>
						</li>
					</ul>
				</div><!-- sidebar -->
			</div>
			<div class="col-md-9 col-sm-12">
				<div class="panel panel-default">
					<h2 class="block-title text-uppercase">Edit Kelas</h2>
					<div class="panel-body">
						<div role="tabpanel" class="sub-vendor manage">

							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#preview" aria-controls="preview" role="tab" data-toggle="tab">Preview</a>
								</li>
								<li role="presentation">
									<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profil Kelas</a>
								</li>
								<li role="presentation">
									<a href="#murid" aria-controls="murid" role="tab" data-toggle="tab">Murid</a>
								</li>
								<li role="presentation">
									<a href="#diskon" aria-controls="diskon" role="tab" data-toggle="tab">Kode Diskon</a>
								</li>
								<li role="presentation">
									<a href="#komunikasi" aria-controls="komunikasi" role="tab" data-toggle="tab">Komunikasi</a>
								</li>
							</ul>
				
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="preview">
									<div class="section-wrap">
										<div class="section-heading"><h3 class="section-title">Profil</h3></div>
										<div class="section-content">
											<div class="section-row">
												<div class="col-sm-4">Nama Kelas</div>
												<div class="col-sm-8"><?php echo $class->class_nama;?></div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">URI</div>
												<div class="col-sm-8"><?php echo $class->class_uri;?></div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Deskripsi</div>
												<div class="col-sm-8"><?php echo $class->class_deskripsi;?></div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Alamat</div>
												<div class="col-sm-8"><?php echo $class->class_lokasi;?></div>
											</div><!-- section-row -->
<?php
	if(empty($class->class_peta)) {
		if(!empty($class->class_lokasi)) {
			$str_lokasi = preg_replace('/[\s\r\n]/','+',$class->class_lokasi);
			$str_lokasi = str_replace('++','+', $str_lokasi);
		} else {
			$str_lokasi = 'monumen+nasional';
		}
		$ll = $str_lokasi;
		$link = 'https://www.google.com/maps/place/'+$str_lokasi;
	} else {
		$peta = explode('||', $class->class_peta);
		$ll = $peta[0];
		if(count($peta) == 2) {
			$link = $peta[1];
		} else {
			$link = 'https://www.google.com/maps/place/'+$peta[0];
		}
	}
?>
											<div class="section-row">
												<div class="col-sm-4">Peta</div>
												<div class="col-sm-8">
													<a target="_blank" href="<?php echo $link;?>">
														<img id="img_preview" src="https://maps.googleapis.com/maps/api/staticmap?size=400x200&maptype=roadmap&markers=color:red%7C<?php echo $ll;?>" />
													</a>
												</div>
											</div><!-- section-row -->
										</div><!-- section-content -->
									</div><!-- section-wrap -->
									<div class="section-wrap">
										<div class="section-heading"><h3 class="section-title">Info</h3></div>
										<div class="section-content">
											<div class="section-row">
												<div class="col-sm-4">Catatan</div>
												<div class="col-sm-8"><?php echo $class->class_catatan;?></div>
											</div><!-- section-row -->
<?php
	if(!empty($class->class_video)) {
		$code = str_replace('https://www.youtube.com/watch?v=', '',$class->class_video);
		$vid = '<iframe src="www.youtube.com/embed/'.$code.'"></iframe>';
	} else {
		$vid = 'Belum ada video tersedia';
	}
?>
											<div class="section-row">
												<div class="col-sm-4">Video</div>
												<div class="col-sm-8"><?php echo $vid;?></div>
											</div><!-- section-row -->
<?php
	if(!empty($class->class_image)) {
		$image = '<img src="'.base_url().'images/class/'.$class->id.'/'.$class->class_image.'" class="img-responsive" />';
	} else {
		$image = 'Belum ada foto tersedia';
	}
?>
											<div class="section-row">
												<div class="col-sm-4">Foto</div>
												<div class="col-sm-8"> 
													<?php echo $image;?>
												</div>
											</div><!-- section-row -->
										</div><!-- section-content -->
									</div><!-- section-wrap --> 
									<div class="section-wrap">
										<div class="section-heading"><h3 class="section-title">Jadwal</h3></div>
										<div class="section-content table">
											<div class="table-responsive">
												<table class="table table-bordered">
													<thead>
													<tr>
														<th class="text-center">No.</th>
														<th class="text-center">Tanggal</th>
														<th class="text-center">Mulai</th>
														<th class="text-center">Selesai</th>
														<th class="text-center">Topik</th>
													</tr>
													</thead>
													<tbody>
<?php
$i=0;
	if($jadwal->num_rows() == 0):
?>
														<tr>
															<td class="text-center" colspan="5">
																<span>Belum ada jadwal tersedia</span>
															</td>
														</tr>
<?php
	elseif($jadwal->num_rows() > 0):
		if($class->class_paket == 0):
			$jdwl = $jadwal->row();
			$tanggal = date('d M Y', strtotime($jdwl->class_tanggal));
			$start = $jdwl->class_jam_mulai.':'.$jdwl->class_menit_mulai;
			$end = $jdwl->class_jam_selesai.':'.$jdwl->class_menit_selesai;
			$topik = $jdwl->class_jadwal_topik;
?>
														<tr>
															<td class="text-center"> 1 </td>
															<td class="text-center"><?php echo $tanggal;?></td>
															<td class="text-center"><?php echo $start;?></td>
															<td class="text-center"><?php echo $end;?></td>
															<td class="text-center"><?php echo $topik;?></td>
														</tr>
<?php
		else:
			foreach($jadwal->result() as $jdwl):
				$i++;
				$tanggal = date('d M Y', strtotime($jdwl->class_tanggal));
				$start = $jdwl->class_jam_mulai.':'.$jdwl->class_menit_mulai;
				$end = $jdwl->class_jam_selesai.':'.$jdwl->class_menit_selesai;
				$topik = $jdwl->class_jadwal_topik;
?>
														<tr>
															<td class="text-center"><?php echo $i;?></td>
															<td class="text-center"><?php echo $tanggal;?></td>
															<td class="text-center"><?php echo $start;?></td>
															<td class="text-center"><?php echo $end;?></td>
															<td class="text-center"><?php echo $topik;?></td>
														</tr>
<?php
			endforeach;
		endif;
	endif;
?>
													</tbody>
												</table>
											</div><!-- table-responsive -->
										</div><!-- section-content -->
									</div><!-- section-wrap -->
									<div class="section-wrap">
<?php 
$harga = (int) empty($price->price_per_session)?$class->class_harga:$price->price_per_session;
$diskon = (int) empty($price->discount)?0:$price->discount
?>
										<div class="section-heading"><h3 class="section-title">Biaya</h3></div>
										<div class="section-content">
											<div class="section-row">
												<div class="col-sm-4">Jumlah pertemuan (sesi)</div>
												<div class="col-sm-8"><?php echo $i;?> x pertemuan</div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Harga per sesi</div>
												<div class="col-sm-8"><?php echo rupiah_format($harga);?></div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Total</div>
												<div class="col-sm-8"><?php echo rupiah_format($i * $harga)?></div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Potongan harga</div>
												<div class="col-sm-8">
													<?php echo rupiah_format($diskon);?>
												</div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Total sesudah diskon</div>
												<div class="col-sm-8"><?php echo rupiah_format(($i*$harga)-$diskon); ?>
												</div> 
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Harga sudah meliputi</div>
												<div class="col-sm-8"><?php echo $class->class_include;?></div>
											</div><!-- section-row -->
										</div><!-- section-content -->
									</div><!-- section-wrap -->
								</div><!-- preview -->
								<div role="tabpanel" class="tab-pane" id="profile">
									<form class="form-horizontal">
										<div class="section-heading">
											<h3 class="section-title">
												<a data-toggle="collapse" 
												   data-parent="#profile" 
												   href="#form_profile"
												   aria-controls="form_profile"
												   aria-expanded="true">
													Detail Profile
												</a>
											</h3>
										</div>
										<div id="form_profile" class="collapse">
											<div class="form-group">
												<label for="Namakelas" class="col-sm-4 control-label">Nama Kelas</label>
												<div class="col-sm-8">
													<input type="text" 
														   class="form-control" 
														   id="Namakelas" 
														   placeholder="Nama dari kelas yang akan diselenggarakan" 
														   disabled="disabled"
														   value="<?php echo $class->class_nama;?>" />
												</div>
											</div>
											<div class="form-group">
												<label for="uri" class="col-sm-4 control-label">URL</label>
												<div class="col-sm-8">
													<input type="text" 
														   class="form-control" 
														   id="class_uri" 
														   name="class_uri"
														   placeholder="Biarkan terisi secara automatis bila Anda ragu"
														   value="<?php echo $class->class_uri;?>" />
												</div>
											</div>
											<div class="form-group">
												<label for="tentang" class="col-sm-4 control-label">Tentang kelas</label>
												<div class="col-sm-8">
													<textarea class="form-control" 
															  name="class_deskripsi"
															  placeholder="Tentang kelas yang akan anda buat" 
															  rows="3"><?php echo $class->class_deskripsi?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="radio" class="col-sm-4 control-label">Tipe Kelas</label>
												<div class="col-sm-8">
													<div class="radio">
														<label>
															<input type="radio" 
																   name="class_paket" 
																   id="class_paket_single" 
																   <?php echo $class->class_paket==0?
																		   'checked="checked"':''?>
																   value="0">
															Hanya satu sesi 
															<i class="fa fa-question-circle" 
															   data-toggle="tooltip" 
															   data-placement="right" 
															   title="Kelas yang hanya diadakan satu kali saja"></i>
														</label>
													</div>
													<div class="radio">
														<label>
															<input type="radio" 
																   name="class_paket" 
																   id="class_paket_series" 
																   <?php echo $class->class_paket==1?
																		   'checked="checked"':''?>
																   value="1" />
															Kelas Berseri 
															<i class="fa fa-question-circle" 
															   data-toggle="tooltip" 
															   data-placement="right" 
															   title="Kelas yang dibuat dalam beberapa sesi dan akan berkelanjutan"></i>
														</label>
													</div>
													<div class="radio">
														<label>
															<input type="radio" 
																   name="class_paket" 
																   id="class_paket_package" 
																   <?php echo $class->class_paket==2?
																		   'checked="checked"':''?>
																   value="2" />
															Satu Paket 
															<i class="fa fa-question-circle" 
															   data-toggle="tooltip" 
															   data-placement="right" 
															   title="Kelas yang terdiri dari beberapa sesi namun harus diikuti semua sesinya oleh murid"></i>
														</label>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="Seo" class="col-sm-4 control-label">Kategori</label>
												<div class="col-sm-8">
													<select class="form-control kategori" name="class_category">
														<option>-- Pilih --</option>
<?php
	if($categories->num_rows() > 0):
		foreach($categories->result() as $category):
			$selected = FALSE;
			if($category->id == $class->category->id) $selected = TRUE;
?>
														<option value="<?php echo $category->id?>" <?php echo $selected?'selected="selected"':'';?>><?php echo ucwords($category->category_name);?></option>
<?php
		endforeach;
	endif;
?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<a data-toggle="collapse" 
													   data-parent="#profile" 
													   href="#form_lokasi"
													   class="btn btn-default main-button next-button"
													   aria-controls="form_lokasi"
													   aria-expanded="true">
														Lanjut
													</a>
												</div>
											</div>
										</div>
										<div class="section-heading">
											<h3 class="section-title">
												<a data-toggle="collapse" 
												   data-parent="#profile" 
												   href="#form_lokasi"
												   aria-controls="form_lokasi"
												   aria-expanded="false">
													Lokasi
												</a>
											</h3>
										</div>
										<div id="form_lokasi" class="collapse">
											<div class="form-group">
												<label for="tentang" class="col-sm-4 control-label">Alamat</label>
												<div class="col-sm-8">
													<textarea class="form-control" 
															  name="class_lokasi"
															  placeholder="Alamat dimana kelas akan diadakan." 
															  rows="3"><?php echo $class->class_lokasi?></textarea>
												</div>
											</div>
<?php
	if(empty($class->class_peta)) {
		if(!empty($class->class_lokasi)) {
			$str_lokasi = preg_replace('/[\s\r\n]/','+',$class->class_lokasi);
			$str_lokasi = str_replace('++','+', $str_lokasi);
		} else {
			$str_lokasi = 'monumen+nasional';
		}
		$ll = $str_lokasi;
		$link = 'https://www.google.com/maps/place/'+$str_lokasi;
	} else {
		$peta = explode('||', $class->class_peta);
		$ll = $peta[0];
		if(count($peta) == 2) {
			$link = $peta[1];
		} else {
			$link = 'https://www.google.com/maps/place/'+$peta[0];
		}
	}
?>
											<div class="form-group">
												<label for="Lokasi" class="col-sm-4 control-label">Peta Lokasi</label>
												<div class="col-sm-8">
													<div class="row">
														<div class="col-sm-6">
															<input type="text" 
																   class="form-control" 
																   id="class_peta_search"
																   name="class_peta_search"
																   placeholder="Masukkan area / lokasi" />
															<br />
															<input type="text" 
																   class="form-control" 
																   id="class_peta"
																   name="class_peta"
																   readonly="readonly"
																   value="<?php echo $class->class_peta;?>"
																   placeholder="Belum ada area / lokasi" />
														</div>
														<div class="col-sm-6">
															<button type="button" 
																	class="btn btn-default cek-button search">
																<i class="fa fa-search"></i>
															</button>
														</div>
													</div>
													<div class="row">
														<div class="col-sm-12">
															<a target="_blank" href="<?php echo $link;?>">
																<img id="img_preview" src="https://maps.googleapis.com/maps/api/staticmap?size=400x200&maptype=roadmap&markers=color:red%7C<?php echo $ll;?>" />
															</a>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<a data-toggle="collapse" 
													   data-parent="#profile" 
													   href="#form_peserta"
													   class="btn btn-default main-button next-button"
													   aria-controls="form_peserta"
													   aria-expanded="true">
														Lanjut
													</a>
												</div>
											</div>
										</div>
										<div class="section-heading">
											<h3 class="section-title">
												<a data-toggle="collapse" 
												   data-parent="#profile" 
												   href="#form_peserta"
												   aria-controls="form_peserta"
												   aria-expanded="false">
													Target Peserta
												</a>
											</h3>
										</div>
										<div id="form_peserta" class="collapse">
											<div class="form-group">
												<label for="tentang" class="col-sm-4 control-label">Target Peserta</label>
												<div class="col-sm-8">
													<textarea class="form-control" 
															  placeholder="Masukan target audience kelas ini" 
															  name="class_perserta_target"
															  rows="3"><?php echo $class->class_perserta_target?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="Seo" class="col-sm-4 control-label">Jumlah Minimal Peserta</label>
												<div class="col-sm-8">
													<input type="number" 
														   class="form-control" 
														   id="class_peserta_min" 
														   name="class_peserta_min"
														   placeholder="Minimal jumlah peserta dalam kelas"
														   value="<?php echo $class->class_peserta_min?>"
														   min="2" />
												</div>
											</div>
											<div class="form-group">
												<label for="Seo" class="col-sm-4 control-label">Jumlah Maksimal Peserta</label>
												<div class="col-sm-8">
													<input type="number" 
														   class="form-control" 
														   id="class_peserta_max"
														   name="class_peserta_max"
														   value="<?php echo $class->class_peserta_max?>"
														   placeholder="Maksimal jumlah peserta dalam kelas" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Tingkat Keahlian</label>
												<div class="col-sm-8">
<?php
	if($levels->num_rows() > 0):
		foreach($levels->result() as $level):
			if(!empty($class->level[$level->id])) $selected = TRUE;
?>
													<div class="radio">
														<label>
															<input type="checkbox" 
																   varlue=""
																   <?php $selected?'checked="checked"':'';?>
																   name="class_level[<?php echo $level->id?>]" /> 
															<?php echo ucwords($level->nama);?>
															(<em><?php echo ucwords($level->name);?></em>)
														</label>
													</div>
<?php
		endforeach;
	endif;
?>
												</div>
											</div>
											<div class="form-group">
												<label for="class_alasan" class="col-sm-4 control-label">Alasan Mengikuti Kelas</label>
												<div class="col-sm-8">
													<textarea class="form-control" 
															  placeholder="Alasan mengapa sebaiknya murid mengikuti kelas ini" 
															  name="class_alasan"
															  id="class_alasan"
															  rows="3"><?php echo $class->class_alasan;?></textarea>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<a data-toggle="collapse" 
													   data-parent="#profile" 
													   href="#form_info"
													   class="btn btn-default main-button next-button"
													   aria-controls="form_info"
													   aria-expanded="true">
														Lanjut
													</a>
												</div>
											</div>
										</div>
										<div class="section-heading">
											<h3 class="section-title">
												<a data-toggle="collapse" 
												   data-parent="#profile" 
												   href="#form_info"
												   aria-controls="form_info"
												   aria-expanded="false">
													Info
												</a>
											</h3>
										</div>
										<div id="form_info" class="collapse">
											<div class="form-group">
												<label for="tentang" class="col-sm-4 control-label">Catatan</label>
												<div class="col-sm-8">
													<textarea class="form-control" 
															  name="class_catatan"
															  id="class_catatan"
															  placeholder="Adakah catatan yang ingin anda cantumkan" 
															  rows="3"><?php echo $class->class_catatan;?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="Namakelas" class="col-sm-4 control-label">Video</label>
												<div class="col-sm-8">
													<input type="text" 
														   class="form-control" 
														   id="class_video" 
														   name="class_video" 
														   value="<?php echo $class->class_video;?>"
														   placeholder="Paste video URL disini, mis: http://www.youtube.com/watch?v=dXyQ92SPWds">
												</div>
											</div>
											<div class="form-group">
												<label for="attachment" class="col-sm-4 control-label">Foto / Image</label>
												<div class="col-sm-8">
													<input type="file" id="class_image">
												</div>
											</div>
<?php
	if(!empty($class->class_image)) :
		$image = '<img src="'.base_url().'images/class/'.$class->id.'/'.$class->class_image.'" class="img-responsive" />';
?>
											<div class="row">
												<div class="col-sm-8">
													<?php echo $image;?>
												</div>
											</div>
<?php 
	endif;
?>
<?php /*
											<div class="form-group">
												<label for="Namakelas" class="col-sm-4 control-label">Tags</label>
												<div class="col-sm-8">
													<select class="form-control level">
														<option value="0">Dasar</option>
														<option value="1">Pemula</option>
														<option value="2">Menengah</option>
														<option value="3">Mahir</option>
														<option value="4">Ahli</option>
														<option value="5">Master</option>
													</select>
													<em>* Pisahkan dengan tanda koma diantara tag</em>
												</div>
											</div>
// */ ?>
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<a data-toggle="collapse" 
													   data-parent="#profile" 
													   href="#form_schedule"
													   class="btn btn-default main-button next-button"
													   aria-controls="form_schedule"
													   aria-expanded="true">
														Lanjut
													</a>
												</div>
											</div>
										</div>
										<div class="section-heading">
											<h3 class="section-title">
												<a data-toggle="collapse" 
												   data-parent="#profile" 
												   href="#form_schedule"
												   aria-controls="form_schedule"
												   aria-expanded="false">
													Jadwal
												</a>
											</h3>
										</div>
										<div id="form_schedule" class="collapse">
											<div class="table-responsive" style="overflow: hidden;">
												<table class="table table-bordered" id="tbl_jadwal">
													<thead>
													<tr>
														<th class="text-center">No.</th>
														<th class="text-center">Tanggal</th>
														<th class="text-center">Mulai</th>
														<th class="text-center">Selesai</th>
														<th class="text-center">Topik</th>
														<th class="text-center">Action</th>
													</tr>
													</thead>
													<tbody>
<?php
$i=0;
	if($jadwal->num_rows() == 0):
?>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_date" 
																   data-date-format="DD MMM gggg" 
																   placeholder="12 Feb 2015" />
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_time" 
																   data-date-format="HH:mm" 
																   placeholder="15:00" />
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_time" 
																   data-date-format="HH:mm" 
																   placeholder="16:30" />
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control" 
																   style="width: 100%"
																   placeholder="Topik untuk sesi ini" />
														</td>
														<td class="text-center">
															<a href="#">delete</a>
														</td>
													</tr>
<?php
	elseif($jadwal->num_rows() > 0):
		if($class->class_paket == 0):
			$jdwl = $jadwal->row();
			$tanggal = date('d M Y', strtotime($jdwl->class_tanggal));
			$start = $jdwl->class_jam_mulai.':'.$jdwl->class_menit_mulai;
			$end = $jdwl->class_jam_selesai.':'.$jdwl->class_menit_selesai;
			$topik = $jdwl->class_jadwal_topik;
?>
													<tr>
														<td class="text-center">1</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_date" 
																   data-date-format="DD MMM gggg" 
																   value="<?php echo $tanggal; ?>"
																   placeholder="12 Feb 2015" />
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_time" 
																   data-date-format="HH:mm" 
																   value="<?php echo $start; ?>"
																   placeholder="15:00" />
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_time" 
																   data-date-format="HH:mm" 
																   value="<?php echo $end; ?>"
																   placeholder="16:30">
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control" 
																   style="width: 100%"
																   value="<?php echo $topik; ?>"
																   placeholder="Topik untuk sesi ini">
														</td>
														<td class="text-center">
															<a href="#">delete</a>
														</td>
													</tr>
<?php
		else:
			foreach($jadwal->result() as $jdwl):
				$i++;
				$tanggal = date('d M Y', strtotime($jdwl->class_tanggal));
				$start = $jdwl->class_jam_mulai.':'.$jdwl->class_menit_mulai;
				$end = $jdwl->class_jam_selesai.':'.$jdwl->class_menit_selesai;
				$topik = $jdwl->class_jadwal_topik;
?>
													<tr>
														<td class="text-center"><?php echo $i;?></td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_date" 
																   data-date-format="DD MMM gggg" 
																   value="<?php echo $jdwl->class_tanggal; ?>"
																   placeholder="12 Feb 2015" />
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_time" 
																   data-date-format="HH:mm" 
																   value="<?php echo $start; ?>"
																   placeholder="15:00" />
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_time" 
																   data-date-format="HH:mm" 
																   value="<?php echo $end; ?>"
																   placeholder="16:30">
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control" 
																   style="width: 100%"
																   value="<?php echo $topik; ?>"
																   placeholder="Topik untuk sesi ini">
														</td>
														<td class="text-center">
															<a href="#">delete</a>
														</td>
													</tr>
<?php
			endforeach;
		endif;
	endif;
?>
													</tbody>
												</table>
<?php
		if($class->class_paket != 0):
?>
												<div class="form-group">
													<div class="col-sm-8 submit-form">
														<button class="btn btn-default main-button register">Tambah Sesi</button>
													</div>
												</div>
<?php 
		endif;
?>
											</div><!-- table-responsive --><!-- section-content -->
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<a data-toggle="collapse" 
													   data-parent="#profile" 
													   href="#form_payment"
													   class="btn btn-default main-button next-button"
													   aria-controls="form_payment"
													   aria-expanded="true">
														Lanjut
													</a>
												</div>
											</div>
										</div>
										<div class="section-heading">
											<h3 class="section-title">
												<a data-toggle="collapse" 
												   data-parent="#profile" 
												   href="#form_payment"
												   aria-controls="form_payment"
												   aria-expanded="false">
													Biaya
												</a>
											</h3>
										</div>
										<div id="form_payment" class="collapse">
											<div class="form-group">
												<label for="Namakelas" class="col-sm-4 control-label">Jumlah Sesi</label>
												<div class="col-sm-8">
													<input type="number" 
														   class="form-control" 
														   id="jumlah_sesi" 
														   readonly="readonly"
														   placeholder="" />
												</div>
											</div>
											<div class="form-group">
												<label for="Namakelas" class="col-sm-4 control-label">Harga per Sesi</label>
												<div class="col-sm-8">
													<input type="number" 
														   class="form-control" 
														   id="harga_per_sesi" 
														   value="<?php echo $harga;?>"
														   placeholder="Nama dari kelas yang akan diselenggarakan" />
												</div>
											</div>
											<div class="form-group">
												<label for="Namakelas" class="col-sm-4 control-label">Total</label>
												<div class="col-sm-8">
													<input type="number" 
														   class="form-control" 
														   readonly="readonly"
														   id="total_harga" 
														   placeholder="" />
												</div>
											</div>
											<div class="form-group">
												<label for="uri" class="col-sm-4 control-label">Diskon (dalam Rupiah)</label>
												<div class="col-sm-8">
													<input type="number" 
														   class="form-control" 
														   id="harga_diskon" 
														   value="<?php echo $diskon;?>"
														   placeholder="0" />
													<em>* Hanya diberlakukan untuk pendaftaran 1 paket</em>
												</div>
											</div>
											<div class="form-group">
												<label for="uri" class="col-sm-4 control-label">Total per Paket</label>
												<div class="col-sm-8">
													<input type="text" 
														   class="form-control" 
														   readonly="readonly"
														   id="total_harga_paket" 
														   placeholder="" />
												</div>
											</div>
											<div class="form-group">
												<label for="tentang" class="col-sm-4 control-label">Harga termasuk</label>
												<div class="col-sm-8">
													<textarea class="form-control" 
															  placeholder="Harga diatas sudah termasuk" 
															  rows="3"><?php echo $class->class_include;?></textarea>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-9 submit-form">
												<button type="submit" class="btn btn-default main-button register">Simpan</button>
												<button type="submit" class="btn btn-default cancel">Batal</button>
											</div>
										</div>
									</form>
<script type="application/javascript">
	$(document).ready(function(e){
		var profile_active = false;
		$('#profile .collapse').on('show.bs.collapse', function(e){
			if(!profile_active) {
				$('#profile .collapse.in').collapse('hide');
				profile_active = true;
				$(this).collapse('show');
				$(this).on('shown.bs.collapse', function(){
					check_price();
					profile_active = false;
				});
			}
//			console.log($(this).attr('id'));
		});
		$('#form_payment input').change(function(){
			check_price();
		});
		
		function check_price() {
			var harga_per_sesi = parseInt($('#harga_per_sesi').val());
			var jumlah_sesi = $('#tbl_jadwal tbody tr').length;
			var total_harga = harga_per_sesi * jumlah_sesi; //parseInt($('#total_harga').val());
			var harga_diskon = parseInt($('#harga_diskon').val());
			var total_harga_paket = total_harga - harga_diskon;
			$('#jumlah_sesi').val(jumlah_sesi);
			$('#total_harga').val(total_harga);
			$('#total_harga_paket').val(total_harga_paket);
		}
	});
</script>
								</div><!-- profile -->
								<div role="tabpanel" class="tab-pane" id="murid">
									<div class="section-wrap">
										<div class="section-heading"><h3 class="section-title">Peserta Kelas</h3></div>
<?php /*
<pre>
<?php
	var_dump($attendance);
?>
</pre>
// */ ?>
										<div class="section-content table">
											<div class="table-responsive">
												<table class="table table-bordered">
<?php
	$i = 0;
	foreach($attendance as $list_jadwal):
?>
													<thead class="text-center">
														<tr>
															<td colspan="2">
																<?php echo 'Sesi '.++$i.'. '.$list_jadwal['topik'];?>
															</td>
														</tr>
														<tr>
															<td>Pemesan</td>
															<td>Murid</td>
														</tr>
													</thead>
													<tbody>
<?php
		foreach($list_jadwal['murid'] as $list_murid):
			$pemesan_first_line = "{$list_murid['pemesan']['nama']} ({$list_murid['pemesan']['phone']})";
			$pemesan_second_line = "<a href=\"{$list_murid['pemesan']['email']}\">{$list_murid['pemesan']['email']}</a>";
			$peserta_first_line = "{$list_murid['peserta']['nama']} ({$list_murid['peserta']['phone']})";
			$peserta_second_line = "<a href=\"{$list_murid['peserta']['email']}\">{$list_murid['peserta']['email']}</a>";
?>
														<tr>
															<td class="text-center">
																<?php echo $pemesan_first_line;?><br />
																<?php echo $pemesan_second_line;?>
															</td>
															<td class="text-center">
																<?php echo $peserta_first_line;?><br />
																<?php echo $peserta_second_line;?>
															</td>
														</tr>

<?php
		endforeach;
?>
													</tbody>
<?php
	endforeach;
?>
												</table>
											</div><!-- table-responsive -->

											<div class="col-sm-offset-8 col-sm-4">
												<button type="submit" class="btn btn-default main-button register">Download</button>
											</div>
										</div><!-- section-content -->
									</div><!-- section-wrap -->
								</div><!-- murid -->
								<div role="tabpanel" class="tab-pane" id="diskon">
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead class="text-center">
												<tr>
													<td>Kode<br />Discount</td>
													<td>Type</td>
													<td>Maks<br />Pengguna</td>
													<td>Start</td>
													<td>Expire</td>
													<td>Value</td>
												</tr>
											</thead>
											<tbody class="text-center">
<?php
	if(count($discount) < 1):
?>
												<tr>
													<td colspan="5">
														Belum ada! <br />
														Gunakan form dibawah untuk membuat discount!
													</td>
												</tr>
<?php
	else:
		foreach($discount as $disc):
			$max_amount = $disc['main']->max_amount == 9999?'Unlimited':$disc['main']->max_amount;
			$start = strpos($disc['main']->start_date, '1971')===FALSE?
					array_shift(explode(' ',$disc['main']->start_date)):
					'Mulai Pendaftaran';
			$end = strpos($disc['main']->expire_date, '2200')===FALSE?
					array_shift(explode(' ',$disc['main']->expire_date)):
					'Akhir Pendaftaran';
			$value = $disc['value']->type=='idr'?
					(rupiah_format($disc['value']->value)):
					('%'.$disc['value']->value);
?>
												<tr>
													<td><?php echo $disc['main']->code?></td>
													<td><?php echo $disc['main']->scope?></td>
													<td><?php echo $max_amount;?></td>
													<td><?php echo $start;?></td>
													<td><?php echo $end;?></td>
													<td><?php echo $value;?></td>
												</tr>
<?php
		endforeach;
	endif;
?>
											</tbody>
										</table>
									</div><!-- table-responsive -->
								
									<div class="section-heading"><h3 class="section-title">Buat Kode Baru</h3></div>
									<form class="form-horizontal">
										<div class="col-sm-12">
											<h4 class="review-title">Tipe Kode Diskon</h4>
											<div class="form-group">
												<div class="radio diskon">
													<div class="col-sm-3">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
															Targeted 
														</label>
													</div>
													<div class="col-sm-9">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
															 Publik (Diskon terpasang untuk semua murid) 
														</label>
													</div>
												</div>
											</div><!-- form-group -->
											<h4 class="review-title">Nilai Diskon</h4>
											<div class="form-group">
												<div class="col-sm-6">
													<div class="radio jumlah">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
															Rp
															<input type="number">
															atau
														</label> 
													</div>
												</div>
												<div class="col-sm-6">
													<div class="radio jumlah">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
															%
															<input type="number"><br />
															dari harga yang terpasang
														</label>
													</div>
												</div>
											</div><!-- form-group -->
										</div>

										<div class="col-sm-12">
											<h4 class="review-title">Masa Berlaku Kode Diskon</h4>
											<div class="form-group">
												<div class="col-sm-5">
													<div class="radio">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
															Sejak awal pendaftaran
														</label> 
													</div>
												</div>
												<div class="col-sm-1">
													atau
												</div>
												<div class="col-sm-6">
													<div class="radio">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
															Tanggal
															<input type="text">
														</label>
													</div>
												</div>
											</div><!-- form-group -->
											<hr />
											<div class="form-group">
												<div class="col-sm-5">
													<div class="radio">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
															Sampai akhir pendaftaran
														</label> 
													</div>
												</div>
												<div class="col-sm-1">
													atau
												</div>
												<div class="col-sm-6">
													<div class="radio">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
															Tanggal
															<input type="text">
														</label>
													</div>
												</div>
											</div><!-- form-group -->
										</div>
										<div class="col-sm-12">
											<h4 class="review-title">Masukkan Kode</h4>
											<div class="form-inline">
												<div class="form-group">
													<input type="text" placeholder="Ketik Kode atau" id="kupon" class="form-control">
													<button class="btn btn-default cek-button" type="submit">Auto Generate</button>
												</div>
											</div>
										</div>
										<div class="col-sm-12">
											<h4 class="review-title">Jumlah Penggunaan</h4>
											<div class="form-group">
												<div class="col-sm-5">
													<div class="radio">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
															Tidak terbatas 
														</label>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="radio">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
															<input type="number">  Penggunaan
														</label>
													</div>
												</div>
											</div><!-- form-group -->
										</div>
										<div class="form-group">
											<div class="col-md-offset-3 col-sm-offset-2 col-sm-9 submit-form">
												<button type="submit" class="btn btn-default main-button register">Simpan</button>
												<button type="submit" class="btn btn-default cancel">Reset</button>
											</div>
										</div>
									</form>

								</div><!-- diskon -->
								<div role="tabpanel" class="tab-pane" id="komunikasi">
									<form class="form-horizontal">
										<div class="form-group">
											<label for="penerima" class="col-sm-2 control-label">Jenis Pesan</label>
											<div class="col-sm-10">
												<select class="form-control" name="jenis_pesan" id="jenis_pesan">
													<option value="1">Pengumuman</option>
													<option value="2">Pengingat</option>
													<option value="3">Peringatan</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="penerima" class="col-sm-2 control-label">Penerima</label>
											<div class="col-sm-10">
												<select class="form-control" name="penerima" id="penerima">
													<option value="1">Murid</option>
													<option value="2">Pemesan</option>
													<option value="3">Murid dan Pemesan</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="subject" class="col-sm-2 control-label">Subject</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="subject" placeholder="Subject">
											</div>
										</div>
										<div class="form-group">
											<label for="message" class="col-sm-2 control-label">Message</label>
											<div class="col-sm-10">
												<textarea class="form-control" placeholder="Message" rows="3"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="attachment" class="col-sm-2 control-label">Attachment</label>
											<div class="col-sm-10">
												<input type="file" id="attachment">
											</div>
										</div>
									  <div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" class="btn btn-default main-button register">Kirim</button>
										</div>
									  </div>
									</form>

									<h4 class="review-title">
										Pengumuman Mulai Kelas Jahit Tingkat Dasar (Sesi 1)
										<span class="info"><em>Dikirim tanggal 15-02-2015</em></span>
									</h4>

									<div class="pesan-content">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime fuga expedita voluptatum at incidunt reiciendis commodi obcaecati nisi aperiam modi dicta sint qui iste repudiandae, tempore ut magni quidem sapiente! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quisquam minus sapiente iusto corrupti architecto quasi, dolorum rem delectus eveniet veniam sequi perspiciatis nemo, nihil obcaecati voluptas iste temporibus laudantium.</p>
									</div>

									<div class="col-sm-offset-8 col-sm-4">
										<button type="submit" class="btn btn-default main-button register">Kirim Ulang</button>
									</div>

								</div><!-- komunikasi -->
							</div><!-- tab-content -->

						</div><!-- tabpanel kelas -->
					</div><!-- panel-body -->
				</div><!-- panel -->
			</div>
		</div>
	</div> <!-- /container -->
<script type="application/javascript">
	$(document).ready(function(){
		
		$('.jadwal_date').datetimepicker({
			pickTime		: false,
			minDate			: todayDate.year+'-'+todayDate.month+'-'+todayDate.date,
			showToday		: true
		});
		$('.jadwal_time').datetimepicker({
			pickDate		: false,
			useSeconds		: false,
			minuteStepping	: 5,
			use24hours		: true
		});
		
	});
</script>
<?php
$this->load->view('vendor/general/footer2');