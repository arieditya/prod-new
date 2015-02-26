<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 2/26/15
 * Time: 9:52 AM
 */
/* $this->load->view('vendor/general/header'); */
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
<div class="row">
    <script type="application/javascript">
        var set_cookie = function(key, value) {
            console.log(key+'='+value+';');
            document.cookie = key+'='+value+';';
            if(!wait2second) clearTimeout(wait2second);
            wait2second = window.setTimeout('window.location.reload()', 2000);
        };
        var get_cookie = function(ckey) {
            var ret;
            document.cookie.split(';').forEach(
                function(a){
                    var a=a.trim();
                    var b = a.split('=');
                    var key = b.shift();
                    var value = b.join('=');
                    if(ckey == key) ret = value;
                });
            return ret;
        };

        var _filter_ = $.parseJSON(get_cookie('filter'));
        if(!_filter_) _filter_ = {};

        var wait2second = null;

        var set_filter = function(key, value) {
            var keys = ['day','level','province','type','price_range','category'];
            if($.inArray(key, keys) >= 0) {
                _filter_[key] = value;
                set_cookie('filter', JSON.stringify(_filter_));
                if(!wait2second) clearTimeout(wait2second);
                wait2second = window.setTimeout('window.location.reload()', 2000);
            }
        };

        var get_filter = function(key) {
            var keys = ['day','level','province','type','price_range','category'];
            if($.inArray(key, keys) >= 0) {
                return _filter_[key];
            }
        };

        var reset_filter = function() {
            set_cookie('filter', '');
            _filter_ = {};
            window.location.reload();
        };

        $(document).ready(function(){
            $('#filter_container')
        });
    </script>
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
                    <li class="title-filter text-16">Filter</li>
                    <li id="cat_list" class="<?php $active = (int)$this->input->get('category', TRUE);echo !empty($active)?' active':''; ?>">
                        <select class="form-control">
                            <option value="0">Hari</option>
                            <option value="1">Senin</option>
                            <option value="2">Selasa</option>
                            <option value="3">Rabu</option>
                            <option value="4">Kamis</option>
                            <option value="5">Jumat</option>
                            <option value="6">Sabtu</option>
                            <option value="7">Minggu</option>
                        </select>
                    </li>
                    <li id="lev_list" class="<?php $active = (int)$this->input->get('level', TRUE);echo !empty($active)?' active':''; ?>">
                        <select class="form-control level">
                            <option value="0">Level</option>
                            <?php foreach($level as $lev):
                                $act = empty($filter['level'])?FALSE:$lev->id == $filter['level']?TRUE:FALSE;
                                $get = $_GET;
                                $get['level'] = $lev->id;
                                unset($get['_']);
                                $par = '?_='.time();
                                foreach($get as $getk => $getv){
                                    $par .= "&{$getk}={$getv}";
                                }
                                ?>
                                <option value="<?php echo $lev->id;?>" class="col-xs-2 level_check level_<?php echo $lev->id;?>"><?php echo ucwords($lev->name);?></option>
                            <?php endforeach;?>
                        </select>
                    </li>
                    <li id="prov_list" class="filter-select">
                        <select class="form-control propinsi">
                            <option value="0">Provinsi</option>
                            <?php foreach($propinsi as $k=>$p){ ?>
                                <option value="<?php echo $k ?>"><?php echo $p ?></option>
                            <?php } ?>
                        </select>
                    </li>
                    <li id="tipe_list" class="filter-select">
                        <select class="form-control">
                            <option value="0">Tipe Kelas</option>
                            <option value="0">Paket</option>
                            <option value="0">Satu Sesi</option>
                        </select>
                    </li>
                    <li id="harga_list" class="filter-select">
                        <select class="form-control kategori">
                            <option value="0">Kategori</option>
                            <?php foreach($category as $cat):
                                $act = FALSE;
                                if(!empty($filter['category']) )
                                    $act = in_array($cat->id, $filter['category']) ?TRUE:FALSE;
                                $get = $_GET;
                                $get['category'] = $cat->id;
                                unset($get['_']);
                                $par = '?_='.time();
                                foreach($get as $getk => $getv){
                                    $par .= "&{$getk}={$getv}";
                                }
                                ?>
                                <option value="<?php echo $cat->id?>"><?php echo ucwords($cat->category_name);?></option>
                            <?php endforeach;?>
                        </select>
                    </li>
                </ul>
                <ul class="sort nav">

                    <li class="title-filter text-16 sort-list">Urutan</li>
                    <li id="sort_by_list" class="sort-list">
                        <select class="form-control">
                            <option value="0">Harga Termurah</option>
                            <option value="1">On Going Class</option>
                            <option value="2">Upcoming Class</option>
                            <option value="3">Past Class</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div><!-- below-nav -->
</nav>
<div class="container content">
    <div class="col-sm-12 block-title-wrap">
        <h2 class="block-title text-center text-uppercase">Kelas Pilihan</h2>
    </div>
    <div class="row">
        <?php
        $i = 0;
        $j = 0;
        if(!empty($class)):
        foreach($class as $kelas):
        if($i < 6) {
        if($i%3==0){
        ?>
    </div>
    <div class="row">
        <?php
        }

        $imgparts = explode('.',$kelas->class_image);
        $ext = array_pop($imgparts);
        array_push($imgparts, $ext);
        $img = empty($kelas->class_image)?'images/default_profile_image.png':('images/class/'.$kelas->id.'/'
            .implode('.', $imgparts));
        $price = (int)$kelas->price_per_session;
        $disc = (int)$kelas->discount;
        if(empty($price)){
            $_price = '0,-';
        } else {
            $_price = number_format($price).',-';
        }
        ?>
        <div class="col-sm-4">
            <div class="content-grid <?php if($disc>0){ echo 'diskon';} ?>">
                <a href="<?php echo base_url('kelas/'.$kelas->class_uri)?>">
                    <div class="grid-top" style="background-image: url(<?php echo base_url().$img;?>);">
                        <div class="grid-title-wrap">
                            <h3 class="grid-title"><?php echo $kelas->class_nama?></h3>
                        </div><!-- grid-title-wrap -->
                    </div><!-- grid-top -->
                </a>
                <div class="grid-bottom">
                    <span class="price">Rp <?php echo $_price.' /sesi'; ?></span>
                    <a href="<?php echo base_url().'kelas/'.$kelas->class_uri?>"><span class="details">Details</span></a>
                    <div class="description">
                        <div class="icon"><i class="fa fa-calendar-o"></i></div>
                            <span class="date">
                                <?php echo date('d M Y', strtotime($kelas->class_tanggal));?> | 17.00 - 19.00 WIB<br/>
                                <?php if($kelas->count_session-1 > 0):
                                    ?>
                                    dan <a href="<?php echo base_url('kelas/'.$kelas->class_uri)?>"
                                           class="pink">
												<span class="link-sesi"><?php echo $kelas->count_session-1;?> sesi
													lainnya</span>
                                </a>
                                <?php else: ?>
                                    <br />
                                <?php endif; ?>
							</span>
                    </div><!-- description -->
                    <div class="review">
                        <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                            <span class="tag"><?php echo
                                $kelas->vendor['profile']->name;?></span>
                        <div class="rating">
                            <?php for($ii=0;$ii<5;$ii++){ ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                        </div>
                    </div>
                </div><!-- grid-bottom -->
            </div> <!-- content-grid -->
        </div><!-- col-sm-4 -->
        <?php
        $i++;
        }
        endforeach;
        else:
            ?>
            <div class="col-md-12">
                <div class="jumbotron">
                    <h3>No Data Found!
                        <small>Please refine your filter..</small>
                    </h3>
                </div>
            </div>
        <?php
        endif;
        ?>

    </div>
    <div class="col-sm-4 col-sm-offset-4">
        <a href="#" class="main-button text-center">Lihat Semua Kelas</a>
    </div>

    <div class="col-sm-12 block-title-wrap">
        <h2 class="block-title text-center text-uppercase">Kelas Terbaru</h2>
    </div>

    <div class="row">
        <?php
        $i = 0;
        $j = 0;
        if(!empty($class)):
            foreach($class as $kelas):
                if($i < 3){
                    $img = empty($kelas->class_image)?'images/default_profile_image.png':('images/class/'.$kelas->id.'/'.$kelas->class_image);
                    $price = (int)$kelas->price_per_session;
                    $disc = (int)$kelas->discount;
                    $_disc = number_format($disc).',-';
                    if(empty($price)){
                        $_price = '0,-';
                    } else {
                        $_price = number_format($price, 0, ',', '.').',-';
                    }
                    ?>
                    <div class="col-sm-4">
                        <div class="content-grid <?php if($disc>0){ echo 'diskon';} ?>">
                            <a href="<?php echo base_url('kelas/'.$kelas->class_uri)?>">
                                <div class="grid-top" style="background-image: url(<?php echo base_url().$img;?>);">
                                    <div class="grid-title-wrap">
                                        <h3 class="grid-title"><?php echo $kelas->class_nama?></h3>
                                    </div><!-- grid-title-wrap -->
                                </div><!-- grid-top -->
                            </a>
                            <div class="grid-bottom">
                                <span class="price">Rp <?php echo $_price.' /sesi'; ?></span>
                                <a href="<?php echo base_url().'kelas/'.$kelas->class_uri?>"><span class="details">Details</span></a>
                                <div class="description">
                                    <div class="icon"><i class="fa fa-calendar-o"></i></div>
                            <span class="date">
                                <?php echo date('d M Y', strtotime($kelas->class_tanggal));?> | 17.00 - 19.00 WIB<br/>
                                <?php if($kelas->count_session-1 > 0):
                                    ?>
                                    dan <a href="<?php echo base_url('kelas/'.$kelas->class_uri)?>"
                                           class="pink">
												<span class="link-sesi"><?php echo $kelas->count_session-1;?> sesi
													lainnya</span>
                                </a>
                                <?php else: ?>
                                    <br />
                                <?php endif; ?>
							</span>
                                </div><!-- description -->
                                <div class="review">
                                    <div class="icon"><i class="fa fa-shopping-cart"></i></div>
                            <span class="tag"><?php echo
                                $kelas->vendor['profile']->name;?></span>
                                    <div class="rating">
                                        <?php for($ii=0;$ii<5;$ii++){ ?>
                                            <i class="fa fa-star"></i>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div><!-- grid-bottom -->
                        </div> <!-- content-grid -->
                    </div><!-- col-sm-4 -->
                    <?php
                    $i++;
                }
            endforeach;
        else:
            ?>
            <div class="col-md-12">
                <div class="jumbotron">
                    <h3>Kelas yang Anda cari tidak ditemukan!
                        <small>Silahkan lakukan pencarian ulang</small>
                    </h3>
                </div>
            </div>
        <?php
        endif;
        ?>

    </div>
</div>
<script type="application/javascript">
    $(document).ready(function(){

        $('.class-title-container').each(function(id, elm){
            console.log();
            var c_id = $(elm).attr('id');
            var top = '-'+$(elm).css('height');
            console.log('TOP:'+top);
            $('#'+c_id).css({'marginTop':top});
        });


        $('.filter_level').click(function(e){
            e.preventDefault();
            var lvl_id = $(this).data('id');
            $('.level_check').empty();
            $('.level_'+lvl_id).append($('<i class="glyphicon fa fa-check"></i>'));
            set_filter('level', lvl_id);
            return false;
        });
        $('.filter_category').click(function(e){
            e.preventDefault();
            var cat_id = $(this).data('id');
            var filter_category = get_filter('category');
            if(!filter_category) filter_category = [];
            var key_position = $.inArray(cat_id, filter_category);
            // toggling
            if( key_position >= 0 ) {
                delete(filter_category[key_position]);
                filter_category = filter_category.filter(function(){return true;});
                $('.cat_'+cat_id).empty();
            } else {
                filter_category.push(cat_id);
                $('.cat_'+cat_id).append($('<i class="fa fa-check"></i>'));
            }
            set_filter('category', filter_category);
            return false;
        });

        $('#price_slider').slider({});
        $('#price_slider').on('slide', function(e){
            var filter_price_range = get_filter('price_range');
            if(!filter_price_range) filter_price_range = {'hi':2000000, 'lo':100000};
            filter_price_range.lo = e.value[0];
            filter_price_range.hi = e.value[1];

            set_filter('price_range', filter_price_range);

            $('#minrange').val(e.value[0]);
            $('#maxrange').val(e.value[1]);
        });
        $('#reset_filter').click(function(){
            window.location.href = window.location.origin+window.location.pathname;
        });
        $('#search_range').click(function(e){
            e.preventDefault();
            var qs = location.search;
            if(qs.length > 0){
                qs = qs.substr(1);
                var qse = qs.split('&');
                var qsb = '?';
                if(qse.length > 0){
                    for(var i=0; i<qse.length; i++){
                        if(qsb.length > 0) qsb += '&';
                        var par = qse[i].split('=');
                        if(par[0] == 'minrange' || par[0] == 'maxrange') {
                        } else {
                            qsb += qse[i];
                        }
                    }
                    $('#price_slider').data('slider-value');
                    qsb += '&minrange='+($('#minrange').val());
                    qsb += '&maxrange='+($('#maxrange').val());
                } else {
                    qsb += 'minrange='+($('#minrange').val());
                    qsb += '&maxrange='+($('#maxrange').val());
                }
            } else {
                var qsb = '?minrange='+($('#minrange').val());
                qsb += '&maxrange='+($('#maxrange').val());
            }
            var path = window.location.origin+window.location.pathname+qsb;
            window.location.href=path;
            return false;
        });
        $.each($('img[dee-discount]'), function(i, elm){
            $(elm).before(
                $('<div class="discount-tag"></div>')
                    .append($("<img src='<?php echo base_url();?>images/tag-discount.png' width='70px'/>"))
            );
        });

        $('#reset_filter').click(function(e){
            e.preventDefault();
            reset_filter();
            return false;
        });
    });
</script>
<?php
$this->load->view('vendor/general/footer');