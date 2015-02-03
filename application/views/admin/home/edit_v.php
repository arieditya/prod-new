<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css">
<script type="text/javascript">
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
	$("#date").datepicker({ dateFormat: "yy-mm-dd" });
});
</script>
<!-- Message Error -->
<?php if ($this->session->flashdata('f_home')): ?>
    <div class="msg msg-ok boxwidth">
        <p><strong><?php echo $this->session->flashdata('f_home'); ?></strong></p>
    </div>
<?php endif; ?>

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Edit Request Guru</h2>
    </div>
    <!-- End Box Head -->

    <form action="<?php echo base_url();?>admin/home/edit_request_guru_submit" method="post" >

        <!-- Form -->
        <div class="form">
            <p>
                <label>Title</label>
                <input type="text" class="field size1" name="title" value="<?php echo $request_guru->request_guru_home_title;?>"/>
                <input type="hidden" name="id" value="<?php echo $request_guru->request_guru_home_id;?>"/>
            </p>
            <p class="inline-field">
                <label>Provinsi</label>
                <select class="field size1" name="provinsi" id="ddProvinsi" onchange="update_provinsi()">
                    <option value="-1" selected>--Pilih Provinsi--</option>
                    <?php foreach($provinsi->result() as $row):?>
                    <option value="<?php echo $row->provinsi_id;?>"><?php echo $row->provinsi_title;?></option>
                    <?php endforeach;?>
                </select>
            </p>
            <p class="inline-field">
                <label>Kota/Lokasi</label>
                <select class="field size1" name="lokasi" id="ddLokasi">
                    <?php foreach($lokasi->result() as $row):?>
                    <option value="<?php echo $row->lokasi_id;?>" <?php echo ($row->lokasi_id==$request_guru->lokasi_id)?'selected':''; ?>><?php echo $row->lokasi_title;?></option>
                    <?php endforeach;?>
                </select>
            </p>
            <p>
                <label>Text</label>
                <textarea class="field size1" rows="10" cols="30" name="text"><?php echo $request_guru->request_guru_home_text;?></textarea>
            </p>
		  <p>
                <label>Tanggal</label>
                <input type="text" class="field size1" name="date" id="date" value="<?php echo $request_guru->request_guru_home_date;?>"/>
            </p>
        </div>
        <!-- End Form -->
        
        <!-- Form Buttons -->
        <div class="buttons">
            <input type="submit" class="button" value="submit" />
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
<!-- End Box -->