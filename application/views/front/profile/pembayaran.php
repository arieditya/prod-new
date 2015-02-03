<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/profile/pembayaran" />
</head>
</body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-guru-header">
                <div id="profile-guru-header-wrap">
                    STATUS PEMBAYARAN
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div class="header">
                            <p class="text-13 justify">Ini adalah status pembayaran Anda. Guru akan dibayar sesuai dengan biaya yang disepakati sebesar 50% setelah melakukan pertemuan belajar pertama dengan murid, dan sisa 50% lagi akan dibayar di akhir setiap paket belajar.</p>
				    
				    </div>
                        <div class="content">
                         <?php foreach($kelas->result() as $row):?>
						<div class="bg-kelas-rating">
							<p>
							<strong>ID Kelas</strong>: <a class="normal-link bold" href="<?php echo base_url();?>profile/kelas/<?php echo $row->kelas_id;?>"><?php echo $row->kelas_id;?></a><br/>
							<strong>Mata Pelajaran</strong>: <?php echo $row->matpel_title;?><br/>
							<strong>Tingkat</strong>: <?php echo $row->jenjang_pendidikan_title;?><br/>
							<strong>Nama Murid</strong>: <?php echo $row->murid_nama;?><br/>
							<strong>Tanggal Kelas Dimulai</strong>: <?php echo $row->kelas_mulai;?>
							</p>
						</div>
                            <table id="profile-rating-table" >
                                <thead>
                                    <th class="w20 center">NO.</th>
                                    <th class="center">JUMLAH JAM</th>
                                    <th class="center" width="250px">KETERANGAN</th>
                                    <th class="center" width="100px">TOTAL HARGA</th>
                                    <th class="center" width="100px">JUMLAH TERBAYAR</th>
                                </thead>
                                <tbody>
                                    <tr style="font-size: 0.8em">
								<td>1</td>
                                        <td rowspan="2"><?php echo $row->kelas_total_jam;?></td>
                                        <td>Pembayaran guru sebesar 50% dari pertemuan pertama paket belajar</td>
								<?php $total_harga = $row->kelas_total_jam * $row->kelas_harga * 0.8;?>
                                        <td rowspan="2">Rp <?php echo number_format($total_harga, 0, '', '.');?></td>
                                        <td>
								<?php if($row->kelas_pembayaran_guru_setengah > 0){ ?>
								Rp <?php echo number_format($row->kelas_pembayaran_guru_setengah, 0, '', '.');?>
								<?php } else { ?>
								<span class="red-notif"><i>Belum dibayar</i></span>
								<?php } ?>
								</td>
                                    </tr>
							 <tr style="font-size: 0.8em">
								<td>2</td>
                                        <td>Pembayaran guru sebesar 50% dari akhir paket belajar</td>
                                        <td>								
								<?php if($row->kelas_pembayaran_guru_penuh > 0){ ?>
								Rp <?php echo number_format($row->kelas_pembayaran_guru_penuh, 0, '', '.');?>
								<?php } else { ?>
								<span class="red-notif"><i>Belum dibayar</i></span>
								<?php } ?>
								</td>
                                    </tr>
                                </tbody>
                            </table>
					   <div class="blank" style="height:20px;"></div>
					 <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <div class="clear" ></div>
                
            </div>
            <div class="blank" style="height:10px;"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>