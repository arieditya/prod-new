<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/validation.css" type="text/css" media="all" />
<style>
    #panel{
	 position: absolute;
	 float:right;
	 right:0;
	 background: #bada55;
	 color: white !important;
      width: 165px;
	 height: 26px;
      font-family: Arial;
      font-size: 13px;
      line-height: 1.6em;
	 z-index:1000;
	 padding-top:-20px;
	 text-align: center;
	-webkit-box-shadow: 0px 2px 4px #888;
	-moz-box-shadow: 0px 2px 4px #888;
	box-shadow: 0px 2px 4px #888;
	 border-radius: 3px  0 0 3px; 
	 -moz-border-radius: 3px  0 0 3px;
	 -webkit-border-radius: 3px  0 0 3px
	}
	#panel:after{
	content: ' ';
	position: absolute;
	width: 0;
	height: 0;
	left: -2px;
	top: 100%;
	border-width: 4px 5px;
	border-style: solid;
	border-color: #666 #666 transparent transparent;
	}
	#panel a{
	 color: white !important;
	 font-weight:bold;
	}
    #sticker {
      margin-top:20px;
	 background: #fff;
      color: #000;
      width: 150px;
	 height: auto;
      font-family: Arial;
      font-size: 13px;
      line-height: 1.6em;
      float:right;
	 padding: 0 4px;
	 position:absolute;
	 right:-1px;
	 z-index:500;
	 text-align: left;
	 -webkit-transform: rotateY(10deg);
	 transform: rotateY(10deg);
	 webkit-transition: all .8s linear;
	 transition: all .8s linear;
	 border-radius: 0 0 10px 10px; 
	 -moz-border-radius: 0 0 10px 10px;
	 -webkit-border-radius: 0 0 10px 10px;
    }
    #sticker:target{
	 -webkit-transform: rotateY(90deg);
	 transform: rotateY(90deg);
    }
    .orange-text{
	color: #ff6600;
	}
</style>
<script>
$(document).ready(function(){
    jQuery("#fast_req").validationEngine({promptPosition: 'inline'});
});
</script>
	<div id="panel">
		<a href="#" id="tutup">Buka</a> | 
		<a href="#sticker">Tutup</a>
    </div>
    <div id="sticker">
     <p class="center">Jika Anda kesulitan atau tidak menemukan guru yang Anda inginkan, masukkan <i>request</i> guru Anda disini untuk kami bantu:</p>
     <?php if($this->session->flashdata('reg_request_notif')):?>
     <div class="guru-notif red-notif">
          <?php echo $this->session->flashdata('reg_request_notif');?>
     </div>
    <?php endif;?>
	<form id="fast_req" name="fast_req" action="<?php echo base_url(); ?>request_guru/request" method="post">
		<p class="bold">Nama: <br/><input type="text" size="18" id="nama" name="nama" class="validate[required2]"></p>
		<p class="bold">Email: <br/><input type="text" size="18" id="email" name="email" class="validate[required2,custom[email]]"></p>
		<p class="bold">Telepon: <br/><input type="text" size="18" id="telp" name="telp" class="validate[required2,custom[onlyNumberSp]]"></p>
		<p class="bold">Mata Pelajaran: <br/><input type="text" size="18" id="matpel" name="matpel" class="validate[required2]"></p>
		<p class="bold">Lokasi: <br/><textarea rows="3" cols="15" id="lokasi" name="lokasi" class="validate[required2]"></textarea></p>
		<p class="bold italic">Request: </span><br/><textarea rows="3" cols="15" id="request" name="request" class="validate[required2]"></textarea></p>
		<p class="fright"><a class="diy-button-mini" style="cursor:pointer;" onclick="document.forms['fast_req'].submit(); return false;">Kirim</a></p>
	</form>
    </div>