<script src="<?php echo base_url(); ?>js/profile.js" type="text/javascript" charset="utf-8"></script>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="jadwal-guru" class="profile-guru-wrap">
            <div id="jadwal-guru-header" class="profile-guru-header">
                <div id="jadwal-guru-header-wrap" class="profile-guru-header-wrap">
                    EDIT JADWAL
                </div>
            </div>
            <div id="jadwal-guru-content" class="guru-content profile-guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('jadwal_notif')):?>
                <div class="guru-notif">
                    <?php echo $this->session->flashdata('jadwal_notif');?>
                </div>
                <?php endif;?>
                <form id="jadwal-tarif-form" class="guru-form" action="<?php echo base_url(); ?>profile/jadwal_submit" method="post">
                    <table>
                        <tr>
                            <td colspan="2">
                                <div class="registrasi-guru-st">
                                    JADWAL
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p class="info2">
                                    Pilih preferensi waktu mengajar yang Anda dengan meng-klik tabel dibawah. <br/>
                                    Warna jingga berarti Anda bersedia untuk mengajar murid pada jam tersebut. <br/>
                                    Pastikan informasi ini seakurat mungkin, karena murid akan menyesuaikan dengan waktu mengajar Anda.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table id="jadwal-guru-table-form">
                                    <tr>
                                        <th style="width: 80px;">Jam</th>
                                        <?php foreach($days as $value):?>
                                        <th>
                                            <?php echo $value;?>
                                        </th>
                                        <?php endforeach;?>
                                    </tr>
                                    <?php for($i=7;$i<24;$i++):?>
                                    <tr>
                                        <td><?php echo sprintf('%02s',$i);?>:00 - <?php echo sprintf('%02s',$i+1);?>:00</td>
                                        <?php for($j=0;$j<7;$j++):?>
                                        <?php $hour = (array_key_exists($j, $jadwal)?$jadwal[$j]:array());?>
                                        <td onclick="jadwal_box_click(this)" class="<?php echo (array_key_exists($i, $hour)?'selected':'');?>">
                                            <input class="jadwal-checkbox none" type="checkbox" name="jadwal[<?php echo $j;?>][<?php echo $i;?>]" <?php echo (array_key_exists($i, $hour)?'checked':'');?>/>
                                        </td>
                                        <?php endfor;?>
                                    </tr>
                                    <?php endfor;?>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="blank" style="height:20px;"></div>
                                <input type="image" src="<?php echo base_url();?>images/edit-jadwal.png"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="blank" style="height: 20px;"></div>
            </div>
        </div>
        <?php $this->load->view('front/profile/template/menu');?>
        <div class="blank" style="height: 30px;"></div>
    </div>
</div>