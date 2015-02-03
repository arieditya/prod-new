<div class="profile-menu">
    <div class="profile-menu-item <?php echo($active=="profile")?"active":"";?>">
        <div id="profile" class="item-wrap">
            <a href="<?php echo base_url();?>profile">Profil Guru</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="edit")?"active":"";?>">
        <div id="edit" class="item-wrap odd">
            <a href="<?php echo base_url();?>profile/edit">Edit Profil Guru</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="rating")?"active":"";?>">
        <div id="rating" class="item-wrap">
            <a href="<?php echo base_url();?>profile/rating">Rating</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="bank")?"active":"";?>">
        <div id="bank" class="item-wrap odd">
            <a href="<?php echo base_url();?>profile/bank">Rekening Bank</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="request")?"active":"";?>">
        <div id="request" class="item-wrap">
            <a href="<?php echo base_url();?>profile/request">Status Request Guru</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="lamar_request")?"active":"";?>">
        <div id="request" class="item-wrap odd">
            <a href="<?php echo base_url();?>profile/lamar_request">Daftar Lamaran</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="kelas")?"active":"";?>">
        <div id="kelas" class="item-wrap">
            <a href="<?php echo base_url();?>profile/kelas">Status Kelas Saat Ini</a>
        </div>
    </div>
    <div class="profile-menu-item <?php echo($active=="pembayaran")?"active":"";?>">
        <div id="pembayaran" class="item-wrap odd">
            <a href="<?php echo base_url();?>profile/pembayaran">Status Pembayaran</a>
        </div>
    </div>
</div>