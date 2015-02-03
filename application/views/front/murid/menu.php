<div id="profile-menu-murid" class="profile-menu">
    <div class="profile-menu-item <?php echo($active=="profile")?"active":"";?>">
        <div id="profile" class="item-wrap">
            <a href="<?php echo base_url();?>murid">Profil Murid</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="edit")?"active":"";?>">
        <div id="edit" class="item-wrap odd">
            <a href="<?php echo base_url();?>murid/edit">Edit Profil Murid</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="request")?"active":"";?>">
        <div id="request" class="item-wrap">
            <a href="<?php echo base_url();?>murid/request">Status Request Guru</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="kelas")?"active":"";?>">
        <div id="kelas" class="item-wrap odd">
            <a href="<?php echo base_url();?>murid/kelas">Status Kelas Saat Ini</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="pembayaran")?"active":"";?>">
        <div id="pembayaran" class="item-wrap">
            <a href="<?php echo base_url();?>murid/pembayaran">Status Pembayaran</a>
        </div>
    </div>
</div>