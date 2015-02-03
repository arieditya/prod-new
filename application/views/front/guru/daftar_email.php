<html>
    <body>
	   <p><img src="<?php echo base_url().'images/header-logo.png';?>" width="150px"/></p>
        <p style="font-size:14px;"><strong>Kpd. <?php echo $guru->guru_nama;?></strong>,</p>
        <p>Selamat Datang di Ruangguru! Terima kasih karena telah mendaftarkan diri Anda sebagai guru di Ruangguru. Ruangguru adalah sebuah website yang menghubungkan calon murid dengan calon guru yang tepat untuk menambah pelajaran di luar sekolah atau kampus, ataupun mengembangkan keahlian di bidang tertentu.</p>
        <p>Login ke akun Anda dengan menggunakan rincian login berikut ini:</p>
        <p>
		   Informasi Akun Anda<br/>
		  <b>E-mail :</b> <?php echo $guru->guru_email;?><br/>
            <b>Nomor ID Guru :</b> <?php echo $guru->guru_id;?>
        </p>
        <p>
		 <strong>Untuk login profil guru</strong> di: <a href="http://www.ruangguru.com/guru/login" class="normal-link"/>www.ruangguru.com/guru/login</a><br/>
           <strong>Untuk merubah password Anda</strong> di: <a href="http://www.ruangguru.com/guru/reset_password" class="normal-link"/>www.ruangguru.com/guru/reset_password</a>
        </p>
	   <br/>
	   <p>
	       <strong>Ini pesan email otomatis, jangan membalas secara langsung</strong>. <strong>Jika Anda memiliki pertanyaan</strong>, silakan hubungi Tim Ruangguru melalui email ke <a href="mailto:info@ruangguru.com" class="normal-link"/>info@ruangguru.com</a> atau menelepon ke 021-9200-3040 pada saat jam kerja. Terima kasih.
	   </p><br/><br/>
        <p>
            Best Regards,<br/><br/>
            <b>Tim Ruangguru</b>
        </p>
        <p>
            <b>Facebook : <a href="https://www.facebook.com/ruanggurucom?ref=hl" class="normal-link">Ruangguru</a></b>&nbsp;<b>Twitter : <a href="https://twitter.com/ruangguru" class="normal-link">@ruangguru</a></b>
        </p>
    </body>
</html>