<html>
<head>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/profile.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $('.bfcs-list .bfcs-tarif').click(function(){        
        obj = $(this).siblings(".bfcs-form-tarif");
        if(!$(obj).is(':visible')){
            $(".bfcs-form-tarif").hide('slow');
        }
        $(obj).slideToggle('slow');
    });
});

$(document).ready(function(){
    $("#change-password-form").validationEngine('attach');
    $("#change-bio-form").validationEngine('attach');
    $("#tambah-matpel-form").validationEngine('attach');
    $("#change-personal-form").validationEngine('attach');
    $("#kualifikasi-form").validationEngine('attach');
    $("#sertifikat-form").validationEngine('attach');
    $("#tarif-form").validationEngine('attach');
    update_matpel();
    update_total_karakter($('#personal_message'),'total-karakter-personal');
});
</script>
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-guru-header">
                <div id="profile-guru-header-wrap">
                    EDIT PROFIL GURU
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <?php if ($this->session->flashdata('edit_profile_notif')): ?>
                        <div class="profile-notif">
                            <?php echo $this->session->flashdata('edit_profile_notif'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="blank" style="height: 20px;"></div>
				<div class="pgc-section fright">
                        <div class="header">
                            <span>Video Profil</span>
                        </div>
                        <div class="content">
                            <div class="pgcw-content">
                                <div class="profile-image">
							<?php if($guru->guru_jenis_video == 0){?>
							<iframe width="300" height="194" src="//www.youtube.com/embed/<?php echo $guru->guru_video?>" frameborder="0" allowfullscreen></iframe>
							<?php } else { ?>
							<iframe src="//player.vimeo.com/video/<?php echo $guru->guru_video?>" width="300" height="194" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
							<?php } ?>
                                </div>
                                <div class="profile-image-change">
                                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>profile/submit_video">
                                        <p>Masukkan ID link video (Youtube atau Vimeo)</p>
                                        <span class="inline-block"><input id="radio1" type="radio" name="jenis_video" value="0" <?php echo($guru->guru_jenis_video == 0) ? 'checked' : ''; ?>/>Youtube</span>
                                        <span class="inline-block"><input id="radio2" type="radio" name="jenis_video" value="1" <?php echo($guru->guru_jenis_video == 1) ? 'checked' : ''; ?>/>Vimeo</span>
                                        <p>
                                            <input id="video" name="video" type="text" class="text" value="<?php echo $guru->guru_video; ?>"/>
                                        </p>
								<p class="text-11">Misal: http://.../89685043 ID: <strong>89685043</strong> (Vimeo)</p>
								<p class="text-11">Misal: http://.../watch?v=CNoD5xEMYfU ID: <strong>CNoD5xEMYfU</strong> (Youtube)</p>
                                        <p>
                                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Foto Profil</span>
                        </div>
                        <div class="content">
                            <div class="pgcw-content">
                                <div class="profile-image">
                                    <?php if (!file_exists("./images/pp/{$guru->guru_id}.jpg")): ?>
                                        <img src="<?php echo base_url(); ?>images/default_profile_image.png"/>
                                    <?php else : ?>
                                        <img src="<?php echo base_url(); ?>images/pp/<?php echo $guru->guru_id; ?>.jpg"/>
                                    <?php endif; ?>
                                </div>
                                <div class="profile-image-change">
                                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>profile/submit_profpic">
                                        <p>Ganti foto</p>
                                        <p>
                                            <input type="file" name="profpic" />
                                        </p>
                                        <p class="text-11">(File gambar JPG atau PNG maks 2MB)</p>
                                        <p>
                                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
				<div class="blank" style="height: 120px;"></div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Password Akun</span>
                        </div>
                        <div class="content">
                            <form id="change-password-form" class="profile-form" action="<?php echo base_url(); ?>profile/pass_submit" method="post">
                                <table>
                                    <tr>
                                        <td style="width: 180px;">Email <span class="red-notif"> * </span></td>
                                        <td>
                                            <p class="bold"><?php echo $guru->guru_email; ?></p>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>Password Lama <span class="red-notif"> * </span></td>
                                        <td>
                                            <input id="passold" name="oldpass" type="password" class="validate[required,minSize[6]] text" value=""/>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>Password Baru <span class="red-notif"> * </span></td>
                                        <td>
                                            <input id="passnew" name="pass" type="password" class="validate[required,minSize[6]] text" value=""/>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>Ulangi Password Baru <span class="red-notif"> * </span></td>
                                        <td>
                                            <input id="confpass" name="confpass" type="password" class="validate[required,equals[passnew]] text" value=""/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="blank" style="height:20px;"></div>
                                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Biodata Diri</span>
                        </div>
                        <div class="content">
                            <form id="change-bio-form" enctype="multipart/form-data" class="profile-form" action="<?php echo base_url(); ?>profile/biodata_submit" method="post">
                                <table>
                                    <tr height="40px">
                                        <td style="width: 280px;">Nama<span class="red-notif"> * </span></td>
                                        <td>
                                            <input id="nama" name="nama" type="text" class="validate[required,custom[onlyLetterSp]] text" value="<?php echo $guru->guru_nama; ?>"/>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>
                                            <span>No. KTP/ Paspor<span class="red-notif"> * </span></span>
                                        </td>
                                        <td>
                                            <?php echo $guru->guru_nik; ?>
                                        </td>
                                    </tr>
                                    <?php if (!empty($guru->guru_nik_image)): ?>
                                        <tr height="40px">
                                            <td></td>
                                            <td>
                                                <img id="guru-nik-img" src="<?php echo base_url(); ?>images/nik/<?php echo $guru->guru_nik_image; ?>" alt="nik"/>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr height="40px">
                                        <td>Unggah KTP/ Paspor</td>
                                        <td>
                                            <p><input type="file" name="nik_image" class="file" /></p>
                                            <p class="text-11">(File gambar JPG atau PNG maks 2MB)</p>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>Jenis Kelamin<span class="red-notif"> * </span></td>
                                        <td>
                                            <p>
                                                <span class="inline-block"><input id="radio1" type="radio" name="gender" value="1" <?php echo($guru->guru_gender == 1) ? 'checked' : ''; ?>/>Laki-laki</span>
                                                <span class="inline-block"><input id="radio2" type="radio" name="gender" value="2" <?php echo($guru->guru_gender == 2) ? 'checked' : ''; ?>/>Perempuan</span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>Pendidikan Saat Ini <span class="red-notif"> * </span></td>
                                        <td>
                                            <p>
                                                <select name="pendidikan_id">
                                                    <?php foreach ($pendidikan->result() as $row): ?>
                                                        <option value="<?php echo $row->pendidikan_id; ?>" <?php echo($row->pendidikan_id==$guru->pendidikan_id)?'selected':'';?>><?php echo $row->pendidikan_title; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>
                                            <p class="auto-line-height">Instansi &AMP; Jurusan Pendidikan Saat Ini<span class="red-notif"> * </span></p>
                                            <p class="text-11">Contoh : Universitas Indonesia - Ilmu Komunikasi</p></td>
                                        </td>
                                        <td>
                                            <input id="instansi" name="pendidikan_instansi" type="text" class="validate[required,maxSize[100]] text" value="<?php echo $guru->guru_pendidikan_instansi; ?>"/>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>Tempat Lahir<span class="red-notif"> * </span></td>
                                        <td>
                                            <input id="tempatlahir" name="tempatlahir" type="text" class="validate[required,custom[onlyLetterSpecial]] text" value="<?php echo (!empty($guru->guru_tempatlahir)) ? $guru->guru_tempatlahir : ''; ?>"/>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>Tanggal Lahir<span class="red-notif"> * </span></td>
                                        <td>
                                            <p>
                                                <?php
                                                $day = intval(date("j", strtotime($guru->guru_lahir)));
                                                $month = intval(date("n", strtotime($guru->guru_lahir)));
                                                $year = intval(date("Y", strtotime($guru->guru_lahir)));
                                                ?>
                                                <select name="tanggal">
                                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                                        <option value="<?php echo $i; ?>" <?php echo($day == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                                <select name="bulan">
                                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                                        <?php $months = array(1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'); ?>
                                                        <option value="<?php echo $i; ?>" <?php echo($month == $i) ? 'selected' : ''; ?>><?php echo $months[$i]; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                                <select name="tahun">
                                                    <?php for ($i = 1950; $i <= (date("Y") - 15); $i++): ?>
                                                        <option value="<?php echo $i; ?>" <?php echo($year == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>No. Ponsel 1<span class="red-notif"> * </span></td>
                                        <td>
                                            <input id="hp" name="hp" type="text" class="validate[required,custom[onlyNumberSp]] text" value="<?php echo $guru->guru_hp; ?>"/>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>
                                            <p class="auto-line-height">No. Ponsel 2</p>
                                        </td>
                                        <td>
                                            <input id="hp_2" name="hp_2" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo $guru->guru_hp_2; ?>"/>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>
                                            <p class="auto-line-height">Telepon Rumah</p>
                                        </td>
                                        <td>
                                            <input id="telp_rumah" name="telp_rumah" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo $guru->guru_telp_rumah; ?>"/>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>
                                            <p class="auto-line-height">Telepon Kantor/ Instansi</p>
                                        </td>
                                        <td>
                                            <input id="telp_kantor" name="telp_kantor" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo $guru->guru_telp_kantor; ?>"/>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>
                                            <p class="auto-line-height">Alamat<span class="red-notif"> * </span></p>
                                            <p class="text-11">Data alamat harus sesuai dengan KTP</p>
                                        </td>
                                        <td>
                                            <textarea id="alamat" name="alamat" class="validate[required] text"><?php echo $guru->guru_alamat; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>
                                            <p class="auto-line-height">Alamat Domisili</p>
                                            <p class="text-11">Apabila data alamat tempat tinggal sekarang tidak sesuai dengan KTP</p></td>
                                        <td>
                                            <textarea id="alamat_domisili" name="alamat_domisili" class="text"><?php echo $guru->guru_alamat_domisili; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>Pekerjaan/ Kategori<span class="red-notif"> * </span></td>
                                        <td>
                                            <p>
                                                <select name="kategori">
                                                    <?php foreach ($kategori->result() as $row): ?>
                                                        <option value="<?php echo $row->kategori_id; ?>" <?php echo ($guru->kategori_id == $row->kategori_id) ? 'selected' : ''; ?>><?php echo $row->kategori_title; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>Facebook</td>
                                        <td>
                                            <input id="fb" name="fb" type="text" class="validate[custom[url]] text" value="<?php echo $guru->guru_fb; ?>"/>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>Twitter</td>
                                        <td>
                                            <input id="twitter" name="twitter" type="text" class="text" value="<?php echo $guru->guru_twitter; ?>"/>
                                        </td>
                                    </tr>
                                    <tr height="40px">
                                        <td>
                                            <p class="auto-line-height">Kode <i>Referral</i> (Opsional):</p>
                                            <p class="text-11">Isikan <i>Referral ID</i> Duta Ruangguru Anda</p>
                                        </td>
                                        <td>
                                            <input id="referral" name="referral" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo $guru->guru_referral; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="blank" style="height:20px;"></div>
                                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
				<div class="pgc-section">
                        <div class="header">
                            <span>Metode Belajar</span>
                        </div>
                        <div class="content">
                            <form id="change-metode-form" class="profile-form" action="<?php echo base_url(); ?>profile/metode_submit" method="post">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <p>
                                                Pilih Metode Belajar Anda<br/>
									   <?php $met = $guru->guru_metode;
											   $m = ",".$met;
											   $m1= strpos($m,'1');
											   $m2= strpos($m,'2');
									   ?>
                                                <input type="checkbox" name="metode[]" value="1" <?php echo(!empty($m1)) ? 'checked' : ''; ?>/>Online<br/>
                                                <input type="checkbox" name="metode[]" value="2" <?php echo(!empty($m2)) ? 'checked' : ''; ?>/>Tatap Muka
                                            </p><br/>
								    <p class="text-12">(Mekanisme dan kelengkapan mengajar ditentukan sendiri oleh guru)</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: left">
                                            <div class="blank" style="height: 20px;"></div>
                                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Lokasi Mengajar</span>
                        </div>
                        <div class="content">
                            <form id="change-bio-form" class="profile-form" action="<?php echo base_url(); ?>profile/lokasi_submit" method="post">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <p>
                                                Pilih Lokasi Tempat Anda Mengajar<br/>
									   <?php $n = 0; ?>
                                                <?php foreach ($lokasi_jkt->result() as $row): ?>
									    <?php if(($n%3 == 0)){echo "<span class='inline-block'>"; }?>
                                                        <input type="checkbox" name="lokasi[<?php echo $row->lokasi_id; ?>]" value="<?php echo $row->lokasi_id; ?>" <?php echo(!empty($lokasi[$row->lokasi_id])) ? 'checked' : ''; ?>/><?php echo $row->lokasi_title; ?><br/>
									   <?php $n++;?>
						                  <?php if(($n%3 == 0)){echo "</span>"; }?>
                                                <?php endforeach; ?>
                                                <br/><br/><span class="inline-block rgc">atau pilih kota lain</span>
<!--                                                <select name="lokasi_lain" style="width: 200px;">
                                                    <option value="0">-- Pilih Kota Lain--</option>
                                                    <?php foreach ($lokasi_lain->result() as $row): ?>
                                                        <option value="<?php echo $row->lokasi_id; ?>" <?php echo(!empty($lokasi[$row->lokasi_id])) ? 'selected' : ''; ?>><?php echo $row->lokasi_title; ?></option>
                                                    <?php endforeach; ?>
                                                </select>-->
                                                <table>
                                                    <tr>
                                                        <td><p>Pilih Provinsi</p></td>
                                                        <td>
                                                            <select id="ddProvinsi" name="provinsi" onchange="update_provinsi()">
                                                                <option value="-1" selected>--Pilih Provinsi--</option>
                                                                <?php foreach ($this->guru_model->get_table('provinsi')->result() as $row): ?>
                                                                    <option value="<?php echo $row->provinsi_id; ?>" ><?php echo $row->provinsi_title; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><p>Pilih Kota</p></td>
                                                        <td>
                                                            <select id="lokasi_lainnya" name="lokasi_lain" style="width: 200px;">
                                                                <option value="-1" selected>--Pilih Kota--</option>
                                                                <?php foreach ($lokasi_lain->result() as $row): ?>
                                                                    <option value="<?php echo $row->lokasi_id; ?>" <?php echo(!empty($lokasi[$row->lokasi_id])) ? 'selected' : ''; ?>><?php echo $row->lokasi_title; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align: left">
                                            <div class="blank" style="height: 20px;"></div>
                                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Mata Pelajaran</span>
                        </div>
                        <div class="content">
                            <?php $count = 0; ?>
                            <table class="matpel-list">
                                <?php foreach ($guru->matpel->result() as $item): ?>
                                    <tr>
                                        <td style="min-width: 20px;"><?php echo++$count; ?>. </td>
                                        <td style="min-width: 200px;"><?php echo $item->matpel_title; ?> (<?php echo $item->jenjang_pendidikan_title; ?>)</td>
                                        <td><?php echo number_format($item->guru_matpel_tarif); ?> /1 Jam kursus</td>
                                        <td style="padding-left:20px">
                                            <a href="<?php echo base_url();?>profile/delete_matpel/<?php echo $item->matpel_id;?>" onclick="return confirm('Anda ingin menghapus pelajaran ini?')"><img title="Delete" src="<?php echo base_url();?>images/delete-entry-button.png"/></a>
                                        </td>
                                    </tr>
							 <?php //if(){ ?>
							 <tr>
							 <form id="tarif-form<?php echo $item->matpel_id;?>" method="post" action="<?php echo base_url().'profile/edit_matpel/'.$item->matpel_id;?>">
							     <td style="min-width: 20px;"><input type="hidden" name="id_guru" value="<?php echo $guru->guru_id;?>"></td>
                                        <td style="min-width: 200px;"><input type="hidden" name="id_matpel" value="<?php echo 
											$item->matpel_id;?>"></td>
                                        <td>
											<input type="number" 
												   min="50000"
												   id="harga<?php echo $item->matpel_id?>" 
												   name="harga<?php echo $item->matpel_id?>" 
												   style="border:1px solid #9de9ff;"
												   class="validate[required,custom[onlyNumberSp], min[50000]]">&nbsp;
											<a onclick="document.getElementById('tarif-form<?php echo $item->matpel_id;?>').submit();" 
											   class="diy-btn-mini" 
											   style="cursor:pointer;">
												Simpan
											</a>
										</td>
							 </form>
							 </tr>
                                <?php endforeach; ?>
                            </table>
                            <div class="_blank" style="height: 30px"></div>
                            <form id="tambah-matpel-form" class="profile-form" action="<?php echo base_url();?>profile/add_matpel" method="post">
                                <table>
                                    <tr>
                                        <td>Jenjang Pendidikan <span class="red-notif"> * </span></td>
                                        <td>
                                            <select id="select-jenjang" name="jenjang" onchange="update_matpel()">
                                                <?php foreach($jenjang->result() as $item):?>
                                                <option value="<?php echo $item->jenjang_pendidikan_id;?>"><?php echo $item->jenjang_pendidikan_title;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mata Pelajaran <span class="red-notif"> * </span></td>
                                        <td>
                                            <select id="select-matpel" name="matpel">
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tarif per Jam <span class="red-notif"> * </span></td>
                                        <td>
                                            <input id="tarif-matpel" 
												   name="tarif" 
												   type="number" 
												   min="50000"
												   class="validate[required,custom[onlyNumberSp],min[50000]] text" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="blank" style="height: 20px;"></div>
                                            <input type="image" src="<?php echo base_url(); ?>images/tambah-button.png"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Tentang Saya <span class="red-notif"> * </span></span>
                        </div>
                        <div class="content">
                            <form id="change-personal-form" class="profile-form" action="<?php echo base_url(); ?>profile/personal_submit" method="post">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <p class="info2">
                                                Tuliskan deskripsi terbaik mengenai diri anda mulai dari jejak rekam prestasi akademis,
                                                penghargaan yang pernah diraih, lomba yang pernah diikuti, prestasi di organisasi/komunitas, 
                                                dan pengalaman mengajar karna hal pertama yang akan dilihat oleh murid adalah deskripsi profil Anda disini
                                            </p>
                                            <p class="info2">
                                                Anda akan mendapatkan :
                                                <br/>- Tambahan 1 poin Rating, jika Anda menulis 501-1000 karakter.
                                                <br/>- Tambahan 2 poin Rating jika lebih dari 1000 karakter.
                                                <br/>- Penalti 1 poin Rating, jika Personal Message Anda kosong.
                                            </p>
								    <br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <textarea oninput="update_total_karakter(this,'total-karakter-personal')" id="personal_message" name="personal_message" class="validate[required] text"><?php echo $guru->guru_bio; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <p>
                                                Total karakter: <span id="total-karakter-personal">0</span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="blank" style="height:20px;"></div>
                                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Pengalaman Mengajar</span>
                        </div>
                        <div class="content">
                            <form id="change-personal-form" class="profile-form" action="<?php echo base_url(); ?>profile/pengalaman_submit" method="post">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <p class="info2">
                                                Jelaskan pengalaman mengajar yang anda miliki disini.<br/>
                                            </p>
								    <br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <textarea id="pengalaman-textbox" name="pengalaman"><?php echo $guru->guru_pengalaman; ?></textarea>                            
                                            <div class="_blank" style="height:10px;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="blank" style="height:20px;"></div>
                                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Kualifikasi <span class="red-notif"> * </span></span>
                        </div>
                        <div class="content">
                            <form id="kualifikasi-form" class="profile-form" action="<?php echo base_url(); ?>profile/kualifikasi_submit" method="post">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <p class="info2">
                                                Jelaskan Kualifikasi anda disini. Anda dapat menjelaskan pelatihan atau sertifikat yang anda miliki.<br/>
                                                Untuk mendapatkan rating, Anda bisa mengunggah hasil pindai ijazah, sertifikat dan transkrip Anda di halaman profile Anda nanti.
                                            </p><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <textarea id="kualifikasi-textbox" name="kualifikasi" class="validate[required]"><?php echo $guru->guru_kualifikasi; ?></textarea>                            
                                            <div class="_blank" style="height:10px;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                                            <div class="blank" style="height:20px;"></div>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>    
                    <div class="pgc-section">
                        <div class="header">
                            <span>Sertifikat</span>
                        </div>
                        <div class="content">
                            <form id="sertifikat-form" enctype="multipart/form-data" class="profile-form" action="<?php echo base_url(); ?>profile/sertifikat_submit" method="post">
                                <table>  
                                    <tr>
                                        <td colspan="2">
                                            <p class="info2">
                                                Untuk mendapatkan rating, Anda bisa meng-upload scan sertifikat dan transcript Anda di halaman ini.
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Sertifikat <span class="red-notif"> * </span></td>
                                        <td>
                                            <input id="title" name="title" type="text" class="validate[required] text" />
                                            <div class="_blank" style="height:10px;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Scan Sertifikat</td>
                                        <td>
                                            <p>
                                                <input type="file" name="sertifikat" />
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <p class="text-11">(File gambar JPG atau PNG maks 2MB)</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="image" src="<?php echo base_url(); ?>images/upload-button.png"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Daftar Sertifikat</span>
                        </div>
                        <div class="content">
                            <table style="width: 100%"> 
                                <tr>
                                    <td colspan="2">
                                        <table id="guru-sertifikat-list">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Sertifikat</th>
                                                <th>File</th>
                                                <th>Action</th>
                                            </tr>
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
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>profile/sertifikat_delete/<?php echo $row->guru_sertifikat_id; ?>" >Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Jadwal Ketersediaan Mengajar <span class="red-notif"> * </span></span>
                        </div>
                        <div class="content">
                            <form id="jadwal-tarif-form" class="profile-form" action="<?php echo base_url(); ?>profile/jadwal_submit" method="post">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <p class="info2">
                                                Pilih preferensi waktu mengajar yang Anda dengan meng-klik tabel dibawah. <br/>
                                                Warna jingga berarti Anda bersedia untuk mengajar murid pada jam tersebut. <br/>
                                                Pastikan informasi ini seakurat mungkin, karena murid akan menyesuaikan dengan waktu mengajar Anda.
                                            </p><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table id="jadwal-guru-table-form">
                                                <tr>
                                                    <th style="width: 45px;">Jam</th>
                                                    <?php foreach ($days as $value): ?>
                                                        <th>
                                                            <?php echo $value; ?>
                                                        </th>
                                                    <?php endforeach; ?>
                                                </tr>
                                                <?php for ($i = 7; $i < 24; $i++): ?>
                                                    <tr>
                                                        <th><?php echo sprintf('%02s', $i); ?>:00</th>
                                                        <?php for ($j = 0; $j < 7; $j++): ?>
                                                            <?php $hour = (array_key_exists($j, $guru->jadwal) ? $guru->jadwal[$j] : array()); ?>
                                                            <td onclick="jadwal_box_click(this)" class="<?php echo (array_key_exists($i, $hour) ? 'selected' : ''); ?>">
                                                                <input class="jadwal-checkbox none" type="checkbox" name="jadwal[<?php echo $j; ?>][<?php echo $i; ?>]" <?php echo (array_key_exists($i, $hour) ? 'checked' : ''); ?>/>
                                                            </td>
                                                        <?php endfor; ?>
                                                    </tr>
                                                <?php endfor; ?>
                                            </table>
                                            <div class="_blank" style="height: 10px;"></div>
                                            <p class="jadwal-guru-info"><img src="<?php echo base_url();?>images/jadwal-available-icon.png" alt="biru"/> Tersedia </p>
                                            <p class="jadwal-guru-info"><img src="<?php echo base_url();?>images/jadwal-notavailable-icon.png" alt="abu-abu"/> Tidak Tersedia </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="blank" style="height:20px;"></div>
                                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                           <div class="fright"><span class="red-notif"> * </span><span class="text-13">Wajib diisi</span></div>
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