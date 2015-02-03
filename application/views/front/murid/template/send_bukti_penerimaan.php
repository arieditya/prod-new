<html>
    <body>
        <p>Kpd. <?php echo $kelas->murid_nama;?>,</p>
        <p>
            Anda telah membayar kelas dengan rincian sebagai berikut ini:
        </p>
        <p>
            <b>Mata Pelajaran :</b> <?php echo $kelas->matpel_title;?><br/>
            <b>Jenjang Pendidikan :</b> <?php echo $kelas->jenjang_pendidikan_title;?><br/>
            <b>Kelas Mulai :</b> <?php echo $kelas->kelas_mulai;?><br/>
        </p>
        <p>
            Untuk bukti penerimaan pembayaran Anda yang telah kami verifikasi silahkan klik link berikut: <a href="<?php echo base_url();?>murid/simpan_bukti/<?php echo $kode;?>">bukti pembayaran dari murid</a>
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