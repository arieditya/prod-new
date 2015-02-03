<html>
<head>

<link rel="canonical" href="http://www.ruangguru.com/murid" />
<script type="text/javascript" src="<?php echo base_url();?>js/home.js"></script>


</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-murid-header" class="profile-guru-header">
                <div id="profile-murid-header-wrap">
                    PROFIL MURID
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div id="profile-picture">
                            <div class="profile-image">
                                <?php if (!file_exists("./images/murid/pp/{$murid->murid_id}.jpg")): ?>
                                    <img src="<?php echo base_url(); ?>images/default_profile_image.png"/>
                                <?php else : ?>
                                    <img src="<?php echo base_url(); ?>images/murid/pp/<?php echo $murid->murid_id; ?>.jpg"/>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div id="profile-bio">
                            <div id="profile-bio-nama">
                                <?php echo $murid->murid_nama;?>
                            </div>
                            <div id="profile-bio-detail">
                                <table>
                                    <tr>
                                        <td>
                                            <strong>ID</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $murid->murid_id;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Email</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $murid->murid_email;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Jenis Kelamin</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo ($murid->murid_gender==1)?'Laki-laki':'Perempuan';?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Tempat Lahir</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $murid->murid_tempatlahir;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Tanggal Lahir</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                              <?php $ttl = explode("-",$murid->murid_lahir);
										$mm = $this->guru_model->convert_month($ttl[1]);
										$dd = sprintf("%d", $ttl[2]);
										echo $dd." ".$mm." ".$ttl[0];
								    ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Kota</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $murid->lokasi_title;?>
                                        </td>
                                    </tr><tr>
                                        <td>
                                            <strong>No. Ponsel</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $murid->murid_hp;?>
                                        </td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="blank" style="height:10px;"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</body>
</html>