<script src="<?php echo base_url(); ?>js/bantuan.js" type="text/javascript" charset="utf-8"></script>
<style>
   ol { counter-reset: item; padding-left: 13px; display: table;}
   .number-list li { display: block; display: table-row;}
  .number-list li:before { content: counters(item, ".") ". "; counter-increment: item; display: table-cell;}
</style>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="bantuan">
        <table>
            <tr>
                <td>
                    <div id="bantuan-faq">
                        <div id="bf-header">
                            <div id="bf-header-wrap">
                                SYARAT DAN KETENTUAN
                            </div>
                        </div>
                        <div id="bf-content">
                            <div class="blank" style="height: 20px;"></div>
                            <div class="bfc-wrap">
                                <div class="bfc-title">
							<?php $this->load->view("front/murid/template/terms");?>
						  </div>
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