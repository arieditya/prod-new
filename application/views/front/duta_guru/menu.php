<div id="profile-menu-dutaguru" class="profile-menu">
    <div class="profile-menu-item <?php echo($active=="profile")?"active":"";?>">
        <div id="profile" class="item-wrap">
            <a href="<?php echo base_url();?>duta_guru">Profil Duta Guru</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="edit")?"active":"";?>">
        <div id="edit" class="item-wrap odd">
            <a href="<?php echo base_url();?>duta_guru/edit">Edit Profil Duta Guru</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="bank")?"active":"";?>">
        <div id="bank" class="item-wrap">
            <a href="<?php echo base_url();?>duta_guru/bank">Rekening Bank</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="list_guru")?"active":"";?>">
        <div id="list_guru" class="item-wrap odd">
            <a href="<?php echo base_url();?>duta_guru/guru">List Guru</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="list_murid")?"active":"";?>">
        <div id="list_murid" class="item-wrap">
            <a href="<?php echo base_url();?>duta_guru/murid">List Murid</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="pembayaran")?"active":"";?>">
        <div id="pembayaran" class="item-wrap odd">
            <a href="<?php echo base_url();?>duta_guru/pembayaran">Status Pembayaran</a>
        </div>
    </div>
</div>