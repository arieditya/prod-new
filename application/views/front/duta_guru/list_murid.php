<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/duta_guru/murid" />
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-dutaguru-header" class="profile-guru-header">
                <div id="profile-duta-header-wrap">
                    LIST MURID
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
				<p class="text-13">Ini adalah list murid yang menggunakan Kode <i>Referral</i> Anda</p>
                    <?php foreach ($murid->result() as $row): ?>
				<div class="bg-kelas-rating">
					<p class="text-13"><strong>ID Murid</strong>: <?php echo $row->murid_id;?><br/>
					<strong>Nama Murid</strong>: <?php echo $row->murid_nama;?></p>
				</div>
				<?php $n=1;?>
			     <?php $kelas = $this->kelas_model->get_duta_murid_in_kelas($this->session->userdata('duta_guru_id'), $row->murid_id);?>
				<?php if($kelas->num_rows() > 0){ ?>
                    <table id="profile-rating-table">
                        <thead class="center">
                            <th>NO</th>
					   <th>ID KELAS</th>
					   <th>MATA PELAJARAN (JENJANG PENDIDIKAN)</th>
                        </thead>
                        <tbody>
				    <?php foreach($kelas->result() as $k){ ?>
                                <tr>
							 <td class="center"><?php echo $n; ?></td>
                                    <td><?php echo $k->kelas_id; ?></td>
                                    <td><?php echo $k->matpel_title." (".$k->jenjang_pendidikan_title.")"; ?></td>
                                </tr>
					<?php $n++; ?>
					<?php } ?>
                        </tbody>
                    </table>
				<?php } else { ?>
					<table id="profile-rating-table">
						<thead class="center">
							<th>STATUS</th>
						</thead>
						<tbody>
                                <tr>
							 <td class="center">Belum ada kelas dari murid ini</td>
                                </tr>
						</tbody>
					</table>
					<?php } ?>
				<div class="blank" style="height:20px;"></div>
				 <?php endforeach; ?>
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