<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/guru/reg_guru_detail" />
<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/profile.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $("#registrasi-guru-form").validationEngine('attach');
    update_total_karakter($('#personal_message'),'total-karakter-personal');
}); 

</script>
</head>
<body>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="registrasi-guru">
            <div id="registrasi-guru-header">
                <div id="registrasi-guru-header-wrap">
                    REGISTRASI GURU ( Bagian 2 dari 2 )
                </div>
            </div>
            <div id="registrasi-guru-content" class="guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('reg_guru_detail_notif')):?>
                <div class="guru-notif">
                    <?php echo $this->session->flashdata('reg_guru_detail_notif');?>
                </div>
                <?php endif;?>
                <form id="registrasi-guru-form" class="guru-form" action="<?php echo base_url(); ?>guru/reg_detail_submit" method="post">
                    <table>
                        <tr>
                            <td style="width: 250px;"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    TARIF
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="info2">
                                    Masukkan tarif Anda untuk setiap mata pelajaran yang Anda ajar. <br/>
                                    Minimum tarif yang dapat Anda masukkan adalah Rp 50,000,-/ jam
                                </p><br/>
                            </td>
                        </tr>
                        <?php foreach($matpel as $item):?>
                        <tr height="40px">
                            <td><?php echo $item->matpel_title;?> (<?php echo $item->jenjang_pendidikan_title;?>)<span class="red-notif text-16"> *</span></td>
                            <td>
                                <input id="tarif<?php echo $item->matpel_id;?>" name="tarif[<?php echo $item->matpel_id; ?>]" type="text" class="validate[required,custom[onlyNumberSp],min[50000]] text" value="<?php echo(!empty($tarif[$item->matpel_id]))?$tarif[$item->matpel_id]:0;?>"/> <span> Rupiah/Jam</span>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    JADWAL
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="info2">
                                    Pilih preferensi waktu mengajar Anda dengan meng-klik tabel di bawah ini.<br/>
                                    Warna biru berarti Anda bersedia untuk mengajar murid pada jam tersebut.<br/>
                                    Pastikan informasi ini seakurat mungkin, karena murid akan menyesuaikan dengan waktu mengajar Anda.
                                </p><br/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table id="jadwal-guru-table-form">
                                    <tr>
                                        <th style="width: 45px;">Jam</th>
                                        <?php foreach($days as $value):?>
                                        <th>
                                            <?php echo $value;?>
                                        </th>
                                        <?php endforeach;?>
                                    </tr>
                                    <?php for($i=7;$i<24;$i++):?>
                                    <tr>
                                        <th><?php echo sprintf('%02s',$i);?>:00</th>
                                        <?php for($j=0;$j<7;$j++):?>
                                        <td onclick="jadwal_box_click(this)" class="<?php echo(!empty($jadwal[$j][$i]))?'selected':'';?>">
                                            <input class="jadwal-checkbox none" type="checkbox" name="jadwal[<?php echo $j;?>][<?php echo $i;?>]" <?php echo(!empty($jadwal[$j][$i]))?'checked':'';?>/>
                                        </td>
                                        <?php endfor;?>
                                    </tr>
                                    <?php endfor;?>
                                </table>
                                <div class="_blank" style="height: 10px;"></div>
                                <p class="jadwal-guru-info"><img src="<?php echo base_url();?>images/jadwal-available-icon.png" alt="biru"/> Tersedia </p>
                                <p class="jadwal-guru-info"><img src="<?php echo base_url();?>images/jadwal-notavailable-icon.png" alt="abu-abu"/> Tidak Tersedia </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    TENTANG SAYA <span class="text-16 red-notif">*</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="info2">
                                    Tuliskan deskripsi terbaik mengenai diri Anda mulai dari jejak rekam prestasi akademis, penghargaan yang pernah diraih, lomba yang pernah diikuti, prestasi di organisasi/ komunitas, dan pengalaman mengajar. Karena hal pertama yang akan dilihat oleh murid adalah deskripsi profil Anda di sini.
                                </p><br/>
                                <p class="info2">
                                    Anda akan mendapatkan :
							 <ul class="normal-list">
								<li>Tambahan 1 poin Rating, jika Anda menulis 501-1000 karakter.</li>
								<li>Tambahan 2 poin Rating jika Anda menulis lebih dari 1000 karakter.</li>
								<li>Penalti 1 poin Rating, jika Anda tidak menulis apapun.</li>
							 </ul>
                                </p>
						  <br/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea oninput="update_total_karakter(this,'total-karakter-personal')" id="personal_message" name="personal_message" class="validate[required] text"><?php echo(!empty($personal_message))?$personal_message:'';?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>
                                    Total karakter : <span id="total-karakter-personal">0</span>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    KUALIFIKASI SAYA <span class="text-16 red-notif">*</span>
                                </div>
                                <div class="_blank" style="height:10px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="info2">
                                    Jelaskan kualifikasi Anda di sini. Anda dapat menjelaskan pelatihan atau sertifikasi yang Anda miliki.<br/>
                                    Untuk mendapatkan rating, Anda bisa mengunggah scan sertifikat dan transkrip nilai Anda di halaman profil Anda nanti.
                                </p>
						  <br/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="kualifikasi-textbox" name="kualifikasi" class="validate[required]"><?php echo(!empty($kualifikasi))?$kualifikasi:'';?></textarea>                            
                                <div class="_blank" style="height:10px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    PENGALAMAN MENGAJAR
                                </div>
                                <div class="_blank" style="height:10px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="info2">
                                    Jelaskan pengalaman mengajar yang Anda miliki disini.<br/>
                                </p>
						  <br/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="pengalaman-textbox" name="pengalaman"><?php echo(!empty($pengalaman))?$pengalaman:'';?></textarea>                            
                                <div class="_blank" style="height:10px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="_blank" style="height: 30px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>Masukkan kode keamanan yang tertera di bawah ini</p>
                                <p>
                                    <?php echo $this->recaptcha->get_html();?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    SYARAT DAN KETENTUAN
                                </div>
                                <div class="_blank" style="height:10px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="info2">
                                    Kami akan mengambil komisi sebesar 20% dari harga ajar Anda. <br/>
							Seluruh transaksi pembayaran akan melalui rekening bank Ruangguru. <br/>
							Anda setuju untuk mengajar di tempat murid kecuali diberitahukan dan disepakati lain.
                                </p>
						  <br/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
							<div class="blank" style="height:5px;"></div>
                                   <a href="<?php echo base_url();?>syarat_ketentuan/guru" class="normal-link" target="_blank">Klik link ini untuk membaca Syarat dan Ketentuan menjadi Guru</a><br/>
							<input type="checkbox" value="1" name="term" id="term" class="validate[required]"/> Saya setuju dengan syarat & ketentuan yang ada<span class="red-notif text-16"> *</span> 
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="blank" style="height:30px;"></div>
                                        <input type="image" src="<?php echo base_url();?>images/daftar-button-big.png"/><br/>
								<span class="red-notif text-16">* </span><span class="text-13">Wajib diisi</span> 
                                </div>
                                <div class="blank" style="height:60px;"></div>
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