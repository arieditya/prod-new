<?php
tcpdf();
//echo($_SERVER['REQUEST_URI']);
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "BUKTI PENERIMAAN PEMBAYARAN DARI MURID";
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
    $content .= '<table class="invoice">
                        <tr>
                            <td width="218px"></td>
					   <td colspan="3" width="80px">&nbsp;</td>
                            <td colspan="3">
					        <strong>BUKTI PENERIMAAN PEMBAYARAN DARI MURID</strong>
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
					   <td width="80px">Tanggal Tagihan</td>
					   <td width="10px">: </td>
					   <td>'.date("d/m/Y").'</td>
                        </tr>
				    <tr>
				        <td colspan="2" >Universitas Siswa Bangsa Internasional, Gedung A R. 220</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">No. Tagihan</td>
					   <td width="10px">: </td>
					   <td width="150px">Ruangguru/'.date("Y").'/murid/'.$kelas->kelas_id.'</td>
				    </tr>
				    <tr>
				        <td colspan="2">Jl. MT. Haryono Kav. 58-60, Pancoran</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">ID Murid</td>
					   <td>: </td>
					   <td>'.$kelas->murid_id.'</td>
				    </tr>
				    <tr>
					    <td colspan="2">Jakarta Selatan, Indonesia, 12780</td>
					    <td colspan="2">&nbsp;</td>
					    <td width="80px">ID Kelas</td>
					    <td>: </td>
					    <td>'.$kelas->kelas_id.'</td>
				    </tr>
				    <tr>
					   <td colspan="2">Telepon: +6221 - 9200 3040</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">Mata Pelajaran</td>
					   <td>: </td>
					   <td>'.$kelas->matpel_title.'</td>
				    </tr>
				    <tr>
					   <td colspan="2">E-mail: bayar@ruangguru.com</td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px">Jenjang Pendidikan</td>
					   <td>: </td>
					   <td>'.$kelas->jenjang_pendidikan_title.'</td>
				    </tr>				    
				    <tr>
					   <td colspan="2"></td>
					   <td colspan="2">&nbsp;</td>
					   <td width="80px"></td>
					   <td></td>
					   <td></td>
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
                            <td colspan="2" width="32%">Nama Murid</td>
                            <td width="10px">: </td>
                            <td width="250px">'.$murid->murid_nama.'</td>
					   <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">No. KTP/ KTM/ SIM/ Paspor</td>
                            <td>: </td>
					   <td>'.$murid->murid_nik.'</td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr>
                            <td colspan="2">Alamat</td>
                            <td>: </td>
					   <td>'.$murid->murid_alamat.'</td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr>
                            <td colspan="2">No. Rekening</td>
                            <td>: </td>
					   <td>'.$kelas->kelas_rek_murid.'</td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr>
                            <td colspan="2">Tanggal Verifikasi Pembayaran</td>
                            <td>: </td>
					   <td>'.$kelas->kelas_date_verified.'</td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr><td>&nbsp;</td></tr>
				</table>
				<div class="blank" style="height: 80px;"></div>
				<table class="invoice-content" cellpadding="2">
					<tr>
						<th width="20px" style="border:1px solid #000; text-align: center;">No.</th>
						<th width="250px" style="border:1px solid #000; text-align: center;">Deskripsi</th>
						<th width="80px"  style="border:1px solid #000; text-align: center;">Jumlah Jam</th>
						<th width="80px"  style="border:1px solid #000; text-align: center;">Harga per Jam</th>
						<th width="80px" style="border:1px solid #000; text-align: center;">Total</th>
					</tr>
					<tr>
						<td height="15px" style="border:1px solid #000; text-align: center;">'. $i=1 .'</td>
						<td height="15px" style="border:1px solid #000; text-align: center;">Pembayaran untuk kelas '.$kelas->matpel_title.'</td>
						<td height="15px" style="border:1px solid #000; text-align: center;">'.$kelas->kelas_total_jam.'</td>
						<td height="15px" style="border:1px solid #000; text-align: center;">Rp '.$kelas->kelas_harga.',-</td>
						<td height="15px" style="border:1px solid #000; text-align: center;">Rp '.$kelas->kelas_total_harga.',-</td>
					</tr>
					<tr>
						<td colspan="2"  id="tdstyle-3">&nbsp;</td>
						<td class="right" style="border-left:1px solid #000; border-bottom:1px solid #000; text-align: center;">Total: </td>
						<td style="border-bottom:1px solid #000;">&nbsp;</td>
						<td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align: center;">Rp '.$kelas->kelas_total_harga.',-</td>
					</tr>
				</table>
                <div class="blank" style="height: 100px;"></div>
			 <div class="blank" style="height: 100px;"></div>	 
			 <div class="bank">
					<p>Pembayaran telah dikirimkan ke salah satu rekening di bawah ini:</p>
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
			<p>Terima kasih telah melalukan <i>request</i> guru di Ruangguru</p>
			<div class="blank" style="height: 20px;"></div>';
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>