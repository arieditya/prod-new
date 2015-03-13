<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/9/15
 * Time: 3:46 PM
 * Proj: prod-new
 */
$vendor_logo = base_url()."images/vendor/{$vendor['profile']->id}/{$vendor['info']->vendor_logo}";
if(empty($sidebar)) $sidebar = 'profile';
?>
			<div class="col-md-3 col-sm-12">
				<div class="sidebar">
					<div class="profile-image-wrap">
						<img src="<?php echo $vendor_logo;?>" alt="" 
							 class="img-responsive">
						<a href="#"><span class="edit"><i class="fa fa-pencil"></i></span></a>
					</div>
					<h3 class="profile-name text-center"><?php echo $vendor['profile']->name?></h3>
	
					<div class="progress">
						<div class="progress-bar progress-bar-warning" 
							 role="progressbar" 
							 aria-valuenow="60" 
							 aria-valuemin="0" 
							 aria-valuemax="100" 
							 title="Progres kelengkapan Profil Vendor"
							 style="width: 60%">
							<?php
                            $i=0;
                            if(!empty($vendor['profile']->email) &&
                                !empty($vendor['profile']->name) &&
                                !empty($vendor['profile']->main_phone) &&
                                !empty($vendor['profile']->address)):
                                    $i+=30;
                            elseif(!empty($vendor['info']->vendor_description)) :
                                $i+=10;
                            elseif(!empty($vendor['info']->vendor_logo)):
                                $i+=10;
                            elseif(!empty($socmed->facebook) || !empty($socmed->pinterest) ||
                                !empty($socmed->twitter) || !empty($socmed->instagram)):
                                $i+=10;
                            elseif(!empty($vendor['info']->contact_person_name)):
                                $i+=5;
                            elseif(!empty($vendor['info']->contact_person_phone)):
                                $i+=5;
                            elseif(!empty($vendor['info']->contact_person_mobile)):
                                $i+=5;
                            elseif(!empty($vendor['info']->contact_person_email)):
                                $i+=5;
                            elseif(!empty($bank_account->bank_id) && !empty($bank_account->no_rek) && !empty($bank_account->atasnama)):
                                $i+=20;
                            endif;
                            echo $i;
                            ?>
						</div>
					</div>
	
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
<?php 
	if(in_array($sidebar, array('profile','penanggungjawab'))):
?>
						<li role="presentation" <?php echo $sidebar=='profile'?'class="active"':'';?>>
							<a href="<?php echo base_url()?>vendor/profile/edit#profil" 
							   aria-controls="profil" 
							   role="tab" 
							   data-toggle="tab">
								<i class="fa fa-user"></i> Profil
							</a>
						</li>
						<li role="presentation" <?php echo $sidebar=='penanggungjawab'?'class="active"':'';?>>
							<a href="<?php echo base_url()?>vendor/profile/edit#reponsible" 
							   aria-controls="reponsible" 
							   role="tab" 
							   data-toggle="tab">
								<i class="fa fa-male"></i> Penanggungjawab
							</a>
						</li>
<?php 
	else: 
?>
						<li role="presentation" >
							<a href="<?php echo base_url()?>vendor/profile/edit/profil" >
								<i class="fa fa-user"></i> Profil
							</a>
						</li>
						<li role="presentation" <?php echo $sidebar=='penanggungjawab'?'class="active"':'';?>>
							<a href="<?php echo base_url()?>vendor/profile/edit/reponsible" >
								<i class="fa fa-male"></i> Penanggungjawab
							</a>
						</li>
<?php 
	endif;
?>
                        <li role="presentation" <?php echo $sidebar=='tambah_kelas'?'class="active"':'';?>>
                            <a href="<?php echo base_url()?>vendor/kelas/baru">
                                <i class="fa fa-plus"></i> Tambah Kelas
                            </a>
                        </li>
                        <li role="presentation" <?php echo $sidebar=='daftar_kelas'?'class="active"':'';?>>
							<a href="<?php echo base_url()?>vendor/kelas/daftar">
								<i class="fa fa-users"></i> Kelas Anda
							</a>
						</li>
					</ul>
				</div><!-- sidebar -->
			</div>
