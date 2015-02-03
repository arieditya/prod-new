<script>
function cu(){
    val = $('#universitas').val();
    $('#univ-wrap').load(base_url+"profile/getuniv/"+val);
}
</script>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="lokasi-guru">
            <div id="lokasi-guru-header">
                <div id="lokasi-guru-header-wrap">
                    EDIT PREFERENSI LOKASI MENGAJAR
                </div>
            </div>
            <div id="lokasi-guru-content" class="guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('lokasi_notif')):?>
                <div class="guru-notif">
                    <?php echo $this->session->flashdata('lokasi_notif');?>
                </div>
                <?php endif;?>
                <form id="change-bio-form" class="guru-form" action="<?php echo base_url(); ?>profile/lokasi_submit" method="post">
                    <table>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    PREFERENSI LOKASI
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>
                                    Pilih Lokasi Tempat Anda Mengajar<br/>
                                <?php foreach ($lokasi_jkt->result() as $row): ?>
                                    <span class="inline-block rgc">
                                        <input type="checkbox" name="lokasi[<?php echo $row->lokasi_id; ?>]" value="<?php echo $row->lokasi_id; ?>" <?php echo(!empty($lokasi[$row->lokasi_id]))?'checked':'';?>/><?php echo $row->lokasi_title; ?>
                                    </span>    
                                <?php endforeach; ?>
                                <br/><span class="inline-block rgc">atau pilih kota lain :</span>
                                <select name="lokasi_lain" style="width: 200px;">
                                    <option value="0">-- Pilih Kota Lain--</option>
                                    <?php foreach ($lokasi_lain->result() as $row): ?>
                                        <option value="<?php echo $row->lokasi_id; ?>" <?php echo(!empty($lokasi[$row->lokasi_id]))?'selected':'';?>><?php echo $row->lokasi_title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                </p>
                            </td>
                        </tr>
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
        <?php $this->load->view('front/profile/template/menu');?>
        <div class="blank" style="height: 30px;"></div>
    </div>
</div>