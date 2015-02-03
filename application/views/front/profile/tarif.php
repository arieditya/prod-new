<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $("#change-tarif-form").validationEngine('attach');
});
</script>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="tarif-guru" class="profile-guru-wrap">
            <div id="tarif-guru-header" class="profile-guru-header">
                <div id="tarif-guru-header-wrap" class="profile-guru-header-wrap">
                    EDIT TARIF
                </div>
            </div>
            <div id="tarif-guru-content" class="guru-content profile-guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('tarif_notif')):?>
                <div class="guru-notif">
                    <?php echo $this->session->flashdata('tarif_notif');?>
                </div>
                <?php endif;?>
                <form id="change-tarif-form" class="guru-form" action="<?php echo base_url(); ?>profile/tarif_submit" method="post">
                    <table>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    TARIF
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="info2">
                                    Masukkan tarif anda untuk setiap mata pelajaran yang anda ajar. <br/>
                                    Minimum tarif yang dapat anda masukkan adalah Rp 50000
                                </p>
                            </td>
                        </tr>
                        <?php foreach($matpel as $item):?>
                        <tr>
                            <td><?php echo $item->matpel_title;?> (<?php echo $item->jenjang_pendidikan_title;?>) : </td>
                            <td>
                                <input id="tarif<?php echo $item->matpel_id;?>" name="tarif[<?php echo $item->matpel_id; ?>]" type="text" class="validate[required,custom[onlyNumberSp],min[50000]] text" value="<?php echo $item->guru_matpel_tarif;?>"/> <span> Rupiah/Jam</span>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        <tr>
                            <td></td>
                            <td>
                                <div class="blank" style="height:20px;"></div>
                                <input type="image" src="<?php echo base_url();?>images/edit-tarif.png"/>
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