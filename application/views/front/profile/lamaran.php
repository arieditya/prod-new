<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/profile/lamar_request" />
</head>
</body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-guru-header">
                <div id="profile-guru-header-wrap">
                    DAFTAR LAMARAN                
			</div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div class="header">
					   <p class="text-13 justify">Berikut ini daftar lamaran di Ruangguru dan lowongan yang telah Anda lamar di Ruangguru. Harap diketahui bahwa respon yang telah Anda berikan terhadap setiap lowongan yang Anda lamar bersifat final dan tidak bisa diubah lagi.</p>
                        </div>
                        <div class="content">
				    	<p class="bold">DAFTAR LAMARAN ANDA</p>
					<p>Di bawah ini adalah daftar lamaran di Ruangguru yang telah Anda lamar. Ruangguru akan menghubungin Anda dalam 2x24 jam</p>
				      <table id="profile-lamar-table">
                                <thead>
                                    <th class="center">ID REQUEST GURU</th>
                                    <th class="center" width="320px">ISI REQUEST</th>
                                    <th class="center">LOKASI REQUEST</th>
                                    <th class="center" colspan="2">RESPON ANDA</th>
                                </thead>
                                <tbody>
							<?php if($list_request->num_rows() >= 1){ ?>
							<?php foreach($list_request->result() as $row){ ?>
							<?php $request_by_id = $this->main_model->get_request_guru_by_id($row->guru_request_home_id);?>
							<tr>
                                        <td class="center">
                                            <a href="<?php echo base_url().'main/view_request_guru/'.$request_by_id->request_guru_home_id;?>" class="normal-link">
                                                <?php echo $request_by_id->request_guru_home_id;?>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="text-13 left"><?php echo substr($request_by_id->request_guru_home_text, 0, 110);?> ... <a href="<?php echo base_url().'main/view_request_guru/'.$request_by_id->request_guru_home_id;?>" class="normal-link">Selengkapnya >></a></span>
                                        </td>
                                        <td class="center">
									<span class="text-13"><?php echo $request_by_id->lokasi_title;?></span>
								</td>
								<td class="center">
									<span class="text-13">Anda sudah melamar lowongan ini</span>
								</td>
								<td class="center">
									<a href="<?php echo base_url().'profile/delete_vacancy/'.$request_by_id->request_guru_home_id.'/'.$this->session->userdata('guru_id');?>" class="normal-link">Batalkan lamaran ini</span>
								</td>
                                    </tr>
							<?php } } ?>
                                </tbody>
                            </table>
					   <div class="blank" style="height:20px;"></div>
					   <p class="bold">DAFTAR REQUEST GURU</p>
					   <p>Di bawah ini adalah daftar lamaran yang ada di Ruangguru.</p>
					   <table id="profile-lamar-table">
							 <th class="center">ID REQUEST GURU</th>
                                    <th class="center" width="380px">ISI REQUEST</th>
                                    <th class="center" width="100px">STATUS REQUEST</th>
                                    <th class="center" width="100px">RESPON</th>
							 <?php $i=1;?>
							 <?php foreach($all_request->result() as $all){ ?>
							 <tr>
                                        <td class="center">
									<?php echo $i++;?>
                                        </td>
								<td>
									<span class="text-13 left"><?php echo substr($all->request_guru_home_text, 0, 110);?> ... <a href="<?php echo base_url().'main/view_request_guru/'.$all->request_guru_home_id;?>" class="normal-link">Selengkapnya >></a></span>
								</td>
								<td class="center">
									<span class="text-13"><?php if($all->request_guru_home_active == 1){ echo "Tersedia";}else{ echo "Sudah tidak tersedia";}?></span>
								</td>
								<td class="center"><?php if($all->request_guru_home_active == 1) { ?>
									<a class="normal-link" href="<?php echo base_url().'profile/add_vacancy/'.$all->request_guru_home_id.'/'.$this->session->userdata('guru_id');?>">Lamar</a>
									<?php } else { ?>
									<span>Lamaran ditutup</span>
									<?php } ?>
								</td>
							</tr>
							<?php } ?>
					   </table>
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
    <div class="blank" style="height:30px;"></div>
</div>
</body>
</html>