<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/bantuan" />
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
</head>
<body>
<div id="content">
    <div id="bantuan">
        <table>
            <tr>
                <td>
                    <div id="bantuan-faq">
                        <div id="bf-header">
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
								<ul class="nav nav-tabs-sq" role="tablist">
									<li id="profile_selector" class="active"><a href="#private" role="tab" data-toggle="tab">Published</a></li>
									<li id="profile2_selector"><a href="#kelas" role="tab" data-toggle="tab">Draft</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="private">
										<?php $this->load->view('front/bantuan/ruangguru');?>
										<?php $this->load->view('front/bantuan/guru');?>
										<?php $this->load->view('front/bantuan/murid');?>
										<?php $this->load->view('front/bantuan/duta_guru');?>
									</div>
									<div class="tab-pane" id="kelas">
										<p>Kelas tidak tersedia</p>
									</div>
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
</body>
</html>