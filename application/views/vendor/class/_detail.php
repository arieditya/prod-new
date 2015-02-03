<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/13/14
 * Time: 11:58 AM
 * Proj: private-development
 */
$this->load->view('vendor/general/header');
?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.tagsinput.css" type="text/css" />
<script type="application/javascript" src="<?php echo base_url();?>assets/js/moment.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/jquery.tagsinput.min.js" ></script>
	<div class="row" style="margin-top: 20px;">
		<div class="col-md-3"></div>
		<div class="col-md-9">
			<h3>Edit Kelas</h3>
			<div id="form-tabs">
				<ul class="nav nav-tabs" role="tablist">
					<li id="tab_profile" class="<?php echo empty($tabs)|| $tabs=='profile'?'active':''?>"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
					<li id="tab_info" class="<?php echo $tabs=='info'?'active':''?>"><a href="#info" role="tab" data-toggle="tab">Info</a></li>
					<li id="tab_jadwal" class="<?php echo $tabs=='shcedule'?'active':''?>"><a href="#schedule" role="tab" data-toggle="tab">Jadwal</a></li>
					<li id="tab_biaya" class="<?php echo $tabs=='biaya'?'active':''?>"><a href="#biaya" role="tab" data-toggle="tab">Biaya</a></li>
					<li id="tab_summary" class="<?php echo $tabs=='summary'?'active':''?>"><a href="#summary" role="tab" data-toggle="tab">Summary</a></li>
				</ul>
				<div class="tab-content" style="margin-top: 20px;margin-bottom: 20px;">
					<div class="tab-pane <?php echo empty($tabs)|| $tabs=='profile'?'active':''?>" id="profile">
						<form method="post" class="form-horizontal" action="<?php echo base_url();?>vendor/kelas/update_profile">
							<input type="hidden" value="<?php echo $class->id;?>" name="id" id="id" />
							<div class="form-group">
								<label class="col-md-3 control-label">Tentang kelas</label>
								<div class="col-md-9">
									<textarea name="class_deskripsi"
											placeholder="Deskripsi mengenai kelas yang akan dilaksanakan sebanyak 1-2 paragraf. Kalimat disarankan bersifat persuasif dan menjelaskan mengapa kelas ini harus diikuti oleh target perserta. Anda juga bisa memaparkan secara singkat, mengapa Anda adalah 'guru' yang tepat untuk kelas ini."
											class="form-control" rows="5"><?php echo $class->class_deskripsi;?>
									</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Alamat kelas</label>
								<div class="col-md-9">
										<textarea name="class_lokasi" class="form-control" rows="5"><?php echo $class->class_lokasi;?></textarea>
								</div>
							</div>
							<div class="form-group has-feedback">
								<label class="col-md-3 control-label">Peta Lokasi</label>
								<div class="col-md-5">
									<input class="form-control" type="text" id="class_map_search" name="maps" placeholder="Masukan nama area atau lokasi anda" />
									<button class="form-control-feedback panel alert-warning" id="btn_search_maps">
										<i class="glyphicon glyphicon-search"></i>
									</button>
<?php
	$ll = explode('||', $class->class_peta);
	$ll = $ll[0];
?>
									<input id="class_maps" class="form-control" readonly="readonly" value="<?php echo $class->class_peta;?>" type="text" name="class_peta" placeholder="" style="margin-top: 5px;" />
								</div>
								<div class="col-md-4">
									<img id="img_preview" src="https://maps.googleapis.com/maps/api/staticmap?size=250x180&maptype=roadmap&markers=color:red%7C<?php echo $ll;?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Jumlah peserta</label>
									<div class="col-md-9">
										<input class="form-control" type="number" name="class_peserta" value="<?php echo $class->class_peserta;?>" 
												placeholder="Jumlah maksimal siswa dalam satu kelas" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Harga per sesi</label>
								<div class="col-md-9">
										<input type="number" class="form-control" name="class_harga" value="<?php echo $class->class_harga;?>"
												placeholder="arga per sesi pertemuan (misal: Rp 100,000/ sesi)" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Kelas Paket</label>
								<div class="col-md-9">
<?php
	$class_package = $class->class_paket == 0?'':'checked="checked" ';
?>
									<label class="checkbox-inline">
										<input type="checkbox" <?php echo $class_package;?>name="class_paket" value="ya" /> <span>Ya, ini adalah kelas paket!</span>
									</label>
								</div>
							</div>
							<hr />
							<div class="form-group">
								<label class="col-md-3 control-label">Kategori</label>
								<div class="col-md-9">
									<select class="form-control" name="class_category">
										<option>-- Pilih Kategory --</option>
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
								<label class="col-md-3 control-label">Tingkat keahlian</label>
								<div class="col-md-9">
									<select class="form-control" name="class_level">
										<option>-- Pilih tingkat --</option>
<?php
	if($levels->num_rows() > 0):
		foreach($levels->result() as $level):
			if($level->id == $class->level->id) $selected = TRUE;
?>
										<option value="<?php echo $level->id?>" <?php echo $selected?'selected="selected"':'';?>><?php echo ucwords($level->nama);?></option>
<?php
		endforeach;
	endif;
?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Alasan megikuti kelas</label>
								<div class="col-md-9">
									<textarea class="form-control" name="class_alasan" rows="5" placeholder="Alasan mengapa sebaiknya murid mengikuti kelas ini" ><?php echo $class->class_alasan;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-success" type="submit">Submit</button>
									<button class="btn btn-warning" type="reset">reset</button>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane <?php echo $tabs=='info'?'active':''?>" id="info">
						<form method="post" action="<?php echo base_url()?>vendor/kelas/update_info" class="form-horizontal" enctype="multipart/form-data">
							<input type="hidden" value="<?php echo $class->id;?>" name="id" />
							<div class="form-group">
								<label class="col-md-3 control-label">Catatan Tambahan</label>
								<div class="col-md-9">
									<textarea class="form-control" name="class_catatan" placeholder="Adakah catatan lain yang ingin anda cantumkan?" rows="5" ><?php echo $class->class_catatan;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Video</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="class_video" value="<?php echo $class->class_video;?>" placeholder="Link video kelas ini, mis: http://www.youtube.com/watch?v=dXyQ92SPWds" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Foto kelas</label>
<?php
	if(!empty($class->class_image)):
?>
								<div class="col-md-5">
									<input type="file" class="form-control" name="class_image" value="<?php echo $class->class_image;?>" placeholder="Upload foto kelas ini" />
								</div>
								<div class="col-md-4">
									<img style="width: 250px" src="<?php echo base_url()."images/class/{$class->id}/{$class->class_image}";?>" />
								</div>
<?php
	else:
?>
								<div class="col-md-9">
									<input type="file" class="form-control" name="class_image" value="<?php echo $class->class_image;?>" placeholder="Upload foto kelas ini" />
								</div>
<?php
	endif;
?>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Tags<br /><small>Pisahkan dengan tanda koma untuk tiap tag</small></label>
								<div class="col-md-9">
									<textarea class="form-control tagInput" name="class_tags" row="5" placeholder="Masukan tag yang ingin ditambahkan, pisahkan tiap tag dengan tanda koma."><?php echo $tags;?></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-success" type="submit">Submit</button>
									<button class="btn btn-warning" type="reset">reset</button>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane <?php echo $tabs=='schedule'?'active':''?>" id="schedule">
						<form class="form-horizontal" action="<?php echo base_url();?>vendor/kelas/update_schedule" method="post">
							<input type="hidden" value="<?php echo $class->id;?>" name="id" />
							<table class="table table-hover table-bordered table-responsive table-striped">
								<thead>
								<tr>
									<th class="center-top">Sesi<br />&nbsp;</th>
									<th class="center-top">Tanggal<br />&nbsp;</th>
									<th class="center-top">Waktu Mulai<br />&nbsp;</th>
									<th class="center-top">Waktu Selesai<br />&nbsp;</th>
									<th style="width: 300px;">Topik<br /><small>(kosongkan untuk tidak menampilkan field ini)</small></th>
									<th>Action<br />&nbsp;</th>
								</tr>
								</thead>
								<tbody id="class_sched">
<?php
$i=0;
	foreach($jadwal->result() as $sched):
		$i++;
?>
								<tr data-id="<?php echo $sched->jadwal_id;?>">
									<td>
										<div class="form-group has-feedback">
											<div class="col-md-12">
												<?php echo $i;?>
											</div>
										</div>
									</td>
									<td>
										<div class="form-group has-feedback">
											<div class="col-md-12">
												<input type="text" class="form-control jadwal_date" id="" name="jadwal_date[<?php echo $sched->jadwal_id;?>]" data-date-format="YYYY-MM-DD" placeholder="2014-10-15" value="<?php echo $sched->class_tanggal?>" />
												<button class="form-control-feedback panel alert-warning copy_date" data-class="date" >
													<span class="glyphicon glyphicon-book" title="Copy to other fields"></span>
												</button>
											</div>
										</div>
									</td>
									<td>
										<div class="form-group has-feedback">
											<div class="col-md-12">
												<input type="text" class="form-control jadwal_time_start" id="" name="jadwal_time_start[<?php echo $sched->jadwal_id;?>]" data-date-format="HH:mm" placeholder="mis: 17:30" value="<?php echo $sched->class_jam_mulai.':'.$sched->class_menit_mulai;?>" />
												<button class="form-control-feedback panel alert-warning copy_time_start" data-class="time_start" >
													<span class="glyphicon glyphicon-book" title="Copy to other fields"></span>
												</button>
											</div>
										</div>
									</td>
									<td>
										<div class="form-group has-feedback">
											<div class="col-md-12">
												<input type="text" class="form-control jadwal_time_end" id="" name="jadwal_time_end[<?php echo $sched->jadwal_id;?>]" data-date-format="HH:mm" placeholder="mis: 17:30" value="<?php echo $sched->class_jam_selesai.':'.$sched->class_menit_selesai;?>"/>
												<button class="form-control-feedback panel alert-warning copy_time_end" data-class="time_end" >
													<span class="glyphicon glyphicon-book" title="Copy to other fields"></span>
												</button>
											</div>
										</div>
									</td>
									<td>
										<div class="form-group has-feedback">
											<div class="col-md-12">
												<input type="text" id="" class="form-control jadwal_topic" name="jadwal_topik[<?php echo $sched->jadwal_id;?>]" />
												<button class="form-control-feedback panel alert-warning copy_topic" data-class="topic" >
													<span class="glyphicon glyphicon-book" title="Copy to other fields"></span>
												</button>
											</div>
										</div>
									</td>
									<td>
										<div class="form-group">
											<div class="col-md-12">
												<button class="btn btn-xs btn-danger" class="delete_button">Delete</button>
											</div>
										</div>
									</td>
								</tr>
<?php
	endforeach;
?>
								</tbody>
								<tfoot>
								<tr>
									<td colspan="6">
										<button type="button" id="add_class_session" class="btn btn-info btn-lg">
											<i class="glyphicon glyphicon-plus"></i>
											<span>Tambah Sesi</span>
										</button>
									</td>
								</tr>
								</tfoot>
							</table>
							<button class="btn btn-success" type="submit">Submit</button>
							<button class="btn btn-warning btn-sm" type="reset">Reset</button>
<?php
	$price = $biaya->row();
?>
						</form>
					</div>
					<div class="tab-pane <?php echo $tabs=='biaya'?'active':''?>" id="biaya">
						<form class="form-horizontal" action="<?php echo base_url();?>vendor/kelas/update_biaya" method="post">
							<input type="hidden" value="<?php echo $class->id;?>" name="id" />
							<div class="form-group">
								<label class="col-md-offset-1 col-md-2 control-label">Jumlah Sesi</label>
								<div class="col-md-8">
									<input class="form-control" readonly="readonly" value="<?php echo $jadwal->num_rows();?>" id="count_sess" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-offset-1 col-md-2 control-label">Harga per sesi</label>
								<div class="col-md-8">
									<input class="form-control" name="price_per_session" id="price_per_session" value="<?php echo empty($price->price_per_session)?'':$price->price_per_session;?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-offset-1 col-md-2 control-label">Total</label>
								<div class="col-md-8">
									<input class="form-control" readonly="readonly" id="total_price" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">
									Diskon (dalam Rp.)<br />
									<small>Hanya diberlakukan untuk pendaftaran 1 paket</small>
								</label>
								<div class="col-md-8">
									<input class="form-control" id="discount_price" name="discount_price" value="<?php echo empty($price->discount)?'':$price->discount;?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">
									Total per paket<br />
								</label>
								<div class="col-md-8">
									<input class="form-control" readonly="readonly" id="total_per_package" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">
									Harga diatas termasuk<br />
								</label>
								<div class="col-md-8">
									<textarea class="form-control" name="class_include"
											  placeholder="Tuliskan apa saja yang termasuk dalam paket anda, seperti: Sertifikat, Biaya peminjaman alat, Bahan-bahan, Sewa ruangan, dll"><?php echo empty($class->class_include)?'':$class->class_include;?></textarea>
								</div>
							</div>
							<div class="form-group">

								<div class="col-md-offset-3 col-md-8">
									<button class="btn btn-success" type="submit">Submit</button>
									<button class="btn btn-warning btn-sm" type="reset">reset</button>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane <?php echo $tabs=='summary'?'active':''; ?>" id="summary">
						<div class="blue-bar" style="margin: 20px 0;">
							<h4>Profile</h4>
						</div>
						<div class="row">
							<div class="col-md-4">Nama</div>
							<div class="col-md-8"><?php echo $class->class_nama; ?></div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-4">URI</div>
							<div class="col-md-8"><?php echo $class->class_uri; ?></div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-4">Deskripsi</div>
							<div class="col-md-8">
								<p><?php echo nl2br($class->class_deskripsi); ?></p>
							</div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-4">Alamat</div>
							<div class="col-md-8"><?php echo $class->class_lokasi; ?></div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-4">Peta</div>
							<div class="col-md-8">
<?php
	$ll = explode('||', $class->class_peta);
?>
								<a target="_blank" href="<?php echo empty($ll[1])?'#':$ll[1];?>"><img id="img_preview" src="https://maps.googleapis.com/maps/api/staticmap?size=550x420&maptype=roadmap&markers=color:red%7C<?php echo empty($ll[0])?'':$ll[0];?>" /></a>
 							</div>
						</div>
						<div class="blue-bar" style="margin: 20px 0;">
							<h4>Info</h4>
						</div>
						<div class="row">
							<div class="col-md-4">Catatan</div>
							<div class="col-md-8"><?php echo nl2br($class->class_catatan);?></div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-4">Video</div>
<?php 	if(!empty($class->class_video))
			$video = preg_replace('/^.*v\=/', '', $kelas->kelas_guru_video);
		else $video = '';
?>
							<div class="col-md-8">
								<iframe id="player" type="text/html" width="540" height="335"
										src="http://www.youtube.com/embed/<?php echo $video;?>?enablejsapi=1&origin=<?php echo base_url();?>"
										frameborder="0">
								</iframe>
							</div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-4">Photo</div>
							<div class="col-md-8">
								<img style="width: 100%" src="<?php echo base_url()."images/class/{$class->id}/{$class->class_image}";?>" />
							</div>
						</div>
						<div class="blue-bar" style="margin: 20px 0;">
							<h4>Jadwal</h4>
						</div>
						<table class="table table-bordered table-responsive table-striped">
							<thead>
							<tr>
								<th>Session ID <small>(Tidak urut)</small></th>
								<th>Tanggal</th>
								<th>Mulai</th>
								<th>Selesai</th>
								<th>Topik</th>
							</tr>
							</thead>
							<tbody>
<?php 
	$sched = $jadwal->result();
	foreach($sched as $schedule):
?>
							<tr>
								<td><?php echo $schedule->jadwal_id;?></td>
								<td><?php echo $schedule->class_tanggal;?></td>
								<td><?php echo $schedule->class_jam_mulai.':'.$schedule->class_menit_mulai;?></td>
								<td><?php echo $schedule->class_jam_selesai.':'.$schedule->class_menit_selesai;?></td>
								<td><?php echo $schedule->class_jadwal_topik;?></td>
							</tr>
<?php 
	endforeach;
?>
							</tbody>
						</table>
						<div class="blue-bar" style="margin: 20px 0;">
							<h4>Biaya</h4>
						</div>
						<div class="row">
							<div class="col-md-4">Jumlah pertemuan (sesi)</div>
							<div class="col-md-8"><?php echo $jadwal->num_rows(); ?> x pertemuan</div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-4">Harga per sesi</div>
							<div class="col-md-8">Rp. <?php echo number_format($price->price_per_session, 0, ',','.'); ?>,--</div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-4">Total</div>
							<div class="col-md-8">Rp. <?php echo number_format($price->price_per_session * $jadwal->num_rows(), 0, ',','.'); ?>,--</div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-4">Potongan harga</div>
							<div class="col-md-8">Rp. <?php echo number_format($price->discount, 0, ',','.');?></div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-4">Total sesudah diskon</div>
							<div class="col-md-8">Rp. <?php echo number_format(($price->price_per_session * $jadwal->num_rows()) - $price->discount, 0, ',','.')?></div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-4">Harga sudah meliputi</div>
							<div class="col-md-8"><?php echo nl2br($class->class_include);?></div>
						</div>
					</div>
				</div>
			</div>
<?php /*?>
			<div class="panel panel-info">
				<div class="panel-heading">
					<h2><?php echo $class->class_nama;?> <small><?php echo $class->class_uri;?></small></h2>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="<?php echo base_url();?>vendor/kelas/update/<?php echo $class->id;?>" method="post" enctype="multipart/form-data">
						<h3>General <small>Keterangan umum</small></h3>
						<input type="hidden" value="<?php echo $class->id;?>" name="id" />
						<div class="form-group">
							<label class="col-md-3 control-label">Tentang kelas</label>
							<div class="col-md-9">
								<textarea name="class_deskripsi" class="form-control" rows="5"
										placeholder="Deskripsi mengenai kelas yang akan dilaksanakan sebanyak 1-2 paragraf. Kalimat disarankan bersifat persuasif dan menjelaskan mengapa kelas ini harus diikuti oleh target perserta. Anda juga bisa memaparkan secara singkat, mengapa Anda adalah 'guru' yang tepat untuk kelas ini."
								><?php echo $class->class_deskripsi;?>
								</textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Alamat kelas</label>
							<div class="col-md-9">
									<textarea name="class_lokasi" class="form-control" rows="5"><?php echo $class->class_lokasi;?></textarea>
							</div>
						</div>
						<div class="form-group has-feedback">
							<label class="col-md-3 control-label">Peta Lokasi</label>
							<div class="col-md-5">
								<input class="form-control" type="text" id="class_map_search" name="maps" placeholder="Masukan nama area atau lokasi anda" />
								<button class="form-control-feedback panel alert-warning" id="btn_search_maps">
									<i class="glyphicon glyphicon-search"></i>
								</button>
<?php
	$ll = explode('||', $class->class_peta);
	$ll = $ll[0];
?>
								<input id="class_maps" class="form-control" readonly="readonly" value="<?php echo $class->class_peta;?>" type="text" name="class_peta" placeholder="" style="margin-top: 5px;" />
							</div>
							<div class="col-md-4">
								<img id="img_preview" src="https://maps.googleapis.com/maps/api/staticmap?size=250x180&maptype=roadmap&markers=color:red%7C<?php echo $ll;?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Jumlah peserta</label>
								<div class="col-md-9">
									<input class="form-control" type="number" name="class_peserta" value="<?php echo $class->class_peserta;?>" 
											placeholder="Jumlah maksimal siswa dalam satu kelas" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Harga per sesi</label>
							<div class="col-md-9">
									<input type="number" class="form-control" name="class_harga" value="<?php echo $class->class_harga;?>"
											placeholder="arga per sesi pertemuan (misal: Rp 100,000/ sesi)" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Kelas Paket</label>
							<div class="col-md-9">
<?php
	$class_package = $class->class_paket == 0?'':'checked="checked" ';
?>
								<label class="checkbox-inline">
									<input type="checkbox" <?php echo $class_package;?>name="class_paket" value="ya" /> <span>Ya, ini adalah kelas paket!</span>
								</label>
							</div>
						</div>
						<hr />
						<div class="form-group">
							<label class="col-md-3 control-label">Kategori</label>
							<div class="col-md-9">
								<select class="form-control" name="class_category">
									<option>-- Pilih Kategory --</option>
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
							<label class="col-md-3 control-label">Tingkat keahlian</label>
							<div class="col-md-9">
								<select class="form-control" name="class_level">
									<option>-- Pilih tingkat --</option>
<?php
	if($levels->num_rows() > 0):
		foreach($levels->result() as $level):
			if($level->id == $class->level->id) $selected = TRUE;
?>
									<option value="<?php echo $level->id?>" <?php echo $selected?'selected="selected"':'';?>><?php echo ucwords($level->nama);?></option>
<?php
		endforeach;
	endif;
?>
								</select>
							</div>
						</div>
						<hr />
						<h3>Detail <small>Keterangan spesifik</small></h3>
						<div class="form-group">
							<label class="col-md-3 control-label">Alasan megikuti kelas</label>
							<div class="col-md-9">
								<textarea class="form-control" name="class_alasan" rows="5" placeholder="Alasan mengapa sebaiknya murid mengikuti kelas ini" ><?php echo $class->class_include;?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Include</label>
							<div class="col-md-9">
								<textarea class="form-control" name="class_include" rows="5" 
										  placeholder="Apakah harga tersebut sudah termasuk fasilitas tambahan yang ingin anda sediakan (misalnya: free trial website di www.xyz.com selama 1 bulan)" ><?php echo $class->class_include;?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Catatan Tambahan</label>
							<div class="col-md-9">
								<textarea class="form-control" name="class_catatan" placeholder="Adakah catatan lain yang ingin anda cantumkan?" rows="5" ><?php echo $class->class_include;?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Video</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="class_video" value="<?php echo $class->class_video;?>" placeholder="Link video kelas ini, mis: http://www.youtube.com/watch?v=dXyQ92SPWds" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Foto kelas</label>
<?php
	if(!empty($class->class_image)):
?>
							<div class="col-md-5">
								<input type="file" class="form-control" name="class_image" value="<?php echo $class->class_image;?>" placeholder="Upload foto kelas ini" />
							</div>
							<div class="col-md-4">
								<img style="width: 250px" src="<?php echo base_url()."images/class/{$class->id}/{$class->class_image}";?>" />
							</div>
<?php
	else:
?>
							<div class="col-md-9">
								<input type="file" class="form-control" name="class_image" value="<?php echo $class->class_image;?>" placeholder="Upload foto kelas ini" />
							</div>
<?php
	endif;
?>
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<button type="submit" class="btn btn-lg btn-primary">Submit</button>
							<button type="reset	" class="btn btn-sm btn-warning">reset</button>
						</div>
					</form>
				</div>
			</div>
<?php // */?>
		</div>
	</div>
<script type="text/template" id="sched_template">
							<tr data-id="">
								<td>
									<div class="form-group has-feedback">
										<div class="col-md-12">
											NEW
										</div>
									</div>
								</td>
								<td>
									<div class="form-group has-feedback">
										<div class="col-md-12">
											<input type="text" class="form-control jadwal_date" id="" name="jadwal_date[]" data-date-format="YYYY-MM-DD" placeholder="2014-10-15" />
											<button class="form-control-feedback panel alert-warning copy_date" data-class="date" id="">
												<span class="glyphicon glyphicon-book" title="Copy to other fields"></span>
											</button>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group has-feedback">
										<div class="col-md-12">
											<input type="text" class="form-control jadwal_time_start" id="" name="jadwal_time_start[]" data-date-format="HH:mm" placeholder="mis: 17:30" />
											<button class="form-control-feedback panel alert-warning copy_time_start" data-class="time_start" >
												<span class="glyphicon glyphicon-book" title="Copy to other fields"></span>
											</button>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group has-feedback">
										<div class="col-md-12">
											<input type="text" class="form-control jadwal_time_end" id="" name="jadwal_time_end[]" data-date-format="HH:mm" placeholder="mis: 17:30" />
											<button class="form-control-feedback panel alert-warning copy_time_end" data-class="time_end" >
												<span class="glyphicon glyphicon-book" title="Copy to other fields"></span>
											</button>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group has-feedback">
										<div class="col-md-12">
											<input type="text" id="" class="form-control" name="jadwal_topik[]" />
											<button class="form-control-feedback panel alert-warning copy_topic" data-class="topic" >
												<span class="glyphicon glyphicon-book" title="Copy to other fields"></span>
											</button>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<div class="col-md-12">
											<button class="btn btn-xs btn-danger">Delete</button>
										</div>
									</div>
								</td>
							</tr>
</script>
<script type="application/javascript">
	var classID = <?php echo $class->id;?>;
	var d = new Date();
	function addZero(numb) {
		numb = parseInt(numb);
		numb = numb<10?'0'+numb:numb.toString();
		return numb;
	}
	var today = {
		'year'	: d.getFullYear(),
		'month'	: addZero(d.getMonth()+1),
		'date'	: addZero(d.getDate()),
		'hour'	: addZero(d.getHours()),
		'minute': addZero(d.getMinutes()),
		'second': addZero(d.getSeconds())
	};
	var class_id = <?php echo $class->id;?>;
	$(document).ready(function(){
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
//*
		$('.copy_time_start, .copy_date, .copy_time_end, .copy_topic').click(function(e){
			e.preventDefault();
			$cls = $(this).data('class');
			$val = $('.jadwal_'+$cls, $($(this).parent())).val();
			$('.jadwal_'+$cls).val($val);
			return false;
		});
		$('.jadwal_date').datetimepicker({
			pickTime		: false,
			minDate			: today.year+'-'+today.month+'-'+today.date,
			showToday		: true
		});
		$('.jadwal_time_start, .jadwal_time_end').datetimepicker({
			pickDate		: false,
			useSeconds		: false,
			minuteStepping	: 5,
			use24hours		: true
		});
// */
		$('#add_class_session').click(function(e){
			e.preventDefault();
			$('#class_sched').append($('#sched_template').html());
/*
			$('.jadwal_date').datetimepicker({
				pickTime		: false,
				minDate			: today.year+'-'+today.month+'-'+today.date,
				showToday		: true
			});
			$('.jadwal_time_start, .jadwal_time_end').datetimepicker({
				pickDate		: false,
				useSeconds		: false,
				minuteStepping	: 5,
				use24hours		: true
			});
// */
			return false;
		});
		$('#price_per_session').change(function(){
			var c_sess = parseInt($('#count_sess').val());
			var prc = parseInt($(this).val());
			$('#total_price').val(c_sess * prc);
		});
		$('#discount_price').change(function(){
			var dsc_pr = parseInt($(this).val());
			var t_pr = parseInt($('#total_price').val());
			$('#total_per_package').val(t_pr - dsc_pr);
		});
		$('#price_per_session').change();
		$('#discount_price').change();
	});
	$('.tagInput').tagsInput({
		'onAddTag': function(tag) {
			console.log('ADD TAG:', tag);
			var $id = $('.tagInput').attr('id');
			if(! $('#'+$id+'_tagsinput').hasClass('form-control') ) $('#'+$id+'_tagsinput').addClass('form-control');
		},
		'onRemoveTag': function(remove) {
			console.log('Removing TAG:', remove);
			var $id = $('.tagInput').attr('id');
			if(! $('#'+$id+'_tagsinput').hasClass('form-control') ) $('#'+$id+'_tagsinput').addClass('form-control');
			$.post(base_url+'vendor/kelas/delete_tags', {'id':classID, 'tag': remove});
			$('#'+$id+'_tag').val(remove);
		},
		'height': '100%',
		'width': '100%',
		'defaultText': '',
		'comfortZone': 70,
		'autoSize': false
	});
</script>
<?php
$this->load->view('vendor/general/footer');