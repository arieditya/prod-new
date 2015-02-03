<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/murid/login" />
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
					<div id="login-murid-header">
						<div id="login-murid-header-wrap">
							LOGIN MURID
						</div>
					</div>
				<div id="login-guru-content" class="guru-content">
				<div class="blank" style="height: 20px;"></div>
					<?php if($this->session->flashdata('login_murid_notif')):?>
					<div class="guru-notif">
						<?php echo $this->session->flashdata('login_murid_notif');?>
					</div>
					<?php endif;?>
					<p>Untuk bisa request kelas, Anda harus login sebagai murid.<br/>Jika Anda belum terdaftar menjadi murid, silahkan 
                        <strong><a class="normal-link" href="<?php echo base_url();?>murid/registrasi">daftar</a></strong>
                        sebagai murid.</p>
				    <div class="blank" style="height: 20px;"></div>
					<form id="login-guru-form" class="guru-form" method="post" action="<?php echo base_url();?>murid/login_submit">
					<table>
						<tr height="50px">
							<td style="width: 250px;"><span class="text-13">Email</span></td>
							<td>
								<input id="email" name="email" type="text" class="validate[required,custom[email]] text" />
							</td>
						</tr>
						<tr>
							<td><span class="text-13">Password</span></td>
							<td>
								<input id="pass" name="password" type="password" class="validate[required,minSize[6]] text" />
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<div class="blank" style="height:5px;"></div>
								<div>
									<a class="normal-link" href="<?php echo base_url();?>murid/reset_password"><span class="text-13 blue-text">Lupa Password?</span></a>
								</div>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<div class="blank" style="height:20px;"></div>
								<div>
									<input type="image" src="<?php echo base_url();?>images/masuk-button.png"/>&nbsp;<a href="<?php echo base_url().'murid/registrasi'?>"><img src="<?php echo base_url().'images/daftar-button.png';?>"/></a>
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