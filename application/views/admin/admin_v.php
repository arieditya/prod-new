<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Ruangguru Administration</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin.css" type="text/css" media="all" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
            var base_url = "<?php echo base_url();?>";
        </script>
    </head>
    <body>
        <!-- Header -->
        <div id="header">
            <div class="shell">
                <!-- Logo + Top Nav -->
                <div id="top">
                    <h1><a href="<?php echo base_url();?>admin">Ruangguru</a></h1>
                    <div id="top-navigation">
                        Welcome <strong><?php echo $this->session->userdata('admin_username');?></strong>
                        <span>|</span>
                        <a href="#">Help</a>
                        <span>|</span>
                        <a href="<?php echo base_url();?>admin/user/profile">Profile Settings</a>
                        <span>|</span>
                        <a href="<?php echo base_url();?>4dm1nzqu/logout">Log out</a>
                    </div>
                </div>
                <!-- End Logo + Top Nav -->
                
                <!-- Main Nav -->
                    <ul id="nav">
                        <li><a href="<?php echo base_url();?>admin/guru" <?php echo ($active==1)?'class="active"':'';?>>Guru</a>
						<ul>
							<li><a href="<?php echo base_url();?>admin/guru" <?php echo ($active==1)?'class="active"':'';?>>Data Guru</a></li>
							<li><a href="<?php echo base_url();?>admin/utilities/nik" <?php echo ($active==98)?'class="active"':'';?>>ID Terbaru</a></li>
							<li><a href="<?php echo base_url();?>admin/utilities/sertifikat" <?php echo ($active==3)?'class="active"':'';?>>Sertifikat Terbaru</a></li>
							<li><a href="<?php echo base_url();?>admin/utilities/cs_email" <?php echo ($active==99)?'class="active"':'';?>>Coming Soon</a></li>
						</ul>
				    </li>
				    <li><a href="<?php echo base_url();?>admin/murid" <?php echo ($active==4)?'class="active"':'';?>><span>Murid</span></a></li>
                        <li><a href="<?php echo base_url();?>admin/duta_guru" <?php echo ($active==2)?'class="active"':'';?>><span>Duta Guru</span></a></li>
                        <li><a href="#"><span>Transaksi</span></a>
						<ul>
							<li><a href="<?php echo base_url();?>admin/request" <?php echo ($active==5)?'class="active"':'';?>>Request</a></li>
							<li><a href="<?php echo base_url();?>admin/utilities/request" <?php echo ($active==96)?'class="active"':'';?>>Request Sidebar</a></li>
							<li><a href="<?php echo base_url();?>admin/kelas" <?php echo ($active==7)?'class="active"':'';?>>Kelas</a></li></li>
						</ul>
				    </li>
                        <li><a href="<?php echo base_url();?>admin/home" <?php echo ($active==6)?'class="active"':'';?>><span>Home</span></a></li>
                        <li><a href="<?php echo base_url();?>admin/utilities/subscribe" <?php echo ($active==97)?'class="active"':'';?>><span>Subscribe</span></a></li>
                        <li><a href="#"><span>Tools</span></a>
				    		<ul>
							<li><a href="<?php echo base_url();?>admin/upload" <?php echo ($active==95)?'class="active"':'';?>>Duta Upload Data</a></li>
							<li><a href="<?php echo base_url();?>admin/upload/send_email" <?php echo ($active==95)?'class="active"':'';?>>Send Email</a></li>
							<li><a href="<?php echo base_url();?>admin/upload/edit_email" <?php echo ($active==95)?'class="active"':'';?>>Edit Template Email</a></li>
							<li><a href="<?php echo base_url();?>admin/reminder" <?php echo ($active==95)?'class="active"':'';?>>Reminder</a></li>
							<li><a href="<?php echo base_url();?>admin/event" <?php echo ($active==95)?'class="active"':'';?>>Event</a></li>
							<li><a href="<?php echo base_url();?>admin/matpel" <?php echo ($active==95)?'class="active"':'';?>>Kategori Pendidikan</a></li>
							<li><a href="<?php echo base_url();?>admin/matpel" <?php echo ($active==95)?'class="active"':'';?>>Matpel</a></li>
						</ul>
				    </li>
				    <li><a href="<?php echo base_url();?>admin/blog" <?php echo ($active==94)?'class="active"':'';?>><span>Blog</span></a></li>
                        <li><a href="http://www.google.com/analytics/"><span>GA</span></a></li>
                    </ul>
                <!-- End Main Nav -->
            </div>
        </div>
        <!-- End Header -->

        <!-- Container -->
        <div id="container">
            <div class="shell">
                
                <?php if(isset($breadcumb)):?>
                <!-- Small Nav -->
                <div class="small-nav">
                    <?php echo $breadcumb; ?>
                </div>
                <!-- End Small Nav -->
                <?php endif;?>

                <!-- Main -->
                <div id="main">
                    <div class="cl">&nbsp;</div>

                    <!-- Content -->
                    <div id="content">
                        <?php echo $content;?>
                    </div>

                    <div class="cl">&nbsp;</div>			
                </div>
                <!-- Main -->
            </div>
        </div>
        <!-- End Container -->

        <!-- Footer -->
        <div id="footer">
            <div class="shell">
                <span class="left">&copy; 2014 - Ruangguru.com</span>
                <span class="right">
                    <!--Created by Yudi Retanto</a> -->
                </span>
            </div>
        </div>
        <!-- End Footer -->
        <script type="text/javascript">
            $('a.column_delete').click(function(){
                return confirm("Are you sure want to delete this entries");
            });
            $('a.del').click(function(){
                return confirm("Are you sure want to delete this entries");
            });
        </script>

    </body>
</html>