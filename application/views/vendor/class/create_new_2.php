<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 2/27/15
 * Time: 6:04 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Ruang Guru</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.fancybox.css" media="screen"/>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox-media.js?v=1.0.6"></script>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/css/style-kelas.css" rel="stylesheet">

</head>

<body class="have-bar">

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <a class="navbar-brand visible-xs" href="#"><img src="<?php echo base_url();?>images/logo-kelas-2.png" height="60"></a>
                <button type="button" class="filter-toggle collapsed visible-xs" data-toggle="collapse" data-target="#list-orange" aria-expanded="false" aria-controls="navbar">Filter</button>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand hidden-xs" href="#"><img src="<?php echo base_url();?>images/logo-kelas-2.png" height="60"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="close-toggle visible-xs" type="button">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="#">Kelas</a></li>
                    <li><a href="#about">Privat</a></li>
                    <li><a href="#contact">FAQ</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown sign-in">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sign In</a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?php echo base_url();?>murid/registrasi">sbg Murid</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url();?>guru/reg_guru">sbg Guru</a>
                            </li>
                            <li>
                                <a class="fancybox" href="#inline-reg">sbg Vendor</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown register">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Daftar</a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a class="fancybox" href="#inline1">sbg Murid</a>
                            </li>
                            <li>
                                <a class="fancybox" href="#inline3">sbg Guru</a>
                            </li>
                            <li>
                                <a class="fancybox" href="#inline2">sbg Vendor</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
    <div class="below-nav">
        <div class="container">
            <div class="row list-orange collapse" id="list-orange">
                <button data-target=".list-orange" data-toggle="collapse" class="close-toggle visible-xs" type="button">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="col-sm-12">
                    <ul class="nav nav-pills">
                        <li><a href="<?php echo base_url().'vendor/profile/edit'?>" class="button-nav-top">Profil Anda</a></li>
                        <li><a href="<?php echo base_url().'vendor/kelas/daftar'?>" class="button-nav-top">Kelas Anda</a></li>
                        <li><a href="<?php echo base_url().'vendor/kelas/baru'?>" class="button-nav-top active">Tambah Kelas</a></li>
                    </ul>
                    <ul class="sort nav">
                        <li class="title-filter sort-list"><i class="fa fa-phone"></i> 021-92000-3040 </li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- below-nav -->
</nav>
<div class="container content kelas">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading heading-label">Pendaftaran Kelas Baru</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="<?php echo base_url();?>vendor/kelas/submit_new" method="post">
                        <div class="form-group">
                            <label for="Namakelas" class="col-sm-4 control-label">Nama Kelas</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Namakelas" placeholder="Nama dari kelas yang akan diselenggarakan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Seo" class="col-sm-4 control-label">SEO Friendly URL</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="Seo" placeholder="Biarkan terisi secara automatis bila Anda ragu">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Seo" class="col-sm-4 control-label">Tentang kelas</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" placeholder="Alamat sesuai dengan alamat domisili saat ini. Cantumkan juga kota tempat tinggal saat ini." rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Seo" class="col-sm-4 control-label">Tarif per pertemuan</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="Seo" placeholder="Masukkan angka saja, mis: 50000. 0 jika kelas gratis">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Seo" class="col-sm-4 control-label">Jumlah Minimal Peserta</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="Seo" placeholder="Minimal jumlah peserta dalam kelas">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Seo" class="col-sm-4 control-label">Jumlah Maksimal Peserta</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="Seo" placeholder="Maksimal jumlah peserta dalam kelas">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Seo" class="col-sm-4 control-label">Kategori</label>
                            <div class="col-sm-8">
                                <select class="form-control kategori">
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
                                <select class="form-control level">
                                    <?php
                                    if($levels->num_rows() > 0):
                                        foreach($levels->result() as $level):
                                            ?>
                                            <option value="<?php echo $level->id?>"><?php echo ucwords($level->nama);?></option>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Seo" class="col-sm-4 control-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" placeholder="Alamat sesuai dengan alamat domisili saat ini. Cantumkan juga kota tempat tinggal saat ini." rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Lokasi" class="col-sm-4 control-label">Peta Lokasi</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" id="class_map_search" name="maps" placeholder="Masukkan area / lokasi" />
                                <a href="#" class="manage-icon pos-icon" id="btn_search_maps"></a>
                                <input id="class_maps" class="form-control" readonly="readonly" type="text" name="class_peta" placeholder="" style="margin-top: 5px;" />
                            </div>
                            <button type="submit" class="btn btn-default cek-button search"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="form-group">
                            <label for="radio" class="col-sm-4 control-label">Tipe Kelas</label>
                            <div class="col-sm-4">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="single" checked>
                                        Hanya satu sesi <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Kelas yang hanya diadakan satu kali saja"></i>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="series" checked>
                                        Kelas Berseri <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Kelas yang dibuat dalam beberapa sesi dan akan berkelanjutan"></i>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="package" checked>
                                        Satu Paket <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Kelas yang terdiri dari beberapa sesi namun harus diikuti semua sesinya oleh murid"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8 submit-form">
                                <button type="submit" class="btn btn-default main-button register">Simpan</button>
                                <button type="reset" class="btn btn-default cancel">Batal</button>
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
$this->load->view('vendor/general/footer');
