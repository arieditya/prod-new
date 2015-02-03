<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/guru/view" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.alerts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/cariguru.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.alerts.css" media="screen" />
<script>
	function do_submit(){
	   $('#profil-guru').submit();
	   return true;
    }
    $(document).ready(function(){
    	   $(".grrc").click(function(){
			if($(this).is(":checked")){
				jAlert('Untuk melanjutkan review guru pilihan Anda silahkan klik <a href="'+base_url+'cari_guru/review">Review Guru</a> <br/> atau lanjutkan ke <a href="'+base_url+'cari_guru/result">Cari Guru</a> untuk menambah pilihan guru.', 'Pilihan guru');
			}
		});
	});
</script>
<!-- FB share -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=636048143136369";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Tweet share -->
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <div id="profile-guru" style="float:left">
            <div id="profile-guru-header">
                <div id="profile-guru-front-wrap">
                    PROFIL GURU
				<input class="grrc" type="checkbox" name="guru[<?php echo $guru->guru_id; ?>]" value="<?php echo $guru->guru_id; ?>" <?php if (!empty($pilihan_guru)) {echo(in_array($guru->guru_id, $pilihan_guru)) ? 'checked' : '';} ?>/> Pilih Guru Ini
			 </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div id="profile-picture">
                            <div class="profile-image">
                                <?php if (!file_exists("./images/pp/{$guru->guru_id}.jpg")): ?>
                                    <img src="<?php echo base_url(); ?>images/default_profile_image.png"/>
                                <?php else : ?>
                                    <img src="<?php echo base_url(); ?>images/pp/<?php echo $guru->guru_id; ?>.jpg"/>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div id="profile-bio">
                            <div id="profile-bio-nama">
                                <?php $nama = $this->guru_model->nama_guru($guru->guru_nama); echo $nama;?>
                                <?php if($guru->guru_nik_verified==1):?>
                                <img src="<?php echo base_url();?>images/verified-ico.png"/>
                                <?php endif;?>
                            </div>
                            <div id="profile-bio-detail">
                                <table>
                                    <tr>
                                        <td>
                                            <strong>ID</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $guru->guru_id;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Jenis Kelamin</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo ($guru->guru_gender==1)?'Laki-laki':'Perempuan';?>
                                        </td>
                                    </tr>
							 <tr>
                                        <td>
                                            <strong>Pekerjaan</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $guru->kategori_title; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="profile-rating">
                            <div id="profile-rating-title">
                                Rating:
                            </div>
                            <div id="profile-rating-value">
                                <p><?php $rate = $this->guru_model->get_rating_by_feedback($guru->guru_id);  
								$rate2 = $this->guru_model->get_calculated_rating($guru->guru_id);
								echo ($rate+$rate2); ?>
						  </p>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
				<div class="pgc-section">
                        <div class="header">
                            <span>Video Profil</span>
                        </div>
                        <div class="content">
					<?php if(!empty($guru->guru_video)){ ?>
						<?php if($guru->guru_jenis_video == 0 ){ ?>
						<iframe width="500" height="281" src="//www.youtube.com/embed/<?php echo $guru->guru_video?>" frameborder="0" allowfullscreen></iframe>
						<?php } else { ?>
						<iframe src="//player.vimeo.com/video/<?php echo $guru->guru_video;?>" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						<?php } ?>
					<?php } else { ?>
						<span>Guru ini belum memiliki video profil</span>
					<?php } ?>
				    </div>
                    </div>
				<div class="pgc-section">
                        <div class="header">
                            <span>Tentang Saya</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php echo str_replace("\n", "<br/>", $guru->guru_bio); ?>
                            </span>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Pendidikan Saat Ini</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php echo $guru->pendidikan_title." - ".$guru->guru_pendidikan_instansi;?>
                                <?php if($guru->guru_pendidikan_verified==1):?>
                                <img src="<?php echo base_url();?>images/verified-ico.png"/>
                                <?php endif;?>
                            </span>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Pelajaran yang Diajar</span>
                        </div>
                        <div class="content">
                            <?php $count = 0; ?>
                            <table class="matpel">
						  <?php $tarif_matpel = $guru->matpel->result(); ?>
						  <?php $n = count($tarif_matpel); ?>
						  <?php $get_jenjang = $tarif_matpel[0]->jenjang_pendidikan_id;?>
						  <?php $get_jenjang_title = $tarif_matpel[0]->jenjang_pendidikan_title; ?>
                                <?php for($i=0;$i<$n;$i++){ ?>
						  <?php if($i==0) { ?>
							<tr>
								<th class="bold"><?php echo $get_jenjang_title; ?></td>
								<th class="bold" width="200px">Tarif/ 1 Jam Kursus</td>
							</tr>
						  <?php } ?>
						  <?php if($tarif_matpel[$i]->jenjang_pendidikan_id == $get_jenjang){ ?>
							<tr>
								<td><?php echo $tarif_matpel[$i]->matpel_title; ?></td>
								<td><?php echo 'Rp '.number_format($tarif_matpel[$i]->guru_matpel_tarif).',-'; ?></td>
							</tr>
								<?php } else { ?>
								<?php $get_jenjang = $tarif_matpel[$i]->jenjang_pendidikan_id; ?>
								<?php $get_jenjang_title = $tarif_matpel[$i]->jenjang_pendidikan_title; ?>
							<tr>
								<th class="bold"><?php echo $get_jenjang_title; ?></td>
								<th class="bold">Tarif/ 1 Jam Kursus</td>
							</tr>
							<tr>
								<td><?php echo $tarif_matpel[$i]->matpel_title; ?></td>
								<td><?php echo 'Rp '.number_format($tarif_matpel[$i]->guru_matpel_tarif).',-'; ?></td>
							</tr>
							<?php } ?>
                                    <?php } ?>
                            </table>
                        </div>
                    </div>
				<div class="pgc-section">
                        <div class="header">
                            <span>Lokasi Mengajar</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php echo $guru->lokasi; ?>
                            </span>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Kualifikasi</span>
                        </div>
                        <div class="content">
                            <span>
                               <?php echo str_replace("\n", "<br/>", $guru->guru_kualifikasi); ?>
                            </span>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Pengalaman Mengajar</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php if(!empty($guru->guru_pengalaman)){ echo str_replace("\n", "<br/>", $guru->guru_pengalaman);} else { echo "Guru ini belum memiliki pengalaman mengajar";}  ?>
                            </span>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Testimoni dari Murid</span>
                        </div>
                        <div class="content">
					   <?php if($kelas->num_rows() == 0){ ?>
                            <span>
                                Guru ini belum memiliki testimoni.
                            </span>
					   <?php } else { ?>
					   <?php foreach($kelas->result() as $k){ ?>
					   <?php $murid = $this->guru_model->get_murid($k->murid_id);?>
					   <?php if($k->kelas_feedback_status == 1){ ?>
					   	<span>
                                <?php echo $k->kelas_testimoni; ?> (<i><?php echo $murid->murid_nama?></i>)
                              </span><br/>
					   <?php } } } ?>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Jadwal Ketersediaan Mengajar</span>
                        </div>
                        <div class="content">
                            <table class="availability" border="0" cellpadding="2" cellspacing="1">
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <th width="50" class="small center">Sen</th>
                                        <th width="50" class="small center">Sel</th>
                                        <th width="50" class="small center">Rab</th>
                                        <th width="50" class="small center">Kam</th>
                                        <th width="50" class="small center">Jum</th>
                                        <th width="50" class="small center">Sab</th>
                                        <th width="50" class="small center">Min</th>
                                    </tr>
                                    <?php for($i=7;$i<24;$i++):?>
                                    <tr>
                                        <th class="small" height="15"><?php echo sprintf('%02s', $i); ?>:00</th>
                                        <?php for($j=0;$j<7;$j++):?>
                                        <?php $hour = (array_key_exists($j, $guru->jadwal)?$guru->jadwal[$j]:array());?>
                                        <td style="background-color: <?php echo (array_key_exists($i, $hour)?'#bedef4':'#F9F9F9');?>">
                                        </td>
                                        <?php endfor;?>
                                    </tr>
                                    <?php endfor;?>
                                </tbody>
                            </table>
                            <span class="small"><img src="<?php echo base_url().'images/jadwal-available-icon.png';?>"/><strong> Biru:</strong> Tersedia<br/><img src="<?php echo base_url().'images/jadwal-notavailable-icon.png';?>"/><strong> Abu-abu:</strong> Tidak Tersedia</span>
                        </div>
				    <div class="blank" style="height:20px;"></div>
				    <?php //print_r($this->session->userdata);?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="blank" style="height:20px;"></div>
        </div>
        <div class="profile-right-box">
            <div class="profile-side-box">
                <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fruanggurucom&amp;width=300&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false&amp;appId=151390271591966" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:230px; height:290px;" allowTransparency="true"></iframe>
            </div>
            <div class="blank" style="height: 10px;"></div>
            <div class="profile-side-box">
                <a class="twitter-timeline"  href="https://twitter.com/ruangguru"  data-widget-id="371164555830779904"></a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</body>
</html>