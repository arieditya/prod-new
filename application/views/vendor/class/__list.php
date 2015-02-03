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
	<h2>Daftar kelas</h2>
		<p>List kelas yang telah Anda buat</p>
	<div class="row" style="margin-top: 20px;">
		<div class="col-md-12">
			<table class="table table-hover">
				<thead>
				<tr>
					<th>No.</th>
					<th>Nama Kelas (URI)</th>
					<th>Harga per sesi <a href="#" title="Harga kelas untuk setiap sesi yang diadakan" class="tooltip">?</a></th>
					<th>Jumlah Sesi <a href="#" class="tooltip" title="Banyaknya sesi yang diadakan oleh penyelenggara">?</a></th>
					<th>Jumlah Murid <a href="#" class="tooltip" title="Jumlah murid yang mengikuti kelas dan sudah melakukan pembayaran">?</a></th>
					<th>Tipe Kelas <a href="#" class="tooltip" title="Single adalah kelas yang dibuat hanya untuk satu sesi. Paket adalah kelas yang dibuat lebih dari satu sesi dan berkelanjutan">?</a></th>
					<th>Status <a href="#" class="tooltip" title="Status &quot;Pending&quot;: kelas sedang menunggu persetujuan tim Ruangguru. Status &quot;Approved&quot;: kelas sudah disetujui oleh tim Ruangguru. Status &quot;Cancelled&quot;: kelas sudah dibatalkan oleh tim Ruangguru. Status &quot;Rejected&quot;: kelas ditolak oleh tim Ruangguru">?</a></th>
					<th>Action <a href="#" class="tooltip" title="Edit Profil: untuk mengubah profil penyelenggara. Poster: untuk mengunggah foto kelas. Published: untuk menampilkan kelas yang dibuat agar bisa dilihat oleh pengunjung website. Unpublished: untuk menyembunyikan kelas yang telah dibuat sehingga hanya dilihat oleh penyelenggara">?</a></th>
				</tr>
				</thead>
				<tbody>
<?php
	$i = 1;
	foreach($classes as $class):
		$status = '';
//* ON DEBUG
		$class->class_status = '4';
// */
		switch($class->class_status){
			case		'0'		: $status = '<span class="label label-info">Pending</span>';break;
			case		'1'		: $status = '<span class="label label-success">Approved</span>';break;
			case		'-1'	: $status = '<span class="label label-danger">Rejected</span>';break;
			case		'4'		: $status = '<span class="label label-warning">Canceled</span>';break;
		}
?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $class->class_nama; ?> <small>(<a href="<?php echo base_url()."kelas/{$class->class_uri}"; ?>" target="_blank"><?php echo $class->class_uri; ?></a>)</small></td>
					<td>Rp. <?php echo number_format($class->class_harga, 2,',','.'); ?></td>
					<td><?php echo $class->jadwal_count; ?></td>
					<td>Rp. <?php echo number_format($class->class_harga*$class->jadwal_count, 2,',','.'); ?></td>
					<td><?php echo $class->class_paket=='1'?'<span class="label label-default">Package</span>':'<span class="label label-info">Single</span>'; ?></td>
					<td><?php echo $status;?></td>
					<td>
						<a class="btn btn-success btn-xs" href="<?php echo base_url()?>vendor/kelas/detil/<?php echo $class->id; ?>" data-tooltip="Harga untuk setiap sesi yang diadakan oleh penyelenggara">Edit Kelas</a>
<?php
	if($class->active == '1'):
?>
						<button class="btn btn-primary btn-xs publish-action" data-action="publish" data-id="<?php echo $class->id; ?>" >Published</button>
<?php
	else:
?>
						<button class="btn btn-danger btn-xs publish-action" data-action="unpublish" data-id="<?php echo $class->id; ?>" >Unpublished</button>
<?php
	endif;
?>
					</td>
				</tr>
<?php 
	$i++;
	endforeach;
?>
				</tbody>
			</table>
		</div>
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
				<h4>Tambah Jadwal Baru</h4>
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
							<button style="margin: 5px;" class="btn btn-success pull-right" type="button" id="jadwal_submit">Simpan</button>
							<button style="margin: 5px;" class="btn btn-xs btn-danger" type="reset" id="jadwal_reset">Batal</button>
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
		function addZero(numb) {
			numb = parseInt(numb);
			numb = numb<10?'0'+numb:numb.toString();
			return numb;
		}
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
			var stat = $(this).data('action') == 'publish'?0:1;
			$.get(base_url+'vendor/kelas/update_publish',{'id': $(this).data('id'),'publish':stat});
			$(this).data('action', stat==0?'unpublish':'publish');
			$(this).text(stat==0?'Unpublished':'Published');
			$(this).toggleClass('btn-danger').toggleClass('btn-primary');
			return false;
		});
	});
</script>
<?php
$this->load->view('vendor/general/footer');
?>