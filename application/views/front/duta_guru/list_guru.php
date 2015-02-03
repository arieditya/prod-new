<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/duta_guru/guru" />
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-dutaguru-header" class="profile-guru-header">
                <div id="profile-duta-header-wrap">
                    LIST GURU 
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
				<p class="text-13">Ini adalah list guru yang menggunakan Kode <i>Referral</i> Anda</p>
                    <table id="profile-rating-table">
                        <thead class="center">
                            <th>NO</th>
                            <th>ID GURU</th>
                            <th>NAMA</th>
                            <th>ID KELAS (MATA PELAJARAN)</th>
                        </thead>
                        <tbody>
				        <?php $n=1;?>
					   <?php foreach ($kelas->result() as $kls): ?>
							<?php $arr[] = $kls->guru_id;?>
					   <?php endforeach; ?>
                            <?php foreach ($guru->result() as $row): ?>
					   <?php if(in_array($row->guru_id, $arr) == FALSE){ ?>
                                <tr>
						      <td class="center"><?php echo $n++; ?></td>
                                    <td class="center"><?php echo $row->guru_id;?></td>
                                    <td><?php echo $row->guru_nama; ?></td>
							 <td>Belum ada kelas untuk guru ini</td>
                                </tr>
					   <?php } ?>
                            <?php endforeach; ?>
					   <?php foreach ($kelas->result() as $k): ?>
                                <tr>
						      <td class="center"><?php echo $n++; ?></td>
                                    <td class="center"><?php echo $k->guru_id;?></td>
                                    <td><?php echo $k->guru_nama; ?></td>
							 <td><?php echo $k->kelas_id ." (".$k->matpel_title.")"; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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