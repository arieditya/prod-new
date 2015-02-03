<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/profile.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css">
<script>
$(document).ready(function(){
    $("#form-edit-kelas").validationEngine('attach');
    update_matpel_all();
});

</script>
<script>
$(document).ready(function(){
    $("#form-buka-kelas").validationEngine('attach');
     $("#date").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
     $("#date1").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
     $("#date2").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
     $("#date3").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
     $("#date4").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
     $("#date5").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
     $("#date6").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
     $("#date7").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
     $("#date8").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
     $("#date9").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
});

var rowNum = 0;
function addRow(frm) {
	rowNum ++;
	var row = '<div  id="rowNum'+rowNum+'"><table id="profile-lamar-table"><tr class="center"><td class="center">Tanggal Kelas</td><td colspan="2" class="center"><input type="text" name="date[]" class="field size5 text" id="date'+rowNum+'"></td></tr><tr class="center"><td class="center">Jam Mulai - Selesai</td><td><select class="inline-field size5" name="mulai_jam[]"><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23"></option></select><select class="inline-field size5" name="mulai_menit[]"><option value="00">00</option><option value="15">15</option><option value="30">30</option><option value="45">45</option></select></td><td class="center"><select class="inline-field size5" name="selesai_jam[]"><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23"></option></select><select class="inline-field size5" name="selesai_menit[]"><option value="00">00</option><option value="15">15</option><option value="30">30</option><option value="45">45</option></select><select class="inline-field size5" name="waktu[]"><option value="1">WIB</option><option value="2">WITA</option><option value="3">WITA</option></select></td></tr><a href="#" class="normal-link bold" onclick="removeRow('+rowNum+');">Hapus</a></table></div>';
	jQuery('#itemRows').append(row);
}

function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}
</script>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-guru-header">
                <div id="profile-guru-header-wrap">
                    DESKRIPSI KELAS LENGKAP             
			</div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div class="header">
					   <p class="text-13 justify">Silahkan dilengkapi keterangan kelas yang akan Anda adakan, agar peserta yang akan mengikuti kelas Anda memperoleh informasi sejelas-jelasnya.</p>
                        </div>
                        <div class="content">
				    <table id="jadwal-kelas">
						<th class="center">Tanggal</th>
						<th class="center">Jam</th>
						<?php foreach($jadwal->result() as $jdwl){ ?>
							<?php 
							//Waktu
							switch ($jdwl->kelas_guru_waktu) {
								case 1:
									$j = "WIB";
									break;
								case 2:
									$j = "WITA";
									break;
								case 3:
									$j = "WIT";
									break;
							}
							
							//Menit mulai
							switch ($jdwl->kelas_guru_menit_mulai) {
								case 0:
									$ms = "00";
									break;
								case 15:
									$ms = 15;
									break;
								case 30:
									$ms = 30;
									break;
								case 45:
									$ms = 45;
									break;
							}
							
							//Menit selesai
							switch ($jdwl->kelas_guru_menit_selesai) {
								case 0:
									$me = "00";
									break;
								case 15:
									$me = 15;
									break;
								case 30:
									$me = 30;
									break;
								case 45:
									$me = 45;
									break;
							}
						?>
						<tr>
							<td><?php echo $jdwl->kelas_guru_tanggal;?></td>
							<td><?php echo $jdwl->kelas_guru_jam_mulai.".".$ms." s/d ".$jdwl->kelas_guru_jam_selesai.".".$me." ".$j;?></td>
							<td><a href="<?php echo base_url().'profile/delete_jadwal/'.$jdwl->jadwal_id.'/'.$kelas->kelas_guru_id;?>" class="normal-link"><img src="<?php echo base_url().'images/publish_x.png';?>"/> Hapus jadwal</a></td>
						</tr>
						<?php } ?>
				    </table>
				     <form id="form-edit-kelas" class="profile-form" action="<?php echo base_url(); ?>profile/edit_kelas_submit" method="post" enctype="multipart/form-data">
						<table id="profile-lamar-table">	
						  <tr>
                                   <td class="center">Tanggal Kelas</td>
							<td class="center" colspan="2">
								<input id="date" type="text" class="field size5 validate[required] text" name="date[]" />
								<input id="id_kelas" type="hidden" name="id_kelas" value="<?php echo $kelas->kelas_guru_id;?>"/>
							</td>
                                </tr>
						  <tr>
                                   <td class="center">Jam Mulai - Selesai</td>
						     <td class="center">
								<select class="inline-field size5" name="mulai_jam[]">
								<?php for($i=6;$i<24;$i++):?>
									<option value="<?php echo $i;?>"><?php echo str_pad($i, 2,"0",STR_PAD_LEFT);?></option>
								<?php endfor;?>
								</select>
								<select class="inline-field size5" name="mulai_menit[]">
									<option value="00">00</option>
									<option value="15">15</option>
									<option value="30">30</option>
									<option value="45">45</option>
								</select>
							</td>
							<td class="center">
								<select class="inline-field size5" name="selesai_jam[]">
									<?php for($i=6;$i<24;$i++):?>
										<option value="<?php echo $i;?>"><?php echo str_pad($i, 2,"0",STR_PAD_LEFT);?></option>
									<?php endfor;?>
								</select>
								<select class="inline-field size5" name="selesai_menit[]">
									<option value="00">00</option>
									<option value="15">15</option>
									<option value="30">30</option>
									<option value="45">45</option>
								</select>
								<select class="inline-field size5" name="waktu[]">
									<option value="1">WIB</option>
									<option value="2">WITA</option>
									<option value="3">WIT</option>
								</select>
							</td>
                                </tr>
						</table>
						<div class="blank" style="height:10px;"></div>
						<div id="itemRows"></div>
						<div class="blank" style="height:10px;"></div>
						<input type="image" src="<?php echo base_url();?>images/simpan-button.png" class="fright"/>
						<a href="#" onclick="addRow(this.form);"><img src="<?php echo base_url();?>images/tambah-jam.png" class="fright"/></a>
					 </form>
                        </div>
                    </div>
                </div>
                <div class="clear" ></div>
                <div class="blank" style="height:60px;"></div>
            </div>
            <div class="blank" style="height:10px;"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>