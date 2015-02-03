<html>
    <body>
        <p>Kpd. <?php echo $kelas->murid_nama;?>,</p>
        <p>
            Anda telah melakukan <i>request</i> untuk kelas berikut ini:
        </p>
        <p>
            <b>Mata Pelajaran :</b> <?php echo $kelas->matpel_title;?><br/>
            <b>Jenjang Pendidikan :</b> <?php echo $kelas->jenjang_pendidikan_title;?><br/>
            <b>Kelas Mulai :</b> <?php echo $kelas->kelas_mulai;?><br/>
        </p>
        <p>
            Untuk rincian tagihan pembayaran paket belajar yang telah Anda ambil, silahkan klik link berikut: <a href="<?php echo base_url();?>murid/simpan_pdf/<?php echo $kode;?>">cek invoice</a>
        </p>
	   <p>
	   	  Harap melakukan pembayaran maksimal 2 hari dari tanggal Invoice. Apabila telat melakukan pembayaran, maka kelas akan secara otomatis dibatalkan.
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