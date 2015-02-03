<!-- Message Error -->
<?php if ($this->session->flashdata('f_murid')): ?>
    <div class="msg msg-ok boxwidth">
        <p><strong><?php echo $this->session->flashdata('f_murid'); ?></strong></p>
    </div>
<?php endif; ?>

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Data Murid</h2>
    </div>
    <!-- End Box Head -->

    <form method="post" >

        <!-- Form -->
        <div class="form">
            <p>
                <label>ID</label>
                <input type="text" class="field size1" name="name" value="<?php echo $murid->murid_id;?>" disabled="true"/>       
            </p>
            <p>
                <label>Nama Murid</label>
                <input type="text" class="field size1" name="name" value="<?php echo $murid->murid_nama;?>" disabled="true"/>
                <input type="hidden" class="field size1" name="id" value="<?php echo $murid->murid_id;?>"/>
            </p>
            <p>
                <label>Email</label>
                <input type="text" class="field size1" name="name" value="<?php echo $murid->murid_email;?>" disabled="true"/>       
            </p>
            <p>
                <label>No. Ponsel 1</label>
                <input type="text" class="field size1" name="name" value="<?php echo $murid->murid_hp;?>" disabled="true"/>       
            </p>
		  <p>
                <label>No. Ponsel 2</label>
                <input type="text" class="field size1" name="name" value="<?php echo $murid->murid_hp_2;?>" disabled="true"/>       
            </p>
		  <p>
                <label>No. Telp Rumah</label>
                <input type="text" class="field size1" name="name" value="<?php echo $murid->murid_telp_rumah;?>" disabled="true"/>       
            </p>
		   <p>
                <label>No. Telp Kantor</label>
                <input type="text" class="field size1" name="name" value="<?php echo $murid->murid_telp_kantor;?>" disabled="true"/>       
            </p>
            <p>
                <label>Gender</label>
                <input type="text" class="field size1" name="name" value="<?php echo ($murid->murid_gender==1)?'Pria':'Wanita';?>" disabled="true"/>       
            </p>
            <p>
                <label>Tempat Lahir</label>
                <input type="text" class="field size1" name="name" value="<?php echo $murid->murid_tempatlahir;?>" disabled="true"/>       
            </p>
            <p>
                <label>Tanggal Lahir</label>
                <input type="text" class="field size1" name="name" value="<?php echo $murid->murid_lahir;?>" disabled="true"/>       
            </p>
            <p>
                <label>Alamat</label>
                <textarea disabled="true" rows="10" cols="30" class="field size1"><?php echo $murid->murid_alamat;?></textarea>
            </p>
		  <p>
                <label>Alamat Domisili</label>
                <textarea disabled="true" rows="10" cols="30" class="field size1"><?php echo $murid->murid_alamat_domisili;?></textarea>
            </p>
            <p>
                <label>Lokasi</label>
                <input type="text" class="field size1" name="name" value="<?php echo $murid->lokasi_title;?>" disabled="true"/>       
            </p>
            <p>
                <label>Referral id</label>
                <input type="text" class="field size1" name="name" value="<?php echo ($murid->murid_referral==0)?'':$murid->murid_referral;?>" disabled="true"/>       
            </p>
            <p>
                <label>Mengetahui Ruangguru Dari</label>
			 <?php $info_source = "";?>
			 <?php $info = explode(",",$murid->source_info_id);?>
			 <?php $n = count($info); $i = 0;?>
			 <?php foreach($info as $in){ ?>
			 <?php if($in != ""){ ?>
			 <?php switch ($in){
					case "1":
						$from= "Duta";
						break;
					case "2":
						$from= "Facebook";
						break;
					case "3":
						$from = "Twitter";
						break;
					case "4":
						$from= "Lainnya";
						break;
					case "5":
						$from = "Pameran";
						break;
					case "6":
						$from = "Roadshow";
						break;
					case "7":
						$from= "Media";
						break;
					}
					$i++;
					if($i != $n){
						$info_source .= $from.", ";
					}else{
						$info_source .= $from;
					}
				  }
				}
				?>
                <input type="text" class="field size1" name="name" value="<?php echo $info_source;?>" disabled="true"/>       
            </p>
		  <p>
                <label>Waktu & Tanggal Daftar</label>
                <input type="text" class="field size1" name="name" value="<?php echo $murid->murid_daftar;?>" disabled="true"/>       
            </p>
        </div>
    </form>
</div>

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Edit Status Murid</h2>
    </div>
    <!-- End Box Head -->

    <form action="<?php echo base_url();?>admin/murid/edit_submit" method="post" >

        <!-- Form -->
        <div class="form">
            <input type="hidden" class="field size1" name="id" value="<?php echo $murid->murid_id;?>"/>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th class="center">Kategori</th>
                            <th class="center">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Is Active</td>
                            <td>
                                <?php $config = 'class="checkbox"';?>
                                <?php echo form_radio('active', '0', ($murid->murid_active==0), $config);?> Tidak
                                <?php echo form_radio('active', '1', ($murid->murid_active==1), $config);?> Ya
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End Form -->
        
        <!-- Form Buttons -->
        <div class="buttons">
            <input type="submit" class="button" value="submit" />
        </div>
        <!-- End Form Buttons -->
    </form>
</div>
<!-- End Box -->

<!-- Box -->
<div class="box">
    <!-- Box Head -->
    <div class="box-head">
        <h2>Delete Murid</h2>
    </div>
    <!-- End Box Head -->

        <div class="form">
            <p>
                <a href="<?php echo base_url().'admin/murid/delete/'.$murid->murid_id;?>" class="del">
                    <button class="button">
                        Delete Murid
                    </button>
                </a>
            </p>
        </div>
</div>
<!-- End Box -->