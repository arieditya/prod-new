<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/daftarguru.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $("#change-password-form").validationEngine('attach');
    $("#change-bio-form").validationEngine('attach');
});
</script>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="biodata-guru">
            <div id="biodata-guru-header">
                <div id="biodata-guru-header-wrap">
                    EDIT BIODATA
                </div>
            </div>
            <div id="biodata-guru-content" class="guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('biodata_notif')):?>
                <div class="guru-notif">
                    <?php echo $this->session->flashdata('biodata_notif');?>
                </div>
                <?php endif;?>
                <form id="change-password-form" class="guru-form" action="<?php echo base_url(); ?>profile/pass_submit" method="post">
                    <table>
                        <tr>
                            <td style="width: 180px;">Email: </td>
                            <td>
                                <p class="bold"><?php echo $guru->guru_email;?></p>
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
                                <input type="image" src="<?php echo base_url();?>images/edit-password.png"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <form id="change-bio-form" enctype="multipart/form-data" class="guru-form" action="<?php echo base_url(); ?>profile/biodata_submit" method="post">
                    <table>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    DATA DIRI
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 180px;">Nama: </td>
                            <td>
                                <input id="nama" name="nama" type="text" class="validate[required,custom[onlyLetterSp]] text" value="<?php echo $guru->guru_nama;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>No ID: </span><br/>
                                <span class="info">(KTP/Pasport)</span>
                            </td>
                            <td>
                                <?php echo $guru->guru_nik;?>
                            </td>
                        </tr>
                        <?php if(!empty($guru->guru_nik_image)):?>
                        <tr>
                            <td></td>
                            <td>
                                <img id="guru-nik-img" src="<?php echo base_url();?>images/nik/<?php echo $guru->guru_nik_image;?>" alt="nik"/>
                            </td>
                        </tr>
                        <?php endif;?>
                        <tr>
                            <td>Upload Scan ID:</td>
                            <td>
                                <p><input type="file" name="nik_image" class="file" /></p>
                                <p class="info">(File gambar JPG atau PNG maks 2MB)</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin: </td>
                            <td>
                                <p>
                                    <span class="inline-block"><input id="radio1" type="radio" name="gender" value="1" <?php echo($guru->guru_gender==1)?'checked':'';?>/>Pria</span>
                                    <span class="inline-block"><input id="radio2" type="radio" name="gender" value="2" <?php echo($guru->guru_gender==2)?'checked':'';?>/>Wanita</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir: </td>
                            <td>
                                <input id="tempatlahir" name="tempatlahir" type="text" class="validate[required,custom[onlyLetterSpecial]] text" value="<?php echo (!empty($guru->guru_tempatlahir))?$guru->guru_tempatlahir:'';?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir: </td>
                            <td>
                                <p>
                                    <?php 
                                    $day = intval(date("j", strtotime($guru->guru_lahir)));
                                    $month = intval(date("n", strtotime($guru->guru_lahir)));
                                    $year = intval(date("Y", strtotime($guru->guru_lahir)));
                                    ?>
                                    <select name="tanggal">
                                        <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?php echo $i; ?>" <?php echo($day==$i)?'selected':'';?>><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <select name="bulan">
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                            <?php $months = array(1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'); ?>
                                            <option value="<?php echo $i; ?>" <?php echo($month==$i)?'selected':'';?>><?php echo $months[$i]; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <select name="tahun">
                                        <?php for ($i = 1970; $i <= (date("Y") - 15); $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php echo($year==$i)?'selected':'';?>><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>No. Ponsel 1: </td>
                            <td>
                                <input id="hp" name="hp" type="text" class="validate[required,custom[onlyNumberSp]] text" value="<?php echo $guru->guru_hp;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">No. Ponsel 2: </p>
                            </td>
                            <td>
                                <input id="hp_2" name="hp_2" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo $guru->guru_hp_2;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">Telepon Rumah: </p>
                            </td>
                            <td>
                                <input id="telp_rumah" name="telp_rumah" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo $guru->guru_telp_rumah;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">Telepon Kantor/Instansi: </p>
                            </td>
                            <td>
                                <input id="telp_kantor" name="telp_kantor" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo $guru->guru_telp_kantor;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">Alamat :</p>
                                <p class="info auto-line-height">Data alamat harus sesuai dengan KTP</p>
                            </td>
                            <td>
                                <textarea id="alamat" name="alamat" class="validate[required] text"><?php echo $guru->guru_alamat;?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">Alamat Domisili:</p>
                                <p class="info auto-line-height">Apabila data alamat tempat tinggal sekarang tidak sesuai dengan KTP</p></td>
                            <td>
                                <textarea id="alamat_domisili" name="alamat_domisili" class="text"><?php echo $guru->guru_alamat_domisili;?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Pekerjaan/Kategori: </td>
                            <td>
                                <p>
                                    <select name="kategori">
                                        <?php foreach ($kategori->result() as $row): ?>
                                            <option value="<?php echo $row->kategori_id; ?>" <?php echo ($guru->kategori_id==$row->kategori_id)?'selected':'';?>><?php echo $row->kategori_title; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>Facebook</td>
                            <td>
                                <input id="fb" name="fb" type="text" class="validate[custom[url]] text" value="<?php echo $guru->guru_fb;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Twitter</td>
                            <td>
                                <input id="twitter" name="twitter" type="text" class="validate[custom[url]] text" value="<?php echo $guru->guru_twitter;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="blank" style="height:20px;"></div>
                                <input type="image" src="<?php echo base_url();?>images/edit-biodata.png"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="blank" style="height: 20px;"></div>
            </div>
        </div>
        <?php $this->load->view('front/profile/template/menu');?>
        <div class="blank" style="height: 30px"></div>
    </div>
</div>