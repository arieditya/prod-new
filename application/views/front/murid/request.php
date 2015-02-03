<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/murid/request" />
<script type="text/javascript">
    function close_overlay(){
        $("#default-overlay").hide();
        $("#overlayed-content").hide();
    }
</script>
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-murid-header" class="profile-guru-header">
                <div id="profile-murid-header-wrap">
                    STATUS REQUEST GURU
                </div>
            </div>
            <div id="profile-guru-content">
                <div class="blank" style="height:20px;"></div>
                <div class="profile-content-text">
                    <p>
                        Ini adalah status request guru Anda, silahkan dilihat dengan seksama. Apabila terjadi kesalahan segera hubungi Tim Ruangguru di e-mail: <span class="bold"><a class="normal-link" href="maito:info@ruangguru.com">info@ruangguru.com</a></span> atau menghubungi kami langsung di nomor <span class="bold blue-text">021 9200 3040</span>.
                    </p>
                </div>
                <div class="blank" style="height:20px;"></div>
                <div class="sp10 fs0p7">
                    <table class="default-table">
                        <tr>
                            <th>KODE REQUEST</th>
                            <th>PELAJARAN & TINGKAT</th>
                            <th width="60px" title="Frekuensi pertemuan per minggu">TOTAL PERTEMUAN</th>
					   <th width="120px">JADWAL PILIHAN MURID</th>
                            <th>GURU</th>
                            <th>RESPON RUANGGURU</th>
                            <th>STATUS REQUEST</th>
                        </tr>
					   <?php foreach($request['data'] as $row):?>
                            <?php if($row->requested_by == 1):?>
                            <?php $num_guru = $row->guru->num_rows();$i=0?>
					   <?php $jyt = $this->request_model->convert_jadwal($row->request_jadwal); ?>
                            <?php foreach($row->guru->result() as $guru):?>
					   <?php if($jyt["flag"] == 1) {
							   $dd = array_keys($jyt[$guru->guru_id]);
							   $n = count($dd);
							   $jadwal_kursus = "";
							   for($j=0;$j<$n;$j++){
								$hari = $this->request_model->convert_day($dd[$j]);
								$key = $dd[$j];
								$jam = $this->request_model->convert_hour($jyt[$guru->guru_id][$key]);
								$jadwal_kursus .= $hari ." (". $jam .")<br/>"; 
							   } ?>
					   <?php } else { ?>
					   <?php $jadwal_kursus = $jyt[0];?>
					   <?php } ?>
                                <?php if($i==0):?>
                                <tr>
                                    <td rowspan="<?php echo $num_guru;?>"><?php echo $row->request_code;?></td>
                                    <td rowspan="<?php echo $num_guru;?>">
                                        <span class="fs1p2"><?php echo $row->matpel_title;?></span><br/>
                                        <span class="bold"><?php echo $row->jenjang_pendidikan_title;?></span>
                                    </td>
                                    <td rowspan="<?php echo $num_guru;?>"><?php echo $row->request_frekuensi;?> minggu</td>
							 <td><?php echo $jadwal_kursus; ?></td>
                                    <td class="bold"><a href="<?php echo base_url().'guru/view/'.$guru->guru_id;?>"><?php echo $guru->guru_nama;?></a></td>
                                    <td class="bold fcrgs<?php echo $guru->request_guru_status_id;?>"><?php echo $guru->request_guru_status_title;?></td>
							 <td><?php if ($row->request_status == 0){ echo "<i>Request</i> ditutup";} else { echo "<i>Request</i> dibuka";}?></td>
                                </tr>
                                <?php else:?>
                                <tr>
						      <td><?php echo $jadwal_kursus; ?></td>
                                    <td class="bold"><a href="<?php echo base_url().'guru/view/'.$guru->guru_id;?>"><?php echo $guru->guru_nama;?></a></td>
                                    <td class="bold fcrgs<?php echo $guru->request_guru_status_id;?>"><?php echo $guru->request_guru_status_title;?></td>
							 <td><?php if ($row->request_status == 0){ echo "<i>Request</i> ditutup";} else { echo "<i>Request</i> dibuka";}?></td>
                                </tr>
                                <?php endif;$i++;?>
                            <?php endforeach;?>
                            <?php else:?>
					   <?php $jyt = $this->request_model->convert_jadwal_kursus($row->request_jadwal); ?>
					   <?php $dd = array_keys($jyt);
							   $n = count($dd);
							   $jadwal_kursus = "";
							   for($j=0;$j<$n-1;$j++){
								$hari = $this->request_model->convert_day($dd[$j]);
								$key = $dd[$j];
								$jam = $this->request_model->convert_hour($jyt[$key]);
								$jadwal_kursus .= $hari ." (". $jam .")<br/>"; 
							   }
					   ?>
                            <tr>
                                <td><?php echo $row->request_code;?></td>
                                <td>
                                    <span class="fs1p2"><?php echo $row->matpel_title;?></span><br/>
                                    <span class="bold"><?php echo $row->jenjang_pendidikan_title;?></span>
                                </td>
                                <td><?php echo $row->request_frekuensi;?> minggu</td>
						   <td><?php echo $jadwal_kursus; ?></td>
						   <?php if($row->guru->num_rows() > 0){ ?>
						   <td class="bold fcrgs1">
						   <?php foreach($row->guru->result() as $guru):?>
								 <?php echo $guru->guru_nama; ?><br/>
						   <?php endforeach;?>
						   </td>
						   <td class="bold fcrgs1"><?php echo $guru->request_guru_status_title;?></td>
						   <?php } else { ?>
								<td class="bold fcrgs1">BELUM TERSEDIA</td>
								<td class="bold fcrgs1">-</td>
						   <?php } ?>
                                <td><?php if ($row->request_status == 0){ echo "<i>Request</i> ditutup";} else { echo "<i>Request</i> dibuka";}?></td>
                            </tr>
                            <?php endif;?>
                        <?php endforeach;?>
                    </table>
                </div>
                <div class="blank" style="height:20px;"></div>
            </div>
            <div class="blank" style="height:10px;"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</body>