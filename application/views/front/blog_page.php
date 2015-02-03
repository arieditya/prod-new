<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/bantuan" />
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
    <div id="bantuan">
        <table>
            <tr>
                <td>
                    <div id="bantuan-faq">
                        <div id="bf-header">
                            <div id="bf-header-wrap">
                                Lowongan
                            </div>
                        </div>
                        <div id="bf-content">
                            <div class="blank" style="height: 20px;"></div>
                            <div class="bfc-wrap">
                                <div class="bfc-title">
                                    Ini adalah halaman daftar lowongan pekerjaan yang tersedia di Ruangguru. Jika Anda berminat dan memiliki kualikasi yang sesuai dengan kriteria, Anda dapat mengirimkan CV ke <a href="mailto:apply@ruangguru.com" class="normal-link bold">apply@ruangguru.com</a>.
                                </div>
						  <br/>
						  <div class="bfc-title italic">
                                   Mohon maaf untuk saat ini belum ada lowongan yang tersedia.
                                </div>
                                <?php //$this->load->view('front/karir/guru');?>
                                <?php //$this->load->view('front/karir/murid');?>
                                <?php //$this->load->view('front/karir/duta_guru');?>
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