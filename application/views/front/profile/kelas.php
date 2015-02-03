<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/profile/kelas" />
</head>
</body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-guru-header">
                <div id="profile-guru-header-wrap">
                    STATUS KELAS SAAT INI
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <?php if ($this->session->flashdata('update_kelas_notif')): ?>
                        <div class="profile-notif">
                            <?php echo $this->session->flashdata('update_kelas_notif'); ?>
                        </div>
                        <div class="_blank" style="height: 10px;"></div>
                    <?php endif; ?>
                    <div class="pgc-section">
                        <div class="header">
                            <p class="text-13 justify"> Ini adalah daftar kelas Anda. Silahkan konfirmasi status kelas Anda, apabila kelas sudah selesai atau belum selesai dengan mengubah di bagian status kelas. Anda juga bisa menambah kelas pertemuan dengan mengklik tombol Tambah, untuk setiap kelas yang telah disepakati.</p>
                        <?php //print_r($kelas->result()); ?>
				    </div>
                        <?php foreach($kelas->result() as $k):?>
                        <div class="content">
                            <form class="profile-form" action="<?php echo base_url();?>profile/update_kelas" method="post">
                            <input type="hidden" name="kelas_id" value="<?php echo $k->kelas_id;?>"/>
                            <table id="profile-rating-table">
                                <thead>
                                    <tr style="background-color: #99d6e4;color:#FFFFFF;">
                                        <td colspan="4">
                                            <span class="bold">Nama Murid:</span> <?php echo $k->murid_nama;?><br/>
                                            <span class="bold">Mata Pelajaran:</span> <?php echo $k->matpel_title;?><br/>
								    <span class="bold">Tingkat:</span> <?php echo $k->jenjang_pendidikan_title;?><br/>
								    <span class="bold">Tanggal Kelas Dimulai:</span> <?php echo $k->kelas_mulai;?><br/>
								    <?php $req = $this->request_model->get_request_by_id($k->request_id);?>
								    <span class="bold">Kode <i>Request</i>:</span> <?php echo $req->request_code;?>
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
                                        <td>
                                            <select name="status[<?php echo $row->kelas_pertemuan_id;?>]">
                                                <?php foreach ($this->guru_model->get_table('kelas_pertemuan_status')->result() as $o):?>
                                                <option  value="<?php echo $o->kelas_pertemuan_status_id;?>" <?php echo ($o->kelas_pertemuan_status_id==$row->kelas_pertemuan_status_id)?'selected':'';?>>
                                                    <?php echo $o->kelas_pertemuan_status_title;?>
                                                </option>
                                                <?php endforeach;?>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            <div class="blank" style="height:20px;"></div>
                            <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>&nbsp;<?php if($k->kelas_status == 1){ ?><a href="<?php echo base_url().'profile/tambah_kelas/'.$k->kelas_id; ?>"><img src="<?php echo base_url().'images/tambah-button.png'; ?>"/><?php } ?></a>
                            </form>
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