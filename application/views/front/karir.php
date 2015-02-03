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
                                <div class="bfc-title" style="line-height:1.6em;">
                                   <p>Ruangguru is a new yet emerging venture in the education space. We are an online marketplace to connect talented teachers/tutors/ institutions with eager students all across Indonesia - and this is just one of the products we build. Since the launching few months ago, we have been growing rapidly. Currently, we manage nearly 7000 tutors across Indonesia - placing us as the largest education marketplace in the country.</p>
								   <p>If you think that there is nothing special in the work of connecting people to learn, you might be wrong. We have witnessed how a simple work of connecting people can help the people to land at their aspiration. We have heard stories of students who gained new skills and because of that, able to get their dream jobs; students who passed the exams at their desirable scores and help them to get a scholarship at a university abroad; and more and more kids who finally get a mentor and someone to look up to. Since we have launched, we have gained 99% of users' satisfaction and positive reviews.</p>
								   <p>Well, maybe we do the simple things, but we believe that the big things always come from the simple thing - the simple idea that connecting people to learn, to be a life-long learner, is essential.</p>
								   <p>2015 is a big year for all of us at Ruangguru. We have an ambitious goal to bring the best learning experience for all of our students, gain significant growth. We want you on board, to join enthusiastic, ambitious, passionate and caring individuals who want to disrupt Indonesia's education. Our current team boasts people having studied in Stanford, Harvard, Columbia, UI, Unpad, IPB, and other top universities originating form diverse locations. Many of them have previously worked in multiple industries - consulting, startup, non-profit, education, research, creative, and others. We promise ample learning opportunities with on the job training, great mentors, and an open, creative and fun environment for you. There is no better time to join us!</p>
								</div>
                                <?php $this->load->view('front/karir/karir');?>
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