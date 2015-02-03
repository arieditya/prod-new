<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/profile" />
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
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-guru-header">
                <div id="profile-guru-header-wrap">
                    PROFIL GURU
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
					   <div class="fb-share-button" data-href="http://www.ruangguru.com/guru/view/<?php echo $guru->guru_id?>" data-type="button" style="position: relative; top: 4px; float: left;"></div>&nbsp;<span  style="position: relative; top: 4px; float: left; right:-8px;"><a href="https://twitter.com/share" class="twitter-share-button" data-text="Jgn lupa pilih saya sbg guru kamu di Ruangguru ya" data-related="jasoncosta" data-lang="en" data-size="medium" data-count="none" data-url="http://www.ruangguru.com/guru/view/<?php echo $guru->guru_id?>">Tweet</a></span>
                        </div>
                        <div id="profile-bio">
                            <div id="profile-bio-nama">
                                <a href="<?php echo base_url().'guru/view/'.$guru->guru_id?>" class="normal-link blue-text"><?php echo $guru->guru_nama;?></a>
                                <?php if($guru->guru_nik_verified==1):?>
                                <img src="<?php echo base_url();?>images/verified-ico.png"/>
                                <?php endif;?>
                            </div>
                            <div id="profile-bio-detail">
                                <table cellpadding="4">
                                    <tr>
                                        <td width="100px">
                                            <strong>ID</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $guru->guru_id;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Email</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $guru->guru_email;?>
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
                                            <strong>Tempat Lahir</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $guru->guru_tempatlahir;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Tanggal Lahir</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php $ttl = explode("-",$guru->guru_lahir);
											$mm = $this->guru_model->convert_month($ttl[1]);
											$dd = sprintf("%d", $ttl[2]);
											echo $dd." ".$mm." ".$ttl[0];
								    ?>
                                        </td>
                                    </tr>
							 <tr>
								<td><strong>No. Telp</strong></td>
								<td>:</td>
								<td><?php echo $guru->guru_hp?></td>
							 </tr>
							 <tr>
								<td><strong>Alamat</strong></td>
								<td>:</td>
								<td><?php echo $guru->guru_alamat?></td>
							 </tr>
							<tr>
                                        <td width="100px">
                                            <strong>Terakhir Login</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $guru->guru_last_login;?><br/>
                                            (<strong><i><?php echo $this->guru_model->convert_last_login($guru->guru_last_login);?></i></strong>)
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
								echo ($rate+$rate2); ?></p>
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
                            <span>Pekerjaan</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php echo $guru->kategori_title; ?>
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
                                <?php echo str_replace("\n", "<br/>", $guru->guru_pengalaman); ?>
                            </span>
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
                                        <th class="small"><?php echo sprintf('%02s', $i); ?>:00</th>
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
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="blank" style="height:10px;"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</body>
</html>