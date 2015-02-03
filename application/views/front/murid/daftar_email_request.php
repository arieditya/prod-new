<html>
    <body>
	   <p><img src="<?php echo base_url().'images/header-logo.png';?>" width="150px"/></p>
        <p style="font-size:14px;"><strong>Kpd. <?php echo $murid->murid_nama;?></strong>,</p>
        <p>Selamat Datang di Ruangguru! Terima kasih karena telah mendaftarkan diri Anda sebagai murid di Ruangguru. Ruangguru adalah sebuah website yang menghubungkan calon murid dengan calon guru yang tepat untuk menambah pelajaran di luar sekolah atau kampus, ataupun mengembangkan keahlian di bidang tertentu.</p>
        <p>Login ke akun Anda dengan menggunakan rincian login berikut ini:</p>
        <p>
		   Informasi Akun Anda<br/>
		  <b>E-mail :</b> <?php echo $murid->murid_email;?><br/>
            <b>Nomor ID Murid :</b> <?php echo $murid->murid_id;?><br/>
            <b>Password :</b> 123456
        </p>
        <p>
		  <strong>Untuk login profil murid</strong> di: <a href="http://www.ruangguru.com/murid/login" class="normal-link"/>www.ruangguru.com/murid/login</a><br/>
            <strong>Harap langsung ubah password akun Anda</strong> di: <a href="http://www.ruangguru.com/murid/reset_password" class="normal-link"/>www.ruangguru.com/murid/reset_password</a>
        </p>
        <p>
		  Panduan untuk menjadi murid di Ruangguru akan kami kirimkan ke email Anda dalam kurun waktu 2x24 jam. Apabila Tim Ruangguru belum mengirimkan materi panduan, maka segera hubungi Tim Ruangguru. 
        </p><br/>
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