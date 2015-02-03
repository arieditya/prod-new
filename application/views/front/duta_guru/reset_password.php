<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/duta_guru/reset_password" />
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $("#login-guru-form").validationEngine('attach');
}); 
</script>
</head>
<body>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="login-guru">
            <div id="login-guru-header">
                <div id="login-guru-header-wrap">
                    RESET PASSWORD DUTA GURU
                </div>
            </div>
            <div id="login-guru-content" class="guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('reset_pass_duta_guru_notif')):?>
                <div class="guru-notif">
                    <?php echo $this->session->flashdata('reset_pass_duta_guru_notif');?>
                </div>
                <?php endif;?>
                <form id="login-guru-form" class="guru-form" method="post" action="<?php echo base_url();?>duta_guru/reset_password_submit">
                    <table>
                        <tr>
                            <td style="width: 250px;">Email : </td>
                            <td>
                                <input id="email" name="email" type="text" class="validate[required,custom[email]] text" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="blank" style="height:20px;"></div>
                                <div>
                                    <input type="image" src="<?php echo base_url();?>images/submit-button.png"/>
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