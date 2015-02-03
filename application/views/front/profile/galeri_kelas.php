<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-guru-header">
                <div id="profile-guru-header-wrap">
                    GALERI KEGIATAN             
			</div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div class="header">
					   <p class="text-13 justify">Silahkan inputkan foto-foto kegiatan kelas yang sudah pernah Anda buat</p>
                        </div>
                        <div class="content">
				    <?php if(!empty($galeri)){ ?>
							<ul id="galeri-kelas">
						<?php	foreach($galeri->result() as $g){ ?>
								<li><img src="<?php echo base_url().'images/class/'.$g->galeri_foto;?>" width="100px"/></li>
						<?php	} ?>
							</ul>
						<?php } ?>
				     <form id="form-galeri-kelas" class="profile-form" action="<?php echo base_url(); ?>profile/galeri_kelas_submit" method="post" enctype="multipart/form-data">
				      <table id="profile-lamar-table">
                                <tbody>
							 <tr>
                                        <td class="center">Foto Kegiatan</td>
								<td colspan="2"><input id="galeri" type="file" class="field size2 text" name="galeri"/>
									<input id="id_kelas_guru" type="hidden" class="field size2 text" name="id_kelas_guru" value ="<?php echo $kelas->kelas_guru_id;?>"/>
								</td>
                                    </tr>
                                </tbody>
                            </table>
						<div class="blank" style="height:10px;"></div>
						<div id="itemRows"></div>
						<div class="blank" style="height:10px;"></div>
						<input type="image" src="<?php echo base_url();?>images/tambah-button.png" class="fright"/>
					 </form>
                        </div>
                    </div>
                </div>
                <div class="clear" ></div>
                <div class="blank" style="height:60px;"></div>
            </div>
            <div class="blank" style="height:10px;"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="blank" style="height:100px;"></div>
</div>