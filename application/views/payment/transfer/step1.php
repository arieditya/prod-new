<?php
$this->load->view('general/header-bootstrap');
$wait = $this->input->cookie('wait', TRUE);
if(empty($wait)) $wait = '[]';
$wait = json_decode($wait);
?>
<link href="<?php echo base_url();?>/assets/css/payment-transfer.css" type="text/css" rel="stylesheet" />
<div id="curtain"></div>
<script type="application/javascript">
	var cart = $.cookie('cart');
	var wait = $.cookie('wait');
	if(!wait) wait = [];
</script>
<div class="main-content">
	<div class="row bg-all">
		<div class="col-md-8 col-md-offset-2">
			<form role="form" method="post" action="<?php echo base_url('payment/transfer/step2');?>">
				<div class="row">
					<div class="col-md-7">
						<h2 class="text-18 bold pinkfont">Review Data Pemesanan</h2>
						<div class="bg-section padding-content shadow">
							<p class="text-16 bold" style="margin-left:-4px;">Data <span class="pinkfont">Pemesan</span></p>
<?php 
	if(empty($student)): 
?>
							<div class="row">
								<!--<div class="col-md-3">
									<button class="btn-blue" id="btn_signin">Sign In</button>
								</div>-->
							</div>
<?php 
	endif; 
?>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama Lengkap Pemesan*</label>
										<input type="text" name="pemesan_name" class="form-control" placeholder="Nama sesuai dengan kartu identitas" value="<?php echo !empty($student)?$student->murid_nama:'';?>" <?php echo !empty($student)?'readonly="readonly"':'';?> />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email*</label>
										<input type="email" name="pemesan_email" class="form-control" placeholder="Contoh: nama@email.com" value="<?php echo !empty($student)?$student->murid_email:'';?>" <?php echo !empty($student)?'readonly="readonly"':'';?> />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Nomor Telepon/HP*</label>
										<input type="tel" name="pemesan_phone" class="form-control" placeholder="Contoh: 08123457890" value="<?php echo !empty($student)?$student->murid_hp:'';?>" <?php echo !empty($student)?'readonly="readonly"':'';?> />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Alamat lengkap*</label>
								<textarea rows="3" class="form-control" name="pemesan_address" <?php echo !empty($student)?'readonly="readonly"':'';?> placeholder="Alamat sesuai dengan alamat domisili saat ini. Cantumkan juga kota tempat tinggal saat ini."><?php echo !empty($student)?$student->murid_alamat:'';?> </textarea>
							</div>
							<br/>
							<p class="text-16 bold">Data <span class="pinkfont">Murid</span></p>
							<div class="row">
								<div class="col-md-12">
									<div class="radio">
										<label>
											<input type="radio" name="whostudent" value="me" <?php echo $whostudent=='me'?'checked="checked"':'';?> />
											Saya sendiri yang akan hadir menjadi murid di kelas ini
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="whostudent" value="other" <?php echo $whostudent!='me'?'checked="checked"':'';?> />
											Saya mendaftarkan untuk orang lain
										</label>
									</div>
								</div>
							</div>
							<div id="student_other" style="display:none;">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Nama Lengkap Siswa*</label>
											<input type="text" name="peserta_name" class="form-control" placeholder="Nama sesuai dengan kartu identitas" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Email</label>
											<input type="email" name="peserta_email" class="form-control" placeholder="Contoh: nama@email.com" />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Nomor Telepon/HP</label>
											<input type="tel" name="peserta_phone" class="form-control" placeholder="Contoh: 08123457890" />
										</div>
									</div>
								</div>
							</div>
							<!--<div class="row">
								<div class="col-md-12">
									<input type="checkbox" name="check">&nbsp;Data pemesan, murid dan rincian pemesanan sudah sesuai.<br/>Saya menyepakati <a href="#" class="blue underline">persyaratan dan ketentuan</a> yang berlaku
								</div>
							</div>-->
						</div>
						<div class="row">
							<div class="col-md-12 top-30 bottom-30">
								<input type="hidden" name="frm_c" value="fex">
								<button type="submit" class="btn-orange">Submit Pesanan</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							</div>
						</div>
					</div>
					<div class="col-md-5" id="right_belly">
						<h2 class="text-18 bold pinkfont">Rincian Pemesanan</h2>
						<div class="bg-section padding-content shadow top-30">
							<p class="text-16 bold">Jadwal kelas yang ingin diikuti</p>
<?php 
	$total_price = 0;
	foreach($in_cart as $cart_list):
		$logo = base_url('images/class/'.$cart_list['class']->id.'/'.$cart_list['class']->class_image);
?>
							<div class="followed-class">
								<div class="row">
									<div class="col-md-4">
										<img class="img-responsive" src="<?php echo $logo; ?>" />
									</div>
									<div class="col-md-8">
										<h5 class="pinkfont bold">
											<?php echo $cart_list['class']->class_nama?><br />
											<a href="#remove_cart" data-r_id="<?php echo $cart_list['class']->id?>" 
											   class="remove_cart">
												<sub>(Remove from list)</sub>
											</a>
										</h5>
									</div>
								</div>
								<hr/>
								<div class="row">
									<table class="white-table">
										<thead>
										<tr>
											<th>No</th>
											<th>Sesi</th>
											<th>Harga</th>
										</tr>
										</thead>
										<tbody>
<?php
		$i = 0;
		$subprice = 0;
		$diskon = TRUE;
		foreach($cart_list['schedule'] as $sched):
			$i++;
			$date = date('j M y', strtotime($sched->class_tanggal));
			$start = $sched->class_jam_mulai.':'.$sched->class_menit_mulai;
			$end = $sched->class_jam_selesai.':'.$sched->class_menit_selesai;
			$followed = FALSE;
//			$sched->available_seat = 0;
			if(in_array($sched->jadwal_id, $cart_list['followed']) && $sched->available_seat > 0) {
				$subprice += (int)$cart_list['class']->price_per_session;
				$followed = TRUE;
			} else {
				$diskon = FALSE;
			}
			$text = $sched->class_jadwal_topik?'':('<span style="'.$followed?'':'text-decoration: line-through;'.'">'.$sched->class_jadwal_topik.'</span>');
			$text .= $sched->available_seat == 0?'<span class="label label-warning">Fullbook</span>':'';
			$text .= (!empty($text)?'<br />':'');
?>
										<tr>
											<td><?php echo $i;?></td>
											<td>
												<?php echo $text;?>
												<span class="bluefont" style="<?php echo $followed?'':'text-decoration: line-through;'?>"><?php echo "{$date}, {$start}-{$end}";?> WIB</span>
											</td>
											<td>
												<div style="float: left;<?php echo $followed?'':'text-decoration: line-through;'?>">
													Rp <?php echo number_format((int)$cart_list['class']->price_per_session, 0, ',',',')?>,-&nbsp;&nbsp;&nbsp;
												</div>
<?php 
	if($cart_list['class']->class_paket == 1):
		if($followed):
?>
												<i class="fa fa-times-circle fa-lg rmv_schd" title="Remove from schedule" data-id="<?php echo $sched->class_id.'|'.$sched->jadwal_id; ?>"></i>
<?php 
		else:
			if($sched->available_seat == 0):
				if(in_array($sched->jadwal_id, $wait)):
?>
												<i class="fa fa-exclamation-circle fa-lg rmv_wait" title="Remove from waiting list" data-id="<?php echo $sched->class_id.'|'.$sched->jadwal_id; ?>"></i>
<?php 
				else:
?>
												<i class="fa fa-question-circle fa-lg  add_wait" title="Add to waiting list" data-id="<?php echo $sched->class_id.'|'.$sched->jadwal_id; ?>"></i>
<?php 
				endif;
			else:
?>
												<i class="fa fa-check-circle fa-lg add_schd" title="Add to schedule" data-id="<?php echo $sched->class_id.'|'.$sched->jadwal_id; ?>"></i>
<?php 
			endif;
		endif;
	endif;
?>
											</td>
										</tr>
<?php
		endforeach;
?>
										</tbody>
										<tfoot>
										<td></td>
										<td><span class="pinkfont">Sub total harga</span><br/>Potongan Harga</td>
										<td>
<?php 
		//if($diskon):
?>
											<span class="pinkfont">Rp <?php echo number_format($subprice, 0, ',',',')?>,-</span><br />
<?php 
			$subprice -= (int) $cart_list['class']->discount;
		//endif;
		$disc = (int) $cart_list['class']->discount;
?>
											<span>Rp <?php echo number_format($disc, 0, ',',',')?>,-</span>
										</td>
										</tfoot>
									</table>
								</div>
							</div>
							<div class="subtotal bottom-20 padtop-30">
								<h4 class="pull-left bold">Subtotal Harga</h4>
								<h4 class="pull-right bold">Rp <?php echo number_format($subprice).',-';?></h4>
							</div>
							<div class="bottom-20"></div>
<?php 
		$total_price += $subprice;
	endforeach;
?>
<?php
//	$potongan_diskon = 250000;
	if(!empty($potongan_diskon)) {
		if(!is_array($potongan_diskon)) $potongan_diskon = array($potongan_diskon);
		foreach($potongan_diskon as $price_code => $price):
?>
							<h5><?php echo $price_code;?></h5>
							<h5>Rp <?php echo number_format($price, 0, ',',',')?>,-</h5>
<?php
			$total_price -= $price;
		endforeach;
	}
	else $potongan_diskon = 0;
?>
							<div class="top-10">
								<div class="form-group">
									<label class="col-md-9">Kode Diskon</label><br/>
									<div class="col-md-9">
										<input type="text" id="kode_diskon" class="form-control" placeholder="(jika ada)" value="" />
									</div>
									<div class="col-md-3 bottom-10">
										<a class="manage-icon text-14" id="cek_diskon">Cek!</a>
									</div>
								</div>
							</div>
							<div class="blue-segment">
								<h3 class="pull-left bold">Total yang harus dibayar</h3>
								<h3 class="pull-right bold">Rp <?php echo number_format($total_price, 0, ',',',')?>,-</h3>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="application/javascript">
	$('input[type=radio][name=whostudent]').click(function(e){
		if($(this).val() == 'other') {
			$('#student_other').show();
		} else {
			$('#student_other').hide();
		}
	});
	
	$(document).ready(function(){
		$('.blue-segment').css(
				{
					'width':$('.blue-segment').parent().css('width'),
					'marginLeft': '-20px'
				}
		);
	});
	
	$('.remove_cart').click(function(e){
		e.preventDefault();
		var r_id = $(this).data('r_id');
		var newCart = [];
		$.each(cart, function(idx, dt){
			if(dt.id == r_id) return;
			newCart.push(dt);
		});
		$.cookie('cart', newCart, {'path': '/'});
		window.location.reload();
		return false;
	});
	
	$('#btn_signin').click(function(e){
		e.preventDefault();
		$('#curtain').show().css({
			'width'				: window.screen.width+200+'px',
			'height'			: window.screen.height+200+'px',
			'background'		: 'rgba(70,70,70,0.4)',
			'top'				: ($('#curtain').position().top * -1)+'px',
			'position'			: 'fixed',
			'z-index'			: 10000000
		});
		
		var $sgn_in = $('<div class="sign_form"></div>');
		var elmDimension = {
			width		: 500,
			height		: 250
		};
		$sgn_in.css({
			left				: Math.floor(window.screen.width/2)-(Math.floor(elmDimension.width/2))+'px',
			top					: Math.floor(window.screen.height/2)-(Math.floor(elmDimension.height/2))+'px',
			width				: elmDimension.width+'px',
			height				: elmDimension.height+'px',
			'position'			: 'absolute',
			'backgroundColor'	: '#eee',
			'color'				: '#333',
			'text-align'		: 'left',
			'border-radius'		: '10px'
		});
		console.log($sgn_in.css('left'));
		console.log($sgn_in.css('top'));
		$sgn_in.append($('#sign_in_fly').html());
		console.log($sgn_in.html());
		$('#curtain').append($sgn_in);
		
		return false;
	});
	$('#cek_diskon').click(function(e){
		e.preventDefault();
		
		$.get(base_url+'payment/transfer/cek_diskon',{
					'kode_diskon'	: $('#kode_diskon').val()
				},
				function(result) {
					if(result.status == 'OK') {
						alert(result.data.message);
						window.location.reload();
					} else if(result.status == 'NOK') {
						alert(result.data.message);
					}
				},
				'json'
		).error(function(jqxhr){
			console.log(jqxhr);
		});
		
		var kode_diskon = $.cookie('kode_diskon');
		var key_exists = false;
		Object.keys(kode_diskon).reduce(
				function(kode, nextKey) {
					if(kode == $('#kode_diskon').val()) {
						key_exists = true;
					}
					return nextKey;
				}
			);
		if(!key_exists) {
			
		}

		$.cookie('kode_diskon', $('#kode_diskon').val(), {'path':'/'});
		window.location.reload();
		return false;
	});
	$('.add_schd').click(function(e){
		e.preventDefault();
		var $id = $(this).data('id').split('|');
		$id[0] = parseInt($id[0]);
		$id[1] = parseInt($id[1]);
		var newCart = [];
		cart.forEach(function(d){
			var newCartElm = {
				id		: d.id,
				jadwal	: []
			};
			var added = false;
			d.jadwal.forEach(function(j){
				if(d.id == $id[0] && j > $id[1] && ! added) {
					newCartElm.jadwal.push($id[1]);
					added = true;
				}
				newCartElm.jadwal.push(j);
			});
			if(d.id == $id[0] && ! added) {
				newCartElm.jadwal.push($id[1]);
			}
			newCart.push(newCartElm);
		});
		$.cookie('cart', newCart, {'path': '/'});
		window.location.reload();
		return false;
	});
	$('.rmv_schd').click(function(e){
		e.preventDefault();
		var $id = $(this).data('id').split('|');
		var newCart = [];
		cart.forEach(function(d){
			var newCartElm = {
				id		: d.id,
				jadwal	: []
			};
			console.log('CART:',d);
			if(d.id != $id[0]) {
				newCartElm = d;
			} else {
				d.jadwal.forEach(function(j){
					if(j != $id[1]){
						newCartElm.jadwal.push(j);
					}
				});
			}
			newCart.push(newCartElm);
		});
		console.log(newCart);
		$.cookie('cart', newCart, {'path': '/'});
		window.location.reload();
		return false;
	});
	$('.add_wait').click(function(e) {
		e.preventDefault();
		var $id = $(this).data('id').split('|');
		$id[1] = parseInt($id[1]);
		var newWait = [];
		var added = false;
		wait.forEach(function(d) {
			if(d == $id[1])
				added = true;
			newWait.push(d);
		});
		if(!added) newWait.push($id[1]);
		$.cookie('wait', newWait, {path: '/'});
		window.location.reload();
		return false;
	});
	$('.rmv_wait').click(function(e) {
		e.preventDefault();
		var $id = $(this).data('id').split('|');
		$id[1] = parseInt($id[1]);
		var newWait = [];
		var added = false;
		wait.forEach(function(d) {
			if(d != $id[1])
				newWait.push(d);
		});
		$.cookie('wait', newWait, {path: '/'});
		window.location.reload();
		return false;
	});
</script>
<script type="text/template" id="sign_in_fly">
	<form action="<?php echo base_url();?>payment/user/login" method="post">
		<div class="row">
			<div class="col-md-6">
				<div class="pull-right">
					<label>Email</label>
				</div>
			</div>
			<div class="col-md-6">
				<input type="email" name="email"/>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="pull-right">
					<label>Password</label>
				</div>
			</div>
			<div class="col-md-6">
				<input type="password" name="password"/>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<button class="btn-orange" type="submit">Submit</button>
			</div>
		</div>
	</form>
</script>
<?php
$this->load->view('vendor/general/footer');
