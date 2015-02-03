<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/profile/update_request" />
</head>
</body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-guru-header">
                <div id="profile-guru-header-wrap">
                    UPDATE REQUEST (<?php echo strtoupper($request->request_code); ?>)
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <?php if ($this->session->flashdata('update_request_notif')): ?>
                        <div class="profile-notif">
                            <?php echo $this->session->flashdata('update_request_notif'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="blank" style="height: 20px;"></div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Respon Saya</span>
                        </div>
                        <div class="content">
                            <form class="profile-form" action="<?php echo base_url(); ?>profile/update_request_submit" method="post">
                                <table>
                                    <tr>
                                        <td style="width: 180px;">Respon Saya: </td>
                                        <td>
                                            <p class="bold fcrgs<?php echo $request->request_guru_status_id;?>"">
                                                <?php echo $request->request_guru_status_title;?>
                                            </p>
                                            <input type="hidden" name="id" value="<?php echo $request->request_id;?>"/>
                                        </td>
                                    </tr>
							<?php if($request->request_status == 1){ ?>
                                    <tr>
                                        <td>Ubah Respon Saya: </td>
                                        <td>
                                            <select name="status">
                                                <?php foreach($status->result() as $row):?>
                                                <option value="<?php echo $row->request_guru_status_id;?>" <?php echo ($row->request_guru_status_id==$request->request_guru_status_id)?'selected':'';?>>
                                                    <?php echo $row->request_guru_status_title;?>
                                                </option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="blank" style="height:20px;"></div>
                                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                                        </td>
                                    </tr>
							<?php } ?>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Kode Request</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php echo $request->request_code; ?>
                            </span>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Mata Pelajaran & Tingkat Pendidikan</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php echo $request->matpel_title;?> (<?php echo $request->jenjang_pendidikan_title;?>)
                            </span>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Total Pertemuan (dalam minggu)</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php echo $request->request_frekuensi;?> Kali
                            </span>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Budget</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php echo $request->request_budget;?>
                            </span>
                        </div>
                    </div>
				<?php if($request->requested_by == 1){ ?>
				<?php $jyt = $this->request_model->convert_jadwal($request->request_jadwal); ?>
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
					<?php $jyt = $this->request_model->convert_jadwal_kursus($request->request_jadwal);?>
					<?php if($jyt["flag"] == 1) {
								$key = array_keys($jyt);
								$n = count($key); 
								$jadwal_kursus = "";
								if($n >= 1){
									for($j=0;$j<$n-1;$j++){
										$dd = sprintf('%d', $key[$j]);
										$hari = $this->request_model->convert_day($dd);
										$jam = $this->request_model->convert_hour($jyt[$key[$j]]);
										$jadwal_kursus .= $hari." (".$jam.")<br/>";
									}
								}
				?>
				<?php } ?>
				<?php } ?>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Preferensi Jadwal yang dipilih Murid</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php echo $jadwal_kursus;?>
                            </span>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Preferensi Waktu Mulai Kursus</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php $dmy = $request->request_mulai;
								  $day = date("l", strtotime($dmy));
								  $trim_dmy = explode("-", $dmy);
								  $dd = $this->request_model->day_to_hari($day);
								  $mm = $this->request_model->convert_month($trim_dmy[1]);
								  echo $dd.", ".$trim_dmy[2]." ".$mm." ".$trim_dmy[0];
						  ?>
                            </span>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Catatan Tambahan</span>
                        </div>
                        <div class="content">
                            <span>
                                <?php if(empty($request->request_catatan)){ echo "Tidak ada catatan untuk request ini"; } else{ echo str_replace("\n", "<br/>", $request->request_catatan);} ?>
                            </span>
                        </div>
                    </div>
				<div class="pgc-section">
                        <div class="header">
                            <span>Status <i>Request</i></span>
                        </div>
                        <div class="content">
                            <span>
                                <?php if($request->request_pilih_status == 1){ echo "<i>Request</i> masih dibuka";} else { echo "<i>Request</i> sudah ditutup"; } ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="blank" style="height:10px;"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>