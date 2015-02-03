<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 11/12/14
 * Time: 3:19 PM
 * Proj: private-development
 */
?>

<div>
	<h3>Anda akan melakukan transaksi pembayaran</h3>
	<p>Ini adalah detil dari transaksi anda:</p>
	<ul>
		<li>Nama Kelas yang diikuti: <br />
			<a href="<?php echo base_url()?>kelas/%%CLASS_URI%%">%%CLASS_NAME%%</a>
		</li>
		<li>Deskripsi singkat: <br />
			%%CLASS_DESC%%
		</li>
		<li>Harga Subtotal:<br />
			Rp. %%PRICE_SUBTOTAL%%
		</li>
		<li>Potongan:<br />
			Rp. %%DISCOUNT%%
		</li>
		<li>Pertemuan:<br />
			%%QUANTITY%% kali
		</li>
		<li>Harga TOTAL:<br />
			<strong>Rp. %%PRICE_TOTAL%%</strong>
		</li>
	</ul>
	
	<p>Pembayaran dapat dilakukan dengan cara:</p>
	<ul>
		<li>Transfer</li>
		<li>Credit Card (Veritrans.co.id)</li>
	</ul>
</div>
