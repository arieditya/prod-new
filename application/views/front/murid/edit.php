<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/murid/edit" />
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/profile.js" type="text/javascript" charset="utf-8"></script>
<script>
function update_provinsi(){
    id=$("#ddProvinsi").val();
    $.getJSON(base_url+"service/get_lokasi/"+id,function(data){
        html = '';
        $.each(data,function(i,item){
            html+= '<option value="'+item.lokasi_id+'">'+item.lokasi_title+'</option>';
        });
        $("#ddLokasi").html(html);
    })
}
$(document).ready(function(){
    $("#change-password-form").validationEngine('attach');
    $("#change-bio-form").validationEngine('attach');
});
</script>
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-murid-header" class="profile-guru-header">
                <div id="profile-murid-header-wrap">
                    EDIT PROFIL MURID
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="blank" style="height: 20px;"></div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Foto Profil</span>
                        </div>
                        <div class="content">
                            <div class="pgcw-content">
                                <div class="profile-image">
                                    <?php if (!file_exists("./images/murid/pp/{$murid->murid_id}.jpg")): ?>
                                        <img src="<?php echo base_url(); ?>images/default_profile_image.png"/>
                                    <?php else : ?>
                                        <img src="<?php echo base_url(); ?>images/murid/pp/<?php echo $murid->murid_id; ?>.jpg"/>
                                    <?php endif; ?>
                                </div>
                                <div class="profile-image-change">
                                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>murid/submit_profpic">
                                        <p>Ganti foto</p>
                                        <p>
                                            <input type="file" name="profpic" />
                                        </p>
                                        <p class="text-11">(File gambar JPG atau PNG maksimum berukuran 2MB)</p>
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
                            <span>Password Akun</span>
                        </div>
                        <div class="content">
                            <form id="change-password-form" class="profile-form" action="<?php echo base_url(); ?>murid/pass_submit" method="post">
                                <table>
                                    <tr>
                                        <td style="width: 180px;">Email<span class="red-notif"> *</span></td>
                                        <td>
                                            <p class="bold"><?php echo $murid->murid_email; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Password Lama<span class="red-notif"> *</span></td>
                                        <td>
                                            <input id="passold" name="oldpass" type="password" class="validate[required,minSize[6]] text" value=""/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Password Baru<span class="red-notif"> *</span></td>
                                        <td>
                                            <input id="passnew" name="pass" type="password" class="validate[required,minSize[6]] text" value=""/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ulangi Password Baru<span class="red-notif"> *</span></td>
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
                            <form id="change-bio-form" enctype="multipart/form-data" class="profile-form" action="<?php echo base_url(); ?>murid/biodata_submit" method="post">
                                <table>
                                    <tr>
                                        <td style="width: 180px;">Nama<span class="red-notif"> *</span></td>
                                        <td>
                                            <input id="nama" name="nama" type="text" class="validate[required,custom[onlyLetterSp]] text" value="<?php echo $murid->murid_nama; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="auto-line-height">No. KTP/ KTM/ SIM/ Paspor<span class="red-notif"> *</span></p>
                                            <p class="text-11">Apabila berumur kurang dari 17 tahun, Anda dapat menggunakan KTP orang tua Anda.</p>
                                        </td>
                                        <td>
                                            <input id="nik" name="nik" type="text" class="validate[required] text" value="<?php echo $murid->murid_nik;?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>    
                                            <p class="auto-line-height">Alamat<span class="red-notif"> *</span></p>
                                            <p class="text-11">Data alamat harus sesuai dengan KTP</p>
                                        </td>
                                        <td>
                                            <textarea id="alamat" name="alamat" class="validate[required] text"><?php echo $murid->murid_alamat; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="auto-line-height">Alamat Domisili</p>
                                            <p class="text-11">Apabila data alamat tempat tinggal sekarang tidak sesuai dengan KTP</p></td>
                                        <td>
                                            <textarea id="alamat_domisili" name="alamat_domisili" class="text"><?php echo $murid->murid_alamat_domisili; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Provinsi<span class="red-notif"> *</span></td>
                                        <td>
                                            <p>
                                                <select id="ddProvinsi" name="provinsi" onchange="update_provinsi()">
									   	  <?php $prov = $this->murid_model->get_province_murid_by_lokasi_id($murid->murid_kota); ?>
                                                    <option value="-1" <?php if($provinsi->num_rows == 0){ echo "selected";} ?>>--Pilih Provinsi--</option>
                                                    <option value="1" <?php if($prov->provinsi_id == 1){ echo "selected";} ?>>DKI Jakarta</option>
                                                    <?php foreach ($provinsi->result() as $row): ?>
										  <?php if($row->provinsi_id != 1){?>
                                                        <option value="<?php echo $row->provinsi_id; ?>" <?php if($row->provinsi_id == $prov->provinsi_id){ echo "selected";} ?>><?php echo $row->provinsi_title; ?></option>
										  <?php } ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kota<span class="red-notif"> *</span></td>
                                        <td>
                                            <p>
                                                <select id="ddLokasi" name="kota">
                                                    <?php foreach ($kota->result() as $row): ?>
                                                        <option value="<?php echo $row->lokasi_id; ?>" <?php echo ($row->lokasi_id==$murid->lokasi_id)?'selected':''; ?>><?php echo $row->lokasi_title; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin<span class="red-notif"> *</span></td>
                                        <td>
                                            <p>
                                                <span class="inline-block"><input id="radio1" type="radio" name="gender" value="1" <?php echo($murid->murid_gender == 1) ? 'checked' : ''; ?>/>Laki-laki</span>
                                                <span class="inline-block"><input id="radio2" type="radio" name="gender" value="2" <?php echo($murid->murid_gender == 2) ? 'checked' : ''; ?>/>Perempuan</span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Lahir<span class="red-notif"> *</span></td>
                                        <td>
                                            <input id="tempatlahir" name="tempatlahir" type="text" class="validate[required,custom[onlyLetterSpecial]] text" value="<?php echo (!empty($murid->murid_tempatlahir)) ? $murid->murid_tempatlahir : ''; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir<span class="red-notif"> *</span></td>
                                        <td>
                                            <p>
                                                <?php
                                                $day = intval(date("j", strtotime($murid->murid_lahir)));
                                                $month = intval(date("n", strtotime($murid->murid_lahir)));
                                                $year = intval(date("Y", strtotime($murid->murid_lahir)));
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
                                                    <?php for ($i = 1970; $i <= (date("Y")); $i++): ?>
                                                        <option value="<?php echo $i; ?>" <?php echo($year == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="auto-line-height"><i>Referral Code</i> (Opsional):</p>
                                            <p class="text-11">Isikan Referral ID Duta Ruangguru Anda</p>
                                        </td>
                                        <td>
                                            <input id="referral" name="referral" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo $murid->murid_referral; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>No. Ponsel 1<span class="red-notif"> *</span></td>
                                        <td>
                                            <input id="hp" name="hp" type="text" class="validate[required,custom[onlyNumberSp]] text" value="<?php echo $murid->murid_hp; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="auto-line-height">No. Ponsel 2</p>
                                        </td>
                                        <td>
                                            <input id="hp_2" name="hp_2" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo $murid->murid_hp_2; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="auto-line-height">Telepon Rumah</p>
                                        </td>
                                        <td>
                                            <input id="telp_rumah" name="telp_rumah" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo $murid->murid_telp_rumah; ?>"/>
                                        </td>
                                    </tr>
							 <tr>
                                        <td>
                                            <p class="auto-line-height">Sekolah/ Universitas/ Instansi</p>
                                        </td>
                                        <td>
                                            <input id="telp_kantor" name="telp_kantor" type="text" class="validate[custom[onlyLetterSpecial]] text" value="<?php echo $murid->murid_instansi; ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="auto-line-height">Telepon Kantor/ Instansi</p>
                                        </td>
                                        <td>
                                            <input id="telp_kantor" name="telp_kantor" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo $murid->murid_telp_kantor; ?>"/>
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
					   <div class="fright"><span class="red-notif">* </span>Wajib diisi</div>
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