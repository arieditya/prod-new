<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 2/12/15
 * Time: 10:42 PM
 */
$this->load->view('vendor/general/header');
?>
    <link href="<?php echo base_url();?>assets/css/bootstrap-slider.css" rel="stylesheet" />
    <script src="<?php echo base_url();?>assets/js/bootstrap-slider.js" type="application/javascript"></script>
    <div class="panel panel-default">
    <div class="panel-body bg-all">
    <div class="row">
        <style type="text/css">

        </style>
        <script type="application/javascript">
            //	$.parseJSON();

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
    <div class="row list-orange">
        <div class="col-md-offset-2 col-md-8">
            <ul class="nav nav-pills">
                <li class="title-filter text-16">Filter</li>
                <li id="cat_list" class="<?php $active = (int)$this->input->get('category', TRUE);echo !empty($active)?' active':''; ?>">
                    <select class="select-style">
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
                    <select class="select-style level">
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
                <li id="prov_list">
                    <select class="select-style propinsi">
                        <option value="0">Provinsi</option>
                        <?php foreach($propinsi as $k=>$p){ ?>
                            <option value="<?php echo $k ?>"><?php echo $p ?></option>
                        <?php } ?>
                    </select>
                </li>
                <li id="tipe_list">
                    <select class="select-style">
                        <option value="0">Tipe Kelas</option>
                        <option value="0">Paket</option>
                        <option value="0">Satu Sesi</option>
                    </select>
                </li>
                <li id="harga_list">
                    <select class="select-style kategori">
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
                <li id="sort_by_list" class="pull-right">
                    <select class="select-style">
                        <option value="0">Harga Termurah</option>
                        <option value="1">On Going Class</option>
                        <option value="2">Upcoming Class</option>
                        <option value="3">Past Class</option>
                    </select>
                </li>
                <li class="title-filter text-16 pull-right">Urutan</li>
            </ul>
        </div>
    </div>
    <div class="row bottom-50">
    <div class="col-md-offset-2 col-md-8">
    <div class="text-center top-10 bottom-10 text-20 bold">Daftar Seluruh Kelas</div>
    <div class="row">
        <?php
        $i = 0;
        $j = 0;
        if(!empty($class)):
        foreach($class as $kelas):
        if($i % 3 == 0 && $i > 0){
        $j++;
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
        <div class="col-md-4 bottom-20">
            <div class="thumbnail" style="width: 308px">
                <a href="<?php echo base_url('kelas/'.$kelas->class_uri)?>">
                    <div style="height: 200px;overflow: hidden;">
                        <img style="width: 100%;top:0;left:0;"
                             data-src="<?php echo base_url().$img;?>"
                             src="<?php echo base_url().$img;?>"
                             alt="..."
                            <?php echo !empty($price)?"dee-picture data-price='{$_price}'":''?>
                            <?php
                            echo !empty($kelas->discount)?'dee-discount':''?>
                            />
                    </div>
                    <div id=<?php echo "'new-class-title".$i."'"?>'' class="class-title-container">
                        <span class="class-title"><?php echo $kelas->class_nama?></span>
                    </div>
                </a>
                <div class="class-info" style="margin-top:0px;">
                    <div>
                        <div class="class-price">
                            Rp <?php echo $_price.' /sesi'; ?>
                        </div>
                        <a href="<?php echo base_url().'kelas/'.$kelas->class_uri?>" class="class-register">
                            DETAIL
                        </a>
                        <div class="clear"></div>
                    </div>
                    <div class="class-session">
                        <div class="ico-session">
                            <img src="<?php echo base_url().'images/calendar.png';?>"/>
                        </div>
                        <p class="text-13"><?php echo date('d M Y', strtotime($kelas->class_tanggal));?> | 17.00 - 19.00 WIB<br/>
                            dan <a href="<?php echo base_url('kelas/'.$kelas->class_uri)?>" class="pink"><span class="link-sesi"><?php echo 5;?> sesi lainnya</span></a><br/>
                        </p>
                    </div>
                    <a href="#"><div class="line-title"><span class="bold text-left text-16 title-filter"></span></div></a>
                    <div class="class-name">
                        <div class="ico-session">
                            <img src="<?php echo base_url().'images/check-order.png';?>"/>
                        </div>
                        <a href="#" class="link-vendor">Toko Kue Primadona</a>
                        <div class="class-rating">
                            <?php for($ii=0;$ii<5;$ii++){ ?>
                                <img src="<?php echo base_url().'images/count-star.png'?>"/>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $i++;
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
        <a href="<?php echo base_url()?>kelas">
            <div class="btn-back top-40">Kembali</div>
        </a>
    </div>
    </div>
    </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function(){
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