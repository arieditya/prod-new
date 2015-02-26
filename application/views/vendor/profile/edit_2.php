<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 2/26/15
 * Time: 11:56 AM
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
                        <li><a href="<?php echo base_url().'vendor/profile/edit'?>" class="button-nav-top active">Profil Anda</a></li>
                        <li><a href="<?php echo base_url().'vendor/kelas/daftar'?>" class="button-nav-top">Kelas Anda</a></li>
                        <li><a href="<?php echo base_url().'vendor/kelas/baru'?>" class="button-nav-top">Tambah Kelas</a></li>
                    </ul>
                    <ul class="sort nav">
                        <li class="title-filter sort-list"><i class="fa fa-phone"></i> 021-92000-3040 </li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- below-nav -->
</nav>

<div class="container content profile">
<div class="row">
    <div class="col-sm-12">
        <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#profil" aria-controls="profil" role="tab" data-toggle="tab">Profil Penyelenggara</a></li>
                <li role="presentation"><a href="#reponsible" aria-controls="reponsible" role="tab" data-toggle="tab">Penganggung Jawab</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="profil">
                    <form class="form-horizontal" role="form" action="<?php echo base_url();
                    ?>vendor/profile/update_profile" method="post" id="form-1" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="emailpenyelenggara" class="col-sm-4 control-label">Email Penyelenggara</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $vendor['profile']->email;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="password" class="col-sm-4 control-label">Password Akun</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="namapenyelenggara" class="col-sm-4 control-label">Nama Penyelenggara</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" value="<?php echo $vendor['profile']->name;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="notelepon" class="col-sm-4 control-label">No. Telp</label>
                            <div class="col-sm-8">
                                <input type="text" name="main_phone" class="form-control" value="<?php echo $vendor['profile']->main_phone;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="alamat" class="col-sm-4 control-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="address" placeholder="Alamat" rows="3"><?php echo $vendor['profile']->address;?></textarea>
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="deskipsi" class="col-sm-4 control-label">Deskripsi penyelenggara</label>
                            <div class="col-sm-8">
                                <textarea rows="3" class="form-control" placeholder="Deskripsi Penyelenggara" name="vendor_description"><?php echo $vendor['info']->vendor_description;?></textarea>
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="logo" class="col-sm-4 control-label">Logo organisasi</label>
                            <div class="col-sm-8">
                                <input name="vendor_logo" type="file" class="form-control" />
                            </div>
                            <div class="col-md-4 ">
                                <img width="180" src="<?php $img = "images/vendor/{$vendor['info']->vendor_id}/{$vendor['info']->vendor_logo}"; echo base_url().(empty($vendor['info']->vendor_logo)?'images/default_profile_image.png':$img);?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8 submit-form">
                                <button type="submit" class="btn btn-default main-button register">Simpan</button>
                                <button type="reset" class="btn btn-default cancel">Reset</button>
                            </div>
                        </div>
                    </form>

                    <h4 class="review-title">Social Media</h4>

                    <form class="form-horizontal" role="form" action="<?php echo base_url();?>vendor/profile/update_socmed" method="post">
                        <div class="form-group">
                            <label for="facebook" class="col-sm-4 control-label">Facebook   http://facebook.com/</label>
                            <div class="col-sm-8">
                                <input type="text" name="socmed_fb" id="facebook" placeholder="Facebook" class="form-control" value="<?php echo empty($socmed->facebook)?'':$socmed->facebook;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="twitter" class="col-sm-4 control-label">Twitter @</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="twitter" placeholder="Twitter" value="<?php echo empty($socmed->facebook)?'':$socmed->twitter;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="instagram" class="col-sm-4 control-label">Instagram  http://instagram.com/</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="instagram" placeholder="Instagram" value="<?php echo empty($socmed->facebook)?'':$socmed->instagram;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="pinterest" class="col-sm-4 control-label">Pinterest</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="pinterest" placeholder="Pinterest" value="<?php echo empty($socmed->facebook)?'':$socmed->pinterest;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8 submit-form">
                                <button type="submit" class="btn btn-default main-button register">Simpan</button>
                                <button type="reset" class="btn btn-default cancel">Reset</button>
                            </div>
                        </div>
                    </form>

                </div><!-- profil -->
                <div role="tabpanel" class="tab-pane" id="reponsible">
                    <h4 class="review-title">Penanggungjawab penyelenggara <span class="info">* Data tidak bisa diakses secara umum</span></h4>

                    <form class="form-horizontal" role="form" action="<?php echo base_url();?>vendor/profile/update_info" method="post" id="form-2" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama" class="col-sm-4 control-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" placeholder="Nama" value="<?php echo $vendor['info']->contact_person_name;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="notelepon" class="col-sm-4 control-label">No. Telp</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="notelepon" placeholder="Nomor Telepon" value="<?php echo $vendor['info']->contact_person_phone;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="nohp" class="col-sm-4 control-label">No. HP</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nohp" placeholder="Nomor HP" value="<?php echo $vendor['info']->contact_person_mobile;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="email" class="col-sm-4 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $vendor['info']->contact_person_email;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="alamat" class="col-sm-4 control-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" placeholder="Alamat" rows="3"><?php echo $vendor['info']->class_room_address;?></textarea>
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8 submit-form">
                                <button type="submit" class="btn btn-default main-button register">Simpan</button>
                                <button type="reset" class="btn btn-default cancel">Reset</button>
                            </div>
                        </div>
                    </form>

                    <h4 class="review-title">Rekening Bank</h4>

                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="Seo" class="col-sm-4 control-label">Bank</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="account_bank" id="bank_select">
                                    <?php
                                    foreach($bank_list as $bank):
                                    ?>
                                    <option
                                        <?php echo !empty($bank_account->bank_id) && $bank_account->bank_id==$bank->bank_id?'selected="selected"':''; ?>
                                        value="<?php echo $bank->bank_id;?>" >
                                                <?php echo $bank->bank_title; ?>
                                    </option>
                                    <?php
                                    endforeach;
                                    ?>
                                    <option
                                        <?php echo ($bank_account->bank_id)==='0'?'selected':''?>
                                        value="x">
                                                Rekening bank lain
                                    </option>
                                </select>
                                <input type="text" name="bank_new" value="<?php echo empty($bank_account->bank_lain)?'':$bank_account->bank_lain; ?>" class="form-control" id="bank_new" style="display: none;" placeholder="Bila nama bank tidak terdapat dalam list diatas dapat ditambah disini"/>
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="norekening" class="col-sm-4 control-label">No. Rekening</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="norekening" placeholder="Nomor Tekening" value="<?php echo empty($bank_account->no_rek)?'':$bank_account->no_rek;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="nama pemilik" class="col-sm-4 control-label">Nama pemilik rekening</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama pemilik" placeholder="Nama pemilik" value="<?php echo empty($bank_account->atasnama)?'':$bank_account->atasnama;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <label for="cabang" class="col-sm-4 control-label">Cabang</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="cabang" placeholder="Cabang" value="<?php echo empty($bank_account->cabang)?'':$bank_account->cabang;?>" />
                            </div>
                        </div><!-- form-group -->
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8 submit-form">
                                <button type="submit" class="btn btn-default main-button register">Simpan</button>
                                <button type="reset" class="btn btn-default cancel">Reset</button>
                            </div>
                        </div>
                    </form>
                </div><!-- <reponsible></reponsible> -->
            </div>

        </div>
    </div>
</div>
</div> <!-- /container -->

<script type="application/javascript">
    $(document).ready(function(){
        $('#bank_select').change(function(e){
            if($(this).val() == 'x') {
                $('#bank_new').show().focus();
            } else {
                $('#bank_new').hide();
            }
        });
        $('#bank_select').change();
    });
</script>
<?php
$this->load->view('vendor/general/footer');