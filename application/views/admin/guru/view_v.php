<!-- Message Error -->
<?php if ($this->session->flashdata('f_guru')): ?>
    <div class="msg msg-ok boxwidth">
        <p><strong><?php echo $this->session->flashdata('f_guru'); ?></strong></p>
    </div>
<?php endif; ?>

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Data Guru</h2>
    </div>
    <!-- End Box Head -->

    <form method="post" >

        <!-- Form -->
        <div class="form">
            <p>
                <label>ID</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_id;?>" disabled="true"/>       
            </p>
            <p>
                <label>Nama Guru</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_nama;?>" disabled="true"/>
                <input type="hidden" class="field size1" name="id" value="<?php echo $guru->guru_id;?>"/>
            </p>
            <p>
                <label>Email</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_email;?>" disabled="true"/>       
            </p>
            <p>
                <label>No. Ponsel 1</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_hp;?>" disabled="true"/>       
            </p>
		  <p>
                <label>No. Ponsel 2</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_hp_2;?>" disabled="true"/>       
            </p>
		  <p>
                <label>No. Telp Rumah</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_telp_rumah;?>" disabled="true"/>       
            </p>
		  <p>
                <label>No. Telp Kantor</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_telp_kantor;?>" disabled="true"/>       
            </p>
            <p>
                <label>NIK</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_nik;?>" disabled="true"/>       
            </p>
            <p>
                <label>Scan NIK</label>
                <?php if(!empty($guru->guru_nik_image)):?>
                <img src="<?php echo base_url().'images/nik/'.$guru->guru_nik_image;?>" alt="nik" style="max-width:500px"/>
                <?php else:?>
                <span>Tidak tersedia</span>
                <?php endif;?>
            </p>
            <p>
                <label>Gender</label>
                <input type="text" class="field size1" name="name" value="<?php echo ($guru->guru_gender==1)?'Pria':'Wanita';?>" disabled="true"/>       
            </p>
            <p>
                <label>Pekerjaan</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->kategori_title;?>" disabled="true"/>       
            </p>
            <p>
                <label>Pendidikan</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->pendidikan_title;?>" disabled="true"/>       
            </p>
            <p>
                <label>Instansi</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_pendidikan_instansi;?>" disabled="true"/>       
            </p>
            <p>
                <label>Tempat Lahir</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_tempatlahir;?>" disabled="true"/>       
            </p>
            <p>
                <label>Tanggal Lahir</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_lahir;?>" disabled="true"/>       
            </p>
            <p>
                <label>Alamat</label>
                <textarea disabled="true" rows="10" cols="30" class="field size1"><?php echo $guru->guru_alamat;?></textarea>
            </p>
		  <p>
                <label>Alamat Domisili</label>
                <textarea disabled="true" rows="10" cols="30" class="field size1"><?php echo $guru->guru_alamat_domisili;?></textarea>
            </p>
            <p>
                <label>FB</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_fb;?>" disabled="true"/>       
            </p>
            <p>
                <label>Twitter</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_twitter;?>" disabled="true"/>       
            </p>
            <p>
                <label>Tentang Saya</label>
                <textarea disabled="true" rows="10" cols="30" class="field size1" style="overflow-y:auto;"><?php echo $guru->guru_bio;?></textarea>
            </p>
            <p>
                <label>Pengalaman Mengajar</label>
                <textarea disabled="true" rows="10" cols="30" class="field size1" style="overflow-y:auto;"><?php echo $guru->guru_pengalaman;?></textarea>
            </p>
            <p>
                <label>Kualifikasi</label>
                <textarea disabled="true" rows="10" cols="30" class="field size1" style="overflow-y:auto;"><?php echo $guru->guru_kualifikasi;?></textarea>
            </p>
            <p>
                <label>Lokasi Mengajar</label>
                <?php foreach($this->guru_model->get_lokasi_guru($guru->guru_id)->result() as $row):?>
                <span><?php echo $row->lokasi_title;?></span><br/>
                <?php endforeach;?>
            </p>
            <p>
                <label>Mata Pelajaran</label>
                <?php foreach($this->guru_model->get_matpel_guru($guru->guru_id)->result() as $row):?>
                <span><?php echo $row->matpel_title;?> (<?php echo $row->jenjang_pendidikan_title;?>)</span><br/>
                <?php endforeach;?>
            </p>
            <p>
                <label>Jadwal Mengajar</label>
                <?php foreach($this->guru_model->get_jadwal_guru($guru->guru_id)->result() as $row):?>
                <?php 
                    $day = "";
                    switch($row->guru_jadwal_day){
                        case 0: $day = "Senin"; break;
                        case 1: $day = "Selasa"; break;
                        case 2: $day = "Rabu"; break;
                        case 3: $day = "Kamis"; break;
                        case 4: $day = "Jumat"; break;
                        case 5: $day = "Sabtu"; break;
                        case 6: $day = "Minggu"; break;
                    }
                ?>
                <span><?php echo $day;?> - <?php echo $row->guru_jadwal_hour;?>:00 </span><br/>
                <?php endforeach;?>
            </p>
            <p>
                <label>Referral id</label>
                <input type="text" class="field size1" name="name" value="<?php echo ($guru->guru_referral==0)?'':$guru->guru_referral;?>" disabled="true"/>       
            </p>
            <p>
                <label>Nama Bank</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->bank_title;?>" disabled="true"/>       
            </p>
            <p>
                <label>No. Rekening</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_bank_rekening;?>" disabled="true"/>       
            </p>
            <p>
                <label>Pemilik Rekening</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_bank_pemilik;?>" disabled="true"/>       
            </p>
            <p>
                <label>Mengetahui Ruangguru Dari</label>
			 <?php $info_source = "";?>
			 <?php $info = explode(",",$guru->source_info_id);?>
			 <?php $n = count($info); $i = 0;?>
			 <?php foreach($info as $in){ ?>
			 <?php if($in != ""){ ?>
			 <?php switch ($in){
					case "1":
						$from= "Duta";
						break;
					case "2":
						$from= "Facebook";
						break;
					case "3":
						$from = "Twitter";
						break;
					case "4":
						$from= "Lainnya";
						break;
					case "5":
						$from = "Pameran";
						break;
					case "6":
						$from = "Roadshow";
						break;
					case "7":
						$from= "Media";
						break;
					}
					$i++;
					if($i != $n-1){
						$info_source .= $from.", ";
					}else{
						$info_source .= $from;
					}
				  }
				}
				?>
                <input type="text" class="field size1" name="name" value="<?php echo $info_source;?>" disabled="true"/>       
            </p>
		  <p>
                <label>Waktu & Tanggal Daftar</label>
                <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_daftar;?>" disabled="true"/>       
            </p>
        </div>
    </form>
</div>
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Edit Rating Guru</h2>
    </div>
    <!-- End Box Head -->

    <form action="<?php echo base_url();?>admin/guru/rating_submit" method="post" >
        <input type="hidden" class="field size1" name="id" value="<?php echo $guru->guru_id;?>"/>
        <!-- Form -->
        <div class="form">
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th class="center">Kategori</th>
                            <th class="center">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lulusan SMA</td>
                            <td>
                                <?php $config = 'class="checkbox"';?>
                                <?php echo form_radio('sma', '0', ($guru->guru_rating_sma==0), $config);?> Tidak
                                <?php echo form_radio('sma', '1', ($guru->guru_rating_sma==1), $config);?> Ya
                            </td>
                        </tr>
                        <tr>
                            <td>Lulusan Diploma</td>
                            <td>
                                <?php echo form_radio('diploma', '0', ($guru->guru_rating_diploma==0), $config);?> Tidak
                                <?php echo form_radio('diploma', '1', ($guru->guru_rating_diploma==1), $config);?> IPK < 3.0
                                <?php echo form_radio('diploma', '2', ($guru->guru_rating_diploma==2), $config);?> IPK 3.0 - 3.5
                                <?php echo form_radio('diploma', '3', ($guru->guru_rating_diploma==3), $config);?> IPK IPK 3.5 - 4.0
                            </td>
                        </tr>
                        <tr>
                            <td>Lulusan S1 UI/ UGM/ ITB/ PT Luar Negeri</td>
                            <td>
                                <?php echo form_radio('s1_top', '0', ($guru->guru_rating_s1_top==0), $config);?> Tidak
                                <?php echo form_radio('s1_top', '1', ($guru->guru_rating_s1_top==1), $config);?> Ya
                            </td>
                        </tr>
                        <tr>
                            <td>Lulusan S1</td>
                            <td>
                                <?php echo form_radio('s1', '0', ($guru->guru_rating_s1==0), $config);?> Tidak
                                <?php echo form_radio('s1', '1', ($guru->guru_rating_s1==1), $config);?> IPK < 3.0
                                <?php echo form_radio('s1', '2', ($guru->guru_rating_s1==2), $config);?> IPK 3.0 - 3.5
                                <?php echo form_radio('s1', '3', ($guru->guru_rating_s1==3), $config);?> IPK IPK 3.5 - 4.0
                            </td>
                        </tr>
                        <tr>
                            <td>Lulusan S2 UI/ UGM/ ITB/ PT Luar Negeri</td>
                            <td>
                                <?php echo form_radio('s2_top', '0', ($guru->guru_rating_s2_top==0), $config);?> Tidak
                                <?php echo form_radio('s2_top', '1', ($guru->guru_rating_s2_top==1), $config);?> Ya
                            </td>
                        </tr>
                        <tr>
                            <td>Lulusan S2</td>
                            <td>
                                <?php echo form_radio('s2', '0', ($guru->guru_rating_s2==0), $config);?> Tidak
                                <?php echo form_radio('s2', '1', ($guru->guru_rating_s2==1), $config);?> IPK < 3.0
                                <?php echo form_radio('s2', '2', ($guru->guru_rating_s2==2), $config);?> IPK 3.0 - 3.5
                                <?php echo form_radio('s2', '3', ($guru->guru_rating_s2==3), $config);?> IPK IPK 3.5 - 4.0
                            </td>
                        </tr>
                        <tr>
                            <td>Lulusan S3 UI/ UGM/ ITB/ PT Luar Negeri</td>
                            <td>
                                <?php echo form_radio('s3_top', '0', ($guru->guru_rating_s3_top==0), $config);?> Tidak
                                <?php echo form_radio('s3_top', '1', ($guru->guru_rating_s3_top==1), $config);?> Ya
                            </td>
                        </tr>
                        <tr>
                            <td>Lulusan S3</td>
                            <td>
                                <?php echo form_radio('s3', '0', ($guru->guru_rating_s3==0), $config);?> Tidak
                                <?php echo form_radio('s3', '1', ($guru->guru_rating_s3==1), $config);?> Ya
                            </td>
                        </tr>
                        <tr>
                            <td>Beasiswa saat kuliah</td>
                            <td>
                                <?php echo form_radio('beasiswa', '0', ($guru->guru_rating_beasiswa==0), $config);?> Tidak
                                <?php echo form_radio('beasiswa', '1', ($guru->guru_rating_beasiswa==1), $config);?> Ya
                            </td>
                        </tr>
                        <tr>
                            <td>Sertifikat Pelatihan</td>
                            <td>
                                <?php echo form_radio('sertifikat', '0', ($guru->guru_rating_sertifikat==0), $config);?> Tidak
                                <?php echo form_radio('sertifikat', '1', ($guru->guru_rating_sertifikat==1), $config);?> Ya
                            </td>
                        </tr>
                        <tr>
                            <td>Nilai TOEFL IBT</td>
                            <td>
                                <?php echo form_radio('toefl_ibt', '0', ($guru->guru_rating_toefl_ibt==0), $config);?> Tidak
                                <?php echo form_radio('toefl_ibt', '1', ($guru->guru_rating_toefl_ibt==1), $config);?> > 600/ 667
                            </td>
                        </tr>
                        <tr>
                            <td>Nilai TOEFL ITP</td>
                            <td>
                                <?php echo form_radio('toefl_itp', '0', ($guru->guru_rating_toefl_itp==0), $config);?> Tidak
                                <?php echo form_radio('toefl_itp', '1', ($guru->guru_rating_toefl_itp==1), $config);?> > 100/ 120    
                            </td>
                        </tr>
                        <tr>
                            <td>Nilai IELTS</td>
                            <td>
                                <?php echo form_radio('ielts', '0', ($guru->guru_rating_ielts==0), $config);?> Tidak
                                <?php echo form_radio('ielts', '1', ($guru->guru_rating_ielts==1), $config);?> > 7.0/ 9.0     
                            </td>
                        </tr>
                        <tr>
                            <td>Nilai GRE</td>
                            <td>
                                <?php echo form_radio('gre', '0', ($guru->guru_rating_gre==0), $config);?> Tidak
                                <?php echo form_radio('gre', '1', ($guru->guru_rating_gre==1), $config);?> > 1400/1600 atau > 322/340    
                            </td>
                        </tr>
                        <tr>
                            <td>Nilai GMAT</td>
                            <td>
                                <?php echo form_radio('gmat', '0', ($guru->guru_rating_gmat==0), $config);?> Tidak
                                <?php echo form_radio('gmat', '1', ($guru->guru_rating_gmat==1), $config);?> > 700/800     
                            </td>
                        </tr>
                        <tr>
                            <td>Nilai CFA</td>
                            <td>
                                <?php echo form_radio('cfa', '0', ($guru->guru_rating_cfa==0), $config);?> Tidak
                                <?php echo form_radio('cfa', '1', ($guru->guru_rating_cfa==1), $config);?> Level 1     
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Form -->
        
        <!-- Form Buttons -->
        <div class="buttons">
            <input type="submit" class="button" value="submit" />
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
<!-- End Box -->

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Daftar Sertifikat Guru</h2>
    </div>
    <!-- End Box Head -->
    <!-- Form -->
    <div class="form">
        <p>
            <label>Nama Guru</label>
            <input type="text" class="field size1" name="name" value="<?php echo $guru->guru_nama; ?>" disabled="true"/>
            <input type="hidden" class="field size1" name="id" value="<?php echo $guru->guru_id; ?>"/>
        </p>
    </div>
    <div class="table">
        <table style="width: 100%">
            <thead>
                <tr class="center">
                    <th>No</th>
                    <th>Nama Sertifikat</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($sertifikat->result() as $row): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td>
                            <?php echo $row->guru_sertifikat_title; ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url() . 'files/sertifikat/' . $row->guru_sertifikat_file; ?>" target="_blank">Open</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagging">
            <div class="left">
                Showing <?php echo $sertifikat->num_rows(); ?> Certificates
            </div>
        </div>
    </div>
</div>
<!-- End Box -->

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Edit Status Guru</h2>
    </div>
    <!-- End Box Head -->

    <form action="<?php echo base_url();?>admin/guru/edit_submit" method="post" >

        <!-- Form -->
        <div class="form">
            <input type="hidden" class="field size1" name="id" value="<?php echo $guru->guru_id;?>"/>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th class="center">Kategori</th>
                            <th class="center">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Is Blocked</td>
                            <td>
                                <?php $config = 'class="checkbox"';?>
                                <?php echo form_radio('blocked', '0', ($guru->guru_blocked==0), $config);?> Tidak
                                <?php echo form_radio('blocked', '1', ($guru->guru_blocked==1), $config);?> Ya
                            </td>
                        </tr>
                        <tr>
                            <td>ID Verified</td>
                            <td>
                                <?php $config = 'class="checkbox"';?>
                                <?php echo form_radio('id_verified', '0', ($guru->guru_nik_verified==0), $config);?> Tidak
                                <?php echo form_radio('id_verified', '1', ($guru->guru_nik_verified==1), $config);?> Ya
                            </td>
                        </tr>
                        <tr>
                            <td>Last Education Verified</td>
                            <td>
                                <?php $config = 'class="checkbox"';?>
                                <?php echo form_radio('edu_verified', '0', ($guru->guru_pendidikan_verified==0), $config);?> Tidak
                                <?php echo form_radio('edu_verified', '1', ($guru->guru_pendidikan_verified==1), $config);?> Ya
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Form -->
        
        <!-- Form Buttons -->
        <div class="buttons">
            <input type="submit" class="button" value="submit" />
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
<!-- End Box -->
