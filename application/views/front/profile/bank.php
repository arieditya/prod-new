<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/profile/bank" />
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $("#bank-form").validationEngine('attach');
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
                    REKENING BANK
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <?php if ($this->session->flashdata('edit_profile_notif')): ?>
                        <div class="profile-notif">
                            <?php echo $this->session->flashdata('edit_profile_notif'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="pgc-section">
                        <p class="no-margin text-13">Rekening Bank yang terdaftar di akun Ruangguru Anda saat ini adalah:</p>
                    </div>
                    <div class="pgc-section">
                        <?php if(!empty($guru->bank_id)):?>
                        <div class="header center bold">
                            <span><?php echo $guru->bank_title;?></span>
                        </div>
                        <div class="header center">
                            <span><?php echo $guru->guru_bank_rekening;?> - <?php echo $guru->guru_bank_pemilik;?></span>
                        </div>
                        <?php else:?>
                        <div class="header center bold">
                            <span>Belum ada no. rekening yang terdaftar</span>
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="pgc-section">
                        <div class="content">
                            <p>Gunakan form di bawah ini untuk mendaftarkan atau mengubah informasi rekening Bank Anda.</p>
                            <form id="bank-form" class="profile-form" action="<?php echo base_url(); ?>profile/bank_submit" method="post">
                                <table cellpadding="5">
                                    <tr>
                                        <td>Bank</td>
                                        <td>
                                            <select name="bank">
                                                <?php foreach($bank->result() as $row):?>
                                                <option value="<?php echo $row->bank_id;?>"><?php echo $row->bank_title;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nomor Rekening Baru</td>
                                        <td>
                                            <input id="norek" name="rekening" type="text" class="validate[required,custom[onlyNumberSp]] text" value=""/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pemilik Rekening</td>
                                        <td>
                                            <input id="atasnama" name="pemilik" type="text" class="validate[required] text" value=""/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Password Akun Ruangguru</td>
                                        <td>
                                            <input id="password" name="password" type="password" class="validate[required] text" value=""/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="_blank" style="height: 20px;"></div>
                                            <span class="text-11">
                                                *Jangan khawatir, kerahasiaan data rekening Anda aman bersama kami.
                                            </span>
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
                </div>
                <div class="clear" ></div>
                
            </div>
            <div class="blank" style="height:10px;"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</body>
</html>