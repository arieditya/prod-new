<script type="text/javascript" src="<?php echo base_url();?>js/jquery.orbit-1.2.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/home.js"></script>
<div id="content">
    <div class="blank" style="height:10px;"></div>
    <div id="home-slider">
        <div id="home-slider-wrap">
            <div id="featured"> 
                <img  src="<?php echo base_url(); ?>images/slider3.jpg" alt="" data-caption="#caption1"/>
                <img  src="<?php echo base_url(); ?>images/slider2.jpg" alt="" data-caption="#caption2"/>
                <img  src="<?php echo base_url(); ?>images/slider1.jpg" alt="" data-caption="#caption3"/>
            </div>
            <span class="orbit-caption" id="caption1">
                <p class="orbit-title">Mempertemukan Guru dan Murid, Efektif dan Efisien</p>
                <p>Ruangguru mempertemukan murid dengan guru yang sesuai dengan spesifikasi yang dicari dan kompetensi yang telah diverifikasi oleh tim Ruangguru.</p>
            </span>
            <span class="orbit-caption" id="caption2">
                <p class="orbit-title">Menjadi Murid Tidak Pernah Semudah Ini!</p>
                <p>Ruangguru memberikan keuntungan dan kemudahan bagi murid dengan pilihan guru berkualitas, fleksibilitas pilihan lokasi dan jadwal belajar, serta kemudahan proses pencarian guru dan pembayaran.</p>
            </span>
            <span class="orbit-caption" id="caption3">
                <p class="orbit-title">Peroleh Benefit Maksimal Sebagai Guru</p>
                <p>Ruangguru merupakan solusi efektif bagi semua guru di Indonesia. Ruangguru memfasilitasi karir mengajar Anda dengan fitur pemasangan profil gratis, 24 jam nationwide, dan tarif yang transparan!</p>
            </span>
        </div>
    </div>
    <div id="home-guru">
        <div id="cari-guru">
            <div id="cari-guru-header">
                <div id="cari-guru-header-wrap">
                    CARI GURU
                </div>
            </div>
            <div id="cari-guru-content">
                <form action="<?php echo base_url();?>cari_guru/result" method="post">
                    <div class="blank" style="height: 20px;"></div>
                    <div class="cari-guru-left cgl-home">
                        <div class="cari-field">
                            <p>Pilih lokasi :</p>
                            <select id="ddLokasi" class="select" name="location" onchange="update_lokasi()">
                                <?php foreach ($lokasi->result() as $row): ?>
                                        <option value="<?php echo $row->lokasi_id; ?>"><?php echo $row->lokasi_title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="cari-field">
                            <p>Jenjang pendidikan :</p>
                            <select id="jenjangP" class="select" name="education" onchange="update_matpel()">
                                <?php foreach ($jenjang->result() as $row): ?>
                                    <option class="<?php echo $row->jenjang_pendidikan_id;?>" value="<?php echo $row->jenjang_pendidikan_id; ?>"><?php echo $row->jenjang_pendidikan_title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="cari-field">
                            <p>Gender :</p>
                            <div class="blank" style="height: 20px;">
                                <div class="r-guru-detail">
                                    <input class="radio" name="gender" type="radio" value="1" <?php if (!empty($input['gender'])) {echo($input['gender'] == 1) ? 'checked' : '';}; ?>/> Pria
                                </div>
                                <div class="r-guru-detail">
                                    <input class="radio" name="gender" type="radio" value="2" <?php if (!empty($input['gender'])) {echo($input['gender'] == 2) ? 'checked' : '';}; ?>/> Wanita
                                </div>
                                <div class="r-guru-detail">
                                    <input class="radio" name="gender" type="radio" value="3" <?php if (!empty($input['gender'])) {echo($input['gender'] == 3) ? 'checked' : '';} else {echo'checked';}; ?>/> Bebas
                                </div>
                            </div>
                        </div>
                        <div class="cari-field">
                            <p>Jenjang pendidikan :</p>
                            <select id="tarifP" class="select" name="tarif">
                                <option value="0">Tarif berapapun</option>
                                <option value="1">< Rp. 100.000 / pertemuan</option>
                                <option value="2">Rp. 101.000 - Rp. 250.000 / pertemuan</option>
                                <option value="2">Rp. 251.000 - Rp. 500.000 / pertemuan</option>
                                <option value="3">> Rp. 500.000 / pertemuan</option>
                            </select>
                        </div>
                        <div class="blank" style="height: 20px"></div>
                        <div class="cari-other">
                            <div class="cari-more"><a href="<?php echo base_url();?>cari_guru">Pilihan pencarian lebih detail>></a></div>
                        </div>
                    </div>
                    <div class="cari-guru-right">
                        <div class="cari-field">
                            <p>Bidang Studi :</p>
                            <div class="blank" style="height: 5px;"></div>
                            <div class="bidang-studi-wrap">
                                <div class="bs-left">
                                    <?php $i=0;?>
                                    <?php foreach ($this->main_model->get_matpel(1,TRUE)->result() as $row):
                                    $i++;
                                    if($i==7):
                                        echo "</div><div class=\"bs-right\">";
                                    endif;
                                    ?>
                                    <div class="bs-row">
                                        <input type="checkbox" name="matpel[]" value="<?php echo $row->matpel_id;?>"/><?php echo $row->matpel_title;?>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                        <div class="blank" style="height: 20px"></div>
                        <div class="cari-submit">
                            <input type="image" src="<?php echo base_url(); ?>images/cari-button.png"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="sign-login-panel">
            <div id="slp-wrap">
                <div id="slp-title">
                    <span>Daftar sekarang untuk mendapatkan guru/ murid yang sesuai dengan kebutuhan Anda!</span>
                </div>
                <div id="slp-murid">
                    <a href="<?php echo base_url();?>murid/registrasi">
                        <img src="<?php echo base_url();?>images/daftar-murid-button.png" />
                    </a>
                    <a href="<?php echo base_url();?>murid/login">
                        <img src="<?php echo base_url();?>images/login-murid-button.png" />
                    </a>
                </div>
                <div id="slp-guru">
                    <a href="<?php echo base_url();?>guru/reg_guru">
                        <img src="<?php echo base_url();?>images/daftar-guru-button.png" />
                    </a>
                    <a href="<?php echo base_url();?>guru/login">
                        <img src="<?php echo base_url();?>images/login-guru-button.png" />
                    </a>
                </div>
                <div id="slp-duta">
                    <a href="<?php echo base_url();?>duta_guru/registrasi">
                        <img src="<?php echo base_url();?>images/daftar-duta-button.png" />
                    </a>
                    <a href="<?php echo base_url();?>duta_guru/login">
                        <img src="<?php echo base_url();?>images/login-duta-button.png" />
                    </a>
                </div>
                <div class="_blank" style="height: 40px;"></div>
            </div>
        </div>
<!--        <div id="daftar-guru">
            <div id="daftar-guru-header">
                <div id="daftar-guru-header-wrap">
                    REGISTRASI GURU
                </div>
            </div>
            <div id="daftar-guru-content">
                <div class="blank" style="height: 20px;"></div>
                <div class="daftar-intro">
                    Sudah merupakan fakta bahwa ada seorang pembaca akan terpengaruh oleh isi tulisan dari sebuah halaman saat ia melihat tata letaknya.
                </div>
                <div class="blank" style="height: 10px;"></div>
                <div class="form-daftar-guru">
                    <form action="<?php echo base_url();?>guru/reg_guru" method="post">
                        <div class="daftar-field">
                            <p>Nama :</p>
                            <input type="text" class="text" name="name" value="masukkan nama" onclick="usernameClick(this)"/>
                        </div>
                        <div class="daftar-field">
                            <p>Email :</p>
                            <input type="text" class="text" name="username" value="masukkan email" onclick="usernameClick(this)"/>
                        </div>
                        <div class="daftar-field">
                            <p>Kata sandi :</p>
                            <input class="text" type="password" name="password" value="" />
                        </div>
                        <div class="daftar-field">
                            <p>Konfirmasi kata sandi :</p>
                            <input class="text" type="password" name="re-password" value="" />
                        </div>
                        <div class="blank" style="height: 32px"></div>
                        <div class="daftar-submit">
                            <div class="daftar-why"><a href="#">mengapa perlu registrasi?</a></div>
                            <input type="image" src="<?php echo base_url(); ?>images/daftar-button.png" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="track-request-guru">
            <form action="#" method="post">
                <div id="trg-title">
                    <img src="<?php echo base_url(); ?>images/mini-track-request-icon.png" />
                    <span>STATUS PEMESANAN GURU :</span>
                </div>
                <div id="trg-text">
                    <span>Pernah melakukan pemesanan guru sebelumnya? Lihat hasil pemesanan Anda disini.</span>
                </div>
                <div id="trg-field">
                    <span>E-Mail:</span>
                    <input type="text" class="text" name="email" value="masukkan email" onclick="usernameClick(this)"/>
                    <span>Kode:</span>
                    <input type="text" class="text" name="code" value="masukkan kode" onclick="usernameClick(this)"/>
                    <input id="trg-submit" type="image" src="<?php echo base_url(); ?>images/mini-track-request-button.png"/>
                </div>
            </form>
        </div>-->
    </div>
    <div class="blank" style="height:45px;"></div>
    <div id="home-stream">
        <div class="stream-wrap">
            <div class="stream-header">
                BERITA TERBARU
            </div>
            <div class="stream-berita">
                <?php foreach ($blog_post as $post):?>
                    <div class="item-berita">
                        <div class="item-berita-wrapper">
                            <div class="blank" style="height: 20px"></div>
                            <div class="ib-content">
                                <div class="ib-thumb">
                                    <div class="ib-thumb-frame">
                                        <?php if(!empty($post['image'])):?>
                                        <img class="ib-thumb-image" src="<?php echo base_url();?>images/blog/<?php echo $post['image']->file_name;?>" />
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="ib-summary">
                                    <div class="ib-excerpt">
                                        <a target="_blank" href="<?php echo base_url();?>blog/?p=<?php echo $post['content']->ID;?>"><?php echo $post['content']->post_title;?></a>
                                    </div>
                                    <div class="ib-date">
                                        <?php echo date("F j Y",  strtotime($post['content']->post_date));?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="stream-wrap">
            <div class="stream-header">
                LATEST TWEET
            </div>
            <div class="stream-tweet">
                <?php foreach ($tweet as $status): ?>
                    <div class="item-tweet">
                        <div class="item-tweet-wrapper">
                            <div class="blank" style="height: 20px"></div>
                            <div class="it-content">
                                <p>
                                    <?php echo $this->custom->link_to_anchor($status->text);?>  <span class="it-date inline-block"><?php echo $status->created_at;?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="stream-wrap">
            <div id="login-header" class="stream-header">
                LOGIN GURU
            </div>
            <div class="login-content">
                <div class="blank" style="height: 20px"></div>
                <div class="form-login-guru">
                    <form action="<?php echo base_url();?>guru/login_submit" method="post">
                        <div class="login-field">
                            <p>Email :</p>
                            <input type="text" class="text" name="username" value="masukkan email" onclick="usernameClick(this)"/>
                        </div>
                        <div class="login-field">
                            <p>Kata sandi :</p>
                            <input class="text" type="password" name="password" value="" />
                        </div>
                        <div class="blank" style="height: 17px"></div>
                        <div class="login-submit">
                            <span><a class="forget-pass" href="#">lupa kata sandi?</a></span>
                            <input type="image" src="<?php echo base_url(); ?>images/masuk-button.png" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
