<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/cari_guru/review" />	
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.alerts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/cariguru.js"></script>

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

</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <?php echo $progress; ?>
    <div class="blank" style="height:30px;"></div>
    <div id="review-guru">
        <div id="review-guru-header">
            <div id="review-guru-header-wrap">
                <h2><span class="text-20">2. REVIEW GURU</span></h2>
            </div>
        </div>
        <div id="review-guru-content">
            <div class="blank" style="height:20px;"></div>
            <?php if(!empty($pilihan)):?>
            <table>
                <tr class="rg-hapus">
                    <td></td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <td class="center">
                        <div class="rg-guru-wrap">
                            <span style="color: #a81010;font-weight: bold;"></span><a href="<?php echo base_url();?>cari_guru/hapus_pilihan/<?php echo $guru->guru_id;?>" class="diy-btn-mini"><img src="<?php echo base_url().'images/delete-entry-button.png'; ?>"/> Hapus dari daftar</a>
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <tr class="rg-pp">
                    <td width="<?php if($pilihan->num_rows() == 1){ echo '30%'; } else { echo '20%';}?>">Daftar Pilihan Guru</td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <td width="<?php if($pilihan->num_rows() == 1){ echo '83%'; } else{ echo '40%';} ?>" class="center">
                        <div class="rg-guru-wrap">
                        <?php if (!file_exists("./images/pp/{$guru->guru_id}.jpg")): ?>
                            <img src="<?php echo base_url(); ?>images/default_profile_image.png"/>
                        <?php else : ?>
                            <img src="<?php echo base_url(); ?>images/pp/<?php echo $guru->guru_id; ?>.jpg"/>
                        <?php endif; ?>
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <tr class="rg-nama">
                    <td></td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <td class="center">
                        <div class="rg-guru-wrap">
				    <?php $nama = $this->guru_model->nama_guru($guru->guru_nama);?>
                        <?php echo $nama;?>
                        <?php if($guru->guru_nik_verified==1):?>
                        <img src="<?php echo base_url();?>images/verified-ico.png"/>
                        <?php endif;?>
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <tr class="rg-grey">
                    <td>Lokasi mengajar</td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <td class="center">
                        <div class="rg-guru-wrap">
                            <?php 
                            foreach($this->guru_model->get_lokasi_guru($guru->guru_id)->result() as $lokasi){
                                echo $lokasi->lokasi_title.'<br/>';
                            }
                            ?>
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <tr class="rg-white">
                    <td>Gender</td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <td class="center">
                        <div class="rg-guru-wrap">
                        <?php echo ($guru->guru_gender==1)?'Laki-laki':'Perempuan';?>
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <tr class="rg-grey">
                    <td>Usia</td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <td class="center">
                        <div class="rg-guru-wrap">
                        <?php echo $this->custom->get_age($guru->guru_lahir);?> Tahun
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <tr class="rg-white">
                    <td>Pendidikan saat ini</td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <td class="center">
                        <div class="rg-guru-wrap">
                        <?php echo $guru->pendidikan_title." - ".$guru->guru_pendidikan_instansi;?>
                        <?php if($guru->guru_pendidikan_verified==1):?>
                        <img src="<?php echo base_url();?>images/verified-ico.png"/>
                        <?php endif;?>
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <tr class="rg-grey">
                    <td>Rating</td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <td class="center">
                        <div class="profile-rating-value">
                            <!--<p><?php //echo $this->guru_model->get_calculated_rating($guru->guru_id);?></p>-->
                            <p><?php $rate = $this->guru_model->get_rating_by_feedback($guru->guru_id);  
								$rate2 = $this->guru_model->get_calculated_rating($guru->guru_id);
								echo ($rate+$rate2); ?>
					   </p>
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <tr class="rg-white">
                    <td>Pelajaran yang dipilih</td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <td>
                        <div class="rg-guru-wrap">
                            <table class="matpel-review">
						  <?php $tarif_matpel = $this->guru_model->get_matpel_guru($guru->guru_id)->result(); ?>
						  <?php $n = count($tarif_matpel); ?>
						  <?php $get_jenjang = $tarif_matpel[0]->jenjang_pendidikan_id;?>
						  <?php $get_jenjang_title = $tarif_matpel[0]->jenjang_pendidikan_title; ?>
						  <?php $sesi = $this->session->userdata('cari_guru'); //print_r($tarif_matpel);?>
                                <?php for($i=0;$i<$n;$i++){ ?>
						  <?php //if($i==0) { ?>
							<!--<tr>
								<th class="bold"><?php //echo $get_jenjang_title; ?></td>
							</tr>-->
						  <?php //} ?>
						  <?php if(($tarif_matpel[$i]->jenjang_pendidikan_id == $sesi['jenjang']) && ($tarif_matpel[$i]->matpel_id == $sesi['matpel'])){ ?>
							<tr>
								<th class="bold"><?php echo $tarif_matpel[$i]->jenjang_pendidikan_title; ?></td>
							</tr>
							<tr>
								<td><?php echo $tarif_matpel[$i]->matpel_title; ?></td>
							</tr>
								<?php //} else { ?>
								<?php //$get_jenjang = $tarif_matpel[$i]->jenjang_pendidikan_id; ?>
								<?php //$get_jenjang_title = $tarif_matpel[$i]->jenjang_pendidikan_title; ?>
							<!--
							<tr>
								<th class="bold"><?php echo $get_jenjang_title; ?></td>
							</tr>
							<tr>
								<td><?php //echo $tarif_matpel[$i]->matpel_title; ?></td>
							</tr>-->
							<?php } ?>
                                    <?php } ?>
                            </table>
					   <div class="_blank" style="height:10px;"></div>
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <tr class="rg-grey">
                    <td>Pekerjaan</td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <td class="center">
                        <div class="rg-guru-wrap">
                            <?php echo $guru->kategori_title;?>
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <tr class="rg-white">
                    <td>Jadwal ketersediaan mengajar</td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <?php $jadwal = $this->profile_model->get_jadwal_map($guru->guru_id);?>
                    <td>
                        <div class="rg-guru-wrap" style="line-height:14px;">
                            <div class="_blank" style="height:16px;"></div>
                            <table class="center" border="0" cellpadding="1" cellspacing="1" width="250">
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <th width="25">S</th>
                                        <th width="25">S</th>
                                        <th width="25">R</th>
                                        <th width="25">K</th>
                                        <th width="25">J</th>
                                        <th width="25">S</th>
                                        <th width="25">M</th>
                                    </tr>
                                    <?php for($i=7;$i<24;$i++):?>
                                    <tr>
                                        <th class="small" width="55"><?php echo sprintf('%02s', $i); ?>:00</th>
                                        <?php for($j=0;$j<7;$j++):?>
                                        <?php $hour = (array_key_exists($j, $jadwal)?$jadwal[$j]:array());?>
                                        <td style="background-color: <?php echo (array_key_exists($i, $hour)?'#bedef4':'#F9F9F9');?>">
                                        </td>
                                        <?php endfor;?>
                                    </tr>
                                    <?php endfor;?>
                                </tbody>
                            </table>
                            <div class="_blank" style="height:8px;"></div>
                            <div class="rg-guru-wrap center"><span class="small"><img src="<?php echo base_url().'images/jadwal-available-icon.png';?>"/> Tersedia</span>&nbsp;&nbsp;
						<span class="small"><img src="<?php echo base_url().'images/jadwal-notavailable-icon.png';?>"/> Tidak Tersedia</span></div>
                            <div class="_blank" style="height:16px;"></div>
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <tr class="rg-grey">
                    <td>Pengalaman mengajar</td>
                    <?php foreach($pilihan->result() as $guru):?>
                    <td class="guru-xp">
                        <div class="rg-guru-wrap left">
                            <?php echo $guru->guru_pengalaman;?>
                        </div>
                    </td>
                    <?php endforeach;?>
                </tr>
                <!--<tr class="rg-white">
                    <td>Personal Message</td>
                    <?php //foreach($pilihan->result() as $guru):?>
                    <td>
                        <div class="rg-guru-wrap">
                            <?php //echo $guru->guru_bio;?>
                        </div>
                    </td>
                    <?php //endforeach;?>
                </tr>
                <tr class="rg-grey">
                    <td>Kualifikasi</td>
                    <?php //foreach($pilihan->result() as $guru):?>
                    <td>
                        <div class="rg-guru-wrap">
                            <?php //echo $guru->guru_kualifikasi;?>
                        </div>
                    </td>
                    <?php //endforeach;?>
                </tr>-->
            </table>
            <?php else:?>
            <div class="rg-info">
                <p>Anda belum memilih guru, silahkan memilih guru pada menu <a href="<?php echo base_url().'cari_guru'; ?>" class="normal-link bold">Cari Guru</a></p>
            </div>
            <?php endif;?>
            <div class="blank" style="height:20px;"></div>
        </div>
    </div>
    <div class="blank" style="height:20px;"></div>
    <div id="cari-guru-nav">
        <a href="<?php echo base_url();?>cari_guru" class="diy-button">KEMBALI</a>
        <span style="display: inline-block;width:30px;"></span>
        <a href="<?php echo base_url();?>cari_guru/request" class="diy-button">LANJUT</a>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</body>
</html>