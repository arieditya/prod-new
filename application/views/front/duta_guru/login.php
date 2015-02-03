<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/duta_guru/login" />
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
            <div id="login-duta-header">
                <div id="login-duta-header-wrap">
                    LOGIN DUTA GURU
                </div>
            </div>
            <div id="login-guru-content" class="guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('login_dutaguru_notif')):?>
                <div class="guru-notif">
                    <?php echo $this->session->flashdata('login_dutaguru_notif');?>
                </div>
                <?php endif;?>
                <form id="login-guru-form" class="guru-form" method="post" action="<?php echo base_url();?>duta_guru/login_submit">
                    <table>
                        <tr height="50px">
                            <td style="width: 250px;">Email</td>
                            <td>
                                <input id="email" name="email" type="text" class="validate[required,custom[email]] text" />
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>
                                <input id="pass" name="password" type="password" class="validate[required,minSize[6]] text" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="blank" style="height:5px;"></div>
                                <div>
                                    <a class="normal-link" href="<?php echo base_url();?>duta_guru/reset_password">Lupa Password?</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="blank" style="height:20px;"></div>
                                <div>
                                    <input type="image" src="<?php echo base_url();?>images/masuk-button.png"/>&nbsp;<a href="<?php echo base_url().'duta_guru/registrasi'?>"><img src="<?php echo base_url().'images/daftar-button.png';?>"/></a>
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