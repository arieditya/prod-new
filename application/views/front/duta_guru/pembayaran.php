<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/duta_guru/pembayaran" />
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-dutaguru-header" class="profile-guru-header">
                <div id="profile-duta-header-wrap">
                    STATUS PEMBAYARAN
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div class="header">
					   <p class="text-13">Ini adalah status pembayaran <i>referral</i> Anda dari guru dan murid yang menggunakan kode <i>Referral</i> Anda dan melakukan program paket belajar. </p>
                            <p class="text-13">
                                <i>Referral</i> GURU:<br/>
                                Untuk setiap guru yang daftar dengan kode <i>referral</i> duta, duta akan dapat 3% dari kelas pertama guru
                            </p>
                        </div>
                        <div class="content">
				         <table id="profile-rating-table" >
                                <thead>
                                    <th class="w20 center">NO</th>
                                    <th class="w20 center">ID KELAS</th>
                                    <th width="100px" class="center">KELAS (JENJANG PENDIDIKAN)</th>
                                    <th class="center" width="70px">NAMA GURU</th>
                                    <th class="center">KETERANGAN</th>
                                    <th class="w60 center">JUMLAH TERBAYAR</th>
                                </thead>
				        <?php $i = 1;?>
					   <?php if($pembayaran_dutaguru->num_rows() > 0){ ?>
					   <?php foreach($pembayaran_dutaguru->result() as $p){ ?>
                                <tbody>
                                    <tr style="font-size: 0.8em">
                                        <td class="center"><?php echo $i++;?></td>
                                        <td class="center"><?php echo $p->kelas_id;?></td>
                                        <td class="center"><?php echo $p->matpel_title."<br/>(".$p->jenjang_pendidikan_title.")";?></td>
                                        <td class="center"><?php echo $p->guru_nama; ?></td>
                                        <td class="center"><?php if($p->kelas_pembayaran_duta_guru > 0){ echo "Pembayaran kode <i>referral</i> Anda dari kelas pertama guru";} else { echo "<span class='red-notif'><i>Belum dibayar</i></span>";}?></td>
                                        <td>Rp <?php echo number_format($p->kelas_pembayaran_duta_guru, 0, '', '.');?></td>
                                    </tr>
                                </tbody>
					   <?php } ?>
					     </table>
					   <?php } else { ?>
					   <p class="bold">Belum ada transaksi dari penggunaan kode <i>referral</i> Anda</p>
					   <?php } ?>
                        </div>
				    <div class="blank" style="height:10px;"></div>
					   <p class="text-13">
                                <i>Referral</i> MURID:<br/>
						  Untuk setiap transaksi dari murid, jika ada kode <i>referral</i> duta, duta akan dapat 3% dari transaksi.
                            </p>
				      <div class="content">
					   <?php if($pembayaran_dutamurid->num_rows() > 0){ ?>
                            <table id="profile-rating-table" >
                                <thead>
                                    <th class="w20">NO</th>
                                    <th class="w20">ID KELAS</th>
                                    <th width="100px" class="center">KELAS (JENJANG PENDIDIKAN)</th>
                                    <th class="center" width="70px">NAMA MURID</th>
                                    <th class="center">KETERANGAN</th>
                                    <th class="w60 center">JUMLAH TERBAYAR</th>
                                </thead>
                                <tbody>
							<?php $i = 1;?>
							<?php foreach($pembayaran_dutamurid->result() as $row):?>
                                    <tr style="font-size: 0.8em">
                                        <td class="center"><?php echo $i++;?></td>
                                        <td class="center"><?php echo $row->kelas_id;?></td>
                                        <td class="center"><?php echo $row->matpel_title."<br/>(".$row->jenjang_pendidikan_title.")";?></td>
                                        <td class="center"><?php echo $row->murid_nama; ?></td>
                                        <td class="center"><?php if ($row->kelas_pembayaran_duta_murid > 0){ echo "Pembayaran kode <i>referral</i> Anda dari murid";} else { echo "<span class='red-notif'><i>Belum dibayar</i></span>";}?></td>
                                        <td>Rp <?php echo number_format($row->kelas_pembayaran_duta_murid, 0, '', '.');?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
					   <?php } else { ?>
					   <p class="bold">Belum ada transaksi dari penggunaan kode <i>referral</i> Anda</p>
					   <?php } ?>
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
</body>
</html>