<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/14/14
 * Time: 7:52 AM
 * Proj: private-development
 */
$this->load->view('vendor/general/header');
?>
<link href="<?php echo base_url();?>assets/css/bootstrap-slider.css" rel="stylesheet" />
<script src="<?php echo base_url();?>assets/js/bootstrap-slider.js" type="application/javascript"></script>
	<div class="panel panel-default">
		<div class="panel-body">

<div class="row bottom-10">
	<div class="col-md-offset-2 col-md-8">
		<div class="row">
			<div class="col-md-8">
				<div class="top-head">
					<h2><?php echo $info->vendor_description;?></h2>
				</div>
			</div>
		</div>
	</div>
</div>
		</div>
	</div>
<?php
$this->load->view('vendor/general/footer');