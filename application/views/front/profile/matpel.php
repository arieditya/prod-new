<script>
function cu(){
    val = $('#universitas').val();
    $('#univ-wrap').load(base_url+"profile/getuniv/"+val);
}
</script>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="matpel-guru">
            <div id="matpel-guru-header">
                <div id="matpel-guru-header-wrap">
                    EDIT PREFERENSI MATA PELAJARAN
                </div>
            </div>
            <div id="matpel-guru-content" class="guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('matpel_notif')):?>
                <div class="guru-notif">
                    <?php echo $this->session->flashdata('matpel_notif');?>
                </div>
                <?php endif;?>
                <form id="change-bio-form" class="guru-form" action="<?php echo base_url(); ?>profile/matpel_submit" method="post">
                    <table>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    PREFERENSI MATA PELAJARAN
                                </div>
                            </td>
                        </tr>
                        <?php foreach($jenjang->result() as $type):?>
                        <tr>
                            <td colspan="2">
                                <p class="rgm"><?php echo $type->jenjang_pendidikan_title;?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>
                                <?php foreach ($this->guru_model->get_matpel($type->jenjang_pendidikan_id)->result() as $row): ?>
                                    <span class="inline-block rgc">
                                        <input type="checkbox" name="matpel[<?php echo $row->matpel_id; ?>]" value="<?php echo $row->matpel_id; ?>" <?php echo(!empty($matpel[$row->matpel_id]))?'checked':'';?>/><?php echo $row->matpel_title; ?>
                                    </span>    
                                <?php endforeach; ?>
                                </p>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="2" style="text-align: center">
                                <div class="blank" style="height: 20px;"></div>
                                <input type="image" src="<?php echo base_url();?>images/submit-button.png"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="blank" style="height: 20px;"></div>
            </div>
        </div>
        <div class="blank" style="height: 30px;"></div>
    </div>
</div>