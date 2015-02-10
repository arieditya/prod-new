<?php $this->load->view('vendor/general/header');?>
<!DOCTYPE html>
<!-- saved from url=(0050)http://getbootstrap.com/examples/starter-template/ -->
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Ruangguru : Cara Mudah Cari Guru Privat, Les, dan Kursus</title>
		<script type="text/javascript" src="<?php echo base_url();?>js/home.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tinycarousel.js"></script>
		<link rel="stylesheet" href="<?php echo base_url();?>css/tinycarousel.css" type="text/css" media="screen"/>
		<script>
			$(document).ready(function(){
				$("#slider6").tinycarousel({
					bullets  : true,
					interval : true,
					intervalTime : 8000
				});
			});
			
			$(document).ready(function() {
				$('.fancybox').fancybox();
			})
		</script>
    </head>
    <body>
<?php
if ($this->session->flashdata('status.message')): ?>
	<div class="msg msg-ok boxwidth">
		<p><strong><?php echo $this->session->flashdata('f_class'); ?></strong></p>
	</div>
<?php endif; 
if ($this->session->flashdata('status.warning')): ?>
	<div class="msg msg-error boxwidth">
		<p><strong><?php echo $this->session->flashdata('f_class_error'); ?></strong></p>
	</div>
<?php endif; ?>
		<section id="header" class="bg-vendor">
            <div class="container">
				<div class="row">
					<div class="col-md-offset-1 col-md-5 padbottom-10">
						<ul class="btn-how-to">
							<li class="btn-pinky shadow"><a href="#cara-kerja">Cara Kerja</a></li>
							<li class="btn-pinky-active shadow"><a class="fancybox" href="#inline2">Daftar kelas pertama gratis!</a></li>
						</ul>
					</div>
				</div>
			</div>
        </section>
        <!--<section id="why" class="bg-all">
        <div class="container bottom-20">
            <div class="row">
				<div class="col-md-offset-1 col-md-10">
					<span class="text-center"><h2 class="bold pink">Mengapa Memilih Ruangguru.com?</h2></span>
					<div class="col-md-3 verifikasi">
						<img src="<?php //echo base_url();?>images/Why-verifikasi.png">
					</div>
					<div class="col-md-3 pilihan">
						<img src="<?php //echo base_url();?>images/Why-Pilihan.png">
					</div>
					<div class="col-md-3 garansi">
						<img src="<?php //echo base_url();?>images/Why-garansi.png">
					</div>
					<div class="col-md-3 bayar">
						<img src="<?php //echo base_url();?>images/Why-bayar.png">
					</div>
				</div>
            </div>
			<div class="bottom-20"></div>
        </div>     
        </section>-->
		<section id="galeri">
			<div class="container bottom-10">
				<div class="row">
					<div class="col-md-offset-1 col-md-10">
						<h1 class="bold text-center top-30">Apa Manfaat Menggunakan Ruangguru?</h1>
						<div class="col-md-6">
							<ul id="manfaat-rg">
								<li>
									<div class="pull-left ico-manfaat"><img src="<?php echo base_url();?>images/rg-1.png"/></div>
									<div>
										<p class="bold pink">Increase Enrollments and Revenues</p>
										<p>Raih penghasilan tambahan! Kami hanya akan mengambil komisi 15% dari setiap siswa yang mendaftar lewat Ruangguru*</p>
									</div>
								</li>
								<li>
									<div class="pull-left ico-manfaat"><img src="<?php echo base_url();?>images/rg-2.png"/></div>
									<div>
										<p class="bold pink">Monitor and Update Your Class</p>
										<p>Penyedia kelas memiliki akun khusus mengelola setiap kelas, memonitor data siswa, pembayaran, hingga berkomunikasi dengan siswa</p>
									</div>
								</li>
								<li>
									<div class="pull-left ico-manfaat"><img src="<?php echo base_url();?>images/rg-3.png"/></div>
									<div>
										<p class="bold pink">Dedicated Customer Service Support</p>
										<p>Tim layanan konsumen kami akan membantu murid untuk mendaftar di kelas, mengingatkan pembayaran, hingga membantu tanya jawab mengenai kelas</p>
									</div>
								</li>
								<li>
									<div class="pull-left ico-manfaat"><img src="<?php echo base_url();?>images/rg-4.png"/></div>
									<div>
										<p class="bold pink">Friendly Return Policy</p>
										<p>Jika kelas yang Anda selenggarakan batal terlakasana karena jumlah siswa tidak mencukupi, kami akan memberikan penggantian biaya 100% kepada murid</p>
									</div>
								</li>
								<li>
									<p>* Dalam kasus tertentu, Anda dapat memperoleh potongan komisi yang lebih kecil. Hubungi <span class="pink">inquiry@ruangguru.com</span> untuk informasi lebih lanjut</p>
								</li>
							</ul>
						</div>
						<div class="col-md-6">
							<ul id="manfaat-rg">
								<li>
									<div class="pull-left ico-manfaat"><img src="<?php echo base_url();?>images/rg-5.png"/></div>
									<div>
										<p class="bold pink">Various Options for Payment Method</p>
										<p>Pembayaran di Ruangguru.com dapat dilakukan dengan kartu kredit, bank transfer, internet banking, dan cash</p>
									</div>
								</li>
								<li>
									<div class="pull-left ico-manfaat"><img src="<?php echo base_url();?>images/rg-6.png"/></div>
									<div>
										<p class="bold pink">Free Email and Social Media Marketing</p>
										<p>Kami akan mempromosikan kelas Anda kepada puluhan ribu anggota komunitas kami secara gratis!</p>
									</div>
								</li>
								<li>
									<div class="pull-left ico-manfaat"><img src="<?php echo base_url();?>images/rg-7.png"/></div>
									<div>
										<p class="bold pink">Available Classrooms for Rent</p>
										<p>Jika Anda tidak tahu dimana akan menyelenggarakan kelas, kami menyediakan opsi penyewaan ruang kelas dengan harga yang terjangkau (tergantung ketersediaan)</p>
									</div>
								</li>
								<li>
									<div class="pull-left ico-manfaat"><img src="<?php echo base_url();?>images/rg-8.png"/></div>
									<div>
										<p class="bold pink">Access to Held Customized Training</p>
										<p>Kami bisa menghubungkan Anda dengan korporat/ organisai/ komunitas yang relevan untuk menyelenggarakan pelatihan secara khusus</p>
									</div>
								</li>
							</ul>
						</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="testi" class="bg-all padbottom-20">
        <div class="container">
			<div class="col-md-offset-1 col-md-10">
				<div id="slider6">
					<a class="buttons prev" href="#"></a>
						<div class="viewport">
							<ul class="overview">
								<li>
									<div class="col-md-8">
										<p class="text-center bold">
											"Dulu saya kesulitan buat mempromosikan kelas yang akan saya buat. Saya juga harus mengurus pendaftaran hingga pembayaran murid satu per satu. Tapi sejak ada Ruangguru, sekarang saya bisa fokus hanya ke kegiatan mengajar!"
										</p>
										<p class="text-center text-13 pink bold">Reza, Jakarta</p>
									</div>
								</li>
								<li>
									<div class="col-md-8">
										<p class="text-center bold">
											"Pemesanan secara online memudahkan saya untuk mencari guru yang saya mau. Sistemnya simple dan praktis, hanya habis beberapa menit!"
										</p>
										<p class="text-center text-13 pink bold">Marissa, Jakarta</p>
									</div>
								</li>
							</ul>
						</div>
					<a class="buttons next" href="#"></a>
				</div>
			</div>
            <!--<div class="row">
                <div class="col-md-2 blank"></div>
                <div class="col-md-2 avatar"><img src="<?php //echo base_url();?>images/Customer1.png"></div>
					<div class="col-md-6">
						<p class="text-right"><span class="text-16 pink bold">Sistemnya simple dan praktis!</span><br><br>
							<span class="bold">"Pemesanan secara online memudahkan saya untuk mencari guru yang saya mau. Sistemnya simple dan praktis, hanya habis beberapa menit!"<br><br>
							Reza (24), Jakarta</span>
						</p>
					</div>
                <div class="col-md-2 blank">
                </div>
            </div>-->
        </div>
    </section>
    <section id="media" class="bottom-20 padtop-30">
        <div class="container">
			<div class="row" id="cara-kerja">
				<h1 class="bold text-center">Bagaimana Cara Kerjanya?</h1>
				<div class="col-md-offset-3 col-md-6 text-center top-30 text-13">
					Institusi/ individu dapat menyelenggarakan kelas (untuk pelajaran apapun) dan kemudian mempublikasikannya melalui website Ruangguru.
				</div>
				<div class="col-md-offset-1 col-md-10">
						<div class="col-md-3 text-center">
							<img src="<?php echo base_url();?>images/step-1.png"/><br/>
							<p class="pink bold text-14">Sign Up</p>
							<p class="text-center text-13">Penyedia Kelas <a class="fancybox pink" href="#inline1">mendaftar di sini</a> dan kemudian mendaftarkan kelas baru yang ingin diselenggarakan</p>
						</div>
						<div class="col-md-3  text-center text-13">
							<img src="<?php echo base_url();?>images/step-2.png"/><br/>
							<p class="pink bold text-14">Review</p>
							<p class="text-center text-13">Pihak Ruangguru.com akan mereview pendaftaran kelas baru dan melakukan konfirmasi dengan Penyedia Kelas</p>
						</div>
						<div class="col-md-3 text-center text-13">
							<img src="<?php echo base_url();?>images/step-3.png"/><br/>
							<p class="pink bold text-14">Publish</p>
							<p class="text-center text-13">Pihak Ruangguru.com akan mereview pendaftaran kelas baru dan melakukan konfirmasi dengan Penyedia Kelas</p>
						</div>
						<div class="col-md-3 text-center text-13">
							<img src="<?php echo base_url();?>images/step-4.png"/><br/>
							<p class="pink bold text-14">Teach</p>
							<p class="text-center text-13">Setelah kelas terisi, Penyedia Kelas dapat mulai mengajar  sesuai dengan jadwal yang ditentukan. Biaya registrasi murid akan dibayarkan setelah kelas.</p>
						</div>
					</ul>
				</div>
			</div>
		</div>      
    </section>
	<section id="kebijakan" class="bg-orange-all top-30">
            <div class="container">
				<div class="row">
					<div class="col-md-12 mulai belajar bold text-center">Pelajari mengenai kebijakan harga, komisi dan pengembalian biaya di sini
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'faq'?>" class="btn-blue bold shadow">Kebijakan</a> 
					</div>
                </div>
            </div>
    </section>
<?php $this->load->view('vendor/general/footer');?>

    </body>
</html>