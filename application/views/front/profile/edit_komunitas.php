<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/profile.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css">
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
                    EDIT KOMUNITAS               
			</div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
				    <div class="content">
					 <p class="text-13"><span class="red-notif">*</span> Wajib diisi</p>
					 <form id="komunitas" class="profile-form" action="<?php echo base_url(); ?>profile/edit_komunitas_submit" method="post" enctype="multipart/form-data">
				      <table id="profile-lamar-table">
						  <?php foreach($komunitas->result() as $k){ ?>
                                <tbody>
							 <tr>
                                        <td class="center">Nama Komunitas/Organisasi <span class="red-notif">*</span></td>
								<td class="center" colspan="2">
									<input id="nama" type="text" class="field size2 validate[required] text" name="nama" value="<?php echo $k->komunitas_nama;?>"/>
									<input id="id" type="hidden" name="id" value="<?php echo $k->komunitas_id;?>"/>
								</td>
                                    </tr>
							 <tr>
                                        <td class="center">Deskripsi Komunitas/Organisasi <span class="red-notif">*</span></td>
								<td class="center" colspan="2"><textarea id="deskripsi" type="text" class="field size2 validate[required] text" name="deskripsi"><?php echo $k->komunitas_deskripsi;?></textarea></td>
                                    </tr>
							 <tr>
                                        <td class="center">Logo Komunitas/Organisasi <span class="red-notif">*</span></td>
								<td class="center" colspan="2">
									<img src="<?php echo base_url().'images/komunitas/'.$k->komunitas_logo;?>" width="100px"/><br/>
									<input id="logo" type="file" class="field size2 validate[required] text" name="logo" />
								</td>
                                    </tr>
                                </tbody>
						  <?php } ?>
                            </table>
						<div class="blank" style="height:10px;"></div>
						<div id="itemRows"></div>
						<div class="blank" style="height:10px;"></div>
						<input type="image" src="<?php echo base_url();?>images/simpan-button.png" class="fright"/>
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