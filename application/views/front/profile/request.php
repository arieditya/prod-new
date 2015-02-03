<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/profile/request" />
</head>
</body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-guru-header">
                <div id="profile-guru-header-wrap">
                    STATUS REQUEST GURU
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div class="header">
					   <p class="text-13 justify">Silakan klik di kode <i>request</i> untuk memberi respon Anda terhadap <i>request</i> dari murid. Mohon pelajari dengan seksama masing-masing rincian <i>request</i>, seperti: mata pelajaran, frekuensi pertemuan tiap minggu, <i>budget</i> dan preferensi jadwal dari murid. Harap diketahui bahwa respon yang Anda berikan terhadap setiap <i>request</i> bersifat final dan tidak bisa diubah lagi.</p>
                        </div>
                        <div class="content">
                            <table id="profile-rating-table">
                                <thead>
                                    <th class="center">KODE <i>REQUEST</i></th>
                                    <th class="center">PELAJARAN & TINGKAT</th>
                                    <th class="center" width="60px" title="Frekuensi pertemuan per minggu">TOTAL PERTEMUAN</th>
							 <th>JADWAL PILIHAN MURID</th>
                                    <th class="center">RESPON ANDA</th>
                                    <th class="center">STATUS RESPON <i>REQUEST</i></th>
                                    <th class="center">STATUS <i>REQUEST</i></th>
                                </thead>
                                <tbody>
                                    <?php foreach($request->result() as $row):?>
                                    <?php if($row->requested_by == 1){ ?>
							 <?php $jyt = $this->request_model->convert_jadwal($row->request_jadwal); ?>
							 <?php $id_guru = $this->session->userdata('guru_id'); ?>
							 <?php if($jyt["flag"] == 1) {
							   $dd = array_keys($jyt[$id_guru]);
							   $n = count($dd);
							   $jadwal_kursus = "";
							   for($j=0;$j<$n;$j++){
								$hari = $this->request_model->convert_day($dd[$j]);
								$key = $dd[$j];
								$jam = $this->request_model->convert_hour($jyt[$id_guru][$key]);
								$jadwal_kursus .= $hari ." (". $jam .")<br/>"; 
							   } ?>
					           <?php } ?>
					           <?php } else { ?>
							 <?php $jyt = $this->request_model->convert_jadwal_kursus($row->request_jadwal);?>
							 <?php if($jyt["flag"] == 1) {
								$key = array_keys($jyt);
								$n = count($key); 
								$jadwal_kursus = "";
								if($n >= 1){
									for($j=0;$j<$n-1;$j++){
										$dd = sprintf('%d', $key[$j]);
										$hari = $this->request_model->convert_day($dd);
										$jam = $this->request_model->convert_hour($jyt[$key[$j]]);
										$jadwal_kursus .= $hari." (".$jam.") ";
									}
								}
								$jadwal_pilihan_murid = $jadwal_kursus;
							?>
					           <?php } ?>
							 <?php } ?>
                                    <tr>
                                        <td class="center bold">
                                            <a href="<?php echo base_url().'profile/update_request/'.$row->request_id;?>" class="normal-link">
                                                <?php echo $row->request_code;?>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="text-13"><?php echo $row->matpel_title;?></span><br/>
                                            <span class="text-13 bold"><?php echo $row->jenjang_pendidikan_title;?></span>
                                        </td>
                                        <td><?php echo $row->request_frekuensi;?> pertemuan</td>
								<?php if($row->requested_by == 1){ ?>
									<td><?php echo $jadwal_kursus; ?></td>
								<?php } else { ?>
									<td><?php echo $jadwal_pilihan_murid; ?></td>
								<?php } ?>
                                        <td class="bold fcrgs<?php echo $row->request_guru_status_id;?>"><?php echo $row->request_guru_status_title;?></td>
                                        <td><?php if($row->request_status == 0){ echo "<i>Request</i> ditutup";} else{ echo "<i>Request</i> dibuka";}?></td>
                                        <td><?php if($row->request_pilih_status == 1){ echo "<i>Request</i> terpenuhi";} else{ echo "<i>Request</i> belum terpenuhi";}?></td>
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