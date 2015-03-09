<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/9/15
 * Time: 2:32 PM
 * Proj: prod-new
 */
$this->load->view('vendor/general/header2');
$vendor_logo = base_url()."images/vendor/{$vendor['profile']->id}/{$vendor['info']->vendor_logo}";
?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" type="text/css" />
<script type="application/javascript" src="<?php echo base_url();?>assets/js/moment.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js" ></script>
    <div class="container content kelas vendor">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="sidebar">
                    <div class="profile-image-wrap">
                        <img src="<?php echo $vendor_logo;?>" alt="" 
							 class="img-responsive">
                        <a href="#"><span class="edit"><i class="fa fa-pencil"></i></span></a>
                    </div>
                    <h3 class="profile-name text-center"><?php echo $vendor['profile']->name?></h3>

                    <div class="progress">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                        60% 
                      </div>
                    </div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation">
                            <a href="#profil" aria-controls="profil" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Profil</a>
                        </li>
                        <li role="presentation">
                            <a href="#reponsible" aria-controls="reponsible" role="tab" data-toggle="tab"><i class="fa fa-male"></i> Penganggungjawab</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users"></i> Kelas Anda</a>
                        </li>
                        <li class="active">
                            <a href="#"><i class="fa fa-plus"></i> Tambah Kelas</a>
                        </li>
                    </ul>
                </div><!-- sidebar -->
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="panel panel-default">
                    <h2 class="block-title text-uppercase">PROFIL PENYELENGGARA</h2>
                    <div class="panel-body">
                        <div role="tabpanel" class="sub-vendor">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#published" aria-controls="published" role="tab" data-toggle="tab">Published</a>
                                </li>
                                <li role="presentation">
                                    <a href="#draft" aria-controls="draft" role="tab" data-toggle="tab">Draft</a>
                                </li>
                                <li role="presentation">
                                    <a href="#past" aria-controls="past" role="tab" data-toggle="tab">Past</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="published">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <td>ID</td>
                                                    <td>Nama Kelas</td>
                                                    <td>Harga Kelas (Rp)</td>
                                                    <td>Jumlah Sesi</td>
                                                    <td>Tipe Kelas</td>
                                                    <td>Jumlah Murid</td>
                                                    <td>Status</td>
                                                    <td>Pengaturan</td>
                                                    <td>Go to web</td>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
	$i = 1;
	foreach($classes as $class):
	$status = '';
	//* ON DEBUG
	//		$class->class_status = '4';
	// */
	switch($class->class_status){
		case		'0'		: $status = '<span class="label label-info">Pending</span>';break;
		case		'1'		: $status = '<span class="label label-success">Approved</span>';break;
		case		'-1'	: $status = '<span class="label label-danger">Rejected</span>';break;
		case		'4'		: $status = '<span class="label label-warning">Request Edit</span>';break;
	}
	switch($class->class_paket){
		case		'0'		: $type = '<span class="label label-default">Single</span>';break;
		case		'1'		: $type = '<span class="label label-info">Series</span>';break;
		case		'2'		: $type = '<span class="label label-success">Package</span>';break;
	}
	$editable = $class->active == 0?TRUE:FALSE;
?>
                                                <tr>
                                                    <td><?php echo ++$i;?></td>
                                                    <td><?php echo $class->class_nama; ?></td>
                                                    <td><?php echo rupiah_format($class->class_harga);?></td>
                                                    <td><?php echo $class->jadwal_count; ?></td>
                                                    <td><?php echo $type;?></td>
                                                    <td><a href="#"><?php echo $class->participant_count; ?>&nbsp;orang</a></td>
                                                    <td class="status">
                                                        <span class="approved icon-circle" title="Approved"><i class="fa fa-check"></i></span>
                                                        <a href="#" class="unpublish icon-circle" title="Request Unpublish"><i class="fa fa-download"></i> </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="manage icon-circle" title="Pengaturan"><i class="fa fa-gears"></i></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="link icon-circle" title="Link"><i class="fa fa-arrow-right"></i></a>
                                                    </td>
                                                </tr>
<?php 
endforeach;
?>
<?php /* ?>
                                                <tr>
                                                    <td>2</td>
                                                    <td>CV and Cover Letter Writing</td>
                                                    <td>0,-</td>
                                                    <td>0</td>
                                                    <td>Single</td>
                                                    <td><a href="#">0 Orang</a></td>
                                                    <td class="status">
                                                        <span class="pending icon-circle" title="Pending"><i class="fa fa-ellipsis-h"></i></span>
                                                        <a href="#" class="publish icon-circle" title="Publish Class"><i class="fa fa-upload"></i></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="manage icon-circle" title="Pengaturan"><i class="fa fa-gears"></i></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="link icon-circle" title="Link"><i class="fa fa-arrow-right"></i></a>
                                                    </td>
                                                </tr>
<?php // */ ?>
                                            </tbody>
                                        </table>
                                    </div><!-- table-responsive -->
                                    <div id="class-notes">
                                        <p> Catatan: </p>
                                        <ol>
                                            <li>
                                                Untuk kelas yang sudah live, Anda hanya dapat mengedit dengan mengubah foto. Jika Anda ingin mengubah detilnya, <a class="blue underline" href="mailto:info@ruangguru.com?Subject=Edit%20Kelas">hubungi kami</a>
                                            </li>
                                            <li>
                                                Anda hanya dapat melihat daftar murid dan menghubungi mereka yang sudah melakukan pembayaran. Untuk melihat daftar murid , klik "<b>Jumlah Murid</b>"
                                            </li>
                                        </ol>
                                    </div>
                                </div><!-- published -->
                                <div role="tabpanel" class="tab-pane" id="draft">Kelas tidak tersedia </div><!-- draft -->
                                <div role="tabpanel" class="tab-pane" id="past">Kelas tidak tersedia </div><!-- past -->
                            </div><!-- tab-content -->

                        </div><!-- tabpanel kelas -->
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div>
        </div>
    </div> <!-- /container -->
