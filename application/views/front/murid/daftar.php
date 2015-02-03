<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/murid" />
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
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
$(document).ready(function(){
    $("#registrasi-murid-form").validationEngine('attach');
    update_provinsi();
}); 

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
        <div id="registrasi-murid">
            <div id="registrasi-murid-header">
                <div id="registrasi-murid-header-wrap">
                    REGISTRASI MURID
                </div>
            </div>
            <div id="registrasi-murid-content" class="murid-content">
                <div class="blank" style="height: 20px;"></div>
                <div class="guru-notif">
                    <?php echo validation_errors('<span="error">', '</span><br/>'); ?>
                </div>
                <form id="registrasi-murid-form" class="guru-form" action="<?php echo base_url(); ?>murid/registrasi" method="post">
                    <table cellpadding="5">
                        <tr>
                            <td style="width: 250px;">Email<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="email" name="email" type="text" class="validate[required,custom[email]] text" value="<?php echo set_value('email'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Password<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="pass" name="pass" type="password" class="validate[required,minSize[6]] text" />
                            </td>
                        </tr>
                        <tr>
                            <td>Ulangi Password<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="confpass" name="confpass" type="password" class="validate[required,equals[pass]] text" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-murid-st">
                                    BIODATA DIRI
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="nama" name="nama" type="text" class="validate[required,custom[onlyLetterSp]] text" value="<?php echo set_value('nama'); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">Alamat<span class="red-notif text-16"> *</span></p>
                            </td>
                            <td>
                                <textarea id="alamat" name="alamat" class="validate[required] text"><?php echo set_value('alamat'); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Provinsi</td>
                            <td>
                                <p>
                                    <select id="ddProvinsi" name="provinsi" onchange="update_provinsi()" class="text-13" style="width:232px">
                                        <?php foreach ($provinsi->result() as $row): ?>
                                            <option value="<?php echo $row->provinsi_id; ?>" <?php echo set_select('provinsi', $row->provinsi_id); ?>><?php echo $row->provinsi_title; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>
                                <p>
                                    <select id="ddLokasi" name="kota" class="text-13" style="width:232px">
                                        <?php foreach ($kota->result() as $row): ?>
                                            <option value="<?php echo $row->lokasi_id; ?>" <?php echo set_select('kota', $row->lokasi_id); ?>><?php echo $row->lokasi_title; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="auto-line-height">No. Ponsel<span class="red-notif text-16"> *</span></p>
                                <p class="text-11">Contoh: 08120987602</p></td>
                            <td>
                                <input id="hp" name="hp" type="text" class="validate[required,custom[onlyNumberSp]] text" value="<?php echo set_value('hp'); ?>"/>
                                
                            </td>
                        </tr>
				    <tr>
                            <td>Jenis Kelamin<span class="red-notif text-16"> *</span></td>
                            <td>
                                <p>
                                    <span class="inline-block"><input id="radio1" type="radio" name="gender" value="1" <?php echo set_radio('gender', '1', TRUE); ?>/>Laki-laki</span>
                                    <span class="inline-block"><input id="radio2" type="radio" name="gender" value="2" <?php echo set_radio('gender', '2'); ?>/>Perempuan</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>Mengetahui Info Ruangguru dari</td>
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
                                <div class="_blank" style="height: 30px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>Masukkan kode keamanan yang tertera dibawah ini<span class="red-notif text-16"> *</span></p>
                                <p>
                                    <?php echo $this->recaptcha->get_html();?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
							<div class="blank" style="height:20px;"></div>
                                   <a href="<?php echo base_url();?>syarat_ketentuan/murid" class="normal-link" target="_blank">Klik link ini untuk membaca Syarat dan Ketentuan menjadi Murid</a><br/>
							<input type="checkbox" value="1" name="term" id="term" class="validate[required]"/> Saya setuju dengan syarat & ketentuan yang ada<span class="red-notif text-16"> *</span> 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="blank" style="height:30px;"></div>
                                        <input type="image" src="<?php echo base_url();?>images/daftar-button-big.png"/><br/>
								<span class="red-notif text-16">* </span><span class="text-13">Wajib diisi</span> 
                                </div>
                                <div class="blank" style="height:60px;"></div>
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