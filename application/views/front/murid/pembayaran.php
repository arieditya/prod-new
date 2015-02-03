<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/murid/pembayaran" />
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-murid-header" class="profile-guru-header">
                <div id="profile-murid-header-wrap">
                    STATUS PEMBAYARAN
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div class="header">
                            <p class="text-13 justify">
						Setelah melakukan proses belajar mengajar pada pertemuan pertama, Anda akan menerima <i>invoice</i> (tagihan) dari kami. Selanjutnya, Anda dipersilahkan melakukan transaksi pembayaran (paling lambat 2x24 jam setelah <i>invoice</i> diterima) ke salah satu opsi alamat rekening yang tertera di <i>invoice</i>.
                            </p>
                            <p class="text-13 justify">
						Setelah melakukan transfer pembayaran, kirimkan bukti transfer melalui email ke <a href="mailto:bayar@ruangguru.com" class="normal-link bold">bayar@ruangguru.com</a> beserta informasi "Nama lengkap" dan "ID kelas yang dibayar" serta konfirmasi telah melakukan pembayaran melalui email <a href="mailto:bayar@ruangguru.com" class="normal-link bold">bayar@ruangguru.com</a> atau telepon langsung ke nomor <span class="bold blue-text">021-9200-3040</span>.
                            </p>
                        </div>
                        <div class="content">
                            <table id="profile-rating-table" >
                                <thead>
                                    <th class="w20 center">ID KELAS</th>
                                    <th class="w20 center">JUMLAH JAM</th>
                                    <th class="center">TARIF PER JAM</th>
                                    <th class="center">TOTAL HARGA</th>
                                    <th class="center">TAHAPAN PEMBAYARAN</th>
                                    <th class="center">JUMLAH TERBAYAR PERTAMA</th>
                                    <th class="center">JUMLAH TERBAYAR KEDUA</th>
                                    <th class="center">STATUS</th>
                                </thead>
                                <tbody>
                                    <?php foreach($kelas->result() as $row):?>
                                    <tr style="font-size: 0.8em">
                                        <td class="center">
                                            <a class="normal-link" href="<?php echo base_url();?>murid/kelas/<?php echo $row->kelas_id;?>">
                                                <?php echo $row->kelas_id;?>
                                            </a>
                                        </td>
                                        <td><?php echo $row->kelas_total_jam;?></td>
                                        <td>Rp <?php echo number_format($row->kelas_harga, 0, '', '.');?></td>
                                        <td>Rp <?php echo number_format($row->kelas_total_harga, 0, '', '.');?></td>
                                        <td><?php if ($row->kelas_tahapan_pembayaran == 1){ echo "Langsung";} else { echo "Dua Tahap";}?></td>
                                        <td>Rp <?php echo number_format($row->kelas_pembayaran_murid, 0, '', '.');?></td>
                                        <td>Rp <?php echo number_format($row->kelas_pembayaran_murid_kedua, 0, '', '.');?></td>
                                        <td>
                                            <?php if($row->kelas_pembayaran_status == 2):;?>
                                            <span class="bold fcsp2">SUDAH BAYAR</span>
                                            <?php else:?>
                                            <span class="bold fcsp1">BELUM BAYAR</span>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
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