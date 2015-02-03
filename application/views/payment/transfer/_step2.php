<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 11/26/14
 * Time: 7:41 PM
 * Proj: private-development
 */
$this->load->view('general/header-bootstrap');
?>
<link href="<?php echo base_url();?>/assets/css/payment-transfer.css" type="text/css" rel="stylesheet">
<div id="curtain"></div>
<div class="main-content">
	<div class="row graybar bottom-30">
		<div class="col-md-8 col-md-offset-2">
			<div class="class-step bold">
				<p><span>1</span> <i>Galeri Kelas</i></p>
				<p><span>2</span> <i>Kelas Pilihan</i></p>
				<p><span>3</span> <em class="pinkfont"><i>Pembayaran</i></em></p>
			</div>
		</div>
	</div>
	<div class="row bg-all">
		<div class="col-md-8 col-md-offset-2">
			<form role="form">
				<div class="row">
					<div class="col-md-7 top-30">
						<h2 class="text-18 bold pinkfont">Review Data Pemesanan</h2>
							<div class="bg-section padding-content shadow">
							<p class="text-16 bold">Data <span class="pinkfont">Pemesan</span></p>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama Lengkap Pemesan*</label>
										<input type="text" class="form-control" placeholder="Nama sesuai dengan kartu identitas" readonly="readonly" value="<?php echo $pemesan['name'];?>" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email*</label>
										<input type="email" class="form-control" placeholder="Contoh: nama@email.com" readonly="readonly" value="<?php echo $pemesan['email'];?>" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Nomor Telepon/HP*</label>
										<input type="tel" class="form-control" placeholder="Contoh: 08123457890" readonly="readonly" value="<?php echo $pemesan['phone'];?>" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Alamat lengkap*</label>
								<textarea rows="5" class="form-control" placeholder="Alamat sesuai dengan alamat domisili saat ini. Cantumkan juga kota tempat tinggal saat ini."readonly="readonly" ><?php echo $pemesan['address'];?></textarea>
							</div>
							<br/>
							<p class="text-16 bold">Data <span class="pinkfont">Pemesan</span></p>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama Lengkap Siswa*</label>
										<input type="text" class="form-control" placeholder="Nama sesuai dengan kartu identitas" readonly="readonly" value="<?php echo $peserta['name'];?>" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email*</label>
										<input type="email" class="form-control" placeholder="Contoh: nama@email.com" readonly="readonly" value="<?php echo $peserta['email'];?>" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Nomor Telepon/HP*</label>
										<input type="tel" class="form-control" placeholder="Contoh: 08123457890" readonly="readonly" value="<?php echo $peserta['phone'];?>" />
									</div>
								</div>
							</div>
						</div>
						<div class="checkbox bottom-30">
							<label>
								<input type="checkbox" id="iagree" />
								Data pemesan, murid dan rincian pemesanan sudah sesuai.<br/>Saya menyepakati <a href="#" class="blue underline">persyaratan dan ketentuan</a> yang berlaku
							</label>
						</div>
						<?php 
						
							$jml_sesi = count($jadwal);
							$price_session = $subtotal/$jml_sesi;
							
							// Use sandbox account
							//Veritrans_Config::$isProduction = true;
							Veritrans_Config::$isProduction = false;
				
							// Set our server key
							Veritrans_Config::$serverKey = 'VT-server-a-AunKPJMwirR3Woa9ndxVCK'; //---> SANDBOX KEY

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
						?>
						<div class="bg-section padding-content shadow top-30">
							<h5 class="pinkfont bold">Pilih metode pembayaran</h5>
							<small>Anda tidak akan dikenakan biaya tambahan!</small>
							<div class="row">
								<a href="<?php echo $vtweb_url;?>" target="_blank">
								<div class="col-md-4 payment-howto">
									<div class="btn-payment2" id="payment_cc">
										<i class="fa fa-cc-visa"></i>
										Kartu Kredit
									</div>
								</div>
								</a>
								<div class="col-md-4 payment-howto">
									<button class="btn-payment" id="payment_atm">
										<i class="fa fa-credit-card"></i>
										Bank Transfer
									</button>
								</div>
								<a href="<?php echo $vtweb_url_cimb;?>" target="_blank">
								<div class="col-md-4 payment-howto">
									<div class="btn-payment2" id="payment_cimb">
										<img src="/images/payment/cimb-click.png" />
										CIMB Clicks
									</div>
								</div>
								</a>
							</div>
							<div class="row">
								<a href="<?php echo $vtweb_url_mandiri;?>" target="_blank">
								<div class="col-md-4 payment-howto">
									<div class="btn-payment2" id="payment_mandiri">
										<img src="/images/payment/mandiri-clickpay.png" />
										Mandiri Clickpay
									</div>
								</div>
								</a>
								<div class="col-md-4 payment-howto">
									<button class="btn-payment" id="payment_cash">
										<img src="/images/payment/uang.png"/>
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
									<a href="<?php echo base_url().'payment/transfer/confirm';?>"><div class="btn-orange text-center">Konfirmasi Pembayaran</div></a>
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
						<button class="btn-orange" id="btn_next">Lanjutkan</button>
					</div>
					<div class="col-md-5" id="right_belly">
						<h2 class="text-18 bold pinkfont">Rincian Pemesanan</h2>
						<div class="bg-section padding-content shadow top-30">
							<div>
								<p class="text-14 text-center bold">Jadwal kelas yang diikuti</p>
								<div class="followed-class">
									<div class="row">
										<table class="table white-table">
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
	foreach($jadwal as $sched):
		$i++;
		$date = date('j F Y', strtotime($sched->class_tanggal));
		$start = $sched->class_jam_mulai.':'.$sched->class_menit_mulai;
		$end = $sched->class_jam_selesai.':'.$sched->class_menit_selesai;
?>
											<tr>
												<td><?php echo $i;?></td>
												<td>
													<?php echo empty($sched->class_jadwal_topik)?'':($sched->class_jadwal_topik.'<br />');?>
													<span class="bluefont"><?php echo "{$date}, {$start}-{$end}";?> WIB</span>
												</td>
												<td>
													<div>
														Rp <?php echo number_format((int)$sched->price_per_session, 0, ',','.');?>,-&nbsp;&nbsp;&nbsp;
													</div>
												</td>
											</tr>
<?php 
	endforeach;
?>
											</tbody>
											<tfoot>
											<tr>
												<td></td>
												<td class="pinkfont">Sub total harga</td>
												<td class="pinkfont">Rp <?php echo number_format((int)$subtotal, 0, ',','.')?>,-</td>
											</tr>
											<tr>
												<td></td>
												<td >Potongan harga</td>
												<td >Rp <?php echo number_format((int)$discount, 0, ',','.')?>,-</td>
											</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
							<div class="blue-segment">
								<h5 class="pull-left">Total yang harus dibayar</h5>
								<h5 class="pull-right">Rp <?php echo number_format((int)$total, 0, ',','.')?>,-</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="application/javascript">
	$(document).ready(function(){
		$('#curtain').hide();
		$('.payment_info').hide();
		$('.btn-payment').click(function(e){
			e.preventDefault();
			var $id = $(this).attr('id');
			$('.btn-payment').removeClass('active');
			$('.payment_info').hide();
			$(this).addClass('active');
			switch($id) {
				case		'payment_atm':
					$('#transfer_info').show();
					break;
				case		'payment_cash':
					$('#cash_info').show();
			}
			return false;
		});
		$('#btn_next').click(function(e){
			e.preventDefault();
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
					'code': '<?php echo $code;?>'
				},
				'type': 'post',
				'dataType': 'json',
				'error': function() {
					var cssOpt = {
						'top'				: Math.floor(window.screen.height/2)+'px',
						'left'				: Math.floor(window.screen.width/2)-(233)+'px',
						'position'			: 'absolute',
						'color'				: '#fff'
					};
					var result_container = $('<div id="result_container"></div>');
					result_container.css(cssOpt);
					result_container.css({
						'height'		: '120px',
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
						'top'				: Math.floor(window.screen.height/2)+'px',
						'left'				: Math.floor(window.screen.width/2)-(233)+'px',
						'position'			: 'absolute',
						'color'				: '#fff'
					};
					var result_container = $('<div id="result_container"></div>');
					result_container.css(cssOpt);
					result_container.css({
						'height'		: '230px',
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
				}
			};
			$.ajax(base_url+'payment/transfer/step3', opt);
//			top:300px; position: absolute; color: #fff
			window.scrollTo(0,0);
			return false;
		});
		$('#curtain').click(function(e){
			e.preventDefault();
			$('#curtain').empty().hide();
		});
		$('#btn_next').attr('disabled','disabled');
		$('#iagree').click(function(){
			if($(this).is(':checked')) $('#btn_next').removeAttr('disabled');
			else $('#btn_next').attr('disabled','disabled');
		});
	});
</script>
<?php
$this->load->view('vendor/general/footer');
