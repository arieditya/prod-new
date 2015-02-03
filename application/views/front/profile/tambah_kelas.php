<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/profile/tambah_kelas" />
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css">
<script type="text/javascript">
$(document).ready(function(){
    $("#date").datepicker({ dateFormat: "yy-mm-dd" });
});
</script>
</head>
</body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-guru-header">
                <div id="profile-guru-header-wrap">
                    TAMBAH KELAS
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
				<?php foreach($kelas->result() as $k){
					$id_kelas = $k->kelas_id;
					$nama_murid= $k->murid_nama;
					$matpel = $k->matpel_title;
					$jenjang = $k->jenjang_pendidikan_title;
					$mulai = $k->kelas_mulai;
					$request_id = $k->request_id;
					}
				?>
                    <div class="pgc-section">
                    <form id="change-password-form" class="guru-form" action="<?php echo base_url(); ?>profile/add_pertemuan_submit" method="post">
                    <table id="profile-rating-table">
				    <tr style="background-color: #99d6e4;color:#FFFFFF;">
						<td colspan="2">
							<label><strong>Nama Murid</strong>: <?php echo $nama_murid;?></label><br/>
							<label><strong>Mata Pelajaran</strong>: <?php echo $matpel;?></label><br/>
							<label><strong>Tingkat</strong>: <?php echo $jenjang;?></label><br/>
							<label><strong>Tanggal Kelas Dimulai</strong>: <?php echo $mulai;?></label><br/>
							<?php $req = $this->request_model->get_request_by_id($request_id);?>
							<label><strong>Kode <i>Request</i></strong>: <?php echo $req->request_code;?></label>
						</td>
				    </tr>
                        <tr>
                            <td>Tanggal Pertemuan: </td>
                            <td>
                                   <input id="date" type="text" class="field size2 validate[required] text" name="date" />
							<input type="hidden" name="id" value="<?php echo $id_kelas;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Jam Mulai: </td>
                            <td>
                                   <select class="inline-field size5" name="mulai_jam">
							<?php for($i=6;$i<24;$i++):?>
								<option value="<?php echo $i;?>"><?php echo str_pad($i, 2,"0",STR_PAD_LEFT);?></option>
							<?php endfor;?>
							</select>
							<select class="inline-field size5" name="mulai_menit">
								<option value="00">00</option>
								<option value="15">15</option>
								<option value="30">30</option>
								<option value="45">45</option>
							</select>
                            </td>
                        </tr>
                        <tr>
                            <td>Jam Selesai: </td>
                            <td>
                                   <select class="inline-field size5" name="selesai_jam">
							<?php for($i=6;$i<24;$i++):?>
								<option value="<?php echo $i;?>"><?php echo str_pad($i, 2,"0",STR_PAD_LEFT);?></option>
							<?php endfor;?>
							</select>
							<select class="inline-field size5" name="selesai_menit">
								<option value="00">00</option>
								<option value="15">15</option>
								<option value="30">30</option>
								<option value="45">45</option>
							</select>
                            </td>
                        </tr>
                    </table>
				<div class="blank" style="height:10px;"></div>
				<input type="image" src="<?php echo base_url();?>images/simpan-button.png" class="fright"/>
				</form>
                    </div>
                </div>
			 <div class="blank" style="height:150px;"></div>
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