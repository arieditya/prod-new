<?php
tcpdf();
//echo($_SERVER['REQUEST_URI']);
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "E-Ticket Essential Skills Series Vol. 03";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title);
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
    $content .= '<p>
				<b>Tiket Essential Skills Series Vol. 03</b><br/><br/>
				<b>Hari/Tanggal</b> : Jumat, 13 Februari 2015<br/>
				<b>Waktu</b> : Pukul 15.00 WIB s/d 18.00 WIB<br/>
				<b>Alamat</b> : Auditorium SBM ITB, 2nd Floor
				</p>
				<br/>
				<table class="invoice">
                        <tr>
                            <td colspan="2" width="32%">Nama Peserta</td>
                            <td width="10px">: </td>
                            <td width="250px">'.$registrasi->nama_registrasi.'</td>
					   <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">No. Telepon</td>
                            <td>: </td>
					   <td>'.$registrasi->telepon_registrasi.'</td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr>
                            <td colspan="2">Institusi</td>
                            <td>: </td>
					   <td>'.$registrasi->institusi_registrasi.'</td>
                            <td colspan="3">&nbsp;</td>
                        </tr>
				    <tr><td>&nbsp;</td></tr>
				</table>
               <div class="blank" style="height: 100px;"></div>
			<p style="font-size: 24px"><i>* Undangan berlaku untuk satu orang</i></p>
			<p style="font-size: 24px"><i>* Undangan harap dibawa sebagai bukti registrasi</i></p>
			<div class="blank" style="height: 20px;"></div>';
ob_end_clean();
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
?>