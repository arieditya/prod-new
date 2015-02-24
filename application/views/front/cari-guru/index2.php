<?php 
$this->load->view('header2',$temp);
?><script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.alerts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/cariguru.js"></script>
<script>
     $(document).ready(function(){
//        update_matpel();
//        update_provinsi();
    }); 
</script>

<!--  FBX -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '583152025127396']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=583152025127396&amp;ev=NoScript" /></noscript>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="cari-guru-detail">
        <div id="cariguru-header"><?php //print_r($this->session->userdata);?>
            <div id="cariguru-header-wrap">
                <h1><span class="text-20"><?php echo strtoupper($temp['meta']['title']);?></span></h1>
            </div>
        </div>
        <div id="cari-guru-content">
			<div id="description" style="text-align: left;float:left;">
				<p><?php echo $temp['meta']['title']?> berkualitas. <br />
					Gunakan perinci pencarian untuk menyaring lebih lanjut
				</p>
			</div>
			<div id="description_link" style="text-align: left;float:right;height: 50px;margin-top: 15px;">
				<a id="show_form" href="#show_me">Tampilkan rincian pencarian</a>
			</div>
			<div style="clear:both;"></div>
			<div id="hide_first">
				<form action="<?php echo base_url(); ?>cari_guru/result" method="post">
					<div class="blank" style="height: 20px;"></div>
					<div class="cari-guru-left">
						<div class="cari-field">
							<p>Pilih Provinsi</p><?php $sesi = $this->session->userdata('cari_guru');?>
							<select id="ddProvinsi" class="select" name="provinsi" onchange="update_provinsi()">
							  <option value="0">Pilih Semua</option>
<?php 
foreach ($this->guru_model->get_provinsi('provinsi')->result() as $row): 
	if( TRUE || $row->provinsi_id != 1):
		$selected = '';
		if (
				$sesi['provinsi']==$row->provinsi_id || 
				(
						!empty($input['provinsi']) && 
						$input['provinsi']->provinsi_id ==$row->provinsi_id
				) ||
				(
						!empty($input['lokasi']) && 
						$input['lokasi']->provinsi_id ==$row->provinsi_id
				) || $row->provinsi_id == 1
		) {
			$selected = 'selected="selected"';
		}
		
?>
									<option value="<?php echo $row->provinsi_id; ?>" <?php echo $selected;?>>
										<?php echo $row->provinsi_title; ?>
									</option>
<?php 
	endif; 
endforeach; ?>
							</select>
						</div>
						<div class="cari-field">
							<p>Pilih Kota</p>
						<input type="hidden" name="sesi_kota" id="sesi_kota" value="<?php echo $sesi['lokasi'];?>"/>
							<select id="ddLokasi" class="select" name="location">
<?php
if(!empty($input['lokasi'])):
?>
								<option value="<?php echo $input['lokasi']->lokasi_id;?>" selected="selected">
									<?php echo $input['lokasi']->lokasi_title;?>
								</option>
<?php 
	else:
?>
								<option value="0">Pilih Semua</option>
<?php 
	endif;
?>
							</select>
						</div>
						<div class="cari-field">
							<p>Preferensi Guru</p>
							<div class="blank" style="height: 10px;"></div>
								<table width="260">
							<tr>
								<td class="text-13">1. Gender</td>
								<!--<td class="text-13">2. Usia</td>-->
							</tr>
							<tr>
									<td><input class="radio" name="gender" type="radio" value="1" <?php if (!empty($input['gender'])) {echo($input['gender'] == 1) ? 'checked' : '';}; ?>/> <span class="text-13">Laki-laki</span></td>
									<!--<td><input class="radio" name="age" type="radio" value="1" <?php //if (!empty($input['umur'])) {echo($input['umur'] == 1) ? 'checked' : '';}; ?>/> <span class="text-13">Di bawah 20 tahun</span></td>-->
								</tr>
								<tr>
									<td><input class="radio" name="gender" type="radio" value="2" <?php if (!empty($input['gender'])) {echo($input['gender'] == 2) ? 'checked' : '';}; ?>/> <span class="text-13">Perempuan</span></td>
									<!--<td><input class="radio" name="age" type="radio" value="2" <?php //if (!empty($input['umur'])) {echo($input['umur'] == 2) ? 'checked' : '';}; ?>/> <span class="text-13">20-30 tahun</span></td>-->
						   </tr>
								<tr>
							<td><input class="radio" name="gender" type="radio" value="3" <?php if (!empty($input['gender'])) {echo($input['gender'] == 3) ? 'checked' : '';} else {echo'checked';}; ?>/> <span class="text-13">Bebas</span></td>
							<!--<td><input class="radio" name="age" type="radio" value="3" <?php //if (!empty($input['umur'])) {echo($input['umur'] == 3) ? 'checked' : '';}; ?>/> <span class="text-13">Di atas 30 tahun</span></td>-->
						  </tr>
						  <!--<tr>
							<td>&nbsp;</td>
							<!--<td><input class="radio" name="age" type="radio" value="4" <?php //if (!empty($input['umur'])) {echo($input['umur'] == 4) ? 'checked' : '';} else {echo'checked';}; ?>/> <span class="text-13">Usia Bebas</span></td>-->
						  <!--</tr>-->
						 </table>
							<div class="blank" style="height: 10px;"></div>
								  <table>
									<tr>
										<td class="text-13">2. Usia</td>
									</tr>
									<tr>
										<td>
											<input class="radio" name="age" type="radio" value="1" <?php if (!empty($input['umur'])) {echo($input['umur'] == 1) ? 'checked' : '';}; ?>/> <span class="text-13">Dibawah 20 tahun</span><br/>
										</td>
									</tr>
									<tr>
										<td>
											<input class="radio" name="age" type="radio" value="2" <?php if (!empty($input['umur'])) {echo($input['umur'] == 2) ? 'checked' : '';}; ?>/> <span class="text-13">20-30 tahun</span><br/>
										</td>
									</tr>
									<tr>
										<td>
											<input class="radio" name="age" type="radio" value="3" <?php if (!empty($input['umur'])) {echo($input['umur'] == 3) ? 'checked' : '';}; ?>/> <span class="text-13">Diatas 30 tahun</span><br/>
										<td>
									</tr>
									<tr>
										<td>
											<input class="radio" name="age" type="radio" value="4" <?php if (!empty($input['umur'])) {echo($input['umur'] == 4) ? 'checked' : '';} else {echo'checked';}; ?>/> <span class="text-13">Usia Bebas</span>
										</td>
									</tr>
							</table>
						</div>
					</div>
					<div class="cari-guru-center">
						<div class="cari-field">
							<p>Kategori Pelajaran</p>
							<select id="select-jenjang" class="select" name="education" onchange="update_matpel()">
						   <option value="0">Pilih Semua</option>
<?php 
foreach ($this->guru_model->get_jenjang()->result() as $row): 
	$selected = '';
	if(
			$sesi['jenjang']==$row->jenjang_pendidikan_id ||
			(
					!empty($input['jenjang']) && 
					$input['jenjang']->jenjang_pendidikan_id==$row->jenjang_pendidikan_id
			) ||
			(
					!empty($input['matpel']) && 
					$input['matpel']->jenjang_pendidikan_id==$row->jenjang_pendidikan_id
			)
	){
		$selected = 'selected="selected"';
	}
?>
									<option class="<?php echo $row->jenjang_pendidikan_id;?>" 
											value="<?php echo $row->jenjang_pendidikan_id; ?>" <?php echo $selected;?>>
										<?php echo $row->jenjang_pendidikan_title; ?>
									</option>
<?php 
endforeach; 
?>
							</select>
						</div>
						
						<div class="cari-field">
							<p>Mata Pelajaran</p>
						<input type="hidden" name="sesi_matpel" id="sesi_matpel" value="<?php echo $sesi['matpel'];?>"/>
							<select id="select-matpel" class="select" name="matpel">
<?php
if(!empty($input['matpel'])):
?>
								<option value="<?php echo $input['matpel']->matpel_id;?>" selected="selected">
									<?php echo $input['matpel']->matpel_title;?>
								</option>
<?php 
	else:
?>
								<option value="0">Pilih Semua</option>
<?php 
	endif;
?>
							</select>
						</div>
					
						<div class="cari-field">
						 <p>Tarif per Jam</p>
							 <select id="tarifP" class="select  text-13" name="tarif">
								   <option value="0" <?php if($sesi['tarif'] == 0){ echo "selected";} else {echo "";}?>>Tarif berapapun</option>
								   <option value="1" <?php if($sesi['tarif'] == 1){ echo "selected";} else {echo "";}?>>&lt; Rp 100,000,-</option>
								   <option value="2" <?php if($sesi['tarif'] == 2){ echo "selected";} else {echo "";}?>>Rp 101,000,- s/d Rp 250,000,-</option>
								   <option value="3" <?php if($sesi['tarif'] == 3){ echo "selected";} else {echo "";}?>>Rp 251,000,- s/d Rp 500,000,-</option>
								   <option value="4" <?php if($sesi['tarif'] == 4){ echo "selected";} else {echo "";}?>>&gt; Rp 500,000,-</option>
							  </select>
					</div>
					<div class="cari-field">
						<p>Metode Belajar</p>
						<div class="r-guru-detail">
							<input class="checkbox" name="metode[]" type="checkbox" value="1" checked/> <span class="text-13">Online</span>
						</div>
						<div class="r-guru-detail">
							<input class="checkbox" name="metode[]" type="checkbox" value="2" checked/> <span class="text-13">Tatap Muka</span>
						</div>
					</div>
	<!--                    <div class="cari-field">
							<p>Nama Guru :</p>
							<input type="text" class="text" name="nama" value="<?php echo (!empty($input['nama']))?$input['nama']:'';?>" />
						</div>-->
					</div>
					<div class="cari-guru-right">
						<div class="cari-field">
							<p>Pilih Kategori Guru</p>
							<input class="checkbox" name="edu[]" type="checkbox" value="7" <?php if(!empty($sesi['kategori'])){ if(in_array("7",$sesi['kategori'])){ echo "checked";} } ?>/> <span class="text-13">Pelajar SMA</span><br/>
							<input class="checkbox" name="edu[]" type="checkbox" value="1" <?php if(!empty($sesi['kategori'])){ if(in_array("1",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Mahasiswa S1</span><br/>
							<input class="checkbox" name="edu[]" type="checkbox" value="2" <?php if(!empty($sesi['kategori'])){ if(in_array("2",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Mahasiswa S2/S3</span><br/>
							<input class="checkbox" name="edu[]" type="checkbox" value="3" <?php if(!empty($sesi['kategori'])){ if(in_array("3",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Guru Sekolah</span><br/>
							<input class="checkbox" name="edu[]" type="checkbox" value="5" <?php if(!empty($sesi['kategori'])){ if(in_array("5",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Guru Privat Full Time (> 1 Tahun)</span><br/>
							<input class="checkbox" name="edu[]" type="checkbox" value="6" <?php if(!empty($sesi['kategori'])){ if(in_array("6",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Guru Privat Part Time</span><br/>
							<input class="checkbox" name="edu[]" type="checkbox" value="4" <?php if(!empty($sesi['kategori'])){ if(in_array("4",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Dosen</span><br/>
							<input class="checkbox" name="edu[]" type="checkbox" value="8" <?php if(!empty($sesi['kategori'])){ if(in_array("8",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Profesional</span><br/>
							<input class="checkbox" name="edu[]" type="checkbox" value="9" <?php if(!empty($sesi['kategori'])){ if(in_array("9",$sesi['kategori'])){ echo "checked";} }?>/> <span class="text-13">Lainnya</span><br/>
							<!--<select class="select" name="edu">
								<option value="-1"/>Bebas</option>
							<?php //foreach ($this->guru_model->get_table('kategori')->result() as $row): ?>
								<option value="<?php //echo $row->kategori_id; ?>" <?php //if (!empty($input['kategori'])) {echo($input['kategori'] == $row->kategori_id) ? 'selected' : '';}; ?>/><?php //echo $row->kategori_title; ?>
							<?php //endforeach; ?>
							</select>-->
						</div>
						<div class="cari-field">
							<p>Tampilkan hanya guru bersertifikat?</p>
							<div class="blank" style="height: 20px;margin-top:10px;">
								<div class="r-guru-detail">
									<input class="radio" name="cert" type="radio" value="1" <?php if (!empty($input['sertifikat'])) {echo($input['sertifikat'] == 1) ? 'checked' : '';}; ?>/> <span class="text-13">Ya</span>
								</div>
								<div class="r-guru-detail">
									<input class="radio" name="cert" type="radio" value="2" <?php if (!empty($input['sertifikat'])) {echo($input['sertifikat'] == 2) ? 'checked' : '';} else {echo'checked';}; ?>/> <span class="text-13">Tidak Perlu Sertifikasi</span>
								</div>
							</div>
						</div>
						<div class="cari-field">
							<p>Urutkan pencarian berdasarkan</p>
							<select class="select" name="sort">
								<option value="1" <?php if (!empty($input['urutan'])) {echo($input['urutan'] == 1) ? 'selected' : '';} ?>><span class="text-13">Rating</span></option>
								<option value="2" <?php if (!empty($input['urutan'])) {echo($input['urutan'] == 2) ? 'selected' : '';} ?>><span class="text-13">Nama Guru</span></option>
								<option value="3" <?php if (!empty($input['urutan'])) {echo($input['urutan'] == 3) ? 'selected' : '';} ?>><span class="text-13">Harga - rendah ke tinggi</span></option>
								<option value="4" <?php if (!empty($input['urutan'])) {echo($input['urutan'] == 4) ? 'selected' : '';} ?>><span class="text-13">Harga - tinggi ke rendah</span></option>
							</select>
						</div>
						<div class="blank" style="height:12px"></div>
						<div class="cari-submit">
							<input type="image" src="<?php echo base_url(); ?>images/cari-button.png"/>
						</div>
					</div>
				</form>
			</div>
<script type="application/javascript">
		function hideForm() {
			$('#hide_first').hide();
			$('#cari-guru-detail')
					.css('height', '120px');
			$('#cari-guru-content')
					.css('height', '60px');
			$('#content')
					.css('minHeight', '170px')
			$('#show_form').html('Tampilkan rincian pencarian');
		}
		function showForm() {
			$('#hide_first').show();
			$('#cari-guru-detail')
					.css('height', '520px');
			$('#cari-guru-content')
					.css('height', '424px');
			$('#content')
					.css('minHeight', '500px');
			$('#show_form').html('Sembunyikan pencarian');
		}
		var formShowed = false;
		hideForm();
		$('#show_form').click(function(e){
			e.preventDefault();
			if(formShowed) hideForm();
			else showForm();
			formShowed = ! formShowed;
			return false;
		})
</script>
        </div>
    </div>
    <div class="blank" style="height:10px"></div>
    <?php if (!empty($show_result)): ?>
        <?php if (!empty($guru['suggest']) && count($guru['data'])>0): ?>
	   <div id="alert-empty-guru">
            <p class="text-13 bold"><img src="<?php echo base_url().'images/icon-punctuation.png'?>" width="15px"/> Maaf, Kami tidak dapat menemukan guru yang Anda cari</p>
		  <p class="text-13">Guru dengan kriteria yang Anda pilih belum terdaftar di database Ruangguru.<br/>
				Mohon melakukan pencarian baru dengan kriteria yang berbeda,<br/>
				atau silahkan isi formulir di halaman Request Guru. Tim Ruangguru akan berusaha mencarikan guru yang sesuai.
		  </p>
	    </div>
            <p class="text-13">Kami Sarankan Guru-Guru Berikut Ini:</p>
        <?php elseif(count($guru['data'])==0):?>
	     <div id="alert-empty-guru">
            <p class="text-13 bold"><img src="<?php echo base_url().'images/icon-punctuation.png'?>" width="15px"/> Maaf, Kami tidak dapat menemukan guru yang Anda cari</p>
		  <p class="text-13">Guru dengan kriteria yang Anda pilih belum terdaftar di database Ruangguru.<br/>
				Mohon melakukan pencarian baru dengan kriteria yang berbeda,<br/>
				atau silahkan isi formulir di halaman Request Guru.<br/>Tim Ruangguru akan berusaha mencarikan guru yang sesuai.
		  </p>
	    </div>
        <?php endif;?>
 </div>
        <div id="cari-guru-page" style="font-family: Ubuntu;">
			<span>Total hasil pencarian: 
				<strong>
					<?php echo $guru['total'];?> Guru ditemukan!
				</strong>
			</span>
        </div>
        <div id="cari-guru-suggest-notif">
        
        <div id="cari-guru-result">
        <?php
        $count = ($pagination['page'] * $pagination['perpage']);
        foreach ($guru['data'] as $row):
        ?>
            <div class="guru-result-con">
                <table>
                    <tr>
                        <td>
                            <div class="guru-result-info">
                                <div class="blank" style="height: 13px;"></div>
                                <div class="guru-result-img">
                                    <div class="gri-wrap">
                                        <?php if (!file_exists("./images/pp/{$row->guru_id}.jpg")): ?>
                                            <img src="<?php echo base_url(); ?>images/default_profile_image.png"/>
                                        <?php else : ?>
                                            <img src="<?php echo base_url(); ?>images/pp/<?php echo $row->guru_id; ?>.jpg"/>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="guru-result-lgu">
                                    <table>
                                        <tr>
                                            <th>Gender</th>
                                            <td>:&nbsp;</td>
                                            <td><?php echo ((int)$row->guru_gender === 1) ? 'Laki-Laki' : 
														'Perempuan'; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Usia</th>
                                            <td>:&nbsp;</td>
                                            <td><?php echo $this->custom->get_age($row->guru_lahir);?> Tahun</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="blank" style="height: 13px;"></div>
                            </div>
                        </td>
                        <td>
                            <div class="guru-result-rating">
                                <div class="blank" style="height: 10px;"></div>
                                <div class="grr-title">
                                    RATING
                                </div>
                                <div class="profile-rating-value">
                                   <p><?php $rate = $this->guru_model->get_rating_by_feedback($row->guru_id);  
								$rate2 = $this->guru_model->get_calculated_rating($row->guru_id);
								echo ($rate+$rate2); ?></p>
                                </div>
                                <div class="grr-checkbox">
                                    <input class="grrc" type="checkbox" name="guru[<?php echo $row->guru_id; ?>]" value="<?php echo $row->guru_id; ?>" <?php if (!empty($pilihan_guru)) {echo(in_array($row->guru_id, $pilihan_guru)) ? 'checked' : '';} ?>/> PILIH GURU <span class="italic text-11">(Maksimal pilih tiga guru, jika sudah selesai silahkan klik tombol &quot;Lanjut&quot; di bawah)</span>
                                </div>
                                <div class="blank" style="height: 13px;"></div>
                            </div>
                        </td>
                        <td>
                            <div class="guru-result-detail">
                                <div class="grd-title">
                                    <div class="grdt-left bold">
								<?php $nama = $this->guru_model->nama_guru($row->guru_nama);?>
                                        <?php echo ++$count . ". " .$nama; ?>
                                    </div>
                                    <div class="grdt-right">
                                        <a href="<?php echo base_url();?>guru/view/<?php echo $row->guru_id;?>" target="blank" class="diy-button-mini">Buka profil lengkap</a>
                                    </div>
                                </div>
                                <div class="blank" style="height: 15px;"></div>
                                <div class="grd-content">
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="grdc-left1"></div>
                                            </td>
                                            <td>
                                                <div class="grdc-right">
                                                    <div class="grdc-title">Tentang <?php echo $nama; ?></div>
                                                    <div class="grdc-text2 justify">
                                                        <?php echo str_replace("\n", "<br/>", $row->guru_bio); ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="grdc-left2"></div>
                                            </td>
                                            <td>
                                                <div class="grdc-right">
                                                    <div class="grdc-title">Pendidikan Saat Ini</div>
                                                    <div class="grdc-text2">
                                                        <?php echo $row->pendidikan_title . " - " . $row->guru_pendidikan_instansi; ?>
                                                        <?php if ($row->guru_pendidikan_verified == 1): ?>
                                                            <img src="<?php echo base_url(); ?>images/verified-ico.png"/>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="grdc-left1"></div>
                                            </td>
                                            <td>
                                                <div class="grdc-right">
                                                    <div class="grdc-title">Pelajaran yang Diajar</div>
                                                    <div class="grdc-text2">
											<table class="matpel">
                                                        <?php $tarif_matpel = $this->guru_model->get_matpel_guru($row->guru_id)->result();
												$n = count($tarif_matpel);
												$get_jenjang = $tarif_matpel[0]->jenjang_pendidikan_id;
												$get_jenjang_title = $tarif_matpel[0]->jenjang_pendidikan_title;
											 ?>
											 <?php for($i=0;$i<$n;$i++){ ?>
											 <?php if($i==0) { ?>
												<tr>
													<th class="bold"><?php echo $get_jenjang_title; ?></th>
													<th class="bold" width="200px">Tarif/ 1 Jam Kursus</th>
												</tr>
											<?php } ?>
												<?php if($tarif_matpel[$i]->jenjang_pendidikan_id == $get_jenjang){ ?>
												<tr>
													<td class="<?php if($tarif_matpel[$i]->matpel_id == $input['matpel']){ echo 'bold bg-hilite italic'; } ?>"><?php echo $tarif_matpel[$i]->matpel_title; ?></td>
													<td class="<?php if($tarif_matpel[$i]->matpel_id == $input['matpel']){ echo 'bold bg-hilite italic'; } ?>"><?php echo 'Rp '.number_format($tarif_matpel[$i]->guru_matpel_tarif).',-'; ?></td>
												</tr>
												<?php } else { ?>
												<?php $get_jenjang = $tarif_matpel[$i]->jenjang_pendidikan_id; ?>
												<?php $get_jenjang_title = $tarif_matpel[$i]->jenjang_pendidikan_title; ?>
												<tr>
													<th class="bold"><?php echo $get_jenjang_title; ?></th>
													<th class="bold">Tarif/ 1 Jam Kursus</th>
												</tr>
												<tr>
													<td class="<?php if($tarif_matpel[$i]->matpel_id == $input['matpel']){ echo 'bold bg-hilite italic'; } ?>"><?php echo $tarif_matpel[$i]->matpel_title; ?></td>
													<td class="<?php if($tarif_matpel[$i]->matpel_id == $input['matpel']){ echo 'bold bg-hilite italic'; } ?>"><?php echo 'Rp '.number_format($tarif_matpel[$i]->guru_matpel_tarif).',-'; ?></td>
												</tr>
												<?php } ?>
                                                        <?php } ?>
											</table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="grdc-left2"></div>
                                            </td>
                                            <td>
                                                <div class="grdc-right">
                                                    <div class="grdc-title">Jadwal Ketersediaan Mengajar</div>
                                                    <div class="grdc-text2">
                                                        <?php $jadwal = $this->profile_model->get_jadwal_map($row->guru_id);?>
                                                        <table class="availability" border="0" cellpadding="0" cellspacing="1" width="160">
                                                            <tbody>
                                                                <tr>
                                                                    <th></th>
                                                                    <th width="16" class="center">Sen</th>
                                                                    <th width="16" class="center">Sel</th>
                                                                    <th width="16" class="center">Rab</th>
                                                                    <th width="16" class="center">Kam</th>
                                                                    <th width="16" class="center">Jum</th>
                                                                    <th width="16" class="center">Sab</th>
                                                                    <th width="16" class="center">Min</th>
                                                                </tr>
                                                                <?php for($i=7;$i<24;$i++):?>
                                                                <tr>
                                                                    <th class="small"><?php echo sprintf('%02s', $i); ?>:00</th>
                                                                    <?php for($j=0;$j<7;$j++):?>
                                                                    <?php $hour = (array_key_exists($j, $jadwal)?$jadwal[$j]:array());?>
                                                                    <td style="background-color: <?php echo (array_key_exists($i, $hour)?'#bedef4':'#F9F9F9');?>">
                                                                    </td>
                                                                    <?php endfor;?>
                                                                </tr>
                                                                <?php endfor;?>
                                                            </tbody>
                                                        </table>
                                                        <span class="small"><img src="<?php echo base_url().'images/jadwal-available-icon.png';?>"/><strong> Biru:</strong> Tersedia<br/><img src="<?php echo base_url().'images/jadwal-notavailable-icon.png';?>"/><strong> Abu-abu:</strong> Tidak Tersedia</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="grdc-left1"></div>
                                            </td>
                                            <td>
                                                <div class="grdc-right">
                                                    <div class="grdc-title">Lokasi Mengajar</div>
                                                    <div class="grdc-text2">
                                                        <?php echo $this->profile_model->get_lokasi_mengajar($row->guru_id);?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
								<tr>
                                            <td>
                                                <div class="grdc-left1"></div>
                                            </td>
                                            <td>
                                                <div class="grdc-right">
                                                    <div class="grdc-title">Metode Belajar</div>
                                                    <div class="grdc-text2">
                                                        <?php
											   $met = $row->guru_metode;
											   $m = ",".$met;
											   $m1= strpos($m,'1');
											   $m2= strpos($m,'2');
											   if(!empty($m1) && !empty($m2)){
												echo "Online dan Tatap Muka";
											   }elseif(!empty($m1)){
												echo "Online";
											   }elseif(!empty($m2)){
												echo "Tatap Muka";
											   }else{
												echo "-";
											   }
											 ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="_blank" style="height: 20px;"></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <?php endforeach; ?>
        </div>        
        <div id="cari-guru-page" style="font-family: Ubuntu;">
			<div style="display: inline-block; text-align: left;width: 30%;">
				Menampilkan 
				<strong><?php echo ($pagination['page'] * $pagination['perpage'])+1?></strong>
				s.d 
				<strong><?php echo $count?></strong>
			</div>
			<div style="display: inline-block; text-align: center;width: 30%;">
				<?php echo $pagination['link'];?>
			</div>
			<div style="display: inline-block; text-align: right;width: 30%;">
				Halaman <strong><?php echo $pagination['page']+1?></strong>
				dari <strong><?php echo ceil($guru['total']/$pagination['perpage']);?></strong>
			</div>
        </div>
	   <?php if($pagination['page']+1 < ceil($guru['total']/$pagination['perpage'])):?>
        <div class="blank" style="height:30px"></div>
        <div id="cari-guru-nav">
            <a href="<?php echo base_url();?>cari_guru/review" class="diy-button">
                LANJUT
            </a>
        </div>
        <div class="blank" style="height:30px"></div>
	   <?php endif; ?>
        <?php endif; ?>
</div>
<div class="pilih-guru-tambah formError">
    <div class="formErrorContent">* Pilihan guru ditambahkan<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div>
</div>
<div class="pilih-guru-hapus formError">
    <div class="formErrorContent">* Pilihan guru dihilangkan<br></div><div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div>
</div>
<?php
$this->load->view('footer');