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
<?php $this->load->view('vendor/general/sidebar')?>
			<div class="col-md-9 col-sm-12">
				<div class="panel panel-default">
					<h2 class="block-title text-uppercase">KELAS ANDA</h2>
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
													<td>Edit</td>
													<td>Go to web</td>
												</tr>
											</thead>
											<tbody>
<?php
	$i = 1;
	foreach($classes_published as $class):
        switch($class->class_paket){
            case		'0'		: $type = '<span class="label label-default">Satu Sesi</span>';break;
            case		'1'		: $type = '<span class="label label-info">Berseri</span>';break;
            case		'2'		: $type = '<span class="label label-success">Paket</span>';break;
        }
        $manage_class_link = base_url().'vendor/kelas/detil/'.$class->id;
        $editable = $class->active == 0?TRUE:FALSE;
        if($class->active == 1):
?>
												<tr>
													<td><?php echo $i++;?></td>
													<td>
														<a href="<?php echo base_url()."vendor/kelas/detil/{$class->id}"?>">
															<?php echo $class->class_nama; ?>
														</a>
													</td>
													<td><?php echo number_format($class->class_harga,0,',','.');?></td>
													<td><?php echo $class->jadwal_count; ?></td>
													<td><?php echo $type;?></td>
													<td>
														<a href="<?php echo base_url()."vendor/kelas/detil/{$class->id}"?>/murid">
															<?php echo $class->participant_count; ?>&nbsp;orang
														</a>
													</td>
													<td class="status">
														<?php if($class->class_status == 1) : ?>
															<span class="approved icon-circle" title="Approved"><i class="fa fa-check"></i></span>
														<?php endif; ?>
														<?php if($class->class_status == 4) : ?>
                                                        	<span class="pending icon-circle" title="Pending Unpublished"><i class="fa fa-ellipsis-h"></i></span>
                                                        <?php endif;
                                                        /**
                                                        <a href="#" class="unpublish icon-circle" title="Request To Unpublish"><i class="fa fa-download"></i> </a>
                                                         */
                                                        ?>
													</td>
													<td class="text-center">
														<a href="<?php echo $manage_class_link?>" 
														   class="manage icon-circle" 
														   title="Pengaturan">
															<i class="fa fa-gears"></i>
														</a>
													</td>
													<td class="text-center">
														<a href="<?php echo base_url()?>kelas/<?php echo $class->class_uri;?>" 
														   class="link icon-circle" 
														   title="Link"
														   target="_blank">
															<i class="fa fa-arrow-right"></i>
														</a>
													</td>
												</tr>
<?php
        endif;
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
												Untuk kelas yang sudah live, Anda tidak dapat mengubah info lagi. Jika Anda ingin mengubah 
												info, <a class="blue underline" href="mailto:info@ruangguru.com?Subject=Edit%20Kelas">hubungi kami</a>
											</li>
											<li>
												Anda hanya dapat melihat daftar murid dan menghubungi mereka yang sudah melakukan pembayaran. Untuk melihat daftar murid , klik "<b>Jumlah Murid</b>"
											</li>
										</ol>
									</div>
								</div><!-- published -->

                                <!-- Tab panes -->
                                    <div role="tabpanel" class="tab-pane" id="draft">
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
                                                    <td>Edit</td>
                                                    <td>Go to web</td>
                                                </tr>
                                                </thead>
                                                <tbody>
<?php
$i = 1;
foreach($classes_draft as $class):
    switch($class->class_paket){
        case		'0'		: $type = '<span class="label label-default">Satu Sesi</span>';break;
        case		'1'		: $type = '<span class="label label-info">Berseri</span>';break;
        case		'2'		: $type = '<span class="label label-success">Paket</span>';break;
    }
    $manage_class_link = base_url().'vendor/kelas/detil/'.$class->id;
    $editable = $class->active == 0?TRUE:FALSE;
?>
                                                        <tr>
                                                            <td><?php echo $i++;?></td>
                                                            <td>
                                                                <a href="<?php echo base_url()."vendor/kelas/detil/{$class->id}"?>">
                                                                    <?php echo $class->class_nama; ?>
                                                                </a>
                                                            </td>
                                                            <td><?php echo number_format($class->class_harga,0,',','.');?></td>
                                                            <td><?php echo $class->jadwal_count; ?></td>
                                                            <td><?php echo $type;?></td>
                                                            <td>
                                                                <a href="#">
                                                                    <?php echo $class->participant_count; ?>&nbsp;orang
                                                                </a>
                                                            </td>
                                                            <td class="status">
																<?php if($class->class_status == 1) : ?>
																	<span class="approved icon-circle" title="Approved"><i class="fa fa-check"></i></span>
																<?php endif; ?>
																<?php if($class->class_status == 4) : ?>
																	<span class="pending icon-circle" title="Pending Published"><i class="fa fa-ellipsis-h"></i></span>
																<?php endif; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="<?php echo $manage_class_link?>"
                                                                   class="manage icon-circle"
                                                                   title="Pengaturan">
                                                                    <i class="fa fa-gears"></i>
                                                                </a>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="<?php echo base_url()?>kelas/<?php echo $class->class_uri;?>"
                                                                   class="link icon-circle"
                                                                   title="Link"
                                                                   target="_blank">
                                                                    <i class="fa fa-arrow-right"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
<?php
    endforeach;
?>
                                                </tbody>
                                            </table>
                                        </div><!-- table-responsive -->
                                        <div id="class-notes">
                                            <p> Catatan: </p>
                                            <ol>
                                                <li>
                                                    Untuk setiap kelas yang sudah dilakukan publish masih butuh ada proses terlebih dahulu dari kami,
                                                    jika ada pertanyaan <a class="blue underline" href="mailto:info@ruangguru.com?Subject=Edit%20Kelas">hubungi kami</a>
                                                </li>
                                            </ol>
                                        </div>
                                    </div><!-- draft -->
								<div role="tabpanel" class="tab-pane" id="past">
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
												<td>Edit</td>
												<td>Go to web</td>
											</tr>
											</thead>
											<tbody>
<?php
$i = 1;
foreach($classes_past as $class):
	switch($class->class_paket){
		case		'0'		: $type = '<span class="label label-default">Satu Sesi</span>';break;
		case		'1'		: $type = '<span class="label label-info">Berseri</span>';break;
		case		'2'		: $type = '<span class="label label-success">Paket</span>';break;
	}
	$manage_class_link = base_url().'vendor/kelas/detil/'.$class->id;
	$editable = $class->active == 0?TRUE:FALSE;
?>
													<tr>
														<td><?php echo $i++;?></td>
														<td>
															<a href="<?php echo base_url()."vendor/kelas/detil/{$class->id}"?>">
																<?php echo $class->class_nama; ?>
															</a>
														</td>
														<td><?php echo number_format($class->class_harga,0,',','.');?></td>
														<td><?php echo $class->jadwal_count; ?></td>
														<td><?php echo $type;?></td>
														<td>
															<a href="#">
																<?php echo $class->participant_count; ?>&nbsp;orang
															</a>
														</td>
														<td class="status">
															<?php if($class->class_status == 1) : ?>
																<span class="approved icon-circle" title="Approved"><i class="fa fa-check"></i></span>
															<?php endif; ?>
															<?php if($class->class_status == 4) : ?>
																<span class="pending icon-circle" title="Pending"><i class="fa fa-ellipsis-h"></i></span>
															<?php endif; ?>
														</td>
														<td class="text-center">
															<a href="<?php echo $manage_class_link?>"
															   class="manage icon-circle"
															   title="Pengaturan">
																<i class="fa fa-gears"></i>
															</a>
														</td>
														<td class="text-center">
															<a href="<?php echo base_url()?>kelas/<?php echo $class->class_uri;?>"
															   class="link icon-circle"
															   title="Link"
															   target="_blank">
																<i class="fa fa-arrow-right"></i>
															</a>
														</td>
													</tr>
<?php
endforeach;
?>
											</tbody>
										</table>
									</div><!-- table-responsive -->
									<div id="class-notes">
										<p> Catatan: </p>
										<ol>
											<li>
												Kelas dalam daftar ini memiliki jadwal yang sudah terlewat semua <a class="blue underline" href="mailto:info@ruangguru.com?Subject=Edit%20Kelas">hubungi kami</a>
											</li>
										</ol>
									</div>
								</div><!-- past -->
							</div><!-- tab-content -->

						</div><!-- tabpanel kelas -->
					</div><!-- panel-body -->
				</div><!-- panel -->
			</div>
		</div>
	</div> <!-- /container -->
