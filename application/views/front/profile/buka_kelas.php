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
                    BUKA KELAS               
			</div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div class="header">
					   <p class="text-13 justify">Buka kelas adalah fitur baru di Ruangguru. Anda sebagai guru dapat membuat kelas sesuai dengan mata pelajaran yang Anda kuasai dalam kurun waktu yang singkat. Kelas ini akan terbuka untuk umum dan untuk siapa saja bisa mendaftar untuk mengikuti kelas Anda</p>
                        </div>
				    <div class="content">
					 <p class="text-13 justify">Anda bisa menampilkan profil Anda sebagai guru ataupun sebagai komunitas/organisasi Anda di kelas yang akan Anda adakan. Silahkan masukkan deskripsi komunitas/organisasi Anda.</p>
					 <?php if($komunitas->num_rows() > 0){ ?>
					 <p class="text-13 justify"><span class="italic">Anda sudah mendaftarkan komunitas Anda di Ruangguru.  </span><a href="<?php echo base_url().'profile/edit_komunitas';?>" class="normal-link">Ubah profil komunitas</a></p>
					 <?php } else { ?>
					 <form id="komunitas" class="profile-form" action="<?php echo base_url(); ?>profile/add_komunitas_submit" method="post" enctype="multipart/form-data">
				      <table id="profile-lamar-table">
                                <tbody>
							 <tr>
                                        <td class="center">Nama Komunitas/Organisasi <span class="red-notif">*</span></td>
								<td class="center" colspan="2"><input id="nama" type="text" class="field size2 validate[required] text" name="nama" /></td>
                                    </tr>
							 <tr>
                                        <td class="center">Deskripsi Komunitas/Organisasi <span class="red-notif">*</span></td>
								<td class="center" colspan="2"><textarea id="deskripsi" type="text" class="field size2 validate[required] text" name="deskripsi"></textarea></td>
                                    </tr>
							 <tr>
                                        <td class="center">Logo Komunitas/Organisasi <span class="red-notif">*</span></td>
								<td class="center" colspan="2"><input id="logo" type="file" class="field size2 validate[required] text" name="logo" /></td>
                                    </tr>
                                </tbody>
                            </table>
						<div class="blank" style="height:10px;"></div>
						<div id="itemRows"></div>
						<div class="blank" style="height:10px;"></div>
						<input type="image" src="<?php echo base_url();?>images/simpan-button.png" class="fright"/>
					 </form>
					 <?php } ?>
				    </div>
				    <div class="blank" style="height:30px;"></div>
				    <p class="text-13"><span class="red-notif">*</span> Wajib diisi</p>
                        <div class="content">
				     <form id="form-buka-kelas" class="profile-form" action="<?php echo base_url(); ?>profile/kelas_submit" method="post" enctype="multipart/form-data">
				      <table id="profile-lamar-table">
                                <tbody>
							 <tr>
                                        <td class="center">Nama Kelas <span class="red-notif">*</span></td>
								<td class="center" colspan="2"><input id="nama" type="text" class="field size2 validate[required] text" name="nama" /></td>
                                    </tr>
							 <tr>
                                        <td class="center">Tentang Kelas <span class="red-notif">*</span></td>
								<td class="center" colspan="2"><textarea id="deskripsi" type="text" class="field size2 validate[required] text" name="deskripsi"></textarea></td>
                                    </tr>
							 <tr>
                                        <td class="center">Tarif per pertemuan (per murid) <span class="red-notif">*</span></td>
								<td class="center" colspan="2"><input id="tarif" type="text" class="field size2 validate[required,custom[onlyNumberSp]] text" name="tarif" /><br/>
									<p class="text-11">Masukkan angka saja, misal: 50000. Jika kelas ini gratis masukkan angka 0</p>
								</td>
                                    </tr>
							 <tr>
                                        <td class="center">Alamat Lokasi Kelas <span class="red-notif">*</span></td>
								<td class="center" colspan="2"><textarea id="lokasi" type="text" class="field size2 validate[required] text" name="lokasi"></textarea></td>
                                    </tr>
							 <tr>
                                        <td class="center">Jumlah Peserta <span class="red-notif">*</span></td>
								<td class="center" colspan="2"><input id="peserta" type="text" class="field size2 validate[required,custom[onlyNumberSp]] text" name="peserta" /><br/>
									<p class="text-11">Masukkan estimasi jumlah peserta. Misal: 50</p>
								</td>
                                    </tr>
							 <tr>
                                        <td class="center">Tampilkan profil sebagai: <span class="red-notif">*</span></td>
								<td colspan="2">
									<input class="radio" type="radio" name="group4" id="group4-1" value="1" checked/>Guru<br/>
									<input class="radio" type="radio" name="group4" id="group4-2" value="2"/>Komunitas/ Organisasi/ Lainnya
								</td>
                                    </tr>
							 <tr>
								<td class="center">Peta Lokasi</td>
								<td colspan="2">
									<input type="text" name="maps_addr" id="maps_addr" placeholder="Masukan alamat disini" /><button id="cari_addr">Cari</button>
									<div id="loc_result">
										<input type="text" readonly="readonly" name="maps" id="loc_ll" />
									</div>
									<script type="application/javascript">
										function set_loc(data) {
											$('#loc_ll').val(data);
										}
										var loc_window = null;
										$('#cari_addr').click(function(e){
											e.preventDefault();
											if(loc_window == null || loc_window.closed) {
												loc_window = window.open("<?php echo base_url()?>profile/get_address_geo/?address="+encodeURIComponent($('#maps_addr').val()), "_blank", "height=520, width=960, status=no, toolbar=no, menubar=no, location=no,addressbar=no");
											} else {
												loc_window.focus()
											}
											return false;
										})
									</script>

<?php /* ?>
									<p class="text-11">Tata cara memasukkan peta lokasi</p>
									<p class="text-11">1. Ketikkan alamat atau nama tempat belajar di <a href="https://www.google.co.id/maps/" target="_blank" class="normal-link">sini</a></p>
									<p class="text-11">2. <i>Copy</i> URL di web browser Anda</p>
									<p class="text-11">3. <i>Paste</i> URL di kolom isian di bawah ini</p>
									<input id="maps" type="text" class="field size2 text" name="maps" /><br/>
<?php // */ ?>
								</td>
							</tr>
									<tr>
										<td class="center">Kelas Paket</td>
										<td colspan="2">
											<p class="text-11">Apakah kelas ini adalah kelas paket?</p>
											<p class="text-11">(Untuk menyelesaikan kelas ini, akan butuh lebih dari 1x pertemuan)</p>
											<p class="text-11">Jika ya, beri tanda centang berikut ini</p>
											<input type="checkbox" name="kelas_paket" value="ya" /> Ya, ini adalah kelas paket!
										</td>
									</tr>
                                </tbody>
                            </table>
						<div class="blank" style="height:10px;"></div>
						<div id="itemRows"></div>
						<div class="blank" style="height:10px;"></div>
						<input type="image" src="<?php echo base_url();?>images/simpan-button.png" class="fright"/>
					 </form>
					 <div class="blank" style="height:30px;"></div>
					   <?php if($kelas->num_rows() >= 1){ ?>
				        <p class="bold">DAFTAR KELAS ANDA</p>
					   <p>Di bawah ini adalah daftar kelas yang telah Anda buat. Kelas akan diverifikasi terlebih dahulu oleh tim Ruangguru, jika statusnya <b>diterima</b> maka Anda diharap melengkapi keterangan kelas yang akan Anda adakan.</p>
				        <table id="profile-lamar-table">
                                <thead>
                                    <th class="center">No.</th>
                                    <th class="center">Nama Kelas</th>
                                    <th class="center">Status Verifikasi</th>
                                    <th class="center">Status Kelas</th>
                                    <th class="center">Jadwal Kelas</th>
                                    <th class="center">Keterangan Kelas</th>
                                    <th class="center">Galeri Kelas</th>
                                </thead>
                                <tbody>
							<?php $i=1; foreach($kelas->result() as $row){ ?>
							<tr>
                                        <td class="center"><?php echo $i++;?></td>
                                        <td class="center"><?php echo $row->kelas_guru_nama;?></td>
								<td class="center <?php if($row->kelas_guru_status == 0){ echo "red-notif";} ?>"><?php if($row->kelas_guru_status == 0){ echo "Belum disetujui";} else { echo "Sudah disetujui";}?></td>
								<td class="center"><?php if($row->kelas_status == 0){ echo "Sudah ditutup";} else { echo "Masih dibuka";}?></td>
								<td class="center">
								<?php if($row->kelas_guru_status == 0){ ?>
									-
								<?php } else { ?>
									<?php if($row->kelas_status == 1){ ?>
										<a href="<?php echo base_url().'profile/edit_kelas/'.$row->kelas_guru_id;?>" class="normal-link">Tambah Jadwal</a>
									<?php } else { ?>
										Kelas ditutup
									<?php } ?>
								<?php } ?>
								</td>
								<td class="center">
								<?php if($row->kelas_guru_status == 0){ ?>
									-
								<?php } else { ?>
									<?php if($row->kelas_status == 1){ ?>
										<a href="<?php echo base_url().'profile/catatan_kelas/'.$row->kelas_guru_id;?>" class="normal-link">Edit</a>
									<?php } else { ?>
										Kelas ditutup
									<?php } ?>
								<?php } ?>
								</td>
								<td class="center">
								<?php if($row->kelas_guru_status == 0){ ?>
									-
								<?php } else { ?>
									<?php if($row->kelas_status == 1){ ?>
										<a href="<?php echo base_url().'profile/galeri_kelas/'.$row->kelas_guru_id;?>" class="normal-link">Tambah Gambar</a>
									<?php } else { ?>
										Kelas ditutup
									<?php } ?>
								<?php } ?>
								</td>
                                    </tr>
							<?php  } ?>
                                </tbody>
                            </table>
					   <?php  } ?>
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