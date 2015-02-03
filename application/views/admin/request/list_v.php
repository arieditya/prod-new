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
        <h2 class="left">+ <a href="<?php echo base_url();?>admin/request/add_request" class="top_box_link">Add Request</a></h2>
	   <div class="right">
			<form action="<?php echo base_url();?>admin/request/search" method="post">
				<label>search by murid</label>
				<input type="text" class="field small-field" name="murid_name"/>
				<input type="submit" class="button" value="search" />
			</form>
		</div>
    </div>
    <!-- End Box Head -->	

    <!-- Table -->
    <div class="table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th>id</th>
                <th>Kode Request</th>
                <th>Pelajaran & Tingkat</th>
                <th>Murid</th>
                <th>Requested From</th>
                <th>Disc</th>
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
                    <a href="<?php echo base_url().'admin/request/view/'.$row->request_id;?>"><?php echo $row->request_id;?></a>
                </td>
                <td><?php echo $row->request_code;?></td>
                <td><?php echo $row->matpel_title;?> (<?php echo $row->jenjang_pendidikan_title;?>) </td>
                <td>
                    <a href="<?php echo base_url().'admin/murid/view/'.$row->murid_id;?>">
                        <?php echo $row->murid_nama;?>
                    </a>
                </td>
			 <td><?php if(($row->requested_by) == 0){ echo "Request Guru"; } else {  echo "Cari Guru";}?></td>
			 <td><?php 
							if(($row->request_get_disc) == 1){ echo "Ya"; } else {  echo "Tidak";}
					?>
			 </td>
			 <td><?php echo $row->request_date;?>
			 </td>
                <td class="center">
                    <a href="<?php echo base_url().'admin/request/change_call/'.$row->request_id.'/'.$page;?>">
				<?php if($row->request_status==1):?>
                    <span class="ok">
                        Active
                    </span>
                    <?php else:?>
                    <span class="no">
                        Closed
                    </span>
                    <?php endif;?>
				</a>
                </td>
			 <td class="center">
				 <a href="<?php echo base_url().'admin/request/change_progress/'.$row->request_id.'/'.$page;?>">
                    <?php if($row->request_progress==1):?>
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
				<form method="post" action="<?php echo base_url().'admin/request/change_ops/'.$row->request_id.'/'.$page;?>">
					<select name='ops' onchange='if(this.value != 0) { this.form.submit(); }'>
						<option value='0' <?php if($row->request_handle_by == 0){ echo "selected";} ?>>-</option>
						<option value='1' <?php if($row->request_handle_by == 1){ echo "selected";} ?>>NF</option>
						<option value='2' <?php if($row->request_handle_by == 2){ echo "selected";} ?>>MR</option>
						<option value='3' <?php if($row->request_handle_by == 3){ echo "selected";} ?>>PW</option>
						<option value='4' <?php if($row->request_handle_by == 4){ echo "selected";} ?>>MH</option>
					</select>
				</form>
			 </td>
			 <td>
                    <a href="<?php echo base_url();?>admin/request/delete/<?php echo $row->request_id;?>" class="ico del" onclick="return confirm('Apakah Anda yakin akan menghapus Request ID = <?php echo $row->request_id; ?> ?')">Delete</a>&nbsp;
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
                <a href="<?php echo base_url();?>admin/request/page/<?php echo $page-1;?>">Previous</a>
                <?php endif;?>
                <?php if(($start+$request->num_rows()) < $count):?>
                <a href="<?php echo base_url();?>admin/request/page/<?php echo $page+1;?>">Next</a>
                <?php endif;?>
            </div>
        </div>
        <!-- End Pagging -->

    </div>
    <!-- Table -->

</div>
<!-- End Box -->