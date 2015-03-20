<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 2/26/15
 * Time: 10:28 AM
 */
$this->load->view('vendor/general/header2');
?>
	<link href="<?php echo base_url();?>/assets/css/payment-transfer.css" type="text/css" rel="stylesheet">
	<div id="curtain"></div>
    <div class="container content">
        <div class="row">
            <div class="col-sm-7">
                <div class="panel panel-default panel-big">
						<div class="panel-heading heading-label">Data Pemesanan</div>
						<div class="panel-body">
							<h4 class="review-title">Data Pemesan</h4>
							<div class="form-group">
								<label for="Nama">Nama Lengkap Pemesan *</label>
								<input type="text" 
									   class="form-control" 
									   name="pemesan_name" 
									   id="pemesan_name" 
									   readonly="readonly"
									   placeholder="Nama sesuai dengan kartu identitas" 
									   value="<?php echo $pemesan['name'];?>" />
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="Email">Email *</label>
									<input type="email" 
										   class="form-control" 
										   id="pemesan_email"
										   name="pemesan_email"
										   placeholder="Contoh: nama@email.com" 
										   readonly="readonly"
										   value="<?php echo $pemesan['email'];?>" />
								</div>
								<div class="form-group col-sm-6">
									<label for="Telp">Nomor Telepon/ HP *</label>
									<input type="text" 
										   class="form-control" 
										   id="pemesan_phone"
										   name="pemesan_phone"
										   placeholder="Contoh: 08123456789" 
										   readonly="readonly"
										   value="<?php echo $pemesan['phone'];?>" />
								</div>
							</div>
						</div>
						<div class="panel-body" id="student_other">
							<h4 class="review-title">Data Peserta</h4>
							<div class="form-group">
								<label for="Nama">Nama Lengkap Peserta *</label>
								<input type="text" 
									   class="form-control" 
									   id="peserta_name" 
									   name="peserta_name" 
									   readonly="readonly"
									   value="<?php echo $peserta['name'];?>" />
							</div>
							<div class="row">
								<div class="form-group col-sm-6">
									<label for="Email">Email *</label>
									<input type="email" 
										   class="form-control" 
										   id="peserta_email"
										   name="peserta_email"
										   readonly="readonly"
										   value="<?php echo $peserta['email'];?>" />
								</div>
								<div class="form-group col-sm-6">
									<label for="Telp">Nomor Telepon/ HP *</label>
									<input type="text" 
										   class="form-control" 
										   id="peserta_phone"
										   name="peserta_phone"
										   readonly="readonly"
										   value="<?php echo $peserta['phone'];?>" />
								</div>
							</div>
						</div>
                </div><!-- panel -->
<?php 
if($total > 0):
	$not_connect = FALSE;
	try {
							$jml_sesi = count($jadwal);
							$price_session = $subtotal/$jml_sesi;
							
							// Use sandbox account
							//Veritrans_Config::$isProduction = true;
							Veritrans_Config::$isProduction = false;
				
							// Set our server key
							Veritrans_Config::$serverKey = 'VT-server-a-AunKPJMwirR3Woa9ndxVCK'; //---> SANDBOX KEY
							$items_details = $veritrans_items;
							if($discount > 0) {
								$disc_items = array(
									'id'		=> 'disc',
									'price'		=> -($discount),
									'quantity'	=> 1,
									'name'		=> 'Discount'
								);
								$items_details[] = $disc_items;
							}
/*
							// Optional
							$item1_details = array(
								'id' => 'a1',
								'price' => $price_session,
								'quantity' => $jml_sesi,
								'name' => "Kelas Test"
							);
							if($discount > 0){
								$item2_details = array(
									'id' => 'a2',
									'price' => -($discount),
									'quantity' => 1,
									'name' => "Discount"
								); 
								$items_details = array ($item1_details, $item2_details);
							}else{
								$items_details = $item1_details;
							}
// */
							// Optional
							$billing_address = array(
								'first_name'    => $pemesan['name'],
								'last_name'     => " ",
								'address'       => $pemesan['address'],
								'phone'         => $pemesan['phone'],
								'country_code'  => 'IDN'
							);
				
							// Optional
							$customer_details = array(
								'first_name'    => $pemesan['name'],
								'last_name'     => " ",
								'email'         => $pemesan['email'],
								'phone'         => $pemesan['phone'],
								'billing_address'  => $billing_address,
							);
					
							$transaction = array(
								'payment_type' => 'vtweb',
								"vtweb" => array (
									"enabled_payments" => array("credit_card"),
									"credit_card_3d_secure" => true,
								),
								'transaction_details' => array(
									'order_id' => $code,
									'gross_amount' => $total,
								),
								'customer_details' => $customer_details,
								'item_details' => $items_details,
							);
							
							$transaction2 = array(
								'payment_type' => 'vtweb',
								"vtweb" => array (
									"enabled_payments" => array("cimb_clicks"),
									"credit_card_3d_secure" => true,
								),
								'transaction_details' => array(
									'order_id' => $code,
									'gross_amount' => $total,
								),
								'customer_details' => $customer_details,
								'item_details' => $items_details,
							);
							
							$transaction3 = array(
								'payment_type' => 'vtweb',
								"vtweb" => array (
									"enabled_payments" => array("mandiri_clickpay"),
									"credit_card_3d_secure" => true,
								),
								'transaction_details' => array(
									'order_id' => $code,
									'gross_amount' => $total,
								),
								'customer_details' => $customer_details,
								'item_details' => $items_details,
							);
				
							$vtweb_url = Veritrans_Vtweb::getRedirectionUrl($transaction);
							$vtweb_url_cimb = Veritrans_Vtweb::getRedirectionUrl($transaction2);
							$vtweb_url_mandiri = Veritrans_Vtweb::getRedirectionUrl($transaction3);
	} catch(Exception $e) {
?>
<script type="application/javascript">
	console.error('Cannot connect to Veritrans payment gateway server!');
</script>
<?php
							$not_connect = TRUE;
							$vtweb_url = 
							$vtweb_url_cimb = 
							$vtweb_url_mandiri = '#not_connect';
	}
						?>
						<div class="bg-section padding-content shadow top-30">
							<div class="pinkfont text-16">Pilih metode pembayaran</div>
							<div class="text-14">Anda tidak akan dikenakan biaya tambahan!</div>
							
							<div class="row">
								<div class="col-md-4 payment-howto">
									<div class="btn-payment2" id="payment_cc">
										<img src="<?php echo base_url();?>/images/payment/visa-mastercard.png" width="25px"/>
										Kartu Kredit
									</div>
								</div>
								<div class="col-md-4 payment-howto">
									<button class="btn-payment2" id="payment_atm">
										<img src="<?php echo base_url();?>/images/payment/atm-bersama.png" width="25px"/>
										Bank Transfer
									</button>
								</div>
								<div class="col-md-4 payment-howto">
									<div class="btn-payment2" id="payment_cimb">
										<img src="<?php echo base_url();?>/images/payment/cimb-click.png" width="60px"/>
										CIMB Clicks
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 payment-howto">
									<div class="btn-payment2" id="payment_mandiri">
										<img src="<?php echo base_url();?>/images/payment/mandiri-clickpay.png" width="30px"/>
										Mandiri Clickpay
									</div>
								</div>
								<div class="col-md-4 payment-howto">
									<button class="btn-payment2" id="payment_cash">
										<img src="<?php echo base_url();?>/images/payment/uang.png" width="30px"/>
										Cash
									</button>
								</div>
								<div class="col-md-4 payment-howto"></div>
							</div>
							<div class="row">
								<div id="transfer_info" class="content-segment payment_info">
									<p class="pinkfont bottom-10">
										Anda memiliki waktu <span>24 jam</span>
										dari sekarang untuk melaksanakan pembayaran.
									</p>
									<p>
										Jika dalam batas waktu tersebut, Anda belum melakukan pembayaran, maka pesanan Anda
										akan dianggap dibatalkan, dan Anda harus mengulang proses pemesanan dari awal.
									</p>
									<p>
										Anda dapat melakukan transfer ke salah satu rekening Bank dibawah ini.
									</p>
									<p>
										<span class="pinkfont">BANK BCA</span><br />
										No. Rekening: 2611-3655-11<br />
										Atas nama: PT. RUANG RAYA INDONESIA
									</p>
									<p>
										<span class="pinkfont">BANK Mandiri</span><br />
										No. Rekening: 157-00-0398209-8<br />
										Atas nama: PT. RUANG RAYA INDONESIA
									</p>
									<p>
										<span class="pinkfont">BANK BNI</span><br />
										No. Rekening: 033-1469330<br />
										Atas nama: PT. RUANG RAYA INDONESIA
									</p>
									<p>
										<span class="pinkfont">BANK BRI</span><br />
										No. Rekening: 2080-01-000124-30-3<br />
										Atas nama: PT. RUANG RAYA INDONESIA
									</p>
									<p>
										<span class="pinkfont">BANK Permata</span><br />
										No. Rekening: 411-0463893<br />
										Atas nama: PT. RUANG RAYA INDONESIA
									</p>
									<p class="bottom-10">
										Setelah transfer, Anda dapat melakukan konfirmasi pembayaran.<br />
										(link untuk konfirmasi juga kami kirimkan melalui email)
									</p>
								</div>
								<div id="cash_info" class="content-segment payment_info">
									<p class="pinkfont bottom-10">
										Anda memiliki waktu <span>24 jam</span>
										dari sekarang untuk melaksanakan pembayaran.
									</p>
									<p>
										Jika dalam batas waktu tersebut, Anda belum melakukan pembayaran, maka pesanan Anda
										akan dianggap dibatalkan, dan Anda harus mengulang proses pemesanan dari awal.
									</p>
									<p>
										Anda dapat melakukan pembayaran langsung ke:
									</p>
									<p>
										<span class="pinkfont">Ruangguru.com HQ</span><br />
										d/a Jalan Tebet Raya 32A Jakarta Selatan<br />
										(patokan: depan Wisma Tebet)<br />
										Telp: 021-9200-3040
									</p>
								</div>
							</div>
						</div>
						<div class="checkbox bottom-30">
							<label>
								<input type="checkbox" id="iagree" />
								Data pemesan, murid dan rincian pemesanan sudah sesuai.<br/>
								Saya menyepakati <a href="http://ruangguru.com/kebijakan" class="blue underline">persyaratan dan ketentuan</a> yang berlaku
							</label>
						</div>
						<div class="agreefirst">
							<button class="btn-orange" id="btn_next">Lanjutkan</button>
							<div class="grey"></div>
						</div>
<?php 
else:
							$vtweb_url = 
							$vtweb_url_cimb = 
							$vtweb_url_mandiri = '';
?>
						<div class="checkbox bottom-30">
							<label>
								<input type="checkbox" id="iagree" />
								Data pemesan, murid dan rincian pemesanan sudah sesuai.<br/>
								Saya menyepakati <a href="http://ruangguru.com/kebijakan" class="blue underline">persyaratan dan ketentuan</a> yang berlaku
							</label>
						</div>
						<div class="agreefirst">
							<button class="btn-orange" id="btn_free">Ambil Tiket Gratis!</button>
							<div class="grey"></div>
						</div>
<?php 
endif;
?>
            </div><!-- col-sm-7 -->
            <div class="col-sm-5">
                <div class="panel panel-default panel-big">
                    <div class="panel-heading heading-label">Rincian Pemesanan</div>
                    <div class="panel-body">
                        <h4 class="review-title">Jadwal kelas yang pesan</h4>
                        <div class="jadwal-item">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Sesi</td>
                                        <td>Harga</td>
                                    </tr>
                                </thead>
                                <tbody>
<?php 
	$total_price = 0;
	foreach($jadwal as $sched):
		$i = 0;
		$subprice = 0;
		$diskon = TRUE;
			$i++;
			$date = date('j M y', strtotime($sched->class_tanggal));
			$start = $sched->class_jam_mulai.':'.$sched->class_menit_mulai;
			$end = $sched->class_jam_selesai.':'.$sched->class_menit_selesai;
			$followed = FALSE;
//			$sched->available_seat = 0;
			$text = $sched->class_jadwal_topik;
			$text .= (!empty($text)?'<br />':'');
			$subprice += $sched->price_per_session;
?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td>
											<?php echo $text;?> 
											<?php echo "{$date}, {$start}-{$end}";?> WIB
										</td>
                                        <td><?php echo rupiah_format((int)$sched->price_per_session)?> </td>
                                    </tr>
<?php
	endforeach;
?>
                                </tbody>
                            </table>
                            <h5 class="sum-label">
								Subtotal Harga 
								<span class="sum-price pull-right"><?php echo rupiah_format($subtotal) ?></span>
							</h5>
<?php 
		if(!empty($discount)):
?>
                            <h5 class="sum-label">
								Potongan Harga 
								<span class="sum-price pull-right"><?php echo rupiah_format($discount)?></span>
							</h5>
<?php 
		endif;
?>
                        </div><!-- jadwal-item -->
                        <h4 class="sum-total">
							Total yang harus dibayar <span class="pull-right">
								<?php echo rupiah_format($total)?>
							</span>
						</h4>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-5 -->
        </div>
    </div> <!-- /container -->
    <script type="application/javascript">
	var code = '<?php echo $code; ?>';
	var _vt_payment_type = false;
	var _vt_link = '';
	var _vt_method = '';
	$(document).ready(function(){
		$('#curtain').hide();
		$('.payment_info').hide();
		$('.btn-payment2').click(function(e){
			var $id = $(this).attr('id');
			$('.btn-payment2').removeClass('active');
			$('.payment_info').hide();
			$(this).addClass('active');
			switch($id) {
				case		'payment_atm':
					$('#transfer_info').show();
					_vt_payment_type = false;
					e.preventDefault();
					return false;
					break;
				case		'payment_cash':
					$('#cash_info').show();
					_vt_payment_type = false;
					e.preventDefault();
					return false;
					break;
				default:
					if($id == 'payment_cc') {
						_vt_link = '<?php echo $vtweb_url;?>';
					} else if($id == 'payment_cimb') {
						_vt_link = '<?php echo $vtweb_url_cimb;?>';
					} else if($id == 'payment_mandiri') {
						_vt_link = '<?php echo $vtweb_url_mandiri;?>';
					}
					_vt_payment_type = true;
					_vt_method = $id;
			}
		});
<?php 
if($total > 0):
// 
?>
		$('#btn_next').click(function(e){
			e.preventDefault();
			if(!$('#iagree').is(':checked')) {
				e.preventDefault();
				$(this).removeClass('active');
				alert('Mohon centang persetujuan anda\n' +
						'dengan persyaratan dan ketentuan kami\n' +
						'yang berlaku terlebih dahulu.\n' +
						'Terima kasih.');
				return false;
			}
			if(_vt_payment_type) {
				$.post(
						base_url+'payment/transfer/step3vt',
						{'code': code, 'method': _vt_method},
						function(dt) {
							
						}
				);
				window.location.href = _vt_link;
				return;
			}
			$('#curtain').show().css({
				'width'				: window.screen.width+200+'px',
				'height'			: window.screen.height+200+'px',
				'background'		: 'rgba(70,70,70,0.4)',
				'top'				: ($('#curtain').position().top * -1)+'px',
				'position'			: 'fixed',
				'z-index'			: 10000000
			});
			var roller = $('<i id="roller" class="fa fa-circle-o-notch fa-spin fa-5x"></i>')
			var cssOpt = {
				'top'				: Math.floor(window.screen.height/2)+'px',
				'left'				: Math.floor(window.screen.width/2)+'px',
				'position'			: 'absolute',
				'color'				: '#fff'
			};
			roller.css(cssOpt);
			$('#curtain').append(roller);
			var opt = {
				'data': {
					't':'AFEB24CEDA7E==',
					'code': code
				},
				'type': 'post',
				'dataType': 'json',
				'error': function() {
					var cssOpt = {
						'top'				: Math.floor(window.screen.height/2)-(90)+'px',
						'left'				: Math.floor(window.screen.width/2)-(233)+'px',
						'position'			: 'absolute',
						'color'				: '#fff'
					};
					var result_container = $('<div id="result_container"></div>');
					result_container.css(cssOpt);
					result_container.css({
						'height'		: '250px',
						'width'			: '465px',
						'backgroundColor': '#eee',
						'text-align'	: 'left',
						'padding'		: 0
					});
					result_container.append($('<h5 class="pinkfont">Transaksi gagal</h5>'));
					result_container.append($('<p>Transaksi anda mengalami kegagalan, silahkan mencoba lagi beberapa saat lagi, atau hubungi customer service kami di:<br /><span class="pinkfont">021.9200.3040</span></p>'));
					result_container.append($('<p>Terima kasih.</p>'));
					$('#roller').remove();
					$('#curtain').append(result_container);
				},
				'success': function(dt){
					var cssOpt = {
						'top'				: Math.floor(window.screen.height/2)-(90)+'px',
						'left'				: Math.floor(window.screen.width/2)-(233)+'px',
						'position'			: 'absolute',
						'color'				: '#fff'
					};
					var result_container = $('<div id="result_container"></div>');
					result_container.css(cssOpt);
					result_container.css({
						'height'		: '250px',
						'width'			: '500px',
						'backgroundColor': '#eee',
						'color'			: '#333',
						'text-align'	: 'left',
						'padding'		: 0
					});
					
					result_container.append($('<img src="/images/payment/customer-service-icon-3.png" style="height: 120px;" />'));
					result_container.append($('<h4>Terima kasih telah melakukan pembayaran bersama <span class="pinkfont">Ruangguru.com</span></h4>'));
					result_container.append($('<p>Pembayaran Anda saat ini sedang diproses dan anda akan menerima email berisi invoice yang kami kirim ke: <span class="pinkfont">'+dt.data.email+'</span></p>'));
					result_container.append($('<p>Kode transaksi anda adalah: <span class="pinkfont">'+dt.data.code+'</span></p>'));
					$('#roller').remove();
					$('#curtain').append(result_container);
					$.removeCookie('cart', {'path':'/'});
					clear_screen(base_url+'kelas');
				}
			};
			$.ajax(base_url+'payment/transfer/step3', opt);
//			top:300px; position: absolute; color: #fff
			window.scrollTo(0,0);
			return false;
		});
<?php 
else:
?>
		$('#btn_free').click(function(e){
			e.preventDefault();
			console.log('free!');
			$.post(
					base_url+'payment/transfer/step3free',
					{'code': code},
					function(dt) {
						if(dt.status == 'OK') {
							$('#curtain').show().css({
								'width'				: window.screen.width+200+'px',
								'height'			: window.screen.height+200+'px',
								'background'		: 'rgba(70,70,70,0.4)',
								'top'				: ($('#curtain').position().top * -1)+'px',
								'position'			: 'fixed',
								'z-index'			: 10000000
							});
							var links = '';
							$.each(dt.tiket, function(d, e){
								links += '<a href="'+base_url+e+'">'+base_url+e+'</a><br />\n';
							});
							var notification = $('<div></div>');
							notification.append('<p>Terima kasih anda telah mengikuti kelas ini.</p>' +
									'<p>Kami telah mengirim Tiket kelas ini ke email anda.</p>' +
									'<p>Apabila anda tidak menerima email, coba periksa folder spam anda.</p>' +
									'<p>Hubungi customer service kami untuk bantuan lebih lanjut.</p>');
							$(notification).css({
								'height'			: '230px',
								'width'				: '500px',
								'backgroundColor'	: '#eee',
								'color'				: '#333',
								'text-align'		: 'left',
								'padding'			: 0,
								'top'				: Math.floor(window.screen.height/2-200)+'px',
								'left'				: Math.floor(window.screen.width/2)-(233)+'px',
								'position'			: 'absolute'
							});
							var notice = $(notification);
							$('#curtain').append($(notice));
							$.removeCookie('cart', {'path':'/'});
							clear_screen(base_url+'kelas');
						}
					},
					'json'
			);
			return false;
		});
<?php 
endif;
?>
		function clear_screen(redirect) {
			$('#curtain').click(function(e){
				e.preventDefault();
				$('#curtain').empty().hide();
				if(typeof redirect != 'undefined')
					window.location.href = redirect;
			});
		}
		$('#btn_next, #btn_free').attr('disabled','disabled');
		var warning = false;
		$('#iagree').click(function(){
			if($(this).is(':checked')) {
				$('.grey').hide();
				warning = false;
				$('#btn_next, #btn_free').removeAttr('disabled');
			} else {
				$('.grey').show();
				$('#btn_next, #btn_free').attr('disabled','disabled');
			}
		});
		$('.grey')
				.click(function(e){
					if(!warning)
					alert('Mohon centang persetujuan anda\n' +
							'dengan persyaratan dan ketentuan kami\n' +
							'yang berlaku terlebih dahulu.\n' +
							'Terima kasih.');
					warning = true;
				});
		$('#btn_next, #btn_free').attr('disabled','disabled');
	});
</script>
<?php
$this->load->view('vendor/general/footer2');
