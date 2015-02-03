<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/cari_guru/request" />	
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.alerts.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/validation.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.alerts.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.min.js" type="text/javascript" charset="utf-8"></script>
<body>
<style>
	.ceklis{ cursor:pointer; }
	.jadwal.ceklis.selected {background-color: #d5df26 !important;}
	.na{background-color: #fabebe !important;}
	#overlay{ visibility:hidden; background-color: #000; opacity: 0.4; position:fixed; top:0; left:0; width:100%; height: 100%; z-index: 9998; }
     #success-notif-request-guru{visibility:hidden}
</style>
<script>
	function recheck_form(){
		var opac = document.getElementById("overlay");
		var dlg = document.getElementById("success-notif-request-guru");
		opac.style.visibility = "visible";
		dlg.style.visibility = "visible";
	}

	function do_submit(){
        $("#overlay").hide();
        $("#success-notif-request-guru").hide();
	   $('#request-guru-form').submit();
	   return true;
    }
    
    	function close_overlay(){
        $("#overlay").hide();
        $("#success-notif-request-guru").hide();
	   return false;
    }

</script>
<script type="text/javascript">
function jadwal_box_click(obj){
    checkbox = $(obj).children('.jadwal-checkbox');
    if(checkbox.is(':checked')){
        checkbox.attr('checked', false);
        $(obj).removeClass('selected');
    }else{
        checkbox.attr('checked', true);
        $(obj).addClass('selected');
	   $(obj).toogleClass('selected');
    }
}
</script>
<script>
    function update_matpel(){
        id=$("#jenjangP").val();
	   sesi_matpel=$("#id_matpel").val();
        $.getJSON(base_url+"cari_guru/get_matpel/"+id,function(data){
            html = '';
            $.each(data,function(i,item){
			if(item.matpel_id == sesi_matpel){
				html+= '<option value=" '+item.matpel_id+' "selected>'+item.matpel_title+'</option>';
			}else{
				html+= '<option value="'+item.matpel_id+'">'+item.matpel_title+'</option>';
			}
            });
            $("#select-matpel").html(html);
        })
    }
    function update_prioritas(obj){
        val=$(obj).val();
        old = $(obj).siblings('input');
        parent = $('.rg-prioritas option[value="'+val+'"]:selected').parent();
        $(parent).children('option[value="'+old.val()+'"]').attr("selected", "selected");
        $(parent).siblings('input').val(old.val());
        $(old).val(val);
        $(obj).val(val);
    }
    $(document).ready(function(){
        $("#request-guru-form").validationEngine({validateNonVisibleFields: true});
	   $("#jkd").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
        update_matpel();
    }); 
    

</script>
<!--<script type="text/javascript">window.history.forward();function noBack(){window.history.forward();}</script>-->
<!--<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">-->

<!--  FBX -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '583152025127396']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=583152025127396&amp;ev=NoScript" /></noscript>

</head>

<body>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height:30px;"></div>
        <?php echo $progress;?>
        <div class="blank" style="height:30px;"></div>
        <table width="100%" id="request-guru">
            <tr>
                <td id="request-left">
                    <div id="request">
                        <div id="request-header">
                            <div id="request-header-wrap">
                               <h2><span class="text-20">3. REQUEST GURU</span></h2>
                            </div>
                        </div>
                        <div id="request-content">
				     <?php if(!empty($pilihan)):?>
                            <form id="request-guru-form" action="<?php echo base_url();?>cari_guru/request_submit" method="post" onsubmit="return confirm('Apakah Anda yakin dengan pilihan guru yang Anda pilih - setelah memilih tidak bisa mengubah lagi')">
                                <div class="blank" style="height:30px;"></div>
                                <?php if ($this->session->flashdata('request_notification')): ?>
                                    <div class="cari-guru-notif">
                                        <p class="red-notif">
                                            <?php echo $this->session->flashdata('request_notification'); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <div id="request-subject">
                                    <div>
                                        <a class="white-text diy-button-mini text-13" href="<?php echo base_url();?>cari_guru/review"><< Kembali ke Review Guru</a>
                                    </div>
                                    <div class="blank" style="height:20px;"></div>
                                    <?php if(!empty($pilihan)):?>
                                    <div class="request-title">
                                        PREFERENSI GURU
                                    </div>
                                    <div class="request-data pushed">
                                        <table>
                                            <tr>
                                                <?php foreach ($pilihan->result() as $guru): ?>
                                                <td width="250px">
                                                    <div class="rg-guru-wrap">
                                                       <a href="<?php echo base_url(); ?>cari_guru/hapus_pilihan_request/<?php echo $guru->guru_id; ?>" class="diy-btn-mini text-13"><img src="<?php echo base_url().'images/delete-entry-button.png'; ?>"/> Hapus dari daftar</a>
                                                    </div>
                                                    <div class="blank" style="height:10px;"></div>
                                                </td>
                                                <?php endforeach; ?>
                                                <?php $count = $pilihan->num_rows();$j = 1;?>
                                            </tr>
                                            <tr>
                                                <td colspan="<?php echo $count;?>">
                                                    <div class="rg-guru-wrap">
                                                        <span class="bold text-12">Prioritas pilihan</span><br/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="rg-pg">
                                                <?php foreach ($pilihan->result() as $guru): ?>
                                                <?php $k = $j++;?>
                                                <td>
                                                    <div class="rg-guru-wrap">
                                                        <select class="rg-prioritas select-small" name="prioritas[<?php echo $guru->guru_id;?>]" onchange="update_prioritas(this)">
                                                            <?php for($i=1;$i<=$count;$i++):?>
                                                            <option value="<?php echo $i;?>" <?php echo($k==$i)?'selected':'';?>><?php echo $i;?></option>
                                                            <?php endfor;?>
                                                        </select>
                                                        <input type="hidden" id="prioritas-<?php echo $k;?>" value="<?php echo $k;?>" />
                                                    </div>
                                                    <div class="blank" style="height:10px;"></div>
                                                </td>
                                                <?php endforeach;?>
                                            </tr>
                                            <tr class="rg-pp">
                                                <?php foreach ($pilihan->result() as $guru): ?>
                                                    <td style="padding-left:20px;">
                                                        <div class="rg-guru-wrap">
                                                            <?php if (!file_exists("./images/pp/{$guru->guru_id}.jpg")): ?>
                                                                <img src="<?php echo base_url(); ?>images/default_profile_image.png" width="90"/>
                                                            <?php else : ?>
                                                                <img src="<?php echo base_url(); ?>images/pp/<?php echo $guru->guru_id; ?>.jpg" width="90"/>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <tr class="rg-nama">
                                                <?php foreach ($pilihan->result() as $guru): ?>
                                                    <td class="center">
                                                        <div class="rg-guru-request-wrap">
												<?php $nama = $this->guru_model->nama_guru($guru->guru_nama);?>
                                                            <p style="width:120px;"><?php echo $nama; ?></p>
                                                        </div>
                                                        <input type="hidden" name="pilihan[]" value="<?php echo $guru->guru_id;?>"/>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <tr class="rg-white left">
                                                <?php foreach ($pilihan->result() as $guru): ?>
                                                    <td style="vertical-align: text-top">
                                                        <div class="rg-guru-wrap">
                                                            <?php
                                                            $jp = 'other';
												$session_jenjang = $this->session->userdata['cari_guru']['jenjang'];
												$session_matpel = $this->session->userdata['cari_guru']['matpel'];
                                                            foreach ($this->guru_model->get_matpel_guru($guru->guru_id)->result() as $matpel) {
													if($matpel->matpel_id == $session_matpel){
														$tarif = $this->guru_model->get_hargapermatpel($guru->guru_id, $session_matpel)->result();
														?>
														<ul class="normal-list text-12">
															<li><?php echo $matpel->jenjang_pendidikan_title; ?></li>
															<li><?php echo $matpel->matpel_title; ?></li>
															<li><strong><?php echo 'Rp ' . number_format($tarif[0]->guru_matpel_tarif) .',-/ jam'; ?></strong></li>
														</ul>
												<?php	}
                                                            }
                                                            ?>
                                                        </div>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="blank" style="height:15px;"></div>
                                    <?php endif;?>
                                    <div class="request-title">
                                        PREFERENSI MATA PELAJARAN
                                    </div>
                                    <div class="request-data">
                                        <div class="request-field">
                                            <span class="bold">Kategori pelajaran <span class="red-notif">*</span></span><br/>
                                            <select class="select" autocomplete="off" id="jenjangP" name="education" onchange="update_matpel()">
                                                <?php foreach($this->guru_model->get_jenjang()->result() as $item):
											if($session_jenjang == $item->jenjang_pendidikan_id){
									   ?>
                                                  <option value="<?php echo $item->jenjang_pendidikan_id;?>" selected><?php echo $item->jenjang_pendidikan_title;?></option>
									   <?php } else { ?>
										<option value="<?php echo $item->jenjang_pendidikan_id;?>"><?php echo $item->jenjang_pendidikan_title;?></option>
                                                <?php }
									   endforeach;
									   ?>
                                            </select>
                                        </div>
                                        <div class="blank" style="height:10px;"></div>
                                        <div class="request-field bidang-studi-wrap">
                                            <span class="bold">Mata pelajaran <span class="red-notif">*</span></span><br/>
								    <input type="hidden" name="id_matpel" id="id_matpel" value="<?php if (empty($session_matpel)){ echo '';} else { echo $session_matpel;} ?>"/>
                                            <select class="select" id="select-matpel" name="matpel">
                                            </select>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="blank" style="height:35px;"></div>
                                    </div>
                                </div>
                                <div id="request-schedule">
                                    <div class="request-title">
                                        JADWAL & FREKUENSI KURSUS
                                    </div>
                                    <div class="request-data">
                                        <table>
								     <tr>
                                                <td>
                                                    <input type="hidden" class="text" name="requested_by" value="1"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="bold">Lama belajar <span class="red-notif">*</span></span>
                                                </td>
                                                <td>
                                                    <input type="text" class="validate[required,custom[onlyNumberSp]] text" name="freq" style="width: 250px" id="freq"/>
										  <span class="inline-block text-11"><i>Misal: Masukkan angka "12" untuk lama belajar 12 minggu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                                                </td>
                                            </tr>
								    <tr>
                                                <td><span class="bold">Kode <i>referral</i></span>
									   </td>
                                                <td>
                                                    <input type="text" class="text" name="referal" style="width: 250px"/>
										  <span class="inline-block text-11"><i>Isikan kode referral Duta Ruangguru Anda</i></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="bold">Jadwal yang tersedia <span class="red-notif">*</span></span></td>
								   </tr>
								   <tr>
									    <td colspan="2">
											<p class="info2">
											<ul class="normal-list">
												<li>Pilih preferensi waktu belajar Anda dengan meng-klik tabel dibawah.</li>
												<li>Pastikan Anda meng-klik di hari dan jam saat guru tersebut bersedia mengajar.</li>
											 </ul>
											</p>
                                                </td>
								   </tr>
								    <tr>    
									   <td colspan="2">
										<?php $count = 0;?>
										<?php foreach($pilihan->result() as $guru):?>
										<?php $jadwal = $this->profile_model->get_jadwal_map($guru->guru_id);?>
										<?php $kelas = $this->kelas_model->get_kelas_by_guru($guru->guru_id);?>
										<?php	$jadwal_dgn_murid_lain = array(); ?>
										<?php if (!empty($kelas->num_rows)){ ?>
													<?php $i = 0; //print_r($kelas->result());
													foreach($kelas->result() as $k){ ?>
														<?php $temu_kelas = $this->kelas_model->get_kelas_pertemuan_by_guru($k->kelas_id);?>
													      <?php if (!empty($temu_kelas->num_rows)){?>
														 		<?php //print_r($i); ?>
																<?php foreach ($temu_kelas->result() as $temu){ ?>
																	<?php $tanggal_temu = date("l, j F Y", strtotime($temu->kelas_pertemuan_date));
																			$hari = explode(",",$tanggal_temu);
																			switch ($hari[0]){
																				case "Sunday":
																					$dd = 6;
																					break;
																				case "Monday":
																					$dd = 0;
																					break;
																				case "Tuesday":
																					$dd = 1;
																					break;
																				case "Wednesday":
																					$dd = 2;
																					break;
																				case "Thursday":
																					$dd = 3;
																					break;
																				case "Friday":
																					$dd = 4;
																					break;
																				case "Saturday":
																					$dd = 5;
																					break;
																				}
																			$jam_mulai = sprintf('%d', $temu->kelas_pertemuan_jam_mulai);
																			$jam_selesai = sprintf('%d', $temu->kelas_pertemuan_jam_selesai);
																			$hh=array();
																			for($n=$jam_mulai; $n<=$jam_selesai;$n++){
																				$hh[$n] = 1;
																			}
																			$jadwal_dgn_murid_lain[$dd] = $hh;
																			} 
																		} ?>
															   <?php } } ?>
															   <?php //print_r($jadwal_dgn_murid_lain)?>
															   <?php $nama = $this->guru_model->nama_guru($guru->guru_nama);?>
									     <span class="fauna-font blue-text capitalize"><strong><?php echo $nama; ?></strong></span>
											<div class="rg-guru-wrap" style="line-height:10px;">
												<div class="_blank" style="height:13px;"></div>
													<table class="availability center" border="0" cellpadding="0" cellspacing="1" width="450">
														<tbody>
															<tr>
																<th></th>
																<?php foreach($days as $hari){?>
																	<th><?php echo $hari?></th>
																<?php } ?>
															</tr>
														<?php for($i=7;$i<24;$i++):?>
														<tr>
															<th height="30px"><?php echo sprintf('%02s', $i); ?>:00</th>
																<?php for($j=0;$j<7;$j++):?>
																	<?php $hour = (array_key_exists($j, $jadwal)?$jadwal[$j]:array());?>
																	<?php $hour_na = (array_key_exists($j, $jadwal_dgn_murid_lain)?$jadwal_dgn_murid_lain[$j]:array());?>
																	<?php if(array_key_exists($i, $hour_na)){ ?>
																		<td class="na" ></td>	
																		<?php } else { ?>
																	<td onclick="jadwal_box_click(this)" style="background-color: <?php echo (array_key_exists($i, $hour)?'#AEE8FC':'#EBEBEB');?>" class="jadwal <?php echo (array_key_exists($i, $hour) ? 'ceklis' : ''); ?>">
																		<input class="jadwal-checkbox none" type="checkbox" name="catch_jadwal[]" value="<?php echo $guru->guru_id.','.$i.','.$j;?>"/>
																	</td>
																<?php } ?>
																<?php endfor;?>
														</tr>
														<?php endfor;?>
													</tbody>
												</table>
												<div class="_blank" style="height:8px;"></div>
												<span style="font-size: 11px;font-weight: normal"><img src="<?php echo base_url()."images/jadwal-available-icon.png" ?>"/><strong>&nbsp;Biru:</strong> Tersedia <strong>
													<br/><img src="<?php echo base_url()."images/jadwal-notavailable-icon.png" ?>"/>&nbsp;Abu-abu:</strong> Tidak Tersedia<br/><strong><img src="<?php echo base_url()."images/jadwal-unavailable-icon.png" ?>"/>&nbsp;Merah:</strong> Mengajar Murid Lain<br/><strong><img src="<?php echo base_url()."images/jadwal-chosen-icon.png" ?>"/>&nbsp;Hijau:</strong> Jadwal yang Anda Pilih</span>
													<div class="_blank" style="height:16px;"></div>
												</div>
										</div>
										<?php $count++;?>
										<?php endforeach; ?>
										<div class="_blank" style="height:20px;"></div>
										</td>
                                            </tr>
                                            <tr>
                                                <td><span class="bold">Kapan Anda ingin memulai jadwal kursus? <span class="red-notif">*</span></span></td>
                                                <td>
                                                    <input id="jkd" type="text" class="validate[required] datepicker text" name="jkd" style="width: 250px"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="bold">Catatan tambahan</span><br/><span class="inline-block text-11"><i>Silakan cantumkan lokasi belajar jika berbeda dengan alamat Anda dan rute menuju lokasi ataupun keterangan lain di sini</i></span></td>
                                                <td>
                                                    <textarea name="catatan" class="text" style="width: 250px"></textarea>
                                                </td>
                                            </tr>
								    <tr>
                                                <td><span class="bold">Metode Belajar</span><br/>
                                                <td>
                                                    <input type="checkbox" name="metode[]" value="1" checked/>Online<br/>
                                                    <input type="checkbox" name="metode[]" value="2" checked/>Tatap Muka
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="blank" style="height:40px;"></div>
                                <div id="request-gender">
                                    <div class="request-data">
                                        <div class="request-field">
                                            <div class="bold">
                                                Masukkan kode keamanan yang tertera dibawah ini :
                                            </div>
                                            <div class="captcha">
                                                <?php echo $this->recaptcha->get_html();?>
                                            </div>
                                        </div>
								<div class="_blank" style="height:10px;"></div>
                                    </div>
                                </div>
						  <div class="blank" style="height:30px;"></div>
                                <div id="request-gender">
                                    <div class="request-title">
                                        SYARAT DAN KETENTUAN
                                    </div>
                                    <div class="blank" style="height:5px;"></div>
                                    <p class="text-13"><a href="<?php echo base_url();?>syarat_ketentuan/guru" class="normal-link" target="_blank">Klik link ini untuk membaca Syarat dan Ketentuan untuk Pesan Guru</a><br/>
							 <input type="checkbox" value="1" name="term" id="term" class="validate[required]"/> Saya setuju dengan syarat & ketentuan yang ada<span class="red-notif text-16"> *</span></p>
                                </div>
                                <div class="blank" style="height:40px;"></div>
                                <div id="request-terms">
								<input type="image" src="<?php echo base_url();?>images/submit-button.png" id="kirim"/>
                                    <div id="request-terms-bottom" class="fright">
								<span class="inline-block text-13"><span class="red-notif">*</span><i>Wajib diisi</i></span>
                                    </div>
                                </div>
                                <div class="blank" style="height:60px;"></div>
                            </form>
					   		<?php else:?>
								<div class="blank" style="height:10px;"></div>
								<div class="rg-info">
									<p>Anda belum memilih guru, silahkan memilih guru pada menu <a href="<?php echo base_url().'cari_guru'; ?>" class="normal-link bold">Cari Guru</a></p>
								</div>
								<div class="blank" style="height:200px;"></div>
							<?php endif;?>
                        </div>
				</div>
                    <div class="blank" style="height:30px;"></div>
                </td>
                <td id="request-right">
                    <div id="pemesanan-guru">
                        <div id="pg-header">
                            <div id="pg-header-wrap">
                                PEMESANAN GURU
                            </div>
                        </div>
                        <div id="pg-content">
                            <div class="blank" style="height: 20px;"></div>
                            <p>
                                <span class="bold">Bagaimana cara memesan guru?</span><br/>
                                <ul class="normal-list">
                                    <li>Sign up di <a class="normal-link" href="<?php echo base_url();?>murid">www.ruangguru.com/murid</a> dan buat akun profil murid. Jika anda sudah memiliki akun, silahkan langsung <a href="<?php echo base_url().'murid/login';?>" class="normal-link bold">login</a>.</li>
                                    <li>Apabila tidak ada guru yang sesuai kriteria Anda, silahkan meminta rekomendasi dari pihak Ruangguru melalui <a href="<?php echo base_url().'request_guru'?>" class="normal-link">Request Guru</a></li>
                                    <li>Kriteria tambahan dapat disampaikan dengan menuliskannya di catatan tambahan ataupun e-mail ke <a href="mailto:info@ruangguru.com" class="normal-link">info@ruangguru.com</a>.</li>
                                    <li>Membaca dengan seksama dan setuju dengan syarat dan ketentuan yang ada.</li>
                                    <li>Pihak Ruangguru akan mengkonfirmasi pemesanan Anda dalam waktu 2 x 24 jam melalui e-mail maupun telepon.</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                    <div class="blank" style="height: 20px;"></div>
                    <div class="social-side-box">
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fruanggurucom&amp;width=300&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false&amp;appId=151390271591966" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:290px;" allowTransparency="true"></iframe>
                    </div>
                    <div class="blank" style="height: 20px;"></div>
                    <div class="social-side-box">
                        <a class="twitter-timeline"  href="https://twitter.com/ruangguru"  data-widget-id="371164555830779904"></a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
<div id="overlay"></div>
	<div id="success-notif-request-guru" class="request-notif">
        <div class="contact-notif-con">
            <div class="request-notif-header">
                <span>Perhatian!</span>
            </div>
            <div class="request-notif-content">
                <div class="_blank" style="height: 20px;"></div>
                <div>
                    <p>Apakah anda yakin dengan pilihan guru yang anda pilih?<br/>Setelah memilih Anda tidak bisa mengubah pilihan lagi</p>
                </div>
                <div class="_blank" style="height: 20px;border-bottom: 1px solid #dddddd"></div>
                <div class="_blank" style="height: 20px;"></div>
                <div class="center">
                    <img src="<?php echo base_url();?>images/lanjut-button.png" onclick="do_submit();" class="ceklis"/>
				<img src="<?php echo base_url();?>images/batal-button.png" onclick="close_overlay();" class="ceklis"/>
                </div>
                <div class="_blank" style="height: 20px;"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
