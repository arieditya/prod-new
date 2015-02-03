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
        <div id="registrasi-murid">
            <div id="registrasi-murid-header">
                <div id="registrasi-murid-header-wrap">
			 TAGIHAN PEMBAYARAN MURID
                </div>
            </div>
            <div id="registrasi-murid-content" class="murid-content">
                <div class="blank" style="height: 20px;"></div>
			 <div id="invoice-page">
                    <table class="invoice">
				     <tr>
						<td colspan="5" width="850px">&nbsp;</td>
						<td colspan="2"><a href="<?php echo base_url()."murid/simpan_pdf/".$kelas->kelas_id;?>" title="Simpan format PDF"><img src="<?php echo base_url()."images/save.png";?>"/></a>&nbsp;&nbsp;&nbsp;<a href="javascript:window.print()" title="Cetak"><img src="<?php echo base_url()."images/printer11.png";?>"/></a></td>
				    </tr>
                        <tr>
                            <td width="200px"><img src="<?php echo base_url()."images/footer-logo-color.png";?>" width="120px"/></td>
					   <td colspan="3" width="80px">&nbsp;</td>
                            <td colspan="3">
						   <img src="<?php echo base_url()."images/tentangkami/tentangkami-murid.png";?>"/><br/>
					        <strong>TAGIHAN PEMBAYARAN MURID</strong>
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
					   <td width="150px">Tanggal Tagihan</td>
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
					   <td>Ruangguru/<?php echo date("Y")?>/murid/</td>
				    </tr>
				    <tr>
					    <td colspan="2">Jl. MT. Haryono Kav. 58-60</td>
					    <td colspan="2">&nbsp;</td>
					    <td>ID Murid</td>
					    <td>: </td>
					    <td><?php echo $kelas->murid_id; ?></td>
				    </tr>
				    <tr>
					   <td colspan="2">Pancoran, Jakarta Selatan</td>
					   <td colspan="2">&nbsp;</td>
					   <td>ID Kelas</td>
					   <td>: </td>
					   <td><?php echo $kelas->kelas_id; ?></td>
				    </tr>
				    <tr>
					   <td colspan="2">Indonesia, 12780</td>
					   <td colspan="2">&nbsp;</td>
					   <td>Mata Pelajaran</td>
					   <td>: </td>
					   <td><?php echo $request->matpel_title; ?></td>
				    </tr>				    
				    <tr>
					   <td colspan="2">E-mail: bayar@ruangguru.com</td>
					   <td colspan="2">&nbsp;</td>
					   <td>Jenjang Pendidikan</td>
					   <td>: </td>
					   <td><?php echo $request->jenjang_pendidikan_title; ?></td>
				    </tr>				    
				    <tr>
					   <td colspan="2">Telepon: +6221 - 9200 3040</td>
					   <td colspan="2">&nbsp;</td>
					   <td>Kelas Mulai</td>
					   <td>: </td>
					   <td><?php echo $kelas->kelas_mulai; ?></td>
				    </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2" width="32%">Nama Murid</td>
                            <td width="10px">: </td>
                            <td><?php echo $murid->murid_nama;?></td>
					   <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr>
                            <td colspan="2">Alamat</td>
                            <td>: </td>
					   <td><?php echo $murid->murid_alamat;?></td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr><td>&nbsp;</td></tr>
                    </table>
				<table class="invoice-content">
					<tr>
						<th width="40px" class="center bordering">No.</th>
						<th width="500px" class="center bordering">Deskripsi</th>
						<th width="130px" class="center bordering">Jumlah Jam</th>
						<th width="130px" class="center bordering">Harga per Jam</th>
						<th width="130px" class="center bordering">Total</th>
					</tr>
					<tr>
						<td class="center bordering"><?php echo $i=1; ?></td>
						<td class="bordering"><?php echo "Pembayaran untuk kelas ".$request->matpel_title." (".$request->guru_nama.")";?></td>
						<td class="center bordering"><?php echo $kelas->kelas_total_jam; ?></td>
						<td class="center bordering">Rp <?php echo $kelas->kelas_harga; ?>,-</td>
						<td class="center bordering">Rp <?php echo $kelas->kelas_pembayaran_murid; ?>,-</td>
					</tr>
					<tr>
						<td colspan="2" id="tdstyle-1">&nbsp;</td>
						<td class="right" id="tdstyle-7">Sub-total: </td>
						<td class="tdstyle-10"></td>
						<td class="center" id="tdstyle-4">Rp <?php echo $kelas->kelas_pembayaran_murid; ?>,-</td>
					</tr>
					<tr>
						<td colspan="2"  id="tdstyle-2">&nbsp;</td>
						<td class="right" id="tdstyle-8">Pajak: </td>
						<td class="tdstyle-10"></td>
						<td class="center" id="tdstyle-5">Rp <?php $n=0; echo $n;?>,-</td>
					</tr>
					<tr>
						<td colspan="2"  id="tdstyle-3">&nbsp;</td>
						<td class="right" id="tdstyle-9">Total: </td>
						<td class="tdstyle-10" id="tdstyle-10"></td>
						<td class="center" id="tdstyle-6">Rp <?php echo (intval($kelas->kelas_pembayaran_murid)+$n); ?>,-</td>
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
					<span class="an-bank bold">PT. RUANG RAYA INDONESIA</span><br/>
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
					<span class="an-bank bold">PT. RUANG RAYA INDONESIA</span><br/>
			 </div>
			<p>Konfirmasi telah menerima pembayaran dengan menghubungi Tim Ruangguru dengan mengirimkan email ke: <a href="mailto:bayar@ruangguru.com" class="normal-link">bayar@ruangguru.com</a>.</p>
			<p class="text-11"><i>* Apabila dalam waktu 2x24 jam setelah bukti pembayaran ini diterima tetapi pembayaran belum diterima, harap segera menghubungi Tim Ruangguru di email: <a href="mailto:bayar@ruangguru.com" class="normal-link">bayar@ruangguru.com</a> atau menghubungi kami langsung di nomor telepon +6221-9200-3040.</i></p>
			<div class="blank" style="height: 20px;"></div>
		   </div>
            </div>
        </div>
        <div class="blank" style="height: 30px;"></div>
    </div>
</div>