<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/15/14
 * Time: 4:12 PM
 * Proj: private-development
 */
$this->load->view('vendor/general/header');
?>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/blueimp-gallery.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-image-gallery.min.css" type="text/css" />
<script type="application/javascript" src="<?php echo base_url();?>assets/js/blueimp-gallery.min.js" ></script>
<script type="application/javascript" src="<?php echo base_url();?>assets/js/bootstrap-image-gallery.js" ></script>
	<div class="container">
		<h2>Ruang Galeri <small>Tempat pameran gambar</small></h2>
		<div id="links">
<?php /*
	foreach($gallery as $galeri):
?>
					<a href="<?php echo base_url().'images/class/'.$galeri->class_id.'/'.$galeri->galeri_foto;?>" data-gallery title="asdf">
						<img src="<?php echo base_url().'images/class/'.$galeri->class_id.'/'.$galeri->galeri_foto;?>" style="max-height: 250px;" />
					</a>
<?php 
	endforeach;
?>
		</div>
		<div>
<?php 
	// */
?>
			<div class="row">
<?php
	if(count($gallery) > 0):
?>
<?php 
	$i = 0;
	foreach($gallery as $galeri):
		if($i % 4 == 0):
?>
			</div>
			<div class="row">
<?php
		endif;
?>
				<div class="col-md-3">
						<div class="thumbnail">
					<a href="<?php echo base_url().'images/class/'.$galeri->class_id.'/'.$galeri->galeri_foto;?>" data-gallery title="asdf">
							<img src="<?php echo base_url().'images/class/'.$galeri->class_id.'/'.$galeri->galeri_foto;?>" style="max-height: 250px;" />
					</a>
						</div>
				</div>
<?php 
		$i++;
	endforeach;
	else:
?>
				<div class="col-md-12" id="no-data">
					<h3>You have no image yet! Upload some pics!</h3>
				</div>
<?php
	endif;
?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<form action="<?php echo base_url();?>vendor/kelas/upload_gallery" method="POST" enctype="multipart/form-data">
					<div class="input-group">
							<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
							<input type="file" class="form-control" name="gallery_pics" />
							<span class="input-group-btn">
								<button type="submit" class="btn btn-info">Upload!</button>
							</span>
					</div>
				</form>
			</div>
		</div>
	</div>

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery"  data-use-bootstrap-modal="false">
	<!-- The container for the modal slides -->
	<div class="slides"></div>
	<!-- Controls for the borderless lightbox -->
	<h3 class="title"></h3>
	<a class="prev"><i style="font-size: 32px;" class="glyphicon glyphicon-chevron-left"></i></a>
	<a class="next"><i style="font-size: 32px;" class="glyphicon glyphicon-chevron-right"></i></a>
	<a class="close">&times;</a>
	<a class="play-pause"></a>
	<ol class="indicator"></ol>
	<!-- The modal dialog, which will be used to wrap the lightbox content -->
	<div class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" aria-hidden="true">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body next"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left prev">
						<i class="glyphicon glyphicon-chevron-left"></i>
						Previous
					</button>
					<button type="button" class="btn btn-primary next">
						Next
						<i class="glyphicon glyphicon-chevron-right"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="application/javascript">
	$(document).ready(function(){
		'use strict'
//        $('#blueimp-gallery').data('useBootstrapModal', false);
        $('#blueimp-gallery').toggleClass('blueimp-gallery-controls', true);
		$('#links').click(function(e){
			e.preventDefault();
			blueimp.Gallery($('#links a'), $('#blueimp-gallery').data());
			return false;
		});
	});
</script>
<?php
$this->load->view('vendor/general/footer');