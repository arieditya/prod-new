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
        <h2 class="left">+ <a href="<?php echo base_url();?>admin/home/add_guru_unggulan" class="top_box_link">Add Guru Unggulan</a></h2>
    </div>
    <!-- End Box Head -->
    <div class="table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th class="center">ID Guru Unggulan</th>
                <th>Nama Guru</th>
                <th width="300">Prestasi Guru</th>
                <th width="110" class="ac">Control</th>
            </tr>
            <?php $i=0;?>
            <?php foreach($guru_unggulan->result() as $row):?>
            <tr <?php echo (($i++%2)!=0)?'class="odd"':'';?>>
                <td class="center"><?php echo $i;?></td>
                <td><?php echo $row->nama_guru_unggulan;?></td>
                <td><?php echo substr($row->prestasi_guru_unggulan, 0, 110);?> ... </td>
                <td class="center">
                    <a href="<?php echo base_url();?>admin/home/edit_guru_unggulan/<?php echo $row->guru_unggulan_id;?>" class="ico edit">Edit</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
	</div>
</div>
<!-- End Box -->

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2 class="left">+ <a href="<?php echo base_url();?>admin/home/add_request_guru" class="top_box_link">Add Request Guru</a></h2>
    </div>
    <!-- End Box Head -->	

    <!-- Table -->
    <div class="table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Lokasi</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th width="110" class="ac">Control</th>
            </tr>
            <?php $i=0;?>
            <?php foreach($request_guru->result() as $row):?>
            <tr <?php echo (($i++%2)!=0)?'class="odd"':'';?>>
                <td class="column_id"><?php echo $row->request_guru_home_id;?></td>
                <td>
                    <a href="<?php echo base_url();?>admin/home/edit_request_guru/<?php echo $row->request_guru_home_id;?>">
                        <?php echo $row->request_guru_home_title;?>
                    </a>
                </td>
                <td><?php echo $row->lokasi_title;?></td>
                <td><?php echo substr($row->request_guru_home_text,0,40);?> ...</td>
                <td><?php echo $row->request_guru_home_date;?> </td>
                <td class="center">
                    <?php if($row->request_guru_home_active==1):?>
                    <span class="ok">
                        Enabled
                    </span>
                    <?php else:?>
                    <span class="no">
                        Disabled
                    </span>
                    <?php endif;?>
                </td>
                <td class="center">
                    <?php if($row->request_guru_home_active==1):?>
                    <span class="ok">
                        <a class="ico edit" href="<?php echo base_url();?>admin/home/change_request_guru_status/<?php echo $row->request_guru_home_id;?>/0">Disable</a>
                    </span>
                    <?php else:?>
                    <span class="no">
                        <a class="ico edit" href="<?php echo base_url();?>admin/home/change_request_guru_status/<?php echo $row->request_guru_home_id;?>/1">Enable</a>
                    </span>
                    <?php endif;?>
                    <a href="<?php echo base_url();?>admin/home/delete_request_guru/<?php echo $row->request_guru_home_id;?>" class="ico del">delete</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
        <!-- Pagging -->
        <div class="pagging">
            <div class="left">
                Showing <?php echo $start+1;?>-<?php echo $start+$request_guru->num_rows();?> of <?php echo $count;?>
            </div>
            <div class="right">
                <?php if($page>1):?>
                <a href="<?php echo base_url();?>admin/home/page/<?php echo $page-1;?>">Previous</a>
                <?php endif;?>
                <?php if(($start+$request_guru->num_rows()) < $count):?>
                <a href="<?php echo base_url();?>admin/home/page/<?php echo $page+1;?>">Next</a>
                <?php endif;?>
            </div>
        </div>
        <!-- End Pagging -->
    </div>
    <!-- Table -->

</div>
<!-- End Box -->


<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2 class="left"><span>List guru yang melamar Request Guru</span></h2>
    </div>
    <!-- End Box Head -->	

    <!-- Table -->
    <div class="table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th>ID Request Guru</th>
                <th>Title Request</th>
                <th>ID Guru</th>
            </tr>
            <?php $i=0;?>
            <?php foreach($request_guru->result() as $row):?>
            <tr <?php echo (($i++%2)!=0)?'class="odd"':'';?>>
			 <?php $low = $this->admin_model->get_lamaran_request_guru($row->request_guru_home_id);?>
			 <td class="column_id"><?php echo $row->request_guru_home_id;?></td>
			 <td class="column_id"><?php echo $row->request_guru_home_title;?></td>
			 <?php if($low->num_rows > 0){ ?>
			 <?php foreach($low->result() as $l){ ?>
                <td><a href="<?php echo base_url().'admin/guru/view/'.$l->guru_id;?>"><?php echo $l->guru_id;?></a>&nbsp;<a href="<?php echo base_url();?>admin/home/delete_request_guru_by_guru/<?php echo $l->guru_id."/".$row->request_guru_home_id;?>" class="ico del">delete</a></td>
			 <?php } ?>
			 <?php } else { ?>
			 <td>&nbsp;</td>
			 <?php } ?>
            </tr>
            <?php endforeach;?>
        </table>
        <!-- Pagging -->
        <div class="pagging">
            <div class="left">
                Showing <?php echo $start+1;?>-<?php echo $start+$request_guru->num_rows();?> of <?php echo $count;?>
            </div>
            <div class="right">
                <?php if($page>1):?>
                <a href="<?php echo base_url();?>admin/home/page/<?php echo $page-1;?>">Previous</a>
                <?php endif;?>
                <?php if(($start+$request_guru->num_rows()) < $count):?>
                <a href="<?php echo base_url();?>admin/home/page/<?php echo $page+1;?>">Next</a>
                <?php endif;?>
            </div>
        </div>
        <!-- End Pagging -->
    </div>
    <!-- Table -->

</div>
<!-- End Box -->
