<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru">
        <div id="profile-guru-header">
            <div id="profile-guru-header-wrap">
                AKUN SAYA
            </div>
        </div>
        <div id="profile-guru-content">
            <?php if ($this->session->flashdata('guru_notification')): ?>
                <div class="blank" style="height:20px;"></div>
                <div class="request-notif profile-guru-notif">
                    <p class="red-notif">
                        <?php echo $this->session->flashdata('guru_notification'); ?>
                    </p>
                </div>
            <?php endif; ?>
            <div id="pgc-wrap">
                <div id="pgc-left">
                    <div class="pgcw-header">
                        <p>FOTO PROFIL</p>
                    </div>
                    <div class="blank" style="height:30px;"></div>
                    <div class="pgcw-content">
                        <div class="profile-image">
                            <?php if (!file_exists("./images/pp/{$guru->guru_id}.jpg")): ?>
                                <img src="<?php echo base_url(); ?>images/default_profile_image.png"/>
                            <?php else : ?>
                                <img src="<?php echo base_url(); ?>images/pp/<?php echo $guru->guru_id; ?>.jpg"/>
                            <?php endif; ?>
                        </div>
                        <div class="profile-image-change">
                            <form method="post" enctype="multipart/form-data" action="<?php echo base_url()?>profile/submit_profpic">
                                <p>Ganti foto:</p>
                                <p>
                                    <input type="file" name="profpic" />
                                </p>
                                <p class="info">(File gambar JPG atau PNG maks 2MB)</p>
                                <p>
                                    <input type="image" src="<?php echo base_url();?>images/ganti-foto.png"/>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="pgc-right">
                    <div class="pgcw-header">
                        <p>PROFIL GURU</p>
                    </div>
                    <div class="blank" style="height:30px;"></div>
                    <div class="pgcw-content">
                        <div class="pg-info">
                            <span class="inline-block">
                                Biodata
                            </span>
                            <span class="inline-block pg-info-edit">
                                <a href="<?php echo base_url();?>profile/biodata">Edit</a>
                            </span>
                        </div>
                        <div class="pg-info">
                            <span class="inline-block">
                                Personal Message
                            </span>
                            <span class="inline-block pg-info-edit">
                                <a href="<?php echo base_url();?>profile/personal">Edit</a>
                            </span>
                        </div>
                        <div class="pg-info">
                            <span class="inline-block">
                                Mata Pelajaran
                            </span>
                            <span class="inline-block pg-info-edit">
                                <a href="<?php echo base_url();?>profile/matpel">Edit</a>
                            </span>
                        </div>
                        <div class="pg-info">
                            <span class="inline-block">
                                Tarif
                            </span>
                            <span class="inline-block pg-info-edit">
                                <a href="<?php echo base_url();?>profile/tarif">Edit</a>
                            </span>
                        </div>
                        <div class="pg-info">
                            <span class="inline-block">
                                Lokasi
                            </span>
                            <span class="inline-block pg-info-edit">
                                <a href="<?php echo base_url();?>profile/lokasi">Edit</a>
                            </span>
                        </div>
                        <div class="pg-info">
                            <span class="inline-block">
                                Jadwal
                            </span>
                            <span class="inline-block pg-info-edit">
                                <a href="<?php echo base_url();?>profile/jadwal">Edit</a>
                            </span>
                        </div>
                        <div class="pg-info">
                            <span class="inline-block">
                                Kualifikasi
                            </span>
                            <span class="inline-block pg-info-edit">
                                <a href="<?php echo base_url();?>profile/kualifikasi">Edit</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="blank" style="height:10px;"></div>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>