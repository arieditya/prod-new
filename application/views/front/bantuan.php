<link rel="stylesheet" href="<?php echo base_url(); ?>css/orbit-1.2.3.css" />
<link rel="canonical" href="http://www.ruangguru.com/kelas" />
<link rel="stylesheet" type="text/css" media="screen and (max-width: 1024px)" href="<?php echo base_url(); ?>css/mobile.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/default.css" />
<?php if (isset($css)){foreach($css as $value){?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/<?php echo $value;?>.css?v=20140218" />
<?php }}?>
<script type="text/javascript">var base_url="<?php echo base_url();?>";</script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/bantuan.js"></script>
<?php /*
<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/bantuan" />
*/?>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/jquery-2.1.1.min.js"></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('.bfcs-list .bfcs-faq-question').click(function(){        
        obj = $(this).siblings(".bfcs-faq-answer");
        if(!$(obj).is(':visible')){
            $(".bfcs-faq-answer").hide('slow');
        }
        $(obj).slideToggle('slow');
    });
});

$(document).ready(function(){
    $('.bfcs-list .bfcs-faq-guru-question').click(function(){        
        obj = $(this).siblings(".bfcs-faq-answer");
        if(!$(obj).is(':visible')){
            $(".bfcs-faq-answer").hide('slow');
        }
        $(obj).slideToggle('slow');
    });
});

$(document).ready(function(){
    $('.bfcs-list .bfcs-faq-duta-question').click(function(){        
        obj = $(this).siblings(".bfcs-faq-answer");
        if(!$(obj).is(':visible')){
            $(".bfcs-faq-answer").hide('slow');
        }
        $(obj).slideToggle('slow');
    });
});
</script>
<?php /*
</head>
*/?>
<?php
$this->load->view('vendor/general/header');
?>
<body>
<div class="container">
<div id="content">
    <div id="bantuan">
        <table>
            <tr>
                <td>
                        <div id="bf-header" style="width:auto;">
                            <div id="bf-header-wrap">
                                FAQ
                            </div>
                        </div>
                        <div id="bf-content">
                            <div class="blank" style="height: 20px;"></div>
                            <div class="bfc-wrap">
                                <div class="bfc-title">
                                    Berikut ini adalah daftar pertanyaan dan jawaban untuk hal-hal yang sering ditanyakan mengenai Ruangguru. Jika Anda masih memiliki pertanyaan lain namun tidak tertera di bawah ini, Anda dapat menghubungi kami ke kontak kami <a href="<?php echo base_url()."kontak_kami";?>" class="normal-link bold">di sini</a>.
                                </div>
								</br>
                                <ul class="nav nav-tabs-2" role="tablist">
									<li id="profile_selector" class="active"><a href="#private" role="tab" data-toggle="tab">Privat</a></li>
									<li id="profile2_selector"><a href="#kelas" role="tab" data-toggle="tab">Kelas</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="private">
										<?php $this->load->view('front/bantuan/ruangguru');?>
										<?php $this->load->view('front/bantuan/guru');?>
										<?php $this->load->view('front/bantuan/murid');?>
										<?php $this->load->view('front/bantuan/duta_guru');?>
									</div>
									<div class="tab-pane" id="kelas">
										<?php $this->load->view('front/bantuan/umum');?>
										<?php $this->load->view('front/bantuan/calon_murid');?>
										<?php $this->load->view('front/bantuan/vendor');?>
									</div>
								</div>
							</div>
						</div>

                </td>
            </tr>
        </table>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</div>
</body>
</html>