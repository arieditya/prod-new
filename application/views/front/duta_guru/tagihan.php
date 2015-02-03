<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
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
    $("#registrasi-murid-form").validationEngine('attach');
    update_provinsi();
}); 

</script>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="registrasi-dutaguru">
            <div id="registrasi-dutaguru-header">
                <div id="registrasi-dutaguru-header-wrap">
			 BUKTI PEMBAYARAN DUTA
                </div>
            </div>
            <div id="registrasi-dutaguru-content" class="dutaguru-content">
                <div class="blank" style="height: 20px;"></div>
			 <div id="invoice-page">
                    <table class="invoice">
				     <tr>
						<td colspan="5" width="850px">&nbsp;</td>
						<td colspan="2"><a href="<?php echo base_url()."duta_guru/simpan_pdf/".$kelas->kelas_id;?>/<?php echo $mode;?>" title="Simpan format PDF"><img src="<?php echo base_url()."images/save.png";?>"/></a>&nbsp;&nbsp;&nbsp;<a href="javascript:window.print()" title="Cetak"><img src="<?php echo base_url()."images/printer11.png";?>"/></a></td>
				    </tr>
                        <tr>
                            <td width="200px"><img src="<?php echo base_url()."images/footer-logo-color.png";?>" width="120px"/></td>
					   <td colspan="3" width="80px">&nbsp;</td>
                            <td colspan="3">
						   <img src="<?php echo base_url()."images/tentangkami/tentangkami-duta.png";?>"/><br/>
					        <strong>BUKTI PEMBAYARAN DUTA <?php if($mode == "guru"){ echo "GURU"; } else { echo "MURID";} ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" width="250px">PT. RUANG RAYA INDONESIA</td>
                            <td colspan="2">&nbsp;</td>
					   <td colspan="3">&nbsp;</td>
                        </tr>                        
				    <tr>
                            <td colspan="2" >d/a: Indonesian Future Leaders</td>
					   <td colspan="2">&nbsp;</td>
					   <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr>
				        <td colspan="2" >Ruangan A.220</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="150px">Tanggal</td>
					   <td>: </td>
					   <td><?php date_default_timezone_set("Asia/Jakarta");
							echo date("d/m/Y");
							?>
					   </td>
				    </tr>
				    <tr>
				        <td colspan="2">Universitas Siswa Bangsa Internasional</td>
					   <td colspan="2">&nbsp;</td>
					   <td>No. Tagihan</td>
					   <td>: </td>
					   <td>Ruangguru/<?php echo date("Y")?>/<?php if($mode == "guru"){ echo "duta_guru"; } else { echo "duta_murid";} ?>/</td>
				    </tr>
				    <tr>
					    <td colspan="2">Jl. MT. Haryono Kav. 58-60</td>
					    <td colspan="2">&nbsp;</td>
					    <td>ID <?php if($mode == "guru"){ echo "Guru"; } else { echo "Murid";} ?></td>
					    <td>: </td>
					    <td><?php if($mode == "guru"){ echo $kelas->guru_id; } else { echo $kelas->murid_id;} ?></td>
				    </tr>
				    <tr>
					   <td colspan="2">Pancoran, Jakarta Selatan</td>
					   <td colspan="2">&nbsp;</td>
					   <td>ID <?php if($mode == "guru"){ echo "Duta Guru"; } else { echo "Duta Murid";} ?></td>
					   <td>: </td>
					   <td><?php if($mode == "guru"){ echo $kelas->duta_guru_id; } else { echo $kelas->duta_murid_id;} ?></td>
				    </tr>
				    <tr>
					   <td colspan="2">Indonesia, 12780</td>
					   <td colspan="2">&nbsp;</td>
					   <td>ID Kelas</td>
					   <td>: </td>
					   <td><?php echo $kelas->kelas_id; ?></td>
				    </tr>				    
				    <tr>
					   <td colspan="2">E-mail: bayar@ruangguru.com</td>
					   <td colspan="2">&nbsp;</td>
					   <td>Mata Pelajaran</td>
					   <td>: </td>
					   <td><?php echo $request->matpel_title; ?></td>
				    </tr>				    
				    <tr>
					   <td colspan="2">Telepon: +6221 - 9200 3040</td>
					   <td colspan="2">&nbsp;</td>
					   <td>Jenjang Pendidikan</td>
					   <td>: </td>
					   <td><?php echo $request->jenjang_pendidikan_title; ?></td>
				    </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2" width="32%">Nama Duta</td>
                            <td width="10px">: </td>
                            <td><?php echo $kelas->duta_guru_nama;?></td>
					   <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr>
                            <td colspan="2">Alamat</td>
                            <td>: </td>
					   <td><?php echo $kelas->duta_guru_alamat;?></td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr><td>&nbsp;</td></tr>
                    </table>
				<table class="invoice-content">
					<tr>
						<th width="40px" class="center bordering">No.</th>
						<th width="700px" class="center bordering" colspan="2">Deskripsi</th>
						<th width="130px" class="center bordering" colspan="2">Total</th>
					</tr>
					<?php if($mode == "guru"){ ?>
						<tr>
							<td class="center bordering"><?php echo $i=1; ?></td>
							<td class="bordering" colspan="2"><?php echo "Pembayaran <i>referral fee </i>dari guru: ".$kelas->guru_nama;?></td>
							<td class="center bordering" colspan="2">Rp <?php echo $kelas->kelas_pembayaran_duta_guru; ?>,-</td>
						</tr>
					<?php }else{ ?>
						<tr>
							<td class="center bordering"><?php echo $i=1; ?></td>
							<td class="bordering" colspan="2"><?php echo "Pembayaran <i>referral fee </i>dari murid: ".$kelas->murid_nama;?></td>
							<td class="center bordering" colspan="2">Rp <?php echo $kelas->kelas_pembayaran_duta_murid; ?>,-</td>
						</tr>
					<?php }?>
					
					<tr>
						<td class="center bordering" id="tdstyle-1">&nbsp;</td>
						<td class="bordering" colspan="2" id="tdstyle-2">&nbsp;</td>
						<td class="center bordering" id="tdstyle-7">Total:</td>
						<td class="center bordering" id="tdstyle-4">Rp <?php echo ($kelas->kelas_pembayaran_duta_murid + $kelas->kelas_pembayaran_duta_guru); ?>,-</td>
					</tr>
				</table>
                <div class="blank" style="height: 20px;"></div>
			 <div class="bank">
					<p>Pembayaran dikirimkan dari salah satu rekening di bawah ini:</p>
					<span class="bankpad1">Bank</span>
					<span>: </span>
					<span class="an-bank bold">Bank Mandiri</span><br/>
					<span>No. Rekening</span>
					<span>: </span>
					<span class="an-bank bold">157-00-0398209-8</span><br/>
					<span class="bankpad2">Atas nama</span>
					<span>: </span>
					<strong>PT. RUANG RAYA INDONESIA</strong><br/>
			 </div>
			 <div class="blank" style="height: 20px;"></div>
			 <div class="bank">
					<span class="bankpad1">Bank</span>
					<span>: </span>
					<span class="an-bank bold">Bank BNI</span><br/>
					<span>No. Rekening</span>
					<span>: </span>
					<span class="an-bank bold">033-1469330</span><br/>
					<span class="bankpad2">Atas nama</span>
					<span>: </span>
					<strong>PT. RUANG RAYA INDONESIA</strong><br/>
			 </div>
			<div class="blank" style="height: 20px;"></div>
			<p>Konfirmasi telah menerima pembayaran dengan menghubungi Tim Ruangguru dengan mengirimkan email ke: <a href="mailto:bayar@ruangguru.com" class="normal-link">bayar@ruangguru.com</a>.</p>
			<p class="text-11"><i>* Apabila dalam waktu 2x24 jam setelah bukti pembayaran ini diterima tetapi pembayaran belum diterima, harap segera menghubungi Tim Ruangguru di email: <a href="mailto:bayar@ruangguru.com" class="normal-link">bayar@ruangguru.com</a> atau menghubungi kami langsung di nomor telepon +6221-9200-3040.</i></p>
			<div class="blank" style="height: 20px;"></div>
		   </div>
            </div>
        </div>
        <div class="blank" style="height: 30px;"></div>
    </div>
</div>