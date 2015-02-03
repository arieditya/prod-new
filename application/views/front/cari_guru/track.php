<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(document).ready(function(){
        $("#track-request-form").validationEngine('attach');
    }); 
</script>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height:30px;"></div>
        <?php echo $progress;?>
        <div class="blank" style="height:30px;"></div>
        <div id="track-request">
            <div id="track-request-header">
                <div id="track-request-header-wrap">
                    4. TRACK MY REQUEST
                </div>
            </div>
            <div id="track-request-content">
                <form id="track-request-form" action="<?php echo base_url();?>cari_guru/track_submit" method="post">
                    <div class="blank" style="height: 10px;"></div>
                    <?php if($this->session->flashdata('track_notification')):?>
                    <div class="track-request-notif cari-guru-notif">
                        <p class="red-notif">
                            <?php echo $this->session->flashdata('track_notification');?>
                        </p>
                    </div>
                    <?php endif;?>
                    <div class="track-request-text">
                        <p>
                            If you have submitted a request, you can track the status of your request which has the info of the tutors contacted and their response.
                        </p>
                        <p>
                            Enter your phone number and postal code of your address.
                        </p>
                    </div>
                    <div class="track-field">
                        <p>NO HANDPHONE</p>
                        <input id="handphone" type="text" class="validate[required,custom[onlyNumberSp]] text" name="handphone"/>
                    </div>
                    <div class="track-field">
                        <p>EMAIL</p>
                        <input id="email" type="text" class="validate[required,custom[email]] text" name="email"/>
                    </div>
                    <div class="track-field">
                        <p>TRACKING CODE</p>
                        <input id="code" type="text" class="validate[required] text" name="code"/>
                    </div>
                    <div class="blank" style="height: 20px;"></div>
                    <div class="track-submit">
                        <input type="image" src="<?php echo base_url(); ?>images/go-button.png"/>
                    </div>
                </form>
                <div class="blank" style="height:30px;"></div>
            </div>
            <div class="blank" style="height:10px;"></div>
        </div>
        <div class="blank" style="height:30px;"></div>
    </div>
</div>