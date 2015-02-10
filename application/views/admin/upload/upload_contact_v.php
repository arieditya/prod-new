<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/9/15
 * Time: 7:15 AM
 * Proj: prod-new
 */
if ($this->session->flashdata('edit_profile_notif')): ?>
	<div class="msg msg-ok boxwidth">
		<p><strong><?php echo $this->session->flashdata('f_class'); ?></strong></p>
	</div>
<?php endif; ?>
<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Upload data</h2>
    </div>
    <!-- End Box Head -->

    <form id="add-kelas" action="<?php echo base_url();?>admin/upload/send_all" method="post" enctype="multipart/form-data">

        <!-- Form -->
        <div class="form">
            <p>
                <label>Upload data</label>
                <input id="data_email" type="file" class="field size1" name="data_email"/>
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