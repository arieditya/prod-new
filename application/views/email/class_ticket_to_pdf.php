<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 1/30/15
 * Time: 1:27 PM
 * Proj: prod-new
 */?><!DOCTYPE html>
<html>
<head>
</head>
<!-- Insert Initial/Loader JS here -->
<body>
	<h1>Class Ticket</h1>
	<h2>Ticket Code: <strong><?php echo $ticket_code?></strong></h2>
	<h3>Class: <strong><?php echo $class_name?></strong></h3>
	<br style="border-bottom: 1px solid black" />
	<p>Peserta:</p>
	<table>
		<tr>
			<td style="width: 100px">Nama</td>
			<td style="width: 500px"><strong><?php echo $murid['name'] ?></strong></td>
		</tr>
		<tr>
			<td style="width: 100px">Email</td>
			<td style="width: 500px"><strong><?php echo $murid['email'] ?></strong></td>
		</tr>
		<tr>
			<td style="width: 100px">No. Telpon</td>
			<td style="width: 500px"><strong><?php echo $murid['phone'] ?></strong></td>
		</tr>
	</table>
	<p>Jadwal sesi:</p>
	<table border="1" style="border-collapse: collapse;" >
		<thead>
		<tr>
			<th style="width: 25px;">No</th>
			<th style="width: 400px;">Session</th>
			<th style="width: 100px;">Absen</th>
		</tr>
		</thead>
		<tbody>
<?php 
	$i = 0;
	foreach($jadwal as $sched):
		$style = '';
		if( ! $sched['attending']) $style = 'background-color: #565656;';
?>
		<tr>
			<td style="<?php echo $style;?>"><?php echo ++$i; ?></td>
			<td style="<?php echo $style;?>">
<?php 
if(!empty($sched['topic'])) echo $sched['topic'].'<br />';
echo $sched['date'] .', '. $sched['start_time'].' s.d '.$sched['end_time'];
?>
			</td>
			<td style="<?php echo $style;?>"></td>
		</tr>
<?php
	endforeach;
?>
		</tbody>
	</table>
</body>
<!-- Insert JS here -->
</html>