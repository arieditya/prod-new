<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/bantuan" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.sticky.js"></script>
<script>
    $(window).load(function(){
      $("#sticker").sticky();
    });
     $(window).load(function(){
      $("#panel").sticky();
    });
</script>
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
    <div class="blank" style="height:30px;"></div>
    <?php $this->load->view('front/layout/popup_form');?>
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
                                <?php $this->load->view('front/bantuan/ruangguru');?>
                                <?php $this->load->view('front/bantuan/guru');?>
                                <?php $this->load->view('front/bantuan/murid');?>
                                <?php $this->load->view('front/bantuan/duta_guru');?>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <?php $this->load->view('front/layout/contact');?>
                    <div class="blank clear" style="height: 20px;"></div>
                    <div class="social-side-box">
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fruanggurucom&amp;width=300&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false&amp;appId=151390271591966" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:290px;" allowTransparency="true"></iframe>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</body>
</html>