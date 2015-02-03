<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $("#biodata-dutaguru-form").validationEngine('attach');
    $("#change-password-form").validationEngine('attach');
}); 
</script>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru">
        <div id="profile-guru-header">
            <div id="profile-guru-header-wrap">
                AKUN SAYA
            </div>
        </div>
        <div id="profile-guru-content">
            <?php if ($this->session->flashdata('guru_notification')): ?>
                <div class="blank" style="height:20px;"></div>
                <div class="request-notif profile-guru-notif">
                    <p class="red-notif">
                        <?php echo $this->session->flashdata('guru_notification'); ?>
                    </p>
                </div>
            <?php endif; ?>
            <div id="pgc-wrap">
                <div id="pgc-left">
                    <div class="pgcw-header">
                        <p>FOTO PROFIL</p>
                    </div>
                    <div class="blank" style="height:30px;"></div>
                    <div class="pgcw-content">
                        <div class="profile-image">
                            <?php if (!file_exists("./images/dutaguru/pp/{$duta_guru->duta_guru_id}.jpg")): ?>
                                <img src="<?php echo base_url(); ?>images/default_profile_image.png"/>
                            <?php else : ?>
                                <img src="<?php echo base_url(); ?>images/dutaguru/pp/<?php echo $duta_guru->duta_guru_id; ?>.jpg"/>
                            <?php endif; ?>
                        </div>
                        <div class="profile-image-change">
                            <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>duta_guru/submit_profpic">
                                <p>Ganti foto:</p>
                                <p>
                                    <input type="file" name="profpic" />
                                </p>
                                <p class="info">(File gambar JPG atau PNG maks 2MB)</p>
                                <p>
                                    <input type="image" src="<?php echo base_url(); ?>images/ganti-foto.png"/>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="pgc-right">
                    <div class="pgcw-header">
                        <p>PROFIL DUTA GURU</p>
                    </div>
                    <div class="blank" style="height:30px;"></div>
                    <div class="pgcw-content">
                        <form id="change-password-form" class="guru-form" action="<?php echo base_url(); ?>duta_guru/pass_submit" method="post">
                            <table>
                                <tr>
                                    <td style="width: 180px;">Email: </td>
                                    <td>
                                        <p class="bold"><?php echo $duta_guru->duta_guru_email; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Password Lama: </td>
                                    <td>
                                        <input id="passold" name="oldpass" type="password" class="validate[required,minSize[6]] text" value=""/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Password Baru: </td>
                                    <td>
                                        <input id="passnew" name="pass" type="password" class="validate[required,minSize[6]] text" value=""/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ulangi Password Baru: </td>
                                    <td>
                                        <input id="confpass" name="confpass" type="password" class="validate[required,equals[passnew]] text" value=""/>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="blank" style="height:20px;"></div>
                                        <input type="image" src="<?php echo base_url(); ?>images/edit-password.png"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <form id="biodata-dutaguru-form" class="guru-form" action="<?php echo base_url(); ?>duta_guru/biodata_submit" method="post">
                            <table>
                                <tr>
                                    <td colspan="2">
                                        <div class="registrasi-guru-st">
                                            BIODATA DIRI
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 180px;">Nama : </td>
                                    <td>
                                        <input id="nama" name="nama" type="text" class="validate[required,custom[onlyLetterSp]] text" value="<?php echo $duta_guru->duta_guru_nama; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat : </td>
                                    <td>
                                        <textarea id="alamat" name="alamat" class="validate[required] text"><?php echo $duta_guru->duta_guru_alamat; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kota : </td>
                                    <td>
                                        <p>
                                            <select name="kota">
                                                <?php foreach ($kota->result() as $row): ?>
                                                    <option value="<?php echo $row->lokasi_id; ?>" <?php echo ($duta_guru->duta_guru_kota==$row->lokasi_id)?"selected":""; ?>><?php echo $row->lokasi_title; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="auto-line-height">No Handphone : </p>
                                        <p class="info auto-line-height">Contoh : 08120987602</p></td>
                                    <td>
                                        <input id="hp" name="hp" type="text" class="validate[required,custom[onlyNumberSp]] text" value="<?php echo $duta_guru->duta_guru_hp; ?>"/>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin : </td>
                                    <td>
                                        <p>
                                            <span class="inline-block"><input id="radio1" type="radio" name="gender" value="1" <?php echo($duta_guru->duta_guru_gender == 1) ? 'checked' : ''; ?>/>Pria</span>
                                            <span class="inline-block"><input id="radio2" type="radio" name="gender" value="2" <?php echo($duta_guru->duta_guru_gender == 2) ? 'checked' : ''; ?>/>Wanita</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tempat Lahir : </td>
                                    <td>
                                        <input id="tempatlahir" name="tempatlahir" type="text" class="validate[required,custom[onlyLetterSpecial]] text" value="<?php echo $duta_guru->duta_guru_tempatlahir; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir : </td>
                                    <td>
                                        <p>
                                            <?php
                                            $day = intval(date("j", strtotime($duta_guru->duta_guru_lahir)));
                                            $month = intval(date("n", strtotime($duta_guru->duta_guru_lahir)));
                                            $year = intval(date("Y", strtotime($duta_guru->duta_guru_lahir)));
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
                                                <?php for ($i = 1970; $i <= (date("Y") - 15); $i++): ?>
                                                    <option value="<?php echo $i; ?>" <?php echo($year == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="blank" style="height:20px;"></div>
                                        <input type="image" src="<?php echo base_url(); ?>images/edit-biodata.png"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="_blank" style="height: 30px;"></div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="blank" style="height:10px;"></div>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>