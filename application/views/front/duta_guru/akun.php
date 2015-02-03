<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/duta_guru" />
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-dutaguru-header" class="profile-guru-header">
                <div id="profile-duta-header-wrap">
                    PROFIL DUTA GURU
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div id="profile-picture">
                            <div class="profile-image">
                                <?php if (!file_exists("./images/dutaguru/pp/{$duta_guru->duta_guru_id}.jpg")): ?>
                                    <img src="<?php echo base_url(); ?>images/default_profile_image.png"/>
                                <?php else : ?>
                                    <img src="<?php echo base_url(); ?>images/dutaguru/pp/<?php echo $duta_guru->duta_guru_id; ?>.jpg"/>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div id="profile-bio">
                            <div id="profile-bio-nama">
                                <?php echo $duta_guru->duta_guru_nama;?>
                            </div>
                            <div id="profile-bio-detail">
                                <table>
                                    <tr>
                                        <td>
                                            <strong>Kode Referral</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <span class="red-notif"><?php echo $duta_guru->duta_guru_id;?></span>
                                        </td>
                                    </tr>
							 <tr>
								<td>&nbsp;</td>
							 </tr>
                                    <tr>
                                        <td>
                                            <strong>Email</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $duta_guru->duta_guru_email;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Jenis Kelamin</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo ($duta_guru->duta_guru_gender==1)?'Laki-laki':'Perempuan';?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Tempat Lahir</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $duta_guru->duta_guru_tempatlahir;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Tanggal Lahir</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php $ttl = explode("-",$duta_guru->duta_guru_lahir);
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
                                            <?php echo $duta_guru->lokasi_title;?>
                                        </td>
                                    </tr><tr>
                                        <td>
                                            <strong>No. Ponsel</strong>
                                        </td>
                                        <td> : </td>
                                        <td>
                                            <?php echo $duta_guru->duta_guru_hp;?>
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