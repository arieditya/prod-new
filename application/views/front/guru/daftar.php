<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/guru" />
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/daftarguru.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $("#registrasi-guru-form").validationEngine('attach');
}); 

function provinsi_click(obj){
    checkbox = $(obj).children('.lokasi');
    if(checkbox.is(':checked')){
        checkbox.attr('checked', true);
        $(obj).removeClass();
    }else{
        checkbox.attr('checked', false);
        $(obj).addClass("validate[minCheckbox[1]]");
	   $(obj).toogleClass("validate[minCheckbox[1]]");
    }
}

function other_provinsi_click(obj){
    selectbox = $(obj).children('.provinsi');
    checkbox = $(obj).children('.lokasi');
    if(checkbox.attr('checked', false)){
		if(selectbox.is(':selected')){
			selectbox.attr('selected', true);
			$(obj).removeClass();
		}else{
			selectbox.attr('selected', false);
			$(obj).addClass("validate[required]");
			$(obj).toogleClass("validate[required]");
		}
	}
}

function cu(){
    val = $('#universitas').val();
    $.getJSON("<?php echo base_url(); ?>guru/getuniv/"+val,
        function(data) {
            $("#univ-wrap").html("");
            str = "";
            $.each(data, function(i,item){
                str += "<span class=\"inline-block rgc\">"
                str += "<input type=\"checkbox\" name=\"matpel["+item.matpel_id+"]\" value=\""+item.matpel_id+"\"/>"+item.matpel_title;
                str += "</span>";
            });
            $("#univ-wrap").html(str);
    });
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
        <div class="blank" style="height: 30px;"></div>
        <div id="registrasi-guru">
            <div id="registrasi-guru-header">
                <div id="registrasi-guru-header-wrap">
                    REGISTRASI GURU ( Bagian 1 dari 2)
                </div>
            </div>
            <div id="registrasi-guru-content" class="guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('reg_guru_notif')):?>
                <div class="guru-notif">
                    <?php echo $this->session->flashdata('reg_guru_notif');?>
                </div>
                <?php endif;?>
                <form id="registrasi-guru-form" class="guru-form" action="<?php echo base_url(); ?>guru/reg_submit" method="post">
                    <table cellpadding="8">
                        <tr height="40px">
                            <td style="width: 250px;">Email<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="email" name="email" type="text" class="validate[required,custom[email]] text" value="<?php echo $email; ?>"/>
                            </td>
                        </tr>
                        <tr height="50px">
                            <td>Password<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="pass" name="pass" type="password" class="validate[required,minSize[6]] text" value="<?php echo $pass; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Ulangi Password<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="confpass" name="confpass" type="password" class="validate[required,equals[pass]] text" value=""/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                   BIODATA DIRI
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="nama" name="nama" type="text" class="validate[required,custom[onlyLetterSp]] text" value="<?php echo (!empty($input['nama']))?$input['nama']:'';?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>No. KTP/ Paspor<span class="red-notif text-16"> *</span>
                                <br/><span class="red-notif text-11">Data ini permanen dan tidak bisa diubah. Jika identitas Anda ditemukan palsu, Akun Anda akan ditutup</span>
                                </td>
                            <td>
                                <input id="nik" name="nik" type="text" class="validate[required] text" value="<?php echo (!empty($input['nik']))?$input['nik']:'';?>"/>
                            </td>
                        </tr>
				    <tr>
                            <td>Jenis Kelamin<span class="red-notif text-16"> *</span></td>
                            <td>
                                <p>
                                    <span class="inline-block"><input id="radio1" type="radio" name="gender" value="1" checked/>Laki-laki</span>
                                    <span class="inline-block"><input id="radio2" type="radio" name="gender" value="2"/>Perempuan</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>Pendidikan Saat Ini<span class="red-notif text-16"> *</span></td>
                            <td>
                                <p>
                                    <select name="pendidikan_id" class="text-13">
                                        <?php foreach ($pendidikan->result() as $row): ?>
                                            <option value="<?php echo $row->pendidikan_id; ?>"><?php echo $row->pendidikan_title; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">Institusi &AMP; Jurusan Pendidikan Saat Ini </p>
                                <p class="text-11">Contoh : Universitas Indonesia - Ilmu Komunikasi<br/>Jika Anda sudah lulus masukkan tingkat pendidikan terakhir</p>
					    </td>
                            </td>
                            <td>
                                <input id="instansi" name="pendidikan_instansi" type="text" class="validate[required,maxSize[100]] text" value="<?php echo (!empty($input['pendidikan_instansi']))?$input['pendidikan_instansi']:'';?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Tempat Lahir<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="tempatlahir" name="tempatlahir" type="text" class="validate[required,custom[onlyLetterSpecial]] text" value="<?php echo (!empty($input['tempatlahir']))?$input['tempatlahir']:'';?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir<span class="red-notif text-16"> *</span></td>
                            <td>
                                <p>
                                    <select name="tanggal" class="text-13">
                                        <?php for ($i = 1; $i <= 31; $i++): ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <select name="bulan" class="text-13">
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                            <?php $months = array(1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'); ?>
                                            <option value="<?php echo $i; ?>"><?php echo $months[$i]; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <select name="tahun" class="text-13">
                                        <?php for ($i = 1950; $i <= (date("Y") - 15); $i++): ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">No. Ponsel 1<span class="red-notif text-16"> *</span></p>
                                <p class="text-11">Contoh: 08120987602</p></td>
                            <td>
                                <input id="hp" name="hp" type="text" class="validate[required,custom[onlyNumberSp]] text" value="<?php echo (!empty($input['hp']))?$input['hp']:'';?>"/>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">No. Ponsel 2</p>
                            </td>
                            <td>
                                <input id="hp_2" name="hp_2" type="text" class="validate[custom[onlyNumberSp]] text" value="<?php echo (!empty($input['hp_2']))?$input['hp_2']:'';?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">Alamat<span class="red-notif text-16"> *</span></p>
                                <p class="text-11">Data alamat sesuai KTP atau domisili</p>
                            </td>
                            <td>
                                <textarea id="alamat" name="alamat" class="validate[required] text"><?php echo (!empty($input['alamat']))?$input['alamat']:'';?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Pekerjaan/ Kategori<span class="red-notif text-16"> *</span></td>
                            <td>
                                <p>
                                    <select name="kategori" class="text-13">
								<option value="7">Pelajar SMA</option>
								<option value="1">Mahasiswa S1</option>
								<option value="2">Mahasiswa S2/S3</option>
								<option value="3">Guru Sekolah</option>
								<option value="5">Guru Privat Full Time (< 1 Tahun)</option>
								<option value="6">Guru Privat Part Time</option>
								<option value="4">Dosen</option>
								<option value="8">Profesional</option>
								<option value="9">Lainnya</option>
                                        <?php //foreach ($kategori->result() as $row): ?>
                                            <!--<option value="<?php //echo $row->kategori_id; ?>"><?php //echo $row->kategori_title; ?></option>-->
                                        <?php //endforeach; ?>
                                    </select>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">Kode <i>Referral</i> (Opsional)</p>
                                <p class="text-11">Tidak wajib, isi jika mengetahui Ruangguru dari Duta Ruangguru</p>
                            </td>
                            <td>
                                <input id="referral" name="referral" type="text" class="validate[custom[onlyNumberSp]] text" />
                            </td>
                        </tr>
                        <tr>
                            <td>Mengetahui Info Ruangguru dari </td>
                            <td>
                                <p>
						  <table id="source-info">
							 <?php $n = 0; ?>
                                    <?php foreach($this->utilities_model->get_source_info()->result() as $row):?>
							  <?php if(($n%2 == 0)){echo "<tr>"; }?>
							 <?php if($n < 7){ ?>
							 <td>
                                    <input id="radio<?php echo $row->source_info_id;?>" type="checkbox" name="source_info[]" value="<?php echo $row->source_info_id;?>"/><?php echo $row->source_info_title;?>
							 </td>
							 <?php } else { ?>
							 <td>
                                    <?php echo $row->source_info_title;?>: <input id="lainnya" type="text" name="lainnya"/>
							 </td>
							 <?php } ?>
							 <?php $n++;?>
							 <?php if(($n%2 == 0)){echo "</tr>"; }?>
							 <?php endforeach;?>
						  </table>
                                </p>
                            </td>
                        </tr>
				    <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    METODE MENGAJAR <span class="red-notif text-16"> *</span>
                                </div>
                            </td>
                        </tr>
				    <tr>
                            <td colspan="2">
                                <p>
                                   <input type="checkbox" name="metode[]" class="validate[minCheckbox[1]]" id="metode1" value="1" checked/>Online
						  </p>
						  <p>
                                   <input type="checkbox" name="metode[]" class="validate[minCheckbox[1]]" id="metode2" value="2" checked/>Tatap Muka
						  </p><br/>
						  <p class="text-12">(Mekanisme dan perlengkapan ditentukan sendiri oleh guru)</p>
					   </td>
				    </tr>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    PREFERENSI LOKASI <span class="red-notif text-16"> *</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>
                                    <span class="bold">Pilih Lokasi Tempat Anda Mengajar:</span><br/>
                                <?php foreach ($lokasi_jkt->result() as $row): ?>
						  <?php if(($n%4 == 0)){echo "<span class='inline-block'>"; }?>
                                        <input type="checkbox" name="lokasi[]" class="validate[minCheckbox[1]]" id="lokasi<?php echo $row->lokasi_id; ?>" value="<?php echo $row->lokasi_id; ?>"/><?php echo $row->lokasi_title; ?><br/>
						  <?php $n++;?>
						  <?php if(($n%4 == 0)){echo "</span>"; }?>
                                <?php endforeach; ?>
                                <br/><br/><p><input type="checkbox" id="lokasi10" name="lokasi[]"/><span class="inline-block rgc bold">atau pilih lokasi lain:</span></p>
                                <table>
                                    <tr>
                                        <td><p>Pilih Provinsi:</p></td>
                                        <td>
                                            <select id="ddProvinsi" name="provinsi" onchange="update_provinsi()">
                                                <option value="">--Pilih Provinsi--</option>
                                                <?php foreach ($this->guru_model->get_table('provinsi')->result() as $row): ?>
                                                    <option value="<?php echo $row->provinsi_id; ?>" ><?php echo $row->provinsi_title; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><p>Pilih Kota:</p></td>
                                        <td>
                                            <select id="lokasi_lainnya" name="lokasi_lain" style="width: 200px;" class="validate[condRequired[lokasi10]]">
                                                <option value="">--Pilih Kota--</option>
                                            </select>
                                        </td>
                                    </tr>
                                        
                                </table>
                                </p>
                            </td>
                        </tr>
						<tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    MATA PELAJARAN YANG ANDA AJAR <span class="red-notif text-16"> *</span>
                                </div>
                            </td>
                        </tr>
                        <?php foreach($jenjang->result() as $type):?>
                        <tr>
                            <td colspan="2">
                                <p class="rgm"><?php echo $type->jenjang_pendidikan_title;?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>
						  <table>
						  <?php $x = 0; ?>
                                <?php foreach ($this->guru_model->get_matpel($type->jenjang_pendidikan_id)->result() as $row): ?>
						  <?php if(($x%4 == 0)){echo "<tr>"; }?>
							 <td>
                                    <span class="inline-block rgc">
                                        <input type="checkbox" class="validate[minCheckbox[1]]" name="matpel[]" value="<?php echo $row->matpel_id; ?>"/><?php echo $row->matpel_title; ?>
                                    </span> 
							</td>
							<?php $x++;?>
							 <?php if(($x%4 == 0)){echo "</tr>"; }?>
                                <?php endforeach; ?>
						  </table>
                                </p>
                            </td>
                        </tr>
                        <?php endforeach;?>

                        <tr>
                            <td colspan="2">
                                <div class="blank" style="height:20px;"></div>
                                <div>
						  	<span class="text-14 red-notif">*</span><span class="text-13"> Wajib diisi</span><br/>
                                    <span class="text-14 red-notif">**</span>Apabila mata pelajaran yang ingin Anda ajarkan tidak ada, 
                                        silahkan mengirimkan request Anda melalui e-mail ke <a href="mailto:info@ruangguru.com?Subject=[WEBSITE] Tambah Mata Pelajaran" target="_top" class="normal-link">info@ruangguru.com</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="blank" style="height:30px;"></div>
                                <div id="register-terms-submit">
                                    <input type="image" src="<?php echo base_url();?>images/lanjut-step-button.png"/>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="blank" style="height: 20px;"></div>
            </div>
        </div>
        <div class="blank" style="height: 30px;"></div>
    </div>
</div>
</body>
</html>