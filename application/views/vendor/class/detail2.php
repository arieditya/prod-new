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
if(!$this->is_admin) {
$profile = $vendor['profile'];
	$info = $vendor['info'];
	if(!empty($info->vendor_logo))
		$vendor_logo = "images/vendor/{$profile->id}/{$info->vendor_logo}";
	else
		$vendor_logo = 'assets/images/user.png';
}
	?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/tagsinput/bootstrap-tagsinput.css" type="text/css" />
<style type="text/css" >
	.bootstrap-tagsinput {
		width: 100% !important; /* override default */
	}
</style>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/moment.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/tagsinput/bootstrap-tagsinput.min.js" ></script>
<script type="application/javascript">
	var class_type = <?php echo (int)$class->class_paket;?>;
</script>
	<div class="container content kelas vendor">
		<div class="row">
<?php $this->load->view('vendor/general/sidebar');?>
			<div class="col-md-9 col-sm-12">
				<div class="panel panel-default">
					<h2 class="block-title text-uppercase">Kelas Anda:
                        <?php echo $class->class_nama; ?>
                    </h2>
                    <span class="info">Status:
                        <?php
                            switch($status->class_status){
                                case -1:
                                    echo "<b class='status-rejected'>rejected</b>";
                                    break;
                                case 0:
                                    echo "<b class='status-draft'>draft</b>";
                                    break;
                                case 1:
                                    if($status->active == 0) echo "<b class='status-draft'>Unpublished</b>";
                                    else echo "<b class='status-published'>Published</b>";
                                    break;
                                case 4: {
                                    echo "<b class='status-pending'> Pending ";
                                    if($status->active == 1) echo "Unpublished";
                                    else echo "Published";
                                    echo "</b>";
                                    break;
                                }
                            }
                        ?>
                    </span>
					<div class="panel-body">
						<div role="tabpanel" class="sub-vendor manage">

							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<?php if(	$this->is_admin || (
											($status->class_status == 0 || $status->class_status == 1 )
												&& $status->active == 0) ) { ?>
                                    <li role="presentation" <?php if($tabs=="profile" || $tabs=="info") { echo "class='active'"; }?> >
                                        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Edit Kelas</a>
                                    </li>
                                <?php } ?>
								<li role="presentation" <?php if($tabs=="preview"){ echo "class='active'"; }?> >
									<a href="#preview" aria-controls="preview" role="tab" data-toggle="tab">Preview</a>
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
								<div role="tabpanel" class="tab-pane <?php if($tabs=="preview"){ echo "active"; }?>" id="preview">
									<div class="section-wrap">
										<div class="section-heading"><h3 class="section-title">Profil</h3></div>
										<div class="section-content">
											<div class="section-row">
												<div class="col-sm-4">Nama Kelas</div>
												<div class="col-sm-8"><?php echo $class->class_nama;?></div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">URL</div>
												<div class="col-sm-8">http://kelas.ruangguru.com/kelas/<?php echo $class->class_uri;?></div>
											</div><!-- section-row -->
                                            <div class="section-row">
                                                <div class="col-sm-4">Tipe Kelas</div>
                                                <div class="col-sm-8">
                                                    <?php
                                                    if($class->class_paket=='0')
                                                        echo "Satu Sesi";
                                                    elseif($class->class_paket=='1')
                                                        echo "Kelas Berseri";
                                                    elseif($class->class_paket=='2')
                                                        echo "Paket";?>
                                                </div>
                                            </div><!-- section-row -->
                                            <div class="section-row">
												<div class="col-sm-4">Deskripsi</div>
												<div class="col-sm-8"><?php echo $class->class_deskripsi;?></div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Kategori</div>
												<div class="col-sm-8"><?php echo $class->category->category_name;?></div>
											</div><!-- section-row -->
                                        </div><!-- section-content -->
                                    </div><!-- section-wrap -->
                                    <div class="section-wrap">
										<div class="section-heading"><h3 class="section-title">Info</h3></div>
										<div class="section-content">
<?php
	if(!empty($class->class_video)) {
		$code = str_replace('https://www.youtube.com/watch?v=', '',$class->class_video);
		$vid = '<iframe src="https://www.youtube.com/embed/'.$code.'"></iframe>';
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
											<div class="section-row">
												<div class="col-sm-4">Tags</div>
												<div class="col-sm-8"> 
													<?php echo !empty($tags)?$tags:'Belum ada tag';?>
												</div>
											</div><!-- section-row -->
										</div><!-- section-content -->
									</div><!-- section-wrap -->
                                    <div class="section-wrap">
                                        <div class="section-heading"><h3 class="section-title">Lokasi</h3></div>
                                        <div class="section-content">
                                            <div class="section-row">
                                                <div class="col-sm-4">Provinsi</div>
                                                <div class="col-sm-8"><?php echo $class->provinsi_title;?></div>
                                            </div><!-- section-row -->
                                            <div class="section-row">
                                                <div class="col-sm-4">Kota / Kabupaten</div>
                                                <div class="col-sm-8"><?php echo $class->lokasi_title;?></div>
                                            </div><!-- section-row -->
                                            <div class="section-row">
                                                <div class="col-sm-4">Alamat</div>
                                                <div class="col-sm-8"><?php echo nl2br($class->class_lokasi);?></div>
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
                                                $link = 'https://www.google.com/maps/place/'.$str_lokasi;
                                            } else {
                                                $peta = explode('||', $class->class_peta);
                                                $ll = $peta[0];
                                                if(count($peta) == 2) {
                                                    $link = $peta[1];
                                                } else {
                                                    $link = 'https://www.google.com/maps/place/'.$peta[0];
                                                }
                                            }
                                            ?>
                                            <div class="section-row">
                                                <div class="col-sm-4">Peta</div>
                                                <div class="col-sm-8">
                                                    <a target="_blank" href="<?php echo $link;?>">
                                                        <img src="https://maps.googleapis.com/maps/api/staticmap?size=400x200&maptype=roadmap&markers=color:red%7C<?php echo $ll;?>" />
                                                    </a>
                                                </div>
                                            </div><!-- section-row -->
                                        </div><!-- section-content -->
                                    </div><!-- section-wrap -->
                                    <div class="section-wrap">
										<div class="section-heading"><h3 class="section-title">Peserta</h3></div>
										<div class="section-content">
											<div class="section-row">
												<div class="col-sm-4">Target Peserta</div>
												<div class="col-sm-8">
													<?php echo nl2br($class->class_perserta_target);?>
												</div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Jumlah Peserta Minimal</div>
												<div class="col-sm-8"> 
													<?php echo $class->class_peserta_min;?>
												</div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Jumlah Peserta Maksimal</div>
												<div class="col-sm-8">
													<?php echo $class->class_peserta_max;?>
												</div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Tingkat Keahlian</div>
												<div class="col-sm-8"> 
<?php
$lvl = '';
if(!empty($class->level)) :
	foreach($class->level as $cls_lvl): 
		if(!empty($lvl)) $lvl .= '<br />';
		$lvl .= "{$cls_lvl->nama} (<em>{$cls_lvl->name}</em>)";
	endforeach;
?>
													<?php echo $lvl;?>
<?php 
else:
?>
													Anda belum memilih tingkat keahlian peserta!
<?php
endif;
?>
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
															<td class="text-center" colspan="6">
																<span>Belum ada jadwal tersedia</span>
															</td>
														</tr>
<?php
	elseif($jadwal->num_rows() > 0):
		if($class->class_paket == 0):
			$jdwl = $jadwal->row();
			$tanggal = date('d\&\n\b\s\p\;M\&\n\b\s\p\;Y', strtotime($jdwl->class_tanggal));
			$start = double_digit($jdwl->class_jam_mulai).':'.double_digit($jdwl->class_menit_mulai);
			$end = double_digit($jdwl->class_jam_selesai).':'.double_digit($jdwl->class_menit_selesai);
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
				$tanggal = date('d\&\n\b\s\p\;M\&\n\b\s\p\;Y', strtotime($jdwl->class_tanggal));
				$start = double_digit($jdwl->class_jam_mulai).':'.double_digit($jdwl->class_menit_mulai);
				$end = double_digit($jdwl->class_jam_selesai).':'.double_digit($jdwl->class_menit_selesai);
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
$pertemuan = $jadwal->num_rows();
$harga = (int) empty($biaya->price_per_session)?$class->class_harga:$biaya->price_per_session;
$total_harga = $harga * $pertemuan;
$diskon = (int) empty($biaya->discount)?0:$biaya->discount;
$total_bayar = $total_harga - $diskon;
?>
										<div class="section-heading"><h3 class="section-title">Biaya</h3></div>
										<div class="section-content">
											<div class="section-row">
												<div class="col-sm-4">Jumlah pertemuan (sesi)</div>
												<div class="col-sm-8"><?php echo $pertemuan;?> x pertemuan</div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Harga per sesi</div>
												<div class="col-sm-8"><?php echo rupiah_format($harga);?></div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Total</div>
												<div class="col-sm-8"><?php echo rupiah_format($total_harga)?></div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Potongan harga</div>
												<div class="col-sm-8">
													<?php echo rupiah_format($diskon);?>
												</div>
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Total sesudah diskon</div>
												<div class="col-sm-8"><?php echo rupiah_format($total_bayar); ?>
												</div> 
											</div><!-- section-row -->
											<div class="section-row">
												<div class="col-sm-4">Harga sudah meliputi</div>
												<div class="col-sm-8"><?php echo $class->class_include;?></div>
											</div><!-- section-row -->
<?php if (($status->class_status == 0) || ($status->class_status == 1 && $status->active == 0)) : ?>
											<div class="col-sm-offset-4 col-sm-8 submit-form">
												<a href="<?php echo base_url()."vendor/kelas/request_publish/{$class->id}";?>"
												   class="btn btn-default main-button register"
												   onclick="return confirm('Apakah anda sudah yakin data-data ' +
													    'yang anda masukan sudah benar? Setelah ini data-data anda ' +
													    'akan di verifikasi oleh admin dan tidak dapat mengubah lagi' +
													    ' data-data ini.')">
                                                        Request To Publish
                                                    </a>
                                            </div>
<?php
elseif ($status->class_status == 1 && $status->active == 1) : ?>
											<div class="col-sm-offset-4 col-sm-8 submit-form">
													<a href="<?php echo base_url()."vendor/kelas/request_unpublish/$class->id";?>"
													   class="btn btn-default main-button register"
													   onclick="return confirm('Anda akan mengajukan permohonan ' +
													    'untuk menurunkan kelas ini. Admin akan mengkonfirmasi ' +
													    'pengajuan anda.')">
														Request To Unpublish
													</a>
											</div>
<?php
else : echo "<span class='info'>Kelas anda sedang dalam tahap verifikasi oleh pihak ruangguru</span>";
endif;
?>
										</div><!-- section-content -->
									</div><!-- section-wrap -->
								</div><!-- preview -->
								<div role="tabpanel" class="tab-pane <?php if($tabs=="profile" || $tabs=="info"){ echo "active"; }?>" id="profile">
										<form method="post" 
											  class="form-horizontal" 
											  enctype="multipart/form-data"
											  action="<?php echo base_url();?>vendor/kelas/update_profile_2">
											<input type="hidden" 
												   value="<?php echo $class->id;?>" 
												   name="id" 
												   id="id" />
										<div class="section-heading">
											<h3 class="section-title">
												<a data-toggle="collapse" 
												   data-parent="#profile" 
												   href="#form_profile"
												   aria-controls="form_profile"
												   aria-expanded="true">
													Profil
												</a>
											</h3>
										</div>
										<div id="form_profile" class="collapse <?php if($tabs=="profile") { echo "in"; }?>">
											<div class="form-group">
												<label for="Namakelas" class="col-sm-4 control-label">Nama Kelas</label>
												<div class="col-sm-8">
													<input type="text" 
														   class="form-control" 
														   id="Namakelas" 
														   name="class_nama"
														   placeholder="Nama dari kelas yang akan diselenggarakan" 
														   value="<?php echo $class->class_nama;?>" />
												</div>
											</div>
											<div class="form-group">
												<label for="uri" class="col-sm-4 control-label">URL</label>
												<div class="col-sm-8">
													<input type="text" 
														   class="form-control" 
<?php if($class->class_status > 0 && !empty($class->class_uri)): ?>
														   disabled="disabled"
<?php else: ?>
														   id="class_uri" 
														   name="class_uri"
														   placeholder="Biarkan terisi secara otomatis bila Anda ragu"
<?php endif; ?>
														   value="<?php echo $class->class_uri;?>" />
                                                    <div class="info">contoh: http://kelas.ruangguru.com/kelas/<b>URL</b></div>
												</div>
											</div>
											<div class="form-group">
												<label for="tentang" class="col-sm-4 control-label">Tentang kelas</label>
												<div class="col-sm-8">
													<textarea class="form-control txt_message" 
															  name="class_deskripsi"
															  placeholder="Deskripsi mengenai kelas Anda, pengajar, dan informasi lainnya yang perlu diketahui peserta kelas" 
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
													<select class="form-control kategori" name="category_id">
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
												<div class="col-sm-offset-4 col-sm-8">
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
                                            <div id="form_info" class="collapse <?php if($tabs=="info") { echo "in"; }?>">
                                                <div class="form-group">
                                                    <label for="attachment" class="col-sm-4 control-label">Tags</label>
                                                    <div class="col-sm-8">
                                                        <input type="text"
                                                               id="class_tags"
                                                               data-role="tagsinput"
                                                               class="input-tags"
                                                               name="class_tags" />
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
                                                               placeholder="Paste video URL disini, mis: http://www.youtube.com/watch?v=dXyQ92SPWds"
                                                               <?php if($tabs=='info') echo "autofocus"?>
                                                            >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="attachment" class="col-sm-4 control-label">Foto / Image</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" id="class_image" name="class_image" />
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
                                                    <div class="col-sm-offset-4 col-sm-8">
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
												<label for="Seo" class="col-sm-4 control-label">Provinsi</label>
												<div class="col-sm-8">
													<select class="form-control kategori" 
															name="class_provinsi_id" 
															id="class_provinsi_id">
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="Seo" class="col-sm-4 control-label">Kota / Kabupaten</label>
												<div class="col-sm-8">
													<select class="form-control kategori" 
															name="class_lokasi_id" 
															id="class_lokasi_id">
													</select>
												</div>
											</div>
<script type="application/javascript">
	$(document).ready(function(){
		$('#class_provinsi_id').change(function(){
			var prov_id =$(this).val();
			$('#class_lokasi_id')
					.empty()
					.append($(generate_location_select(prov_id)));
		});
	});
	$('#class_provinsi_id')
			.empty()
			.append($(generate_provinsi_select()));
<?php
	$p_id = empty($class->class_provinsi_id)?1:$class->class_provinsi_id;
?>
	$('#class_lokasi_id')
			.empty()
			.append($(generate_location_select(<?php echo $p_id;?>)));
<?php 
	if(!empty($class->class_provinsi_id)):
		$p_select = '[value="'.$p_id.'"]';
	else:
		$p_select = ':first';
	endif;
?>
	$('#class_provinsi_id option<?php echo $p_select;?>').attr({'selected':'selected'});
<?php 
	if(!empty($class->class_lokasi_id)):
		$l_select = '[value="'.$class->class_lokasi_id.'"]';
	else:
		$l_select = ':first';
	endif;
?>
	$('#class_lokasi_id option<?php echo $l_select;?>').attr({'selected':'selected'});
</script>
											<div class="form-group">
												<label for="tentang" class="col-sm-4 control-label">Alamat</label>
												<div class="col-sm-8">
													<textarea class="form-control" 
															  name="class_lokasi"
															  placeholder="Cantumkan alamat lengkap tempat kelas Anda diselenggarakan termasuk nama gedung atau institusi (jika ada)" 
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
		$link = 'https://www.google.com/maps/place/'.$str_lokasi;
	} else {
		$peta = explode('||', $class->class_peta);
		$ll = $peta[0];
		if(count($peta) == 2) {
			$link = $peta[1];
		} else {
			$link = 'https://www.google.com/maps/place/'.$peta[0];
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
																   id="class_map_search"
																   name="class_peta_search"
																   placeholder="Masukkan area / lokasi" />
															<br />
															<input type="text" 
																   class="form-control" 
																   id="class_maps"
																   name="class_peta"
																   readonly="readonly"
																   value="<?php echo $class->class_peta;?>"
																   placeholder="Belum ada area / lokasi" />
														</div>
														<div class="col-sm-6">
															<button type="button" 
																	id="btn_search_maps"
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
												<div class="col-sm-offset-4 col-sm-8">
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
													Peserta
												</a>
											</h3>
										</div>
										<div id="form_peserta" class="collapse">
											<div class="form-group">
												<label for="tentang" class="col-sm-4 control-label">Target Peserta</label>
												<div class="col-sm-8">
													<textarea class="form-control" 
															  placeholder="Masukan target audience kelas ini. Contoh : umum, di atas 25 tahun, freelancer, dll"
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
			$selected = FALSE;
			if(!empty($class->level[$level->id])) $selected = TRUE;
?>
													<div class="radio">
														<label>
															<input type="checkbox" 
																   value="<?php echo $level->id?>"
																   <?php echo $selected?'checked="checked"':'';?>
																   name="level_id[<?php echo $level->id?>]" /> 
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
												<div class="col-sm-offset-4 col-sm-8">
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
	if($jadwal->num_rows() > 0):
		if($class->class_paket == 0):
			$i = 1;
			$jdwl = $jadwal->row();
			$tanggal = date('d M Y', strtotime($jdwl->class_tanggal));
			$start = double_digit($jdwl->class_jam_mulai).':'.double_digit($jdwl->class_menit_mulai);
			$end = double_digit($jdwl->class_jam_selesai).':'.double_digit($jdwl->class_menit_selesai);
			$topik = $jdwl->class_jadwal_topik;
	?>
													<tr class="jadwal_row">
														<td class="text-center">1</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_date" 
																   name="class_tanggal[0]"
																   data-date-format="DD MMM gggg" 
																   value="<?php echo $tanggal; ?>"
																   placeholder="12 Feb 2015" />
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_time" 
																   name="class_jam_mulai[0]"
																   data-date-format="HH:mm" 
																   value="<?php echo $start; ?>"
																   placeholder="15:00" />
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_time" 
																   name="class_jam_selesai[0]"
																   data-date-format="HH:mm" 
																   value="<?php echo $end; ?>"
																   placeholder="16:30">
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control" 
																   style="width: 100%"
																   name="class_topik[0]"
																   value="<?php echo $topik; ?>"
																   placeholder="Topik untuk sesi ini">
														</td>
														<td class="text-center">
															<a class="jadwal_delete" href="#">delete</a>
														</td>
													</tr>
<?php
		else:
			foreach($jadwal->result() as $jdwl):
				$i++;
				$tanggal = date('d M Y', strtotime($jdwl->class_tanggal));
				$start = double_digit($jdwl->class_jam_mulai).':'.double_digit($jdwl->class_menit_mulai);
				$end = double_digit($jdwl->class_jam_selesai).':'.double_digit($jdwl->class_menit_selesai);
				$topik = $jdwl->class_jadwal_topik;
?>
													<tr class="jadwal_row">
														<td class="text-center"><?php echo $i;?></td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_date" 
																   data-date-format="DD MMM gggg" 
																   name="class_tanggal[<?php echo $i?>]"
																   value="<?php echo $tanggal; ?>"
																   placeholder="12 Feb 2015" />
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_time" 
																   data-date-format="HH:mm" 
																   name="class_jam_mulai[<?php echo $i?>]"
																   value="<?php echo $start; ?>"
																   placeholder="15:00" />
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control jadwal_time" 
																   data-date-format="HH:mm" 
																   name="class_jam_selesai[<?php echo $i?>]"
																   value="<?php echo $end; ?>"
																   placeholder="16:30">
														</td>
														<td class="text-center">
															<input type="text" 
																   class="form-control" 
																   style="width: 100%"
																   name="class_topik[<?php echo $i?>]"
																   value="<?php echo $topik; ?>"
																   placeholder="Topik untuk sesi ini">
														</td>
														<td class="text-center">
															<a href="#" class="jadwal_delete">delete</a>
														</td>
													</tr>
<?php
			endforeach;
		endif;
	endif;
	if($jadwal->num_rows() == 0 || $class->class_paket != 0):
?>
													<tr class="jadwal_next_row jadwal_row">
														<td class="text-center">NEW</td>
														<td class="text-center">
															<input type="text" 
																   name="class_tanggal[]"
																   class="form-control jadwal_date" 
																   data-date-format="DD MMM gggg" 
																   placeholder="12 Feb 2015" />
														</td>
														<td class="text-center">
															<input type="text" 
																   name="class_jam_mulai[]"
																   class="form-control jadwal_time" 
																   data-date-format="HH:mm" 
																   placeholder="15:00" />
														</td>
														<td class="text-center">
															<input type="text" 
																   name="class_jam_selesai[]"
																   class="form-control jadwal_time" 
																   data-date-format="HH:mm" 
																   placeholder="16:30" />
														</td>
														<td class="text-center">
															<input type="text" 
																   name="class_topik[]"
																   class="form-control" 
																   style="width: 100%"
																   placeholder="Topik untuk sesi ini" />
														</td>
														<td class="text-center">
															<a href="#" class="jadwal_delete">delete</a>
														</td>
													</tr>
<?php
	endif;
?>
<script type="application/javascript">
	var row_jadwal = <?php echo $i;?>;
</script>
<?php
	if($class->class_paket != 0):
?>
<script type="application/javascript">
	$(document).ready(function(){
		function add_event() {
			$('.jadwal_next_row:last input').on('focusin',add_another_row);
		}
		function remove_event() {
			$('.jadwal_next_row:last input').off('focusin',add_another_row);
		}
		function add_another_row(){
			var $clone = $('.jadwal_next_row:last').clone();
			remove_event();
			$('.jadwal_next_row').removeClass('jadwal_next_row');
			$('.jadwal_date', $clone).datetimepicker({
				pickTime		: false,
				minDate			: todayDate.date+' '+todayDate.monthWrd+' '+todayDate.year,
				showToday		: true
			});
			$('.jadwal_time', $clone).datetimepicker({
				pickDate		: false,
				useSeconds		: false,
				minuteStepping	: 5,
				use24hours		: true
			});
			$('.jadwal_delete', $clone).click(function(e){
				e.preventDefault();
				delete_jadwal_row($(this));
				return false;
			});
			$('#tbl_jadwal tbody').append($clone);
			add_event();
			row_jadwal++;
			$(this).focus();
		}
		add_event();
		$('.jadwal_delete').click(function(e){
			e.preventDefault();
			delete_jadwal_row($(this));
			return false;
		});
		function delete_jadwal_row(that) {
			 var $tr = that.parent().parent();
			row_jadwal--;
			$($tr).remove();
		}
	});
</script>
<?php 
	endif;
?>
													</tbody>
												</table>
											</div><!-- table-responsive --><!-- section-content -->
											<div class="form-group">
												<div class="col-sm-offset-4 col-sm-8">
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
														   value="<?php
                                                           echo $pertemuan;?>"
														   readonly="readonly"
														   placeholder="" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Harga per Sesi</label>
												<div class="col-sm-8">
													<input type="number" 
														   class="form-control" 
														   id="harga_per_sesi" 
														   name="price_per_session" 
														   value="<?php echo $harga;?>"
														   placeholder="Nama dari kelas yang akan diselenggarakan" />
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label">Total</label>
												<div class="col-sm-8">
													<input type="number" 
														   class="form-control" 
														   readonly="readonly"
														   id="total_harga" 
														   value="<?php echo $total_harga;?>"
														   placeholder="" />
												</div>
											</div>
											<div class="form-group">
												<label for="uri" class="col-sm-4 control-label">Diskon (dalam Rupiah)</label>
												<div class="col-sm-8">
													<input type="number" 
														   class="form-control" 
														   name="discount" 
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
														   value="<?php echo $total_bayar?>"
														   placeholder="" />
												</div>
											</div>
											<div class="form-group">
												<label for="tentang" class="col-sm-4 control-label">Harga termasuk</label>
												<div class="col-sm-8">
													<textarea class="form-control" 
															  name="class_include"
															  placeholder="Harga diatas sudah termasuk. Contoh: coffee break, lunch, sertifikat, buku panduan, dll"
															  rows="3"><?php echo $class->class_include;?></textarea>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10 submit-form">
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
			var jumlah_sesi = row_jadwal;
            if(class_type == '0') {
                var jumlah_sesi = 1;
            }
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
								<div role="tabpanel" class="tab-pane <?php if($tabs=="murid"){ echo "active"; }?>" id="murid">
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
													<td>Kode<br />Diskon</td>
													<td>Tipe</td>
													<td>Alokasi</td>
													<td>Start</td>
													<td>Expire</td>
													<td>Nilai<br />Diskon</td>
												</tr>
											</thead>
											<tbody class="text-center">
<?php
	if(count($discount) < 1):
?>
												<tr>
													<td colspan="6">
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
									<form class="form-horizontal" 
										  method="post" 
										  action="<?php echo base_url()?>vendor/kelas/add_discount" >
										<input type="hidden" 
											   value="<?php echo $class->id;?>" 
											   name="id" 
											   id="id" />
										<div class="col-sm-12">
											<h4 class="review-title">Tipe Kode Diskon</h4>
											<div class="form-group">
												<div class="radio diskon">
													<div class="col-sm-3">
														<label>
															<input type="radio" 
																   name="scope" 
																   value="target" checked="checked" />
															Targeted 
														</label>
													</div>
													<div class="col-sm-9">
														<label>
															<input type="radio" 
																   name="scope" 
																   value="public" />
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
															<input type="radio" 
																   name="nominal_type" 
																   id="nominal_type_idr"
																   value="idr" />
															Rp
															<input type="number" 
																   id="nominal_value_idr" 
																   class="nominal_value" />
															atau
														</label> 
													</div>
												</div>
												<div class="col-sm-6">
													<div class="radio jumlah">
														<label>
															<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
															<input type="radio" 
																   name="nominal_type" 
																   id="nominal_type_percent"
																   value="percent" />
															%
															<input type="number" 
																   id="nominal_value_percent" 
																   class="nominal_value" />
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
															<input type="radio" 
																   name="begin" 
																   value="*" >
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
															<input type="radio" 
																   name="begin" 
																   value="start" >
															Tanggal
															<input type="text" 
																   name="begin_date" 
																   data-date-format="DD MMM gggg" 
																   class="jadwal_date" />
														</label>
													</div>
												</div>
											</div><!-- form-group -->
											<hr />
											<div class="form-group">
												<div class="col-sm-5">
													<div class="radio">
														<label>
															<input type="radio" 
																   name="ended" 
																   value="*" />
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
															<input type="radio" 
																   name="ended" 
																   value="expire" />
															Tanggal
															<input type="text" 
																   name="ended_date" 
																   data-date-format="DD MMM gggg" 
																   class="jadwal_date" />
														</label>
													</div>
												</div>
											</div><!-- form-group -->
										</div>
										<div class="col-sm-12">
											<h4 class="review-title">Masukkan Kode</h4>
											<div class="form-inline">
												<div class="form-group">
													<input type="text" 
														   placeholder="Ketik Kode atau" 
														   id="code_discount" 
														   name="code_discount" 
														   class="form-control">
													<button class="btn btn-default cek-button" 
															id="generate_code"
															type="button">Auto Generate</button>
												</div>
											</div>
										</div>
										<div class="col-sm-12">
											<h4 class="review-title">Jumlah Penggunaan</h4>
											<div class="form-group">
												<div class="col-sm-5">
													<div class="radio">
														<label>
															<input type="radio" 
																   name="jumlah" 
																   value="*" />
															Tidak terbatas 
														</label>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="radio">
														<label>
															<input type="radio" 
																   name="optionsRadios" 
																   id="optionsRadios1" 
																   value="limited" />
															<input type="number" name="usage_qty" />  Penggunaan
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
									<form class="form-horizontal" 
										  action="<?php echo base_url()?>vendor/kelas/send_email" 
										  enctype="multipart/form-data" 
										  method="post">
										<div class="form-group">
											<label for="penerima" class="col-sm-2 control-label">Jenis Pesan</label>
											<div class="col-sm-10">
												<select class="form-control" name="jenis_pesan" id="jenis_pesan">
													<option value="1">Pengumuman</option>
													<option value="2">Pengingat</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="penerima" class="col-sm-2 control-label">Penerima</label>
											<div class="col-sm-10">
												<select class="form-control" name="penerima" id="penerima">
													<option value="peserta">Murid</option>
													<option value="pendaftar">Pemesan</option>
													<option value="semua">Murid dan Pemesan</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="subject" class="col-sm-2 control-label">Subject</label>
											<div class="col-sm-10">
												<input type="text" 
													   class="form-control" 
													   id="subject" 
													   name="subject" 
													   placeholder="Subject">
											</div>
										</div>
										<div class="form-group">
											<label for="message" class="col-sm-2 control-label">Message</label>
											<div class="col-sm-10">
												<textarea class="form-control txt_message" 
														  placeholder="Message" 
														  name="message"
														  rows="3"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="attachment" class="col-sm-2 control-label">Attachment</label>
											<div class="col-sm-10">
												<input type="file" name="attach" />
											</div>
										</div>
									  <div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" class="btn btn-default main-button register">Kirim</button>
										</div>
									  </div>
									</form>
<?php 
foreach($sent_message as $sent):
	$sent_time = date('d M Y H:i:s', strtotime($sent->sent_time));
	$attachment = empty($sent->attachment)?
			'':
			base_url('documents/email_attach/kelas/'.$class->id.'/'.$sent->attachment);
?>
									<h4 class="review-title">
										<?php echo $sent->subject;?>
										<span class="info"><em>Dikirim tanggal: <?php echo $sent_time;?></em></span>
									</h4>

									<div class="pesan-content">
										<p><?php echo $sent->message;?></p>
<?php
	if(!empty($attachment)):
?>
										<p>
											<strong>Attachment:</strong>
											<a href="<?php echo $attachment?>"><?php echo $sent->attachment;?></a>
										</p>
<?php
	endif;
	$resent_link = base_url()."vendor/kelas/resend_email?class_id={$class->id}&email_id={$sent->id}";
?>
									</div>
									<div class="col-sm-offset-8 col-sm-4">
										<a href="<?php echo $resent_link;?>">
											<button type="button" class="btn btn-default main-button register">
												Kirim Ulang
											</button>
										</a>
									</div>
<?php 
endforeach;
?>
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
			minDate			: todayDate.date+' '+todayDate.monthWrd+' '+todayDate.year,
//			minDate			: todayDate.year+'-'+todayDate.month+'-'+todayDate.date,
			showToday		: true
		});
		$('.jadwal_time').datetimepicker({
			pickDate		: false,
			useSeconds		: false,
			minuteStepping	: 5,
			use24hours		: true
		});
		$('button#generate_code').click(function(e){
			e.preventDefault();
			$('#code_discount').val(hashGenerator());
		});
		$('input[name="nominal_type"]').click(function(){
			var $type = $(this).val();
			$('.nominal_value').removeAttr('name');
			$('.nominal_value').attr('disabled','disabled');
			$('#nominal_value_'+$type).removeAttr('disabled');
			$('#nominal_value_'+$type).attr('name', 'nominal_value');
		});
		$('.nominal_value').focus(function(){
			var $type = $(this).attr('id').replace('nominal_value_','');
			$('.nominal_value').removeAttr('name');
			$('.nominal_value').attr('disabled','disabled');
			$('#nominal_value_'+$type).removeAttr('disabled');
			$('#nominal_value_'+$type).attr('name', 'nominal_value');
		});
	});
</script>
<?php
$this->load->view('vendor/general/footer2');