<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="bantuan">
        <table>
            <tr>
                <td>
                    <div id="event-detail">
                        <div id="bf-header">
                            <div id="bf-header-wrap">
                                PAGE NOTIFICATION PAYMENT
                            </div>
                        </div>
                        <div id="bf-content">
                            <div class="blank" style="height: 20px;"></div>
                            <div class="bfc-wrap">
                                <div class="bfc-title">
							<p class="bold center"><?php //echo var_dump();?></p>
							<?php 
								// Use sandbox account
								Veritrans_Config::$isProduction = false;
								
								// Set our server key
								Veritrans_Config::$serverKey = 'VT-server-a-AunKPJMwirR3Woa9ndxVCK';
								
								// Fill transaction data
								$kelas = 373;
								$hash = md5($kelas);
								$transaction = array(
									"vtweb" => array (
									"credit_card_3d_secure" => true,
									),
									'transaction_details' => array(
									'order_id' => 'RG'.$kelas.substr($hash,0,3),
									'gross_amount' => 10000,
									)
								);
									
								$vtweb_url = Veritrans_Vtweb::getRedirectionUrl($transaction);
								
								// Redirect 
								header('Location: ' . $vtweb_url);
								
							?>
							<!--<a href="https://vtweb.sandbox.veritrans.co.id/v2/vtlink/04fd7224-5507-487a-a9a4-3299484aa6cb">Pembayaran via VeriTrans</a>-->
						  </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>