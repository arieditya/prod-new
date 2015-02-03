<<<<<<< .
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
							
Veritrans_Config::$isProduction = false;

$notif = new Veritrans_Notification();

$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;

if ($transaction == 'capture') {
  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
  if ($type == 'credit_card'){
    if($fraud == 'challenge'){
    // TODO set payment status in merchant's database to 'Challenge by FDS'
    // TODO merchant should decide whether this transaction is authorized or not in MAP
    $this->payment_model->add_transaction($type, $order_id, $transaction);

      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
    } else {
    // TODO set payment status in merchant's database to 'Success'
    $this->payment_model->add_transaction($type, $order_id, $transaction);

      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
    }
  } else if ($transaction == 'settlement'){
  // TODO set payment status in merchant's database to 'Settlement'
  $this->payment_model->add_transaction($type, $order_id, $transaction);

    echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
  } else if($transaction == 'pending'){
  // TODO set payment status in merchant's database to 'Pending'
  $this->payment_model->add_transaction($type, $order_id, $transaction);

    echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
  } else if ($transaction == 'deny') {
  // TODO set payment status in merchant's database to 'Denied'
  $this->payment_model->add_transaction($type, $order_id, $transaction);

    echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
  }
}
?>

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