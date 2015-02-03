<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/murid/kelas" />
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-murid-header" class="profile-guru-header">
                <div id="profile-murid-header-wrap">
                    STATUS KELAS SAAT INI
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div class="header">
                            <p class="text-13 justify">Ini adalah status kelas Anda saat ini, silahkan dilihat dengan seksama. Apabila terjadi kesalahan segera hubungi Tim Ruangguru di e-mail: <span class="bold"><a class="normal-link" href="maito:info@ruangguru.com">info@ruangguru.com</a></span> atau menghubungi kami langsung di nomor <span class="bold blue-text">021 9200 3040</span>.</p>
                        </div>
                        <?php foreach($kelas->result() as $k):?>
                        <div class="content">
                            <table id="profile-rating-table">
                                <thead>
                                    <tr style="background-color: #99d6e4;">
                                        <td colspan="4">
                                            <span class="bold">Nama Guru :</span> <?php echo $k->guru_nama;?><br/>
                                            <span class="bold">Mata Pelajaran :</span> <?php echo $k->matpel_title;?><br/>
                                            <span class="bold">Tingkat :</span> <?php echo $k->jenjang_pendidikan_title;?><br/>
                                            <span class="bold">Tanggal Kelas Dimulai :</span> <?php echo $k->kelas_mulai;?><br/>
								    <?php $req = $this->request_model->get_request_by_id($k->request_id);?>
                                            <span class="bold">Kode <i>Request</i> :</span> <?php echo $req->request_code;?>
                                        </td>
								<td><span class="bold">Status Kelas:</span><br/><span class="<?php if($k->kelas_status == 0){ echo "red-notif"; }?>"><?php if($k->kelas_status == 1){ echo "Kelas masih berlangsung";} else { echo "Kelas sudah selesai"; }?></span></td>
                                    </tr>
                                    <tr>
                                        <th class="center">NO</th>
                                        <th>TANGGAL PERTEMUAN</th>
                                        <th class="w40 center">JAM MULAI</th>
                                        <th class="w40 center">JAM SELESAI</th>
                                        <th class="center">STATUS KELAS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0;?>
                                    <?php foreach($this->kelas_model->get_kelas_pertemuan($k->kelas_id)->result() as $row):?>
                                    <tr>
                                        <td class="center">
                                            <?php echo ++$i;?>
                                        </td>
								<?php 
									$dmy = $row->kelas_pertemuan_date;
									$day = date("l", strtotime($dmy));
									$trim_dmy = explode("-", $dmy);
									$dd = $this->request_model->day_to_hari($day);
									$mm = $this->request_model->convert_month($trim_dmy[1]);
								?>
                                        <td style="text-align: left;"><?php echo $dd.", ".$trim_dmy[2]." ".$mm." ".$trim_dmy[0]; ?></td>
                                        <td><?php echo date("H:i", strtotime($row->kelas_pertemuan_jam_mulai));?></td>
                                        <td><?php echo date("H:i", strtotime($row->kelas_pertemuan_jam_selesai));?></td>
                                        <td><?php echo $row->kelas_pertemuan_status_title;?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
					   <br/>
					   <?php if($k->kelas_feedback_status == 0){ ?>
					   <b><a href="<?php echo base_url().'murid/kelas_feedback/'.$k->kelas_id;?>" class="normal-link">Berikan <i>feedback</i> untuk kelas ini</a></b>
					   <?php } ?>
                            <div class="blank" style="height:20px;"></div>
                        </div>
                        <?php endforeach;?>
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