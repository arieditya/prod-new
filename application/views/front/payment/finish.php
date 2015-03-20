<div id="content">
	<div class="blank" style="height:30px;"></div>
	<div id="bantuan">
		<table>
			<tr>
				<td>
					<div id="event-detail">
						<div id="payment-header">
							<div id="bf-header-wrap">
								STATUS PEMBAYARAN
							</div>
						</div>
						<div id="bf-content">
							<div class="blank" style="height: 20px;"></div>
							<div class="bfc-wrap">
								<div class="bfc-title">
									<p class="bold center"></p>
									<p>ID Pemesanan Anda: <?php echo $_GET['order_id'];?><br/>
										Status Pemesanan Anda: <?php if($_GET['transaction_status']=="settlement"){ echo "Berhasil";} 
										elseif($_GET['transaction_status']=="capture"){ echo "Menunggu Approval dari Bank";}?>
									</p>
									<p>Terima kasih sudah melakukan <i>request</i> di Ruangguru.com</p>
									</p>
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
<?php /*
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="bantuan">
        <table>
            <tr>
                <td>
                    <div id="event-detail">
                        <div id="bf-header">
                            <div id="bf-header-wrap">
                                PAGE FINISH PAYMENT
                            </div>
                        </div>
                        <div id="bf-content">
                            <div class="blank" style="height: 20px;"></div>
                            <div class="bfc-wrap">
                                <div class="bfc-title">
							<p class="bold center"><?php //echo var_dump();?></p>
						  </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="blank" style="height:30px;"></div>
>>>>>>> .r88
</div>
*/
// END OF FILE