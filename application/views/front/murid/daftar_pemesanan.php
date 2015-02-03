<script>
function goBack()
  {
  window.history.back()
  }
</script>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="review-guru">
        <div id="review-guru-header">
            <div id="review-guru-header-wrap">
                DAFTAR PEMESANAN
            </div>
        </div>
        <div id="review-guru-content">
            <div class="blank" style="height:20px;"></div>
            <?php if(!empty($pilihan)):?>
            <table>
			<?php foreach($pilihan->result() as $guru):?>
                <tr style="border-bottom: 1px solid !important;">
                    <td>
				    <?php if (!file_exists("./images/pp/{$guru->guru_id}.jpg")): ?>
                            <a href="<?php echo base_url(),'guru/view/'.$guru->guru_id;?>" class="normal-link"><img src="<?php echo base_url(); ?>images/default_profile_image.png"/></a>
                        <?php else : ?>
                            <a href="<?php echo base_url(),'guru/view/'.$guru->guru_id;?>" class="normal-link"><img src="<?php echo base_url(); ?>images/pp/<?php echo $guru->guru_id; ?>.jpg"/></a>
                        <?php endif; ?>
				</td>
				<td width="550px">
					<span class="text-13 bold"><a href="<?php echo base_url(),'guru/view/'.$guru->guru_id;?>" class="normal-link"><?php echo $guru->guru_nama;?></a></span><br/>
					<span class="text-13"><?php if(empty($guru->guru_pendidikan_instansi)){ echo "-"; } else { echo $guru->guru_pendidikan_instansi;} ?></span><br/>
					<span class="text-13"><?php echo substr($guru->guru_kualifikasi,0,200);?> ... </span><br/>
					<?php $matpel = $this->session->userdata('cari_guru'); $hargapermatpel = $this->guru_model->get_matpel_guru($guru->guru_id);?>
						<?php foreach($hargapermatpel->result() as $row){ ?>
						<?php if($row->matpel_id == $matpel['matpel']){ ?>
						<ul class="normal-list text-13" style="margin-left:-23px; margin-top: 5px;">
							<li><?php echo $row->matpel_title;?></li>
							<li>Rp <?php echo number_format($row->guru_matpel_tarif);?>,-</li>
						</ul>
						<?php } } ?>
				</td>
				<td width="30px"></td>
				<td width="100px">
					<div class="profile-rating-value">
						<p><?php echo $guru->guru_rating;?></p>
					</div>
				</td>
                </tr>
			 <?php endforeach;?>
            </table>
            <?php else:?>
            <div class="rg-info">
                <p>Anda belum memilih guru, silahkan memilih guru pada menu <a href="<?php echo base_url().'cari_guru'; ?>" class="normal-link bold">Cari Guru</a></p>
            </div>
            <?php endif;?>
            <div class="blank" style="height:20px;"></div>
        </div>
    </div>
    <div class="blank" style="height:20px;"></div>
    <div id="cari-guru-nav">
	   <?php if(!empty($pilihan)){ ?>
        <a style="cursor:pointer;" class="diy-button" onClick="goBack()">KEMBALI</a>
	   <?php } else { ?>
	   <a href="<?php echo base_url();?>cari_guru" class="diy-button">CARI GURU</a>
	   <?php } ?>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>