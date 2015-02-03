<link rel="stylesheet" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.min.js" type="text/javascript" charset="utf-8"></script>
<style>
	.ceklis{ cursor:pointer; }
	.jadwal.ceklis.selected {background-color: #d5df26 !important;}
	.none{visibility:hidden;}
</style>

<script type="text/javascript">
function update_matpel(){
    id=$("#jenjangP").val();
    sesi_matpel=$("#sesi_matpel").val();
    $.getJSON(base_url+"cari_guru/get_matpel/"+id,function(data){
	html = '';
        $.each(data,function(i,item){
	   if(item.matpel_id == sesi_matpel){
            html+= '<option value="'+item.matpel_id+'" selected>'+item.matpel_title+'</option>';
	   } else {
		  html+= '<option value="'+item.matpel_id+'">'+item.matpel_title+'</option>';
	   }
        });
        $("#matpel").html(html);
    })
}

function update_provinsi(){
    id=$("#ddProvinsi").val();
    sesi_kota=$("#sesi_lokasi").val();
        $.getJSON(base_url+"service/get_lokasi/"+id,function(data){
	   html = '';
        $.each(data,function(i,item){
		if(item.lokasi_id == sesi_kota){
            html+= '<option value="'+item.lokasi_id+'" selected>'+item.lokasi_title+'</option>';
		}else{
		  html+= '<option value="'+item.lokasi_id+'">'+item.lokasi_title+'</option>';
		}
        });
        $("#ddLokasi").html(html);
        })
}

function jadwal_box_click(obj){
    checkbox = $(obj).children('.jadwal-checkbox');
    if(checkbox.is(':checked')){
        checkbox.attr('checked', false);
        $(obj).removeClass('selected');
    }else{
        checkbox.attr('checked', true);
        $(obj).addClass('selected');
	   $(obj).toogleClass('selected');
    }
}

$(document).ready(function(){
     $("#mulai").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
    update_matpel();
    update_provinsi();
});
</script>

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
        <h2>Data Request</h2>
    </div>
    <!-- End Box Head -->

    <!--<form method="post">-->
    <form method="post" action="<?php echo base_url(); ?>admin/request/edit_request_submit/<?php echo $request->request_id;?>">

        <!-- Form -->
        <div class="form">
            <p>
                <label>ID</label>
                <input type="text" class="field size1" name="name" value="<?php echo $request->request_id;?>" disabled="true"/>       
            </p>
            <p>
                <label>Kode Request</label>
                <input type="text" class="field size1" name="name" value="<?php echo $request->request_code;?>" disabled="true"/>
            </p>
            <p>
                <label>Murid</label>
                <input type="text" class="field size1" name="name" disabled value="<?php echo $request->murid_nama;?>"/>       
            </p>
		  <p>
                <label>Tingkat Pendidikan</label>
                <select class="inline-field size5" name="pendidikan" onchange="update_matpel()" id="jenjangP">
                     <?php foreach($this->guru_model->get_jenjang()->result() as $item):
					if($matpel->jenjang_pendidikan_id == $item->jenjang_pendidikan_id){
				 ?>
                         <option value="<?php echo $item->jenjang_pendidikan_id;?>" selected><?php echo $item->jenjang_pendidikan_title;?></option>
				 <?php } else { ?>
					<option value="<?php echo $item->jenjang_pendidikan_id;?>"><?php echo $item->jenjang_pendidikan_title;?></option>
                     <?php }
					endforeach;
				 ?>
                </select>
            </p>
            <p class="inline-field">
                <label>Mata Pelajaran</label>
			 <input type="hidden" id="sesi_matpel" value="<?php echo $matpel->matpel_id;?>"/>
                <select class="select" id="matpel" name="matpel">
                </select>
            </p>
		  <?php if($request->requested_by == 0){ ?>
		  <p>
                <label>Provinsi</label>
                <select class="inline-field size5" name="provinsi" onchange="update_provinsi()" id="ddProvinsi">
                      <?php foreach ($this->guru_model->get_provinsi('provinsi')->result() as $item):
					if($lokasi->provinsi_id == $item->provinsi_id){
				 ?>
                         <option value="<?php echo $item->provinsi_id;?>" selected><?php echo $item->provinsi_title;?></option>
				 <?php } else { ?>
					<option value="<?php echo $item->provinsi_id;?>"><?php echo $item->provinsi_title;?></option>
                     <?php }
					endforeach;
				 ?>
                </select>
            </p>
            <p class="inline-field">
                <label>Lokasi</label>
			 <input type="hidden" id="sesi_lokasi" value="<?php echo $lokasi->lokasi_id;?>"/>
                <select class="select" id="ddLokasi" name="lokasi">
                </select>
            </p>
		  <?php } ?>
            <p>
                <label>Jumlah pertemuan</label>
                <input type="text" class="field size1" name="request_frek" value="<?php echo $request->request_frekuensi;?>"/>       
            </p>
            <p>
                <label>Referral Code (Duta Murid)</label>
			 <input type="text" class="field size1" name="duta_murid" value="<?php echo $request->referal_code;?>"/> 
            </p>
            <p>
                <label>Budget</label>
                <input type="text" class="field size1" name="budget" value="<?php echo $request->request_budget;?>"/>       
            </p>
		  <?php  if($request->requested_by == 0) {  $jyt = $this->request_model->convert_jadwal_kursus_admin($request->request_jadwal); //print_r($jyt);?>
		  <?php $jyt_cetak = $this->request_model->convert_jadwal_kursus($request->request_jadwal);?>
		  <?php  if($jyt_cetak["flag"] == 1) { 
					    $key = array_keys($jyt_cetak); //print_r($jyt);
					    $n = count($key);
					    $jadwal_kursus = "";
					    if($n >= 1){
						   for($j=0;$j<$n-1;$j++){
						   	$dd = sprintf('%d', $key[$j]); //print_r($key[$j]);
							$hari = $this->request_model->convert_day($dd);
							$jam = $this->request_model->convert_hour($jyt_cetak[$key[$j]]);
							$jadwal_kursus .= $hari." (".$jam.") ";
						   }
					     }
					$jadwal_pilihan_murid = $jadwal_kursus;
				}else{
					$jadwal_pilihan_murid = $jyt_cetak[0];
				}				
		?>
		  <p>
                <label>Jadwal Pilihan Murid</label>
                <textarea type="text" class="field size1" name="jyt"  disabled="true"><?php echo $jadwal_pilihan_murid;?></textarea>       
			 <table class="availability center" border="0" cellpadding="0" cellspacing="1" width="450">
				<tbody>
					<tr>
						<th></th>
						<?php foreach($days as $hari){?>
							<th width="50px"><?php echo $hari?></th>
						<?php } ?>
					</tr>
					<?php for($i=7;$i<24;$i++):?>
					<tr>
						<th height="30px"><?php echo sprintf('%02s', $i); ?>:00</th>
							<?php for($j=0;$j<7;$j++):?>
							<?php $hour = (array_key_exists($j, $jyt)?$jyt[$j]:array());?>
							<td onclick="jadwal_box_click(this)" style="background-color: <?php echo (array_key_exists($i, $hour)?'#AEE8FC':'#EBEBEB');?>" class="jadwal ceklis">
								<input class="none jadwal-checkbox" type="checkbox" name="catch_jadwal[]" value="<?php echo $i.','.$j;?>"/>
							</td>
							<?php endfor;?>
					</tr>
					<?php endfor;?>
				</tbody>
			</table>
            </p>
		  <?php } ?>
            <p>
                <label>Mulai</label>
                <input type="text" class="field size2" name="mulai" id="mulai" value="<?php echo $request->request_mulai;?>"/>       
            </p>
		  <p>
                <label>Preferensi Gender</label>
                <select class="inline-field size5" name="gender">
                    <option value="1" <?php if($request->request_gender == 1){ echo "selected";}?>>Bebas</option>
                    <option value="2" <?php if($request->request_gender == 2){ echo "selected";}?>>Laki-laki</option>
                    <option value="3" <?php if($request->request_gender == 3){ echo "selected";}?>>Perempuan</option>
                </select>
            </p>
		  <p>
                <label>Diskon (ada duta murid dan transaksi >= Rp 1.000.000,-)</label>
                <select class="inline-field size5" name="disc">
                    <option value="1" <?php if($request->request_get_disc == 1){ echo "selected";}?>>Ya</option>
                    <option value="0" <?php if($request->request_get_disc == 0){ echo "selected";}?>>Tidak</option>
                </select>
            </p>
            <p>
                <label>Catatan</label>
                <textarea class="field size1" rows="10" cols="30" name="catatan"><?php echo $request->request_catatan;?></textarea>
            </p>
        </div>

    <div class="buttons">
          <input type="submit" class="button" value="submit" />
     </div>
	</form>
</div>


<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Status Guru</h2>
    </div>
    <!-- End Box Head -->	

    <!-- Table -->
    <div class="table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th rowspan="2">ID Guru</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Email</th>
                <th rowspan="2">Telp.</th>
                <th rowspan="2">Prioritas</th>
                <th rowspan="2">Add Kelas</th>
                <th rowspan="2" width="150px">Jadwal Pilihan Murid</th>
                <th colspan="3" class="center">Response Status</th>
                <th rowspan="2" class="center">Status Request</th>
            </tr>
		  <tr>               
                <th class="center">Belum Dijawab </th>
                <th class="center">Ditolak </th>
                <th class="center">Diterima </th>
		  </tr>
            <?php $i=0;?>
            <?php foreach($guru->result() as $row):?>
            <tr <?php echo (($i++%2)!=0)?'class="odd"':'';?>>
                <td class="column_id">
                    <a href="<?php echo base_url().'admin/guru/view/'.$row->guru_id;?>"><?php echo $row->guru_id;?></a>&nbsp;<a href="<?php echo base_url();?>admin/request/delete_guru/<?php echo $row->request_id;?>/<?php echo $row->guru_id;?>" class="ico del" onclick="return confirm('Apakah Anda yakin akan menghapus guru tersebut dari request <?php echo $row->request_id; ?> ?')"></a>&nbsp;
                </td>
                <td><?php echo $row->guru_nama;?></td>
                <td><?php echo $row->guru_email;?></td>
                <td><?php echo $row->guru_hp;?></td>
                <td class="center"><?php echo $row->request_guru_priority;?></td>
                <td><a href="<?php echo base_url()."admin/kelas/add_kelas_request/". $request->request_id ."/" .$row->guru_id?>"><img src="<?php if($row->request_guru_status_title == "DITERIMA"){ echo base_url().'images/add_kelas.png'; } else { echo "";} ?>" width="70px"/></a></td>
                
			 <!-- JADWAL -->
			 <?php if($request->requested_by == 0){ ?>
						<td><?php echo $jadwal_pilihan_murid;?></td>
			 <?php } else { ?>
			 <?php $jyt = $this->request_model->convert_jadwal($request->request_jadwal);?>
			 <?php if($jyt["flag"] == 1) {
					$dd = array_keys($jyt[$row->guru_id]);
					$n = count($dd);
					$jadwal_kursus = "";
						for($j=0;$j<$n;$j++){
							$hari = $this->request_model->convert_day($dd[$j]);
							$key = $dd[$j];
							$jam = $this->request_model->convert_hour($jyt[$row->guru_id][$key]);
							$jadwal_kursus .= $hari ." (". $jam .")<br/>"; 
						} ?>
			 <?php } ?>
				<td><?php echo $jadwal_kursus;?></td>
			 <?php } ?>
			 
			 <!-- END OF JADWAL -->
			 
			 <td class="center">
                    <a href="<?php echo base_url()."admin/request/change_status/". $request->request_id ."/" .$row->guru_id ."/1"?>"><img src="<?php if($row->request_guru_status_title == "BELUM DIJAWAB"){ echo base_url().'images/tick.png'; } else { echo base_url().'images/publish_x.png';} ?>"/></a>
                </td>
			 <td class="center">
                    <a href="<?php echo base_url()."admin/request/change_status/". $request->request_id ."/" .$row->guru_id ."/2"?>"><img src="<?php if($row->request_guru_status_title == "DITOLAK"){ echo base_url().'images/tick.png'; } else { echo base_url().'images/publish_x.png';} ?>"/></a>
                </td>
			 <td class="center">
                    <a href="<?php echo base_url()."admin/request/change_status/". $request->request_id ."/" .$row->guru_id ."/3"?>"><img src="<?php if($row->request_guru_status_title == "DITERIMA"){ echo base_url().'images/tick.png'; } else { echo base_url().'images/publish_x.png';} ?>"/></a>
                </td>
			 <td class="center">
                    <a href="<?php echo base_url()."admin/request/change_status_request/". $request->request_id ."/".$request->request_pilih_status;?>"><img src="<?php if($request->request_pilih_status == 1){ echo base_url().'images/tick.png'; } else { echo base_url().'images/publish_x.png';} ?>"/></a>
                </td>
            </tr>
            <?php endforeach;?>
		  <form method="post" action="<?php echo base_url().'admin/request/add_guru/'.$request->request_id;?>">
		  <tr>
			<td>Masukkan ID Guru</td>
			<td><input type="text" class="field size2" name="id_guru"/></td>
			<td><input type="submit" class="button" value="submit" /></td>
		  </tr>
		 </form>
		</table>
    </div>
    <!-- Table -->

</div>
<!-- End Box -->

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Edit Status Request</h2>
    </div>
    <!-- End Box Head -->

    <form action="<?php echo base_url();?>admin/request/edit_submit" method="post" >

        <!-- Form -->
        <div class="form">
            <input type="hidden" class="field size1" name="id" value="<?php echo $request->request_id;?>"/>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th class="center">Kategori</th>
                            <th class="center">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Is Active</td>
                            <td>
                                <?php $config = 'class="checkbox"';?>
                                <?php echo form_radio('active', '0', ($request->request_status==0), $config);?> Tidak
                                <?php echo form_radio('active', '1', ($request->request_status==1), $config);?> Ya
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
