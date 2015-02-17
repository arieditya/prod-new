<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/13/14
 * Time: 4:44 PM
 * Proj: private-development
 */
$this->load->view('vendor/general/header');
?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" type="text/css" />
<script type="application/javascript" src="<?php echo base_url();?>assets/js/moment.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js" ></script>
<div class="row list-orange">
	<div class="col-md-offset-2 col-md-8">
		<ul class="nav nav-pills">
			<li class="sub-menu-btn"><a href="<?php echo base_url().'vendor/profile/edit'?>">Profil Anda</a></li>
			<li class="sub-menu-btn-active"><a href="<?php echo base_url().'vendor/kelas/daftar'?>">Kelas Anda</a></li>
			<li class="sub-menu-btn"><a href="<?php echo base_url().'vendor/kelas/baru'?>">Tambah Kelas</a></li>
			<li class="pull-right bottom-10 bold"><img src="<?php echo base_url().'images/phone-2.png';?>" width="20px"/>&nbsp;021-92000-3040</li>
		</ul>
	</div>
</div>
	<div class="row padbottom-30 bg-all">
		<div class="col-md-offset-2 col-md-8">
			<h2 class="pink">Kelas Saya</h2>
			<div class="bg-section shadow bottom-20 padding-content">
				<ul class="nav nav-tabs-sq" role="tablist">
					<li id="profile_selector" class="active"><a href="#profile" role="tab" data-toggle="tab">Published</a></li>
					<li id="profile2_selector"><a href="#profile-2" role="tab" data-toggle="tab">Draft</a></li>
					<li id="profile3_selector"><a href="#profile-3" role="tab" data-toggle="tab">Past</a></li>
				</ul>
				<div class="tab-content bg-section">
					<div class="tab-pane active" id="profile">
						<div class="panel-body">
							<table class="table-class bold" width="850">
								<thead>
									<tr>
										<th class="text-center">ID</th>
										<th class="text-center">Nama Kelas</th>
										<th class="text-center">Harga Kelas (Rp) <!--<a href="#" class="tooltip" title="Harga kelas untuk setiap sesi yang diadakan">?</a>--></th>
										<th class="text-center">Jumlah Sesi</th>
										<th class="text-center">Tipe Kelas</th>
										<th class="text-center">Jumlah Murid</th>
										<th class="text-center">Status</th>
										<th class="text-center" width="120px">Action</th>
										<th class="text-center">Go to web</th>
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
									<td><?php echo $i; ?></td>
									<td><?php echo $class->class_nama; ?></td>
									<td><?php echo number_format($class->class_harga).',-'; ?></td>
									<td><?php echo $class->jadwal_count; ?></td>
									<td><?php echo $type; ?></td>
									<td>
										<a href="<?php echo base_url().'vendor/kelas/detil/'.$class->id; ?>/attendance" 
										   class="list_participant blue underline">
											<?php echo $class->participant_count; ?>&nbsp;orang
										</a>
									</td>
									<td><?php echo $status;?></td>
									<td>
<?php 
	if($class->class_status != '-1'):
		
?>
										<a class="manage-icon text-12 bold" href="<?php echo base_url().'vendor/kelas/detil/'.$class->id; ?>" style="margin-top: 3px;">
											<img src="<?php echo base_url().'images/manage.png';?>" width="18px"/>&nbsp;Manage
										</a>
		<br />
<?php 
		if($class->class_status == '0'): 
			
?>
										<a class="manage-icon text-12 bold" href="<?php echo base_url().'vendor/kelas/detil/'.$class->id; ?>">
											<i class="fa fa-upload"></i>&nbsp;Publish Class
										</a>
<?php 
		elseif($class->class_status == '1'):
			
?>
										<a class="manage-icon text-12 bold" href="<?php echo base_url().'vendor/kelas/detil/'.$class->id; ?>">
											<i class="fa fa-download"></i>&nbsp;Request&nbsp;Unpublish
										</a>
<?php 
		else: 
			
?>
										<a class="manage-icon text-12 bold" href="<?php echo base_url().'vendor/kelas/detil/'.$class->id; ?>">
											<i class="fa fa-exclamation"></i>&nbsp;Cancel&nbsp;Request
										</a>
<?php 
		endif;
	else:
?>
										<span class="text-12 bold">REJECTED</span>
<?php 
	endif;
?>

									</td>
									<td><a href="<?php echo base_url().'kelas/'.$class->class_uri;?>" class="blue underline">Link</a></td>
								</tr>
								<?php 
									$i++;
									endforeach;
								?>
							</tbody>
							</table>
						</div>
						<div id="class-notes">
							<p>Catatan:</p>
							<ol>
								<li>Untuk kelas yang sudah live, Anda hanya dapat mengedit dengan mengubah foto. Jika Anda ingin mengubah detilnya, <a href="mailto:info@ruangguru.com?Subject=Edit%20Kelas" class="blue underline">hubungi kami</a></li>
								<li>Anda hanya dapat melihat daftar murid dan menghubungi mereka yang sudah melakukan pembayaran. Untuk melihat daftar murid , klik "<b>Jumlah Murid</b>"</li>
							</ol>
						</div>
					</div>
					<div class="tab-pane" id="profile-2">
						<div class="panel-body">
							<p>Kelas tidak tersedia</p>
						</div>
					</div>
					<div class="tab-pane" id="profile-3">
						<div class="panel-body">
							<p>Kelas tidak tersedia</p>
						</div>
					</div>
				</div>
			</div>
			<div class="bottom-30"></div>
		</div>
	
<div id="galeri_kelas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="galeri_label" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="galeri_label">Galeri Kelas</h4>
			</div>
			<div class="modal-body">
				<div class="row">
				</div>
			</div>
		</div>
	</div>
</div>

<div id="jadwal_kelas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="jadwal_label" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="jadwal_label">Jadwal Kelas</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-hover">
							<thead>
							<tr>
								<th>Tanggal</th>
								<th>Waktu Mulai</th>
								<th>Waktu Selesai</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody id="class_sched">
							</tbody>
						</table>
					</div>
				</div>
				<h4>Tambah jadwal baru</h4>
				<input type="hidden" id="class_id" value="" />
				<div class="row">
					<div class="col-md-4">
						<input type="text" class="form-control" id="jadwal_date" name="jadwal_date" data-date-format="YYYY-MM-DD" placeholder="Masukkan tanggal (mis: 2014-10-15)" />
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control" id="jadwal_time_start" name="jadwal_time_start" data-date-format="HH:mm" placeholder="Masukkan Jam mulai (mis: 17:30)" />
					</div>
					<div class="col-md-4">
						<input type="text" class="form-control" id="jadwal_time_end" name="jadwal_time_end" data-date-format="HH:mm" placeholder="Masukkan Jam selesai (mis: 19:00)" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="pull-right">
							<button style="margin: 5px;" class="btn btn-success pull-right" type="button" id="jadwal_submit">Submit</button>
							<button style="margin: 5px;" class="btn btn-xs btn-danger" type="reset" id="jadwal_reset">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/template" id="class_sched_template">
</script>

<script type="application/javascript">
	$(document).ready(function(){
		$('#jadwal_submit').click(function(e){
			e.preventDefault();
			$.post(
					'<?php echo base_url();?>vendor/kelas/add_schedule',
					{
						'class_id'			: $('#class_id').val(),
						'jadwal_date'		: $('#jadwal_date').val(),
						'jadwal_time_start'	: $('#jadwal_time_start').val(),
						'jadwal_time_end'	: $('#jadwal_time_end').val()
					},
					function (xhr) {
						if(xhr.status == 'OK') {
							$tr = 	'<tr>' +
										'<td>'+$('#jadwal_date').val()+'</td>' +
										'<td>'+$('#jadwal_time_start').val()+'</td>' +
										'<td>'+$('#jadwal_time_end').val()+'</td>' +
										'<td>' +
											'<button class="btn btn-xs btn-danger" data-id="'+xhr.data.id+'">Delete</button>' +
										'</td>' +
									'</tr>';
							$('#no_data').remove();
							$('#class_sched').append($($tr));
							$('#jadwal_date').val('');
							$('#jadwal_time_start').val('');
							$('#jadwal_time_end').val('');
							}
					}
			);
			return false;
		});
		$('#jadwal_kelas').on('show.bs.modal', function(e) {
			var $parent = e.relatedTarget;
			var $data = $($parent).data();
			$('#class_id').val($data.id);
			$.get(
					'<?php echo base_url();?>vendor/kelas/get_jadwal',
					{
						'id'		: $data.id
					},
					function (xhr) {
						if(xhr.status == 'OK') {
							$('#class_sched').empty();
							if(xhr.data.rows > 0) {
								xhr.data.schedule.forEach(function(sched) {
									$tr = 	'<tr>' +
												'<td>'+sched.class_tanggal+'</td>' +
												'<td>'+sched.class_jam_mulai+':'+sched.class_menit_mulai+'</td>' +
												'<td>'+sched.class_jam_selesai+':'+sched.class_menit_selesai+'</td>' +
												'<td>' +
													'<button class="btn btn-xs btn-danger" data-id="'+sched.jadwal_id+'">Delete</button>' +
												'</td>' +
											'</tr>';
									$('#class_sched').append($($tr));
								});
							} else {
									$('#class_sched').append($('<tr><td colspan="4" style="text-align: center" id="no_data">No data available yet!</td></tr>'));
							}
						}
					}
			);
		});
		var d = new Date();
		var addZero = function (numb) {
			numb = parseInt(numb);
			numb = numb<10?'0'+numb:numb.toString();
			return numb;
		};
		var today = {
			'year'	: d.getFullYear(),
			'month'	: addZero(d.getMonth()+1),
			'date'	: addZero(d.getDate()),
			'hour'	: addZero(d.getHours()),
			'minute': addZero(d.getMinutes()),
			'second': addZero(d.getSeconds())
		};
		$('#jadwal_date').datetimepicker({
			pickTime		: false,
			minDate			: today.year+'-'+today.month+'-'+today.date,
			showToday		: true
		});
		$('#jadwal_time_start, #jadwal_time_end').datetimepicker({
			pickDate		: false,
			useSeconds		: false,
			minuteStepping	: 5,
			use24hours		: true
		});
		$('.publish-action').click(function(e){
			e.preventDefault();
			if($(this).data('action') == 'unpublish'){
				$.get(base_url+'vendor/kelas/update_publish',{'id': $(this).data('id'),'publish':1});
				$(this).data('action', 'publish');
				$(this).text('Request Unpublished');
				$(this).toggleClass('btn-danger').toggleClass('btn-primary');
				window.location.reload();
			} else {
				alert('Anda telah meminta untuk membuka kembali penyuntingan data.')
				return false;
			}
		});
	});
</script>
<?php
$this->load->view('vendor/general/footer');