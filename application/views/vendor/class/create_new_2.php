<?php 
/**
 * New Class
 * Created by: AriedityaPr.dH
 * Created time: 20150309 13:41 +7
 */
$this->load->view('vendor/general/header2');
$vendor_logo = base_url()."images/vendor/{$vendor['profile']->id}/{$vendor['info']->vendor_logo}";
?>
    <div class="container content kelas vendor">
        <div class="row">
<?php $this->load->view('vendor/general/sidebar');?>
            <div class="col-md-9 col-sm-12">
                <div class="panel panel-default">
                    <h2 class="block-title text-uppercase">Pendaftaran Kelas Baru</h2>
                    <div class="panel-body">
						<form class="form-horizontal" 
							  action="<?php echo base_url();?>vendor/kelas/submit_new" 
							  method="post">

                            <div class="form-group">
                                <label for="Namakelas" class="col-sm-4 control-label">Nama Kelas</label>
                                <div class="col-sm-8">
									<input type="text" 
										   class="form-control" 
										   name="class_nama" 
										   id="class_name" 
										   placeholder="Nama dari kelas yang akan diselenggarakan" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Tentang kelas</label>
                                <div class="col-sm-8">
									<textarea class="form-control" 
											  name="class_deskripsi" 
											  placeholder="Deskripsi mengenai kelas Anda, pengajar, dan informasi lainnya yang perlu diketahui peserta kelas" 
											  rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Seo" class="col-sm-4 control-label">Tarif per pertemuan</label>
                                <div class="col-sm-8">
									<input type="number" 
										   step="1000"
										   class="form-control" 
										   id="class_harga" 
										   name="class_harga" 
										   placeholder="Masukkan angka saja, mis: 50000. 0 jika kelas gratis">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Seo" class="col-sm-4 control-label">Jumlah Minimal Peserta</label>
                                <div class="col-sm-8">
                                <input type="number" 
									   class="form-control" 
									   id="class_peserta_min" 
									   name="class_peserta_min" 
									   placeholder="Minimal jumlah peserta dalam kelas">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Seo" class="col-sm-4 control-label">Jumlah Maksimal Peserta</label>
                                <div class="col-sm-8">
                                <input type="number" 
									   class="form-control" 
									   id="class_peserta_max" 
									   name="class_peserta_max" 
									   placeholder="Maksimal jumlah peserta dalam kelas">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Seo" class="col-sm-4 control-label">Kategori</label>
                                <div class="col-sm-8">
                                    <select class="form-control kategori" name="class_category">
<?php
	if($categories->num_rows() > 0):
		foreach($categories->result() as $category):
?>
											<option value="<?php echo $category->id?>"><?php echo ucwords($category->category_name);?></option>
<?php
		endforeach;
	endif;
?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Seo" class="col-sm-4 control-label">Level yang Diajarkan</label>
                                <div class="col-sm-8">
									<div class="radio">
<?php
	if($levels->num_rows() > 0):
		foreach($levels->result() as $level):
?>
										<label>
											<input type="checkbox" 
												   name="class_level[<?php echo $level->id?>]" 
												   value="<?php echo $level->id?>" />
											<?php echo ucwords($level->nama);?>
										</label>
<?php
		endforeach;
	endif;
?>
									</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Seo" class="col-sm-4 control-label">Alamat</label>
                                <div class="col-sm-8">
									<textarea class="form-control" 
											  name="class_lokasi" 
											  rows="5"
											  placeholder="Cantumkan alamat lengkap tempat kelas Anda diselenggarakan termasuk nama gedung atau institusi (jika ada)" ></textarea>
                                </div>
                            </div>
<?php /* ?>
                            <div class="form-group">
                                <label for="Lokasi" class="col-sm-4 control-label">Peta Lokasi</label>
                                <div class="col-sm-4">
									<input class="form-control" 
										   type="text" 
										   id="class_map_search" 
										   name="maps" 
										   placeholder="Masukkan area / lokasi" />
									<input id="class_maps" 
										   class="form-control" 
										   readonly="readonly" 
										   type="text" 
										   name="class_peta" 
										   placeholder="" style="margin-top: 5px;" />
                                </div>
                                <button type="button" class="btn btn-default cek-button search" id="btn_search_maps">
									<i class="fa fa-search"></i>
								</button>
								<div class="col-md-4">
									<img id="img_preview" src="https://maps.googleapis.com/maps/api/staticmap?size=160x100&maptype=roadmap" />
								</div>
                            </div>
<?php // */ ?>
                            <div class="form-group">
                                <label for="radio" class="col-sm-4 control-label">Tipe Kelas</label>
                                <div class="col-sm-8">
                                    <div class="radio">
                                        <label>
											<input type="radio" name="class_paket" value="0" />
                                            Satu Sesi
											<i class="fa fa-question-circle" 
											   data-toggle="tooltip" 
											   data-placement="right" 
											   title="Kelas yang hanya diadakan satu kali saja"></i>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
											<input type="radio" name="class_paket" value="1" />
                                            Kelas Berseri
											<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Kelas yang dibuat dalam beberapa sesi dan akan berkelanjutan"></i>
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
											<input type="radio" name="class_paket" value="2" />
                                            Paket <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Kelas yang terdiri dari beberapa sesi namun harus diikuti semua sesinya oleh murid"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8 submit-form">
                                    <button type="submit" class="btn btn-default main-button register">Simpan</button>
                                    <button type="submit" class="btn btn-default cancel">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- panel -->
            </div>
        </div>
    </div> <!-- /container -->

<script type="application/javascript" >
    $(document).ready(function(){
        $('#class_name').blur(function(){
            $.get('<?php echo base_url();?>vendor/kelas/generate_uri', {title: $(this).val()})
                .success(function(data){
                    console.log(data);
                    if(data.status == 'OK') {
                        $('#class_uri').val(data.data.uri);
                    }
                });
        });
        $('input[type=number]').keydown(function(e){
            if(
                ( e.keyCode < 48 || e.keyCode > 57 )
                    && !(
                    false
                        || e.keyCode == 8 // backspace
                        || e.keyCode == 9 // tabs
                        || e.keyCode == 17 // ctrl
                        || e.keyCode == 18 // alt
                        || e.keyCode == 33 // pgup
                        || e.keyCode == 34 // pgdn
                        || e.keyCode == 35 // end
                        || e.keyCode == 36 // home
                        || e.keyCode == 37 // left
                        || e.keyCode == 38 // up
                        || e.keyCode == 39 // right
                        || e.keyCode == 40 // down
                        || e.keyCode == 45 // ins
                        || e.keyCode == 46 // delete
                    )
                ) return false;
        });
    });
</script>
<?php
$this->load->view('vendor/general/footer2');
