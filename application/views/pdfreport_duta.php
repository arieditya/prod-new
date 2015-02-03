<?php
if($mode == "murid"){
$title = "BUKTI PEMBAYARAN DUTA MURID";
}else{
$title = "BUKTI PEMBAYARAN DUTA GURU";
}
tcpdf();
//echo($_SERVER['REQUEST_URI']);
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
    // we can have any view part here like HTML, PHP etc
    $content = ob_get_contents();
    if($mode == "murid"){
    $content .= '<table class="invoice">
                        <tr>
                            <td width="218px"></td>
					   <td colspan="3" width="80px">&nbsp;</td>
                            <td colspan="3">
					        <strong>BUKTI PEMBAYARAN DUTA MURID</strong>
                            </td>
                        </tr>
				    <tr>
                            <td colspan="2" width="250px"><strong>PT. RUANG RAYA INDONESIA</strong></td>
                            <td colspan="2">&nbsp;</td>
					   <td colspan="3">&nbsp;</td>
                        </tr>                        
				    <tr>
                            <td colspan="2" >d/a: Indonesian Future Leaders</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">Tanggal</td>
					   <td width="10px">: </td>
					   <td>'.date("d/m/Y").'</td>
                        </tr>
				    <tr>
				        <td colspan="2" >Universitas Siswa Bangsa Internasional, Gedung A R .220</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">No. Tagihan</td>
					   <td width="10px">: </td>
					   <td width="150px">Ruangguru/'.date("Y").'/duta_murid/'.$kelas->kelas_id.'</td>
				    </tr>
				    <tr>
				        <td colspan="2">Jl. MT. Haryono Kav. 58-60, Pancoran</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">ID Duta Murid</td>
					   <td>: </td>
					   <td>'.$kelas->duta_murid_id.'</td>
				    </tr>
				    <tr>
					    <td colspan="2">Jakarta Selatan, Indonesia, 12780</td>
					    <td colspan="2">&nbsp;</td>
					    <td width="80px">ID Murid</td>
					    <td>: </td>
					    <td width="150px">'.$kelas->murid_id.'</td>
				    </tr>
				    <tr>
					   <td colspan="2">Telepon: +6221 - 9200 3040</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">Mata Pelajaran</td>
					   <td>: </td>
					   <td width="150px">'.$kelas->matpel_title.'</td>
				    </tr>
				    <tr>
					   <td colspan="2">E-mail: bayar@ruangguru.com</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">Jenjang Pendidikan</td>
					   <td>: </td>
					   <td width="150px">'.$kelas->jenjang_pendidikan_title.'</td>
				    </tr>				    
				    <tr>
					   <td colspan="2"></td>
					   <td colspan="2">&nbsp;</td>
					   <td></td>
					   <td></td>
					   <td width="150px"></td>
				    </tr>				    
				    <tr>
					   <td colspan="2"></td>
				    </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
				    <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2" width="32%">Nama Duta Murid</td>
                            <td width="10px">: </td>
                            <td width="250px">'.$duta->duta_guru_nama.'</td>
					   <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr>
                            <td colspan="2">Alamat</td>
                            <td>: </td>
					   <td>'.$duta->duta_guru_alamat.'</td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr><td>&nbsp;</td></tr>
				</table>
				<div class="blank" style="height: 80px;"></div>
				<div class="blank" style="height: 80px;"></div>
				<table class="invoice-content" cellpadding="2">
					<tr>
						<th width="20px" style="border:1px solid #000; text-align: center;">No.</th>
						<th width="400px" style="border:1px solid #000; text-align: center;">Deskripsi</th>
						<th width="100px" style="border:1px solid #000; text-align: center;" colspan="3">Total</th>
					</tr>
					<tr>
						<td height="15px" style="border:1px solid #000; text-align: center;">'. $i=1 .'</td>
						<td height="15px" style="border:1px solid #000; text-align: center;">Pembayaran <i>referral fee</i> dari murid '.$kelas->murid_nama.'</td>
						<td height="15px" style="border:1px solid #000; text-align: center;" colspan="3">Rp '.$kelas->kelas_pembayaran_duta_murid.',-</td>
					</tr>
					<tr>
						<td colspan="2"  id="tdstyle-3">&nbsp;</td>
						<td class="right" style="border-left:1px solid #000; border-bottom:1px solid #000; text-align: center;">Total: </td>
						<td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align: center;" colspan="2">Rp '.$kelas->kelas_pembayaran_duta_murid.',-</td>
					</tr>
				</table>
                <div class="blank" style="height: 100px;"></div>
			 <div class="blank" style="height: 100px;"></div>
			 <div class="blank" style="height: 100px;"></div>
			 <div class="blank" style="height: 100px;"></div>
			 
			 <div class="bank">
					<p>Pembayaran dikirimkan dari salah satu rekening di bawah ini:</p>
					<span class="bankpad1">Bank</span>
					<span>: </span>
					<strong>Bank Mandiri</strong><br/>
					<span>No. Rekening</span>
					<span>: </span>
					<strong>157-00-0398209-8</strong><br/>
					<span class="bankpad2">Atas nama</span>
					<span>: </span>
					<strong>PT. RUANG RAYA INDONESIA</strong><br/>
			 </div>
			 <div class="bank">
					<span class="bankpad1">Bank</span>
					<span>: </span>
					<strong>Bank BNI</strong><br/>
					<span>No. Rekening</span>
					<span>: </span>
					<strong>033-1469330</strong><br/>
					<span class="bankpad2">Atas nama</span>
					<span>: </span>
					<strong>PT. RUANG RAYA INDONESIA</strong><br/>
			 </div>
			<p>Konfirmasi telah menerima pembayaran dengan menghubungi Tim Ruangguru dengan mengirimkan email ke: <a href="mailto:bayar@ruangguru.com">bayar@ruangguru.com</a>.</p>
			<p style="font-size: 24px"><i>* Apabila dalam waktu 2x24 jam setelah bukti pembayaran ini diterima tetapi pembayaran belum diterima, harap segera menghubungi Tim Ruangguru di email: <a href="mailto:bayar@ruangguru.com" class="normal-link">bayar@ruangguru.com</a> atau menghubungi kami langsung di nomor telepon +6221-9200-3040.</i></p>
			<div class="blank" style="height: 20px;"></div>';
	    }else{
			    $content .= '<table class="invoice">
                        <tr>
                            <td width="218px"></td>
					   <td colspan="3" width="80px">&nbsp;</td>
                            <td colspan="3">
					        <strong>BUKTI PEMBAYARAN DUTA GURU</strong>
                            </td>
                        </tr>
				    <tr>
                            <td colspan="2" width="250px"><strong>PT. RUANG RAYA INDONESIA</strong></td>
                            <td colspan="2">&nbsp;</td>
					   <td colspan="3">&nbsp;</td>
                        </tr>                        
				    <tr>
                            <td colspan="2" >d/a: Indonesian Future Leaders</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">Tanggal</td>
					   <td width="10px">: </td>
					   <td>'.date("d/m/Y").'</td>
                        </tr>
				    <tr>
				        <td colspan="2" >Universitas Siswa Bangsa Internasional, Gedung A R .220</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">No. Tagihan</td>
					   <td width="10px">: </td>
					   <td width="150px">Ruangguru/'.date("Y").'/duta_guru/'.$kelas->kelas_id.'</td>
				    </tr>
				    <tr>
				        <td colspan="2">Jl. MT. Haryono Kav. 58-60, Pancoran</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">ID Duta Guru</td>
					   <td>: </td>
					   <td>'.$kelas->duta_guru_id.'</td>
				    </tr>
				    <tr>
					    <td colspan="2">Jakarta Selatan, Indonesia, 12780</td>
					    <td colspan="2">&nbsp;</td>
					    <td width="80px">ID Guru</td>
					    <td>: </td>
					    <td width="150px">'.$kelas->guru_id.'</td>
				    </tr>
				    <tr>
					   <td colspan="2">Telepon: +6221 - 9200 3040</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">Mata Pelajaran</td>
					   <td>: </td>
					   <td width="150px">'.$kelas->matpel_title.'</td>
				    </tr>
				    <tr>
					   <td colspan="2">E-mail: bayar@ruangguru.com</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">Jenjang Pendidikan</td>
					   <td>: </td>
					   <td width="150px">'.$kelas->jenjang_pendidikan_title.'</td>
				    </tr>				    
				    <tr>
					   <td colspan="2">Telepon: +6221 - 9200 3040</td>
				    </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
				    <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2" width="32%">Nama Duta Guru</td>
                            <td width="10px">: </td>
                            <td width="250px">'.$kelas->duta_guru_nama.'</td>
					   <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr>
                            <td colspan="2">Alamat</td>
                            <td>: </td>
					   <td>'.$kelas->duta_guru_alamat.'</td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr><td>&nbsp;</td></tr>
				</table>
				<div class="blank" style="height: 80px;"></div>
				<div class="blank" style="height: 80px;"></div>
				<table class="invoice-content" cellpadding="2">
					<tr>
						<th width="20px" style="border:1px solid #000; text-align: center;">No.</th>
						<th width="400px" style="border:1px solid #000; text-align: center;">Deskripsi</th>
						<th width="100px" style="border:1px solid #000; text-align: center;" colspan="3">Total</th>
					</tr>
					<tr>
						<td height="15px" style="border:1px solid #000; text-align: center;">'. $i=1 .'</td>
						<td height="15px" style="border:1px solid #000; text-align: center;">Pembayaran <i>referral fee</i> dari guru '.$kelas->guru_nama.'</td>
						<td height="15px" style="border:1px solid #000; text-align: center;" colspan="3">Rp '.$kelas->kelas_pembayaran_duta_guru.',-</td>
					</tr>
					<tr>
						<td colspan="2"  id="tdstyle-3">&nbsp;</td>
						<td class="right" style="border-left:1px solid #000; border-bottom:1px solid #000; text-align: center;">Total: </td>
						<td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align: center;" colspan="2">Rp '.$kelas->kelas_pembayaran_duta_guru.',-</td>
					</tr>
				</table>
                <div class="blank" style="height: 100px;"></div>
			 <div class="blank" style="height: 100px;"></div>
			 <div class="blank" style="height: 100px;"></div>
			 <div class="blank" style="height: 100px;"></div>
			 
			 <div class="bank">
					<p>Pembayaran dikirimkan dari salah satu rekening di bawah ini:</p>
					<span class="bankpad1">Bank</span>
					<span>: </span>
					<strong>Bank Mandiri</strong><br/>
					<span>No. Rekening</span>
					<span>: </span>
					<strong>157-00-0398209-8</strong><br/>
					<span class="bankpad2">Atas nama</span>
					<span>: </span>
					<strong>PT. RUANG RAYA INDONESIA</strong><br/>
			 </div>
			 <div class="bank">
					<span class="bankpad1">Bank</span>
					<span>: </span>
					<strong>Bank BNI</strong><br/>
					<span>No. Rekening</span>
					<span>: </span>
					<strong>033-1469330</strong><br/>
					<span class="bankpad2">Atas nama</span>
					<span>: </span>
					<strong>PT. RUANG RAYA INDONESIA</strong><br/>
			 </div>
			<p>Konfirmasi telah menerima pembayaran dengan menghubungi Tim Ruangguru dengan mengirimkan email ke: <a href="mailto:bayar@ruangguru.com">bayar@ruangguru.com</a>.</p>
			<p style="font-size: 24px"><i>* Apabila dalam waktu 2x24 jam setelah bukti pembayaran ini diterima tetapi pembayaran belum diterima, harap segera menghubungi Tim Ruangguru di email: <a href="mailto:bayar@ruangguru.com" class="normal-link">bayar@ruangguru.com</a> atau menghubungi kami langsung di nomor telepon +6221-9200-3040.</i></p>
			<div class="blank" style="height: 20px;"></div>';
		}
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>