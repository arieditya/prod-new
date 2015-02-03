<link rel="stylesheet" href="<?php echo base_url(); ?>css/validation.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css">
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
function update_harga(){
	total_harga = document.getElementById("total_harga");
	harga = document.getElementById("harga");
	total_jam = document.getElementById("total_jam");
	jml_harga = harga * total_jam;

	if(jml_harga != $total_harga){
		alert("Perkalian jumlah jam dan harga salah!");
	}
	
	
}

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

$(document).ready(function(){
    $("#add-pertemuan").validationEngine();
    $("#date").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
    $("#date_verified").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
    $("#date_verified_kedua").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
    $("#date_payment1").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
    $("#date_payment2").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
    $("#mulai").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
    update_matpel();
    update_provinsi();

});
</script>

<!-- Message Error -->
<?php if ($this->session->flashdata('f_kelas')): ?>
    <div class="msg msg-ok boxwidth">
        <p><strong><?php echo $this->session->flashdata('f_kelas'); ?></strong></p>
    </div>
<?php endif; ?>

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Kelas</h2>
    </div>
    <!-- End Box Head -->

    <form id="add-kelas" action="<?php echo base_url();?>admin/kelas/update_kelas_submit/<?php echo $kelas->kelas_id;?>" method="post" >

        <!-- Form -->
        <div class="form">
            <p>
                <label>ID Kelas</label>
                <input type="text" class="field" size="15px"  name="id" disabled value="<?php echo $kelas->kelas_id;?>"/>
            </p>
            <p>
                <label>Nama Guru</label>
                <input id="guru" type="text" class="field size1" name="guru" value="<?php echo $kelas->guru_nama;?>"/>
            </p>
            <p>
                <label>Nama Murid</label>
                <input id="murid" type="text" class="field size1" name="murid" disabled value="<?php echo $kelas->murid_nama;?>"/>
            </p>
		  <p>
                <label>Nama Duta Guru</label>
                <input id="murid" type="text" class="field size1" name="duta" disabled value="<?php if(!empty($kelas->duta_guru_id)){ echo $kelas->duta_guru_nama; }else{ echo ""; }?>"/>
                <input id="duta_murid" type="hidden" name="duta_murid" disabled value="<?php echo $kelas->duta_guru_id;?>"/>
                <input id="duta_guru" type="hidden" name="duta_guru" disabled value="<?php echo $kelas->duta_murid_id;?>"/>
            </p>
		  <p>
                <label>Nama Duta Murid</label>
			 <?php $duta_guru = $this->kelas_model->get_duta_info($kelas->duta_murid_id);?>
                <input id="murid" type="text" class="field size1" name="duta" disabled value="<?php if(!empty($kelas->duta_murid_id)){ echo $duta_guru->duta_guru_nama; }else{ echo ""; }?>"/>
            </p>
		  <p>
                <label>Dapat Diskon  (ada duta murid dan transaksi >= Rp 1.000.000,-)</label>
                <select class="field size2" id="disc" name="disc">
				<option value="1" <?php if($request->request_get_disc==1){ echo "selected";}?>>Ya</option>
				<option value="0" <?php if($request->request_get_disc==0){ echo "selected";}?>>Tidak</option>
                </select>
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
			 <input type="hidden" id="sesi_matpel" value="<?php echo $kelas->matpel_id; ?>"/>
                <select class="select" id="matpel" name="matpel">
                </select>
            </p>
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
            <p class="inline-field">
                <label>Tanggal Mulai</label>
                <input id="mulai" name="mulai" type="text" class="field" size="15px" value="<?php echo $kelas->kelas_mulai;?>"/>
            </p>
            <p>
                <label>Catatan</label>
                <textarea class="field size1" rows="10" cols="30" name="catatan"><?php echo $kelas->kelas_catatan;?></textarea>
            </p>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
            <input type="submit" class="button" value="Submit" />
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
<!-- End Box -->

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Pembayaran Murid</h2>
    </div>
    <!-- End Box Head -->

    <form id="add-kelas" action="<?php echo base_url();?>admin/kelas/pembayaran_submit" method="post" >

        <!-- Form -->
        <div class="form">
            <p>
                <label>Lama Belajar</label>
                <input type="hidden" name="id" value="<?php echo $kelas->kelas_id;?>"/>
                <input id="total_pertemuan" type="text" class="field size2" name="total_pertemuan" value="<?php echo $kelas->kelas_frekuensi; ?>" />
            </p>
            <p>
                <label>Lama Jam Belajar</label>
			 <?php /* if(!empty($request)){ 
					if($request->requested_by == 1){ 
						$jyt = $this->request_model->convert_jadwal($request->request_jadwal);
						if($jyt["flag"] == 1) { 
							$key = array_keys($jyt[$kelas->guru_id]);
							$n = count($key);
							$durasi = 0;
							if($n >= 1){
								for($j=0;$j<$n;$j++){
									$dd = sprintf('%d', $key[$j]);
									$hh = $jyt[$kelas->guru_id][$dd];
									$min_hh = min($hh);
									$max_hh = max($hh);
									$jml_hh = $max_hh - $min_hh;
									$durasi += $jml_hh;
								}
							}
						  } else {
							$durasi = 0;
						  }
						} else { 
						$jyt = $this->request_model->convert_jadwal_kursus($request->request_jadwal); 
						if($jyt["flag"] == 1) { 
							$key = array_keys($jyt);//print_r();
							$n = count($key);
							if($n >= 1){
								for($j=0;$j<$n-1;$j++){
									$dd = sprintf('%d', $key[$j]);
									$hh = $jyt[$kelas->guru_id][$dd];
									$min_hh = min($hh);
									$max_hh = max($hh);
									$jml_hh = $max_hh - $min_hh;
									$durasi += $jml_hh;	
								}
							}
						} else {
							$durasi = 0;
						}
					}
					} else {
						$durasi = 0;
					}*/
			?>
                <input id="durasi" type="text" class="field size2" name="durasi" value="<?php if($kelas->kelas_durasi == 0) { echo "0"; } else { echo $kelas->kelas_durasi; } ?>"/>
            </p>
            <p>
                <label>Harga per Jam</label>
                <input id="harga" type="text" class="field size2" name="harga" value="<?php echo $kelas->kelas_harga;?>" />
            </p>
            <p>
                <label>Total Jam Belajar</label>
			 <p>(Lama Belajar x Lama Jam Belajar per Minggu)</p>
			 <?php ?>
                <input id="total_jam" type="text" class="field size2"  name="total_jam" value="<?php echo $kelas->kelas_total_jam;?>" />
            </p>
            <p>
                <label>Total Harga</label>
			 <p>(Total Jam Belajar x Harga per Jam)</p>
                <input id="total_harga" type="text" class="field size2" name="total_harga" value="<?php echo $kelas->kelas_total_harga;?>" />
            </p> 
            <p>
                <label>Tahapan Pembayaran</label>
               <select class="inline-field size5" name="tahap_pembayaran">
                    <option value="1" <?php if($kelas->kelas_tahapan_pembayaran== 1){ echo "selected";}?>>Langsung</option>
                    <option value="2" <?php if($kelas->kelas_tahapan_pembayaran == 2){ echo "selected";}?>>Dua Tahap</option>
                </select>
            </p>	
            <p>
                <label>Persen Pembayaran Pertama</label>
               <select class="inline-field size5" name="persen_pembayaran">
                    <option value="1" <?php if($kelas->kelas_persen_pembayaran == 1){ echo "selected";}?>>100%</option>
                    <option value="2" <?php if($kelas->kelas_persen_pembayaran == 2){ echo "selected";}?>>50%</option>
                </select>
            </p>
            <p class="inline-field">
			 <label>Copy Paste Link Pembayaran</label>
			 <?php 
			   if(empty($payment->status_payment)){
			   $jam = $kelas->kelas_total_jam;
			   $harga = $kelas->kelas_harga;
			   $total = $kelas->kelas_total_harga;
			   $jml = $jam * $harga;
			   
			   if($jml == $total){
				if($kelas->kelas_total_harga > 0){
				
				// Fill transaction data
				$hash = md5($kelas->kelas_id);
				
				// Use sandbox account
				Veritrans_Config::$isProduction = true;
				//Veritrans_Config::$isProduction = false;
				
				// Set our server key
				//Veritrans_Config::$serverKey = 'VT-server-a-AunKPJMwirR3Woa9ndxVCK'; //---> SANDBOX KEY
                                Veritrans_Config::$serverKey = 'VT-server-uOH49Wzel6UwMKYHikpZ5WQE';

				
				// Optional
				$item_details = array(
				'id' => $kelas->kelas_id,
				'price' => $kelas->kelas_harga,
				'quantity' => $kelas->kelas_total_jam,
				'name' => $kelas->matpel_title." (".$kelas->jenjang_pendidikan_title.")"
				);
				
				// Optional
					$billing_address = array(
					'first_name'    => $kelas->murid_nama,
					'last_name'     => " ",
					'address'       => $kelas->murid_alamat,
					'phone'         => $kelas->murid_hp,
					'country_code'  => 'IDN'
				);
				
				// Optional
					$customer_details = array(
					'first_name'    => $kelas->murid_nama,
					'last_name'     => " ",
					'email'         => $kelas->murid_email,
					'phone'         => $kelas->murid_hp,
					'billing_address'  => $billing_address,
				);
					
					$transaction = array(
					'payment_type' => 'vtweb',
					"vtweb" => array (
					"enabled_payments" => array("credit_card", "mandiri_clickpay", "cimb_clicks", "bank_transfer"),
					"credit_card_3d_secure" => true,
					),
					'transaction_details' => array(
					'order_id' => 'RG'.$kelas->kelas_id.substr($hash,0,3),
					'gross_amount' => $kelas->kelas_total_harga,
					),
					'customer_details' => $customer_details,
					'item_details' => $item_details,
					);
				
					$vtweb_url = Veritrans_Vtweb::getRedirectionUrl($transaction);
				  }
				
			 ?>
			 <?php if($kelas->kelas_total_harga == 0){ ?>
			 <?php echo "Masukkan detail harga kelas"; ?>
			 <?php } else { ?>
                <input type="text" class="field" size="100px" value="<?php echo $vtweb_url;?>"/>
			 <?php } ?>
			 <?php } else { ?>
			  <script>alert("Perkalian jumlah jam dan harga salah!");</script>
			 <?php } ?>
			 <?php } else { ?>
             <?php echo "Pembayaran sedang diproses oleh bank"; ?>
			 <?php } ?>
            </p>		  
        </div>
        <!-- End Form -->
        
        <!-- Form Buttons -->
        <div class="buttons">
            <input type="submit" class="button" value="Submit" />&nbsp;<a href="<?php echo base_url().'admin/kelas/send_invoice/'.$kelas->kelas_id;?>" class="button">Kirim Invoice ke Murid</a>&nbsp;<a href="<?php echo base_url().'admin/reminder/add/'.$kelas->kelas_id;?>" class="button">Add Reminder</a>
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
<!-- End Box -->

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Update Status Pembayaran Murid</h2>
    </div>
    <!-- End Box Head -->

    <form id="add-kelas" action="<?php echo base_url();?>admin/kelas/update_pembayaran_murid_submit" method="post" >

        <!-- Form -->
        <div class="form">
            <p>
                <label>Jumlah Terbayar Dari Murid (Manual)</label>
                <input type="text" class="field size2" id="pembayaran_murid" name="pembayaran_murid"  value="<?php echo $kelas->kelas_pembayaran_murid;?>"  />
			 <input type="hidden" name="id" value="<?php echo $kelas->kelas_id;?>"/>
            </p>
		  <p>
                <label>No. Rekening Murid (Manual)</label>
                <input id="no_rek_murid" type="text" class="field" size="50px" name="no_rek_murid" value="<?php echo $kelas->kelas_rek_murid;?>" />
            </p>
		  <p>
                <label>Tanggal Verifikasi Pembayaran (Manual)</label>
                <input id="date_verified" type="text" class="field size2" name="date_verified" value="<?php echo $kelas->kelas_date_verified;?>" />
            </p>
		  <p>
                <label>Status Pembayaran (Manual)</label>
                <select class="inline-field size5" name="status_pembayaran">
                    <option value="1" <?php if($kelas->kelas_pembayaran_status == 1){ echo "selected";}?>>Belum Dibayar</option>
                    <option value="2" <?php if($kelas->kelas_pembayaran_status == 2){ echo "selected";}?>>Sudah Dibayar</option>
                </select>
            </p>
        </div>
        <!-- End Form -->
        
        <!-- Form Buttons -->
        <div class="buttons">
            <input type="submit" class="button" value="Submit" />&nbsp;<a href="<?php echo base_url().'admin/kelas/send_bukti_pembayaran/'.$kelas->kelas_id;?>" class="button">Kirim Bukti Pembayaran</a>
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
<!-- End Box -->

<?php if(($kelas->kelas_tahapan_pembayaran == 2) && ($kelas->kelas_persen_pembayaran >= 2)){ ?>
<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Update Status Pembayaran Murid Kedua</h2>
    </div>
    <!-- End Box Head -->

    <form id="add-kelas" action="<?php echo base_url();?>admin/kelas/update_pembayaran_murid_kedua_submit" method="post" >

        <!-- Form -->
        <div class="form">
            <p>
                <label>Jumlah Terbayar Dari Murid (Manual)</label>
                <input type="text" class="field size2" id="pembayaran_murid_kedua" name="pembayaran_murid_kedua"  value="<?php echo $kelas->kelas_pembayaran_murid_kedua;?>"  />
			 <input type="hidden" name="id" value="<?php echo $kelas->kelas_id;?>"/>
            </p>
		  <p>
                <label>No. Rekening Murid (Manual)</label>
                <input id="no_rek_murid" type="text" class="field" size="50px" name="no_rek_murid" value="<?php echo $kelas->kelas_rek_murid;?>" />
            </p>
		  <p>
                <label>Tanggal Verifikasi Pembayaran (Manual)</label>
                <input id="date_verified_kedua" type="text" class="field size2" name="date_verified_kedua" value="<?php echo $kelas->kelas_date_verified_kedua;?>" />
            </p>
		  <p>
                <label>Status Pembayaran (Manual)</label>
                <select class="inline-field size5" name="status_pembayaran_kedua">
                    <option value="1" <?php if($kelas->kelas_pembayaran_kedua_status == 1){ echo "selected";}?>>Belum Dibayar</option>
                    <option value="2" <?php if($kelas->kelas_pembayaran_kedua_status == 2){ echo "selected";}?>>Sudah Dibayar</option>
                </select>
            </p>
        </div>
        <!-- End Form -->
        
        <!-- Form Buttons -->
        <div class="buttons">
            <input type="submit" class="button" value="Submit" />&nbsp;<a href="<?php echo base_url().'admin/kelas/send_bukti_pembayaran/'.$kelas->kelas_id;?>" class="button">Kirim Bukti Pembayaran</a>
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
<!-- End Box -->
<?php } ?>
<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Pembayaran Guru</h2>
    </div>
    <!-- End Box Head -->

    <form id="add-kelas" action="<?php echo base_url();?>admin/kelas/update_pembayaran_guru_submit" method="post" >

        <!-- Form -->
        <div class="form">
	   	  <p>
                <label>Jenis Pembayaran</label>
                <select class="inline-field size5" name="jenis_pembayaran">
                    <option value="0" <?php if($kelas->kelas_jenis_pembayaran_guru == 0){ echo "selected";}?>>Pembayaran kelas pertama</option>
                    <option value="1" <?php if($kelas->kelas_jenis_pembayaran_guru == 1){ echo "selected";}?>>Pembayaran kelas terakhir</option>
                </select>
            </p>
            <p>
                <label>Pembayaran Pertama Ke Guru (Manual)</label>
			 <p>(50% Total Harga - 10% Total Harga)</p>
                <input type="text" class="field size2" id="half_to_guru" name="half_to_guru"  value="<?php echo $kelas->kelas_pembayaran_guru_setengah;?>" />
			 <input type="hidden" name="id" value="<?php echo $kelas->kelas_id;?>"/>
            </p>
		  <p>
                <label>Tanggal Pembayaran Pertama</label>
                <input id="date_payment1" type="text" class="field size2" name="date_payment1"  value="<?php echo $kelas->kelas_date_payment1;?>"/>
            </p>
            <p>
                <label>Pembayaran Kedua Ke Guru (Manual)</label>
			 <p>(50% Total Harga - 10% Total Harga)</p>
                <input type="text" class="field size2" id="full_to_guru" name="full_to_guru"  value="<?php echo $kelas->kelas_pembayaran_guru_penuh;?>"  />
            </p>
		  <p>
                <label>Tanggal Pembayaran Kedua</label>
                <input id="date_payment2" type="text" class="field size2" name="date_payment2"  value="<?php echo $kelas->kelas_date_payment2;?>"/>
            </p>		  
        </div>
        <!-- End Form -->
        
        <!-- Form Buttons -->
        <div class="buttons">
            <input type="submit" class="button" value="Submit" />&nbsp;<a href="<?php echo base_url().'admin/kelas/send_invoice_guru/'.$kelas->kelas_id;?>" class="button">Kirim Bukti Pembayaran ke Guru</a>
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
<!-- End Box -->


<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Pembayaran Duta Guru</h2>
    </div>
    <!-- End Box Head -->

    <form id="add-kelas" action="<?php echo base_url();?>admin/kelas/update_pembayaran_dutaguru_submit" method="post" >

        <!-- Form -->
        <div class="form">
            <p>
			 <?php $cek_duta = $this->kelas_model->get_status_pembayaran_duta($kelas->guru_id, $kelas->duta_guru_id);?>
                <label>Jumlah Terbayar Ke Duta dari Guru (Manual)</label>
			  <p>(3% Total Harga) </p>
			 <input type="hidden" name="id" value="<?php echo $kelas->kelas_id;?>"/>
                <input type="text" class="field size2" id="to_duta_guru" name="to_duta_guru"  value="<?php echo $kelas->kelas_pembayaran_duta_guru;?>"  style="float:left;"/>&nbsp;<?php if(!empty($cek_duta) && ($cek_duta->kelas_id != $kelas->kelas_id)){ ?><img src="<?php echo base_url().'images/sudah-dibayar.png' ?>" width="100px"/><?php  }  ?>
            </p>
        </div>
        <!-- End Form -->
        
        <!-- Form Buttons -->
        <div class="buttons">
            <input type="submit" class="button" value="Submit" />&nbsp;<a href="<?php echo base_url().'admin/kelas/send_invoice_duta/'.$kelas->kelas_id;?>" class="button">Kirim Bukti Pembayaran ke Duta Guru</a>
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
<!-- End Box -->

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Pembayaran Duta Murid</h2>
    </div>
    <!-- End Box Head -->

    <form id="add-kelas" action="<?php echo base_url();?>admin/kelas/update_pembayaran_dutamurid_submit" method="post" >

        <!-- Form -->
        <div class="form">
		  <p>
                <label>Jumlah Terbayar Ke Duta dari Murid (Manual)</label>
			  <p>(3% Total Harga)</p>
			 <input type="hidden" name="id" value="<?php echo $kelas->kelas_id;?>"/>
                <input type="text" class="field size2" id="to_duta_murid" name="to_duta_murid"  value="<?php echo $kelas->kelas_pembayaran_duta_murid;?>"  />
            </p>
        </div>
        <!-- End Form -->
        
        <!-- Form Buttons -->
        <div class="buttons">
            <input type="submit" class="button" value="Submit" />&nbsp;<a href="<?php echo base_url().'admin/kelas/send_invoice_duta_murid/'.$kelas->kelas_id;?>" class="button">Kirim Bukti Pembayaran ke Duta Murid</a>
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
<!-- End Box -->

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Add Pertemuan</h2>
    </div>
    <!-- End Box Head -->

    <form id="add-pertemuan" action="<?php echo base_url();?>admin/kelas/add_pertemuan_submit" method="post" >

        <!-- Form -->
        <div class="form">
            <p>
                <label>Tanggal Pertemuan</label>
                <input id="date" type="text" class="field size2 validate[required]" name="date" />
                <input type="hidden" name="id" value="<?php echo $kelas->kelas_id;?>"/>
            </p>
            <p>
                <label>Jam Mulai</label>
                <select class="inline-field size5" name="mulai_jam">
                    <?php for($i=6;$i<24;$i++):?>
                    <option value="<?php echo $i;?>"><?php echo str_pad($i, 2,"0",STR_PAD_LEFT);?></option>
                    <?php endfor;?>
                </select>
                <select class="inline-field size5" name="mulai_menit">
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>
            </p>
            <p>
                <label>Jam Selesai</label>
                <select class="inline-field size5" name="selesai_jam">
                    <?php for($i=6;$i<24;$i++):?>
                    <option value="<?php echo $i;?>"><?php echo str_pad($i, 2,"0",STR_PAD_LEFT);?></option>
                    <?php endfor;?>
                </select>
                <select class="inline-field size5" name="selesai_menit">
                    <option value="00">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>
                <span class="clear"></span>
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

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Kelas Pertemuan</h2>
    </div>
    <!-- End Box Head -->	

    <!-- Table -->
    <div class="table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Status</th>
                <th class="center" colspan="2">Action</th>
            </tr>
            <?php $i=0;?>
            <?php foreach($pertemuan->result() as $g):?>
            <tr <?php echo (($i++%2)!=0)?'class="odd"':'';?>>
                <td><?php echo $i;?></td>
                <td><?php echo $g->kelas_pertemuan_date;?></td>
                <td><?php echo $g->kelas_pertemuan_jam_mulai;?></td>
                <td><?php echo $g->kelas_pertemuan_jam_selesai;?></td>
                <td>
                    <?php echo $g->kelas_pertemuan_status_title;?>
                </td>
			<td class="center">
                    <a href="<?php echo base_url();?>admin/kelas/edit_kelas_pertemuan/<?php echo $g->kelas_pertemuan_id;?>" class="ico edit">edit</a>
                </td>
                <td class="center">
                    <a href="<?php echo base_url();?>admin/kelas/delete_kelas_pertemuan/<?php echo $g->kelas_pertemuan_id;?>" class="ico del">delete</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>

    </div>
    <!-- Table -->

</div>
<!-- End Box -->

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Feedback</h2>
    </div>
    <!-- End Box Head -->	

    <!-- Table -->
    <div class="form">
        <p>
            <label>Send Request Feedback</label>
            <a href="<?php echo base_url().'admin/kelas/request_feedback/'.$kelas->kelas_id;?>" >
                <button class="button">
                    Request Feedback
                </button>
            </a>
		  &nbsp;&nbsp;&nbsp;
		  <a href="<?php echo base_url().'admin/kelas/add_feedback/'.$kelas->kelas_id;?>" >
                <button class="button">
                    Add Feedback
                </button>
            </a>
        </p>
	   <br/>
	   <table cellspacing="10">
		<tr>
			<th>No.</th>
			<th>Pertanyaan</th>
			<th>Feedback dari Murid</th>
			<th>Skor Feedback</th>
		</tr>
		<?php 
			$i = 1;
			if($feedback->num_rows() > 0) { 
			foreach($feedback->result() as $row):
		?>
		<tr>
			<td class="center"><?php echo $i++;?></td>
			<td><?php echo $row->feedback_question_title;?></td>
			<td style="padding-left:22px;"><?php echo $row->feedback_answer_title;?></td>
			<td class="center"><?php $score = floatval($row->feedback_answer_score);
						  $duration = intval($kelas->kelas_total_jam);
						  if($row->feedback_answer_sort <= 3){
							$rate = -($score) * $duration;
						 }else{
							$rate = $score * $duration;
						 }
						  echo $rate;
				?>
			</td>
		</tr>
		<?php $total_feedback[]= $rate;?>
		<?php endforeach;?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<?php $avg1 = ($total_feedback[0]+$total_feedback[1]+$total_feedback[2]+$total_feedback[3])/4;?>
			<?php $avg2 = ($avg1+$total_feedback[4]+$total_feedback[5])/3;?>
			<td style="padding-left:22px;"><strong>Total Skor Feedback</strong></td>
			<td class="center"><strong><?php echo round($avg2, 2);?></strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="padding-left:22px;"><strong>Rating Guru</strong></td>
			<td class="center"><strong><?php echo floatval($kelas->guru_rating);?></strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="padding-left:22px;"><strong>Total Rating Guru</strong></td>
			<td class="center"><strong><?php $total_rate = floatval($kelas->guru_rating) + $avg2; echo round($total_rate, 2);?></strong></td>
		</tr>
		<?php } else { ?>
		<tr>
			<td class="center">-</td>
			<td class="center">-</td>
			<td>Belum ada feedback dari murid</td>
			<td class="center">0</td>
		</tr>
		<?php } ?>
	   </table>
        <br/><br/>
        <p>
            <label>Testimoni</label>
            <textarea class="field size1" rows="10" cols="30" name="testimoni" disabled><?php echo $kelas->kelas_testimoni;?></textarea>
        </p>
	   
	   <form action="<?php echo base_url().'admin/kelas/update_rating/'.$kelas->guru_id; ?>" method="post">
		<?php if($feedback->num_rows() > 0) { ?>
		<input type="hidden" id="skor" name="skor" value="<?php echo round($total_rate, 2);?>"/>
		<input type="hidden" id="kelas_id" name="kelas_id" value="<?php echo $kelas->kelas_id;?>"/>
		<?php }else{ ?>
		<input type="hidden" id="skor" name="skor" value=""/>
		<input type="hidden" id="kelas_id" name="kelas_id" value="<?php echo $kelas->kelas_id;?>"/>
		<?php }?>
		 <div class="buttons">
               <input type="submit" class="button" value="Update Rating" />
           </div>
	   </form>
    </div>
</div>