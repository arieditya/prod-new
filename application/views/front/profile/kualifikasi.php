<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $("#kualifikasi-form").validationEngine('attach');
    $("#sertifikat-form").validationEngine('attach');
});
</script>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="kualifikasi-guru" class="profile-guru-wrap">
            <div id="kualifikasi-guru-header" class="profile-guru-header">
                <div id="kualifikasi-guru-header-wrap" class="profile-guru-header-wrap">
                    EDIT KUALIFIKASI
                </div>
            </div>
            <div id="kualifikasi-guru-content" class="guru-content profile-guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('kualifikasi_notif')):?>
                <div class="guru-notif">
                    <?php echo $this->session->flashdata('kualifikasi_notif');?>
                </div>
                <?php endif;?>
                <form id="kualifikasi-form" class="guru-form" action="<?php echo base_url(); ?>profile/kualifikasi_submit" method="post">
                    <table>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    KUALIFIKASI SAYA
                                </div>
                                <div class="_blank" style="height:10px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="info2">
                                    Jelaskan Kualifikasi anda disini. Anda dapat menjelaskan pelatihan atau sertifikat yang anda miliki.<br/>
                                    Untuk mendapatkan rating, Anda bisa meng-upload scan sertifikat dan transcript Anda di halaman profile Anda nanti.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="kualifikasi-textbox" name="kualifikasi"><?php echo (!empty($guru->guru_kualifikasi))?$guru->guru_kualifikasi:$default_text;?></textarea>                            
                                <div class="_blank" style="height:10px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="image" src="<?php echo base_url();?>images/edit-kualifikasi.png"/>
                                <div class="blank" style="height:20px;"></div>
                            </td>
                        </tr>
                    </table>
                </form>
                <form id="sertifikat-form" enctype="multipart/form-data" class="guru-form" action="<?php echo base_url(); ?>profile/sertifikat_submit" method="post">
                    <table>  
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    UPLOAD SERTIFIKAT
                                </div>
                                <div class="_blank" style="height:10px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="info2">
                                    Untuk mendapatkan rating, Anda bisa meng-upload scan sertifikat dan transcript Anda di halaman ini.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Sertifikat: </td>
                            <td>
                                <input id="title" name="title" type="text" class="validate[required] text" />
                                <div class="_blank" style="height:10px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Scan Sertifikat: </td>
                            <td>
                                <p>
                                    <input type="file" name="sertifikat" />
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <p class="info">(File gambar JPG atau PNG maks 2MB)</p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="image" src="<?php echo base_url();?>images/upload.png"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    DAFTAR SERTIFIKAT
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table id="guru-sertifikat-list">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sertifikat</th>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $i = 1;?>
                                    <?php foreach($sertifikat->result() as $row):?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td>
                                            <?php echo $row->guru_sertifikat_title;?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url().'files/sertifikat/'.$row->guru_sertifikat_file;?>" target="_blank">Open</a>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url();?>profile/sertifikat_delete/<?php echo $row->guru_sertifikat_id;?>" >Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="blank" style="height: 20px;"></div>
            </div>
        </div>
        <?php $this->load->view('front/profile/template/menu');?>
        <div class="blank" style="height: 30px;"></div>
    </div>
</div>