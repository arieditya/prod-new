<html>
    <body>
	   <p><img src="<?php echo base_url().'images/header-logo.png';?>" width="150px"/></p><br/>
        <p>Kpd. <?php echo $kelas->murid_nama;?>,</p>
        <p>
            Anda telah menyelesaikan kelas berikut ini:
        </p>
        <p>
            <b>Guru :</b> <?php echo $kelas->guru_nama;?><br/>
            <b>Mata Pelajaran :</b> <?php echo $kelas->matpel_title;?><br/>
            <b>Jenjang Pendidikan :</b> <?php echo $kelas->jenjang_pendidikan_title;?><br/>
            <b>Kelas Mulai :</b> <?php echo $kelas->kelas_mulai;?><br/>
        </p>
        <p>
            Mohon kesediaannya untuk memberikan <i>feedback</i> pada link berikut 
            <a href="<?php echo base_url();?>murid/kelas_feedback/<?php echo $kode;?>">
                <i>Feedback</i>
            </a>
		  <br/>
		  <i>Feedback</i> harus diisi sesuai dengan kinerja mengajar guru untuk menjadi bahan evaluasi mengajar selanjutnya.
        </p>
        <p>
            <b>Ini pesan email otomatis, jangan membalas secara langsung.</b> 
            Apabila ada pertanyaan seputar Ruangguru, Anda dapat menghubungi Kami dengan mengirimkan email ke info@ruangguru.com atau menelepon ke 021-9200-3040 pada saat jam kerja. Terima kasih.
        </p>
        <p>
            Best Regards,<br/><br/>
            <b>Tim Ruangguru</b>
        </p>
        <p>
            Follow Us :<br/>
            <b>Twitter : <a href="https://twitter.com/ruangguru" class="normal-link">@ruangguru</a></b><br/>
            <b>Facebook : <a href="https://www.facebook.com/ruanggurucom" class="normal-link">Ruangguru</a></b>
        </p>
    </body>
</html>