<html>
    <body>
	   <p><img src="<?php echo base_url().'images/header-logo.png';?>" width="150px"/></p><br/>
        <p>Kpd. <?php echo $kelas->duta_guru_nama;?>,</p>
        <p>
            <i>Referral</i> Anda telah menyelesaikan kelas berikut:
        </p>
        <p>
            <b>Guru :</b> <?php echo $kelas->guru_nama;?><br/>
            <b>Mata Pelajaran :</b> <?php echo $kelas->matpel_title;?><br/>
            <b>Jenjang Pendidikan :</b> <?php echo $kelas->jenjang_pendidikan_title;?><br/>
            <b>Kelas Mulai :</b> <?php echo $kelas->kelas_mulai;?><br/>
        </p>
        <p>
		  Pembayaran <i>referral fee</i> duta guru sudah dikirimkan ke rekening Anda<br/>
            Untuk rincian bukti pembayaran, silahkan klik link berikut: <a href="<?php echo base_url();?>duta_guru/simpan_pdf/<?php echo $kode;?>/guru">kirim bukti pembayaran</a>
        </p>
        <p>
            <b>Ini pesan email otomatis, jangan membalas secara langsung.</b> 
		  Apabila ada pertanyaan seputar Ruangguru, Anda dapat menghubungi Kami dengan mengirimkan email ke bayar@ruangguru.com atau menelepon ke 021-9200-3040 pada saat jam kerja. Terima kasih.
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