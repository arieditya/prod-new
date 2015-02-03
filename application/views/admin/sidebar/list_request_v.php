<!-- Message Error -->
<?php if ($this->session->flashdata('f_request')): ?>
    <div class="msg msg-ok boxwidth">
        <p><strong><?php echo $this->session->flashdata('f_request'); ?></strong></p>
    </div>
<?php endif; ?>

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2 class="left">Request Sidebar</h2>
    </div>
    <!-- End Box Head -->	

    <!-- Table -->
    <div class="table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Matpel</th>
                <th>Email</th>
                <th>Tgl Request</th>
                <th class="center">Status</th>
                <th class="center">Progress</th>
                <th class="center">Ops</th>
			  <th width="50">Control</th>
            </tr>
            <?php $i=0;?>
            <?php foreach($request->result() as $row):?>
            <tr <?php echo (($i++%2)!=0)?'class="odd"':'';?>>
                <td class="column_id">
                    <a href="<?php echo base_url().'admin/utilities/view_request/'.$row->id_request;?>"><?php echo $row->id_request;?></a>
                </td>
                <td><?php echo $row->nama_request;?></td>
			 <td><?php echo $row->telp_request;?></td>
			 <td><?php echo $row->matpel_request;?></td>
			 <td><?php echo $row->email_request;?></td>
			 <td><?php echo $row->date_request;?></td>
                <td class="center">
                    <?php if($row->status_request==1):?>
                    <a href="<?php echo base_url().'admin/utilities/change_request_status/0/'.$row->id_request.'/'.$page;?>"><span class="ok">
                        Active
                    </span></a>
                    <?php else:?>
                    <a href="<?php echo base_url().'admin/utilities/change_request_status/1/'.$row->id_request.'/'.$page;?>"><span class="no">
                        Closed
                    </span></a>
                    <?php endif;?>
                </td>
			 <td class="center">
				<a href="<?php echo base_url().'admin/utilities/change_progress/'.$row->id_request.'/'.$page;?>">
					<?php if($row->progress_request==1):?>
						<span class="ok">
							Success
						</span>
						<?php else:?>
						<span class="no">
							In Progress
						</span>
					<?php endif;?>
				</a>
                </td>
			 <td>
				<form method="post" action="<?php echo base_url().'admin/utilities/change_ops/'.$row->id_request.'/'.$page;?>">
					<select name='ops' onchange='if(this.value != 0) { this.form.submit(); }'>
						<option value='0' <?php if($row->handle_request == 0){ echo "selected";} ?>>-</option>
						<option value='1' <?php if($row->handle_request == 1){ echo "selected";} ?>>NF</option>
						<option value='2' <?php if($row->handle_request == 2){ echo "selected";} ?>>MR</option>
						<option value='3' <?php if($row->handle_request == 3){ echo "selected";} ?>>PW</option>
						<option value='4' <?php if($row->handle_request == 4){ echo "selected";} ?>>MH</option>
					</select>
				</form>
			 </td>
			 <td>
                    <a href="<?php echo base_url();?>admin/utilities/delete_request/<?php echo $row->id_request;?>" class="ico del" onclick="return confirm('Apakah Anda yakin akan menghapus Request ID = <?php echo $row->id_request; ?> ?')">Delete</a>&nbsp;
                </td>
            </tr>
            <?php endforeach;?>
        </table>
        <!-- Pagging -->
        <div class="pagging">
            <div class="left">
                Showing <?php echo $start+1;?>-<?php echo $start+$request->num_rows();?> of <?php echo $count;?>
            </div>
            <div class="right">
                <?php if($page>1):?>
                <a href="<?php echo base_url();?>admin/utilities/page/<?php echo $page-1;?>">Previous</a>
                <?php endif;?>
                <?php if(($start+$request->num_rows()) <= $count):?>
                <a href="<?php echo base_url();?>admin/utilities/page/<?php echo $page+1;?>">Next</a>
                <?php endif;?>
            </div>
        </div>
        <!-- End Pagging -->

    </div>
    <!-- Table -->

</div>
<!-- End Box -->