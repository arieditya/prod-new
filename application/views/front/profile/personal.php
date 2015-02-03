<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/profile.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $("#change-personal-form").validationEngine('attach');
    update_total_karakter($('#personal_message'),'total-karakter-personal');
}); 
</script>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="personal-guru" class="profile-guru-wrap">
            <div id="personal-guru-header" class="profile-guru-header">
                <div id="personal-guru-header-wrap" class="profile-guru-header-wrap">
                    EDIT PERSONAL MESSAGE
                </div>
            </div>
            <div id="personal-guru-content" class="guru-content profile-guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('personal_notif')):?>
                <div class="guru-notif">
                    <?php echo $this->session->flashdata('personal_notif');?>
                </div>
                <?php endif;?>
                <form id="change-personal-form" class="guru-form" action="<?php echo base_url(); ?>profile/personal_submit" method="post">
                    <table>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    PERSONAL MESSAGE :
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="info2">
                                    Anda akan mendapatkan :
                                    <br/>- Tambahan 1 poin Rating, jika Anda menulis 501-1000 karakter.
                                    <br/>- Tambahan 2 poin Rating jika lebih dari 1000 karakter.
                                    <br/>- Tenalti 1 poin Rating, jika Personal Message Anda kosong.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea oninput="update_total_karakter(this,'total-karakter-personal')" id="personal_message" name="personal_message" class="validate[required] text"><?php echo $guru->guru_bio;?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>
                                    Total karakter : <span id="total-karakter-personal">0</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="blank" style="height:20px;"></div>
                                <input type="image" src="<?php echo base_url();?>images/edit-personal-message.png"/>
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