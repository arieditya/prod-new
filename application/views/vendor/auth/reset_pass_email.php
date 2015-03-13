<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 3/13/15
 * Time: 5:03 PM
 */
?>
<html>
    <body>
        <p>Kpd. <?php echo $vendor->name;?>,</p>
<p>
    Password Anda telah berhasil di reset. Berikut adalah rincian Password ID Ruangguru Anda.
</p>
<p>
    <b>E-mail :</b> <?php echo $vendor->email;?><br/>
    <b>Password Baru :</b> <?php echo $vendor_profile->new_pass;?><br/>
</p>
<p>
    Jangan lupa untuk mengganti password Anda di
    http://www.kelas.ruangguru.com/
</p>
<p>
    <b>Ini pesan email otomatis, jangan membalas secara langsung.</b>
    Anda dapat menghubungi kami dengan mengirimkan email ke info@ruangguru.com atau menelpon ke 021 9200 3040 pada saat jam kerja.
    Terima Kasih.
</p>
<p>
    Best Regards,<br/>
    <b>- Tim Ruangguru, Belajar Apapun Dari Siapapun-</b>
</p>
<p>
    Follow Us :<br/>
    <b>Twitter : @ruangguru</b><br/>
    <b>Facebook : Ruangguru</b>
</p>
</body>
</html>