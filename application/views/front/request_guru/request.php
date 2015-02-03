<html>
<head>
<title>Cari Guru Les Murah untuk Datang ke Rumah? Request Disini</title>
<meta name="description" content="Ruangguru punya banyak guru les yang siap datang ke rumah dengan rate murah. Kamu juga bisa cari guru untuk toefl dan ielts atau pelajaran lain disini." />
<link rel="canonical" href="http://www.ruangguru.com/request_guru" />
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.alerts.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.alerts.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/validation.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui-1.10.3.custom.min.js" type="text/javascript" charset="utf-8"></script>
<style>
	.ceklis{ cursor:pointer; }
	.jadwal{background-color: #EBEBEB !important;}
	.jadwal.ceklis.selected {background-color: #d5df26 !important;}
</style>

<script>
    function update_matpel(){
        id=$("#jenjangP").val();
        $.getJSON(base_url+"cari_guru/get_matpel/"+id,function(data){
            html = '';
            $.each(data,function(i,item){
                html+= '<option value="'+item.matpel_id+'">'+item.matpel_title+'</option>';
            });
            $("#select-matpel").html(html);
        })
    }
    
      function update_provinsi(){
        id=$("#ddProvinsi").val();
        $.getJSON(base_url+"service/get_lokasi/"+id,function(data){
            html = '';
            $.each(data,function(i,item){
                html+= '<option value="'+item.lokasi_id+'">'+item.lokasi_title+'</option>';
            });
            $("#ddLokasi").html(html);
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
	   $('#request-guru-form').submit(function() {
		return confirm("Apakah Anda yakin dengan pilihan yang Anda pilih - setelah memilih tidak bisa mengubah lagi");
		});
        $("#request-guru-form").validationEngine('attach');
	   $("#jkd").datepicker({ minDate: new Date(),dateFormat: "yy-mm-dd" });
        update_matpel();
        update_provinsi();
    }); 
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
        <div id="request-guru-banner">
            <img src="<?php echo base_url();?>images/request-guru-banner.jpg" alt="banner"/>
        </div>
        <div class="blank" style="height:30px;"></div>
        <table width="100%" id="request-guru">
            <tr>
                <td id="request-left">
                    <div id="request">
                        <div id="request-header">
                            <div id="request-header-wrap">
                               <h2><span class="text-20">PESAN GURU</span></h2>
                            </div>
                        </div>
                        <div id="request-content">
                            <form id="request-guru-form" action="<?php echo base_url();?>cari_guru/request_submit" method="post">
                                <div class="blank" style="height:30px;"></div>
                                <?php if ($this->session->flashdata('request_notification')): ?>
                                    <div class="cari-guru-notif">
                                        <p class="red-notif">
                                            <?php echo $this->session->flashdata('request_notification'); ?>
                                        </p>
                                    </div>
                                <?php endif; ?>
                                <div id="request-subject">
                                   <!-- <?php //if(!empty($pilihan)):?>
                                    <div class="request-title">
                                        PREFERENSI GURU
                                    </div>
                                    <div class="request-data pushed">
                                        <table>
                                            <tr>
                                                <?php //foreach ($pilihan->result() as $guru): ?>
                                                <td>
                                                    <div class="rg-guru-wrap">
                                                        <span style="color: #a81010;font-weight: bold;">X </span><a href="<?php //echo base_url(); ?>cari_guru/hapus_pilihan_request/<?php //echo $guru->guru_id; ?>">hapus dari daftar</a>
                                                    </div>
                                                    <div class="blank" style="height:10px;"></div>
                                                </td>
                                                <?php //endforeach; ?>
                                                <?php //$count = $pilihan->num_rows();$j = 1;?>
                                            </tr>
                                            <tr>
                                                <td colspan="<?php //echo $count;?>">
                                                    <div class="rg-guru-wrap">
                                                        <span class="bold">Prioritas Pilihan:</span><br/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="rg-pg">
                                                <?php //foreach ($pilihan->result() as $guru): ?>
                                                <?php //$k = $j++;?>
                                                <td>
                                                    <div class="rg-guru-wrap">
                                                        <select class="rg-prioritas select-small" name="prioritas[<?php //echo $guru->guru_id;?>]" onchange="update_prioritas(this)">
                                                            <?php //for($i=1;$i<=$count;$i++):?>
                                                            <option value="<?php //echo $i;?>" <?php //echo($k==$i)?'selected':'';?>><?php //echo $i;?></option>
                                                            <?php //endfor;?>
                                                        </select>
                                                        <input type="hidden" id="prioritas-<?php //echo $k;?>" value="<?php //echo $k;?>" />
                                                    </div>
                                                    <div class="blank" style="height:10px;"></div>
                                                </td>
                                                <?php //endforeach;?>
                                            </tr>
                                            <tr class="rg-pp">
                                                <?php //foreach ($pilihan->result() as $guru): ?>
                                                    <td>
                                                        <div class="rg-guru-wrap">
                                                            <?php //if (!file_exists("./images/pp/{$guru->guru_id}.jpg")): ?>
                                                                <img src="<?php //echo base_url(); ?>images/default_profile_image.png"/>
                                                            <?php //else : ?>
                                                                <img src="<?php //echo base_url(); ?>images/pp/<?php //echo $guru->guru_id; ?>.jpg"/>
                                                            <?php //endif; ?>
                                                        </div>
                                                    </td>
                                                <?php //endforeach; ?>
                                            </tr>
                                            <tr class="rg-nama">
                                                <?php// foreach ($pilihan->result() as $guru): ?>
                                                    <td>
                                                        <div class="rg-guru-wrap">
                                                            <?php //echo $guru->guru_nama; ?>
                                                        </div>
                                                        <input type="hidden" name="pilihan[]" value="<?php echo $guru->guru_id;?>"/>
                                                    </td>
                                                <?php //endforeach; ?>
                                            </tr>
                                            <tr class="rg-white">
                                                <?php //foreach ($pilihan->result() as $guru): ?>
                                                    <td style="vertical-align: text-top">
                                                        <div class="rg-guru-wrap">
                                                            <?php
                                                            //$jp = 'other';
                                                           // foreach ($this->guru_model->get_matpel_guru($guru->guru_id)->result() as $matpel) {
                                                            //    echo '<span class="inline-block" style="width:20px;">-</span>' . $matpel->matpel_title . ' ('.$matpel->jenjang_pendidikan_title.')<br/>';
                                                            //}
                                                            ?>
                                                        </div>
                                                    </td>
                                                <?php //endforeach; ?>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="blank" style="height:15px;"></div>
                                    <?php //endif;?>-->
						<div class="request-title">
                                        <h3><span class="text-18">DATA DIRI</span></h3>
                                    </div>
                                    <div class="request-data">
                                        <table>
									<tr>
                                                <td>
                                                    <input type="hidden" class="text" name="requested_by" value="0"/>
                                                </td>
                                            </tr>
                                            <tr height="40px">
                                                <td width="285px">
                                                    <span class="bold">Nama <span class="red-notif">*</span></span>
                                                </td>
									   <td>
                                                    <input type="text" class="validate[required,custom[onlyLetterSp]] text" name="nama" style="width: 250px" id="freq"/>
                                                </td>
                                            </tr>
									<tr>
										<td><span class="bold">Jenis Kelamin<span class="red-notif text-16"> *</span></span></td>
										<td>
										<p>
											<span class="inline-block"><input id="radio1" type="radio" name="gender" value="1" checked/>Laki-laki</span>
											<span class="inline-block"><input id="radio2" type="radio" name="gender" value="2"/>Perempuan</span>
										</p>
										</td>
									</tr>
								    <tr height="40px">
                                                <td><span class="bold">Email <span class="red-notif">*</span></span></td>
                                                <td>
                                                    <input type="text" class="validate[required,custom[email]] text" name="email" style="width: 250px"/>
                                                </td>
                                            </tr>
								    <tr height="40px">
                                                <td><span class="bold">Telepon <span class="red-notif">*</span></span></td>
                                                <td>
                                                    <input type="text" class="validate[required,custom[onlyNumberSp]] text" name="telp" style="width: 250px"/>
                                                </td>
                                            </tr>
								    	<tr height="40px">
                                                <td><span class="bold">Alamat <span class="red-notif">*</span></span>
									   </td>
                                                <td>
                                                    <textarea name="alamat"  class="validate[required] text" style="width: 250px"></textarea>
                                                </td>
                                            </tr>
								 </table>
                                    </div>
							 <div class="blank" style="height:30px;"></div>
                                    <div class="request-title">
                                        <h3><span class="text-18">PREFERENSI MATA PELAJARAN</span></h3>
                                    </div>
                                    <div class="request-data">
                                        <div class="request-field">
                                            <span class="bold">Kategori pelajaran <span class="red-notif">*</span></span><br/>
                                            <select class="select" autocomplete="off" id="jenjangP" name="education" onchange="update_matpel()">
                                                <?php foreach($this->guru_model->get_jenjang()->result() as $item):?>
                                                <option value="<?php echo $item->jenjang_pendidikan_id;?>"><?php echo $item->jenjang_pendidikan_title;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="blank" style="height:10px;"></div>
                                        <div class="request-field bidang-studi-wrap">
                                            <span class="bold">Mata pelajaran <span class="red-notif">*</span></span><br/>
                                            <select class="select" id="select-matpel" name="matpel">
                                            </select>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="blank" style="height:35px;"></div>
                                    </div>
						  <div class="request-title">
                                        <h3><span class="text-18">PREFERENSI LOKASI</span></h3>
                                    </div>
                                    <div class="request-data">
                                        <div class="request-field">
                                            <span class="bold">Provinsi <span class="red-notif">*</span></span><br/>
									<select id="ddProvinsi" class="select" name="provinsi" onchange="update_provinsi()">
										<option value="1">DKI Jakarta</option>
										<?php foreach ($this->guru_model->get_provinsi('provinsi')->result() as $row): ?>
										<option value="<?php echo $row->provinsi_id; ?>"><?php echo $row->provinsi_title; ?></option>
										<?php endforeach; ?>
									</select>
                                        </div>
                                        <div class="blank" style="height:10px;"></div>
                                        <div class="request-field bidang-studi-wrap">
                                            <span class="bold">Lokasi <span class="red-notif">*</span></span><br/>
										<select id="ddLokasi" class="select" name="location">
										</select>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="blank" style="height:35px;"></div>
                                    </div>
                                </div>
                                <div id="request-schedule">
                                    <div class="request-title">
                                        <h3><span class="text-18">JADWAL & FREKUENSI KURSUS</span></h3>
                                    </div>
                                    <div class="request-data">
                                        <table>
									<tr>
                                                <td>
                                                    <input type="hidden" class="text" name="requested_by" value="0"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="bold">Lama belajar <span class="red-notif">*</span></span>
                                                </td>
									   <td>
                                                    <input type="text" class="validate[required,custom[onlyNumberSp]] text" name="freq" style="width: 250px" id="freq"/>
										  <span class="inline-block text-11"><i>Misal: Masukkan angka "12" untuk lama belajar 12 minggu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="bold"><i>Budget</i> (per jam)</span></td>
                                                <td>
                                                    <input type="text" class="validate[custom[onlyNumberSp],min[50000]] text" name="budget" style="width: 250px"/>
										  <span class="inline-block text-11"><i>Misal: Masukkan angka "50000" untuk budget Rp 50,000,-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span> 
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
                                                <td>
										<span class="bold">Jadwal yang Anda pilih <span class="red-notif">*</span></span>
										<input type="hidden" class="validate[required]" name="sch_opt" id="sch_opt"/>
									   </td>
                                            </tr>
								     <tr>
									    <td colspan="2">
											<p class="info2">
												Pilih preferensi waktu belajar Anda dengan meng-klik tabel dibawah. <br/>
											</p>
                                                </td>
								   </tr>
								    <tr>    
									   <td colspan="2">
											<div class="rg-guru-wrap" style="line-height:14px;">
												<div class="_blank" style="height:16px;"></div>
													<table class="availability center" border="0" cellpadding="0" cellspacing="1" width="450">
														<tbody>
															<tr>
																<th></th>
																<?php foreach($days as $hari){?>
																	<th width="16"><?php echo $hari?></th>
																<?php } ?>
															</tr>
														<?php for($i=7;$i<24;$i++):?>
														<tr>
															<th height="30px"><?php echo sprintf('%02s', $i); ?>:00</th>
																<?php for($j=0;$j<7;$j++):?>
																	<td onclick="jadwal_box_click(this)" class="jadwal ceklis">
																		<input class="none jadwal-checkbox" type="checkbox" name="catch_jadwal[]" value="<?php echo $i.','.$j;?>"/>
																	</td>
																<?php endfor;?>
														</tr>
														<?php endfor;?>
													</tbody>
												</table>
												<div class="_blank" style="height:8px;"></div>
												<span style="font-size: 11px;font-weight: normal"><img src="<?php echo base_url()."images/jadwal-chosen-icon.png" ?>"/><strong>&nbsp;Hijau:</strong> Jadwal yang Anda Pilih<strong>
													<div class="_blank" style="height:16px;"></div>
												</div>
										</td>
                                            </tr>
                                            <tr>
                                                <td><span class="bold">Kapan Anda ingin memulai jadwal kursus? <span class="red-notif">*</span></span></td>
                                                <td>
                                                    <input id="jkd" type="text" class="validate[required] datepicker text" name="jkd" style="width: 250px"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="bold">Catatan tambahan</span><br/><span class="inline-block text-11"><i>Cantumkan lokasi belajar jika berbeda dengan alamat Anda dan rute menuju lokasi tersebut agar memudahkan guru les yang anda pesan datang ke rumah atau lokasi yang anda tentukan, ataupun keterangan lain di sini</i></span></td>
                                                <td>
                                                    <textarea name="catatan" class="text" style="width: 250px"></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="blank" style="height:40px;"></div>
                                <div id="request-gender">
                                    <div class="request-title">
                                        <h3><span class="text-18">PREFERENSI GURU</span></h3>
                                    </div>
                                    <div class="request-data">
                                        <div class="request-field">
                                            <span class="bold">Apakah Anda memiliki preferensi gender guru?</span><br/>
                                            <span>
                                                <input type="radio" name="gender" value="1" checked/> Bebas
                                            </span>
                                            <span>
                                                <input type="radio" name="gender" value="2"/> Laki-laki
                                            </span>
                                            <span>
                                                <input type="radio" name="gender" value="3"/> Perempuan
                                            </span>
                                        </div>
                                        <div class="blank" style="height:20px;"></div>
								<div class="request-field">
                                            <span class="bold">Metode belajar manakah yang Anda pilih?</span><br/>
                                            <span>
                                                <input type="checkbox" name="metode[]" value="1" checked/> Online
                                            </span>
                                            <span>
                                                <input type="checkbox" name="metode[]" value="2" checked/> Tatap Muka
                                            </span>
                                        </div>
                                        <div class="blank" style="height:20px;"></div>
                                        <div class="request-field">
                                            <div class="bold">
                                                Masukkan kode keamanan yang tertera di bawah ini :
                                            </div>
                                            <div class="captcha">
                                                <?php echo $this->recaptcha->get_html();?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blank" style="height:30px;"></div>
                                <div id="request-gender">
                                    <div class="request-title">
                                        <h3><span class="text-18">SYARAT DAN KETENTUAN</span></h3>
                                    </div>
                                    <div class="blank" style="height:5px;"></div>
                                    <p class="text-13"><a href="<?php echo base_url();?>syarat_ketentuan/pesan_guru" class="normal-link" target="_blank">Klik link ini untuk membaca Syarat dan Ketentuan untuk Pesan Guru</a><br/>
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
                        </div>
                    </div>
                    <div class="blank" style="height:30px;"></div>
                </td>
                <td id="request-right">
                    <div id="pemesanan-guru">
                        <div id="pg-header">
                            <div id="pg-header-wrap">
                               <h3><span class="text-20">PEMESANAN GURU</span></h3>
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
</body>
</html>
