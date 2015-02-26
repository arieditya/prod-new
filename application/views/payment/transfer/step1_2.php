<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 2/26/15
 * Time: 10:28 AM
 */
$wait = $this->input->cookie('wait', TRUE);
if(empty($wait)) $wait = '[]';
$wait = json_decode($wait);
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
</nav>

<script type="application/javascript">
    var cart = $.cookie('cart');
    var wait = $.cookie('wait');
    if(!wait) wait = [];
</script>

<div class="container content">
    <div class="row">
        <div class="col-sm-7">
            <div class="panel panel-default panel-big">
                <div class="panel-heading heading-label">Review Data Pemesanan</div>
                <div class="panel-body">
                    <h4 class="review-title">Data Pemesan</h4>
                    <form role="form" method="post" action="<?php echo base_url('payment/transfer/step2');?>">
                        <div class="form-group">
                            <label for="Nama">Nama Lengkap Pemesan *</label>
                            <input type="text" class="form-control" id="Nama" placeholder="Nama sesuai dengan kartu identitas" value="<?php echo !empty($student)?$student->murid_nama:'';?>" <?php echo !empty($student)?'readonly="readonly"':'';?> />
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="Email">Email *</label>
                                <input type="email" class="form-control" id="Email" placeholder="Contoh: nama@email.com" value="<?php echo !empty($student)?$student->murid_email:'';?>" <?php echo !empty($student)?'readonly="readonly"':'';?> />
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="Telp">Nomor Telepon/ HP *</label>
                                <input type="text" class="form-control" id="Telp" placeholder="Contoh: 08123456789" value="<?php echo !empty($student)?$student->murid_hp:'';?>" <?php echo !empty($student)?'readonly="readonly"':'';?> />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap *</label>
                            <textarea class="form-control" placeholder="Alamat sesuai dengan alamat domisili saat ini. Cantumkan juga kota tempat tinggal saat ini." rows="3" <?php echo !empty($student)?'readonly="readonly"':'';?> ><?php echo !empty($student)?$student->murid_alamat:'';?> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="radio">Data Murid</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="whostudent" value="me" <?php echo $whostudent=='me'?'checked="checked"':'';?> />
                                    Saya sendiri yang akan hadir menjadi murid di kelas ini
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="whostudent" value="other" <?php echo $whostudent!='me'?'checked="checked"':'';?> />
                                    Saya mendaftarkan untuk orang lain
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default main-button register">Submit Pesanan</button>
                    </form>
                </div>
            </div><!-- panel -->
        </div><!-- col-sm-7 -->
        <div class="col-sm-5">
            <div class="panel panel-default panel-big">
                <div class="panel-heading heading-label">Rincian Pemesanan</div>
                <div class="panel-body">
                    <h4 class="review-title">Jadwal kelas yang ingin diikuti</h4>
<?php
                $total_price = 0;
                foreach($in_cart as $cart_list):
                    $logo = base_url('images/class/'.$cart_list['class']->id.'/'.$cart_list['class']->class_image);
?>
                    <div class="jadwal-item">
                        <div class="jadwal-wrap">
                            <div class="row">
                                <div class="col-xs-4">
                                    <img class="img-responsive" src="<?php echo $logo; ?>" />
                                </div>
                                <div class="col-xs-8">
                                    <?php echo $cart_list['class']->class_nama?><br />
                                    <a href="#remove_cart" data-r_id="<?php echo $cart_list['class']->id?>"
                                       class="remove">
                                        <i class="fa fa-times"></i>
                                        Remove from list
                                    </a>
                                </div>
                            </div>
                        </div> <!-- jadwal-wrap -->
                    <table class="table table-responsive">
                            <thead>
                            <tr>
                                <td>No</td>
                                <td>Sesi</td>
                                <td>Harga</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
<?php
    $i = 0;
    $subprice = 0;
    $diskon = TRUE;
    foreach($cart_list['schedule'] as $sched):
        $i++;
        $date = date('j M y', strtotime($sched->class_tanggal));
        $start = $sched->class_jam_mulai.':'.$sched->class_menit_mulai;
        $end = $sched->class_jam_selesai.':'.$sched->class_menit_selesai;
        $followed = FALSE;
        //			$sched->available_seat = 0;
        if(in_array($sched->jadwal_id, $cart_list['followed']) && $sched->available_seat > 0) {
            $subprice += (int)$cart_list['class']->price_per_session;
            $followed = TRUE;
        } else {
            $diskon = FALSE;
        }
        $text = $sched->class_jadwal_topik?'':('<span style="'.$followed?'':'text-decoration: line-through;'.'">'.$sched->class_jadwal_topik.'</span>');
        $text .= $sched->available_seat == 0?'<span class="label label-warning">Fullbook</span>':'';
        $text .= (!empty($text)?'<br />':'');
?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td>
                                    <?php echo $text;?>
                                    <span class="bluefont" style="<?php echo $followed?'':'text-decoration: line-through;'?>"><?php echo "{$date}, {$start}-{$end}";?> WIB</span>
                                </td>
                                <td>
                                    Rp <?php echo number_format((int)$cart_list['class']->price_per_session, 0, ',',',')?>,-&nbsp;&nbsp;&nbsp;
                                </td>
                                <td><a href="#" class="remove">
<?php
                                if($cart_list['class']->class_paket == 1):
                                    if($followed):
?>
                                        <i class="fa fa-times" title="Remove from schedule" data-id="<?php echo $sched->class_id.'|'.$sched->jadwal_id; ?>"></i>
<?php
                                    else:
                                        if($sched->available_seat == 0):
                                            if(in_array($sched->jadwal_id, $wait)):
?>
                                                <i class="fa fa-exclamation-circle fa-lg rmv_wait" title="Remove from waiting list" data-id="<?php echo $sched->class_id.'|'.$sched->jadwal_id; ?>"></i>
<?php
                                            else:
?>
                                                <i class="fa fa-question-circle fa-lg  add_wait" title="Add to waiting list" data-id="<?php echo $sched->class_id.'|'.$sched->jadwal_id; ?>"></i>
<?php
                                            endif;
                                        else:
?>
                                            <i class="fa fa-check-circle fa-lg add_schd" title="Add to schedule" data-id="<?php echo $sched->class_id.'|'.$sched->jadwal_id; ?>"></i>
<?php
                                        endif;
                                    endif;
                                endif;
?>
                                    </a></td>
                            </tr>
<?php
    endforeach;
?>
                            </tbody>
                        </table>
                        <h5 class="sum-label">Subtotal Harga
                            <span class="pinkfont">Rp <?php echo number_format($subprice, 0, ',',',')?>,-</span>
                        </h5>
                        <?php
                        $subprice -= (int) $cart_list['class']->discount;
                        $disc = (int) $cart_list['class']->discount;
                        ?>
                        <h5 class="sum-label">Potongan Harga
                            <span>Rp <?php echo number_format($disc, 0, ',',',')?>,-</span>
                        </h5>
                        <hr>
                        <h5 class="sum-label">Subtotal Order
                            <span class="sum-price pull-right">Rp <?php echo number_format($subprice).',-';?></span>
                        </h5>
                    </div><!-- jadwal-item -->
<?php
                    $total_price += $subprice;
                endforeach;
?>
                    <?php
                    if(!empty($potongan_diskon)) {
                        if(!is_array($potongan_diskon)) $potongan_diskon = array($potongan_diskon);
                            foreach($potongan_diskon as $price_code => $price):
                                ?>
                                <h5><?php echo $price_code;?></h5>
                                <h5>Rp <?php echo number_format($price, 0, ',',',')?>,-</h5>
                                <?php
                                $total_price -= $price;
                            endforeach;
                    }
                    else $potongan_diskon = 0;
                    ?>

                    <label for="own">Kode Diskon</label>
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control" id="kupon" placeholder="( jika ada )">
                        </div>
                        <button type="submit" class="btn btn-default cek-button">Cek</button>
                    </form>

                    <h4 class="sum-total">Total yang harus dibayar
                        <span class="pull-right">Rp <?php echo number_format($total_price, 0, ',',',')?>,-</span>
                    </h4>
                </div><!-- panel-body -->
            </div><!-- panel -->
        </div><!-- col-sm-5 -->
    </div>
</div> <!-- /container -->

<script type="application/javascript">
    $('input[type=radio][name=whostudent]').click(function(e){
        if($(this).val() == 'other') {
            $('#student_other').show();
        } else {
            $('#student_other').hide();
        }
    });

    $(document).ready(function(){
        $('.blue-segment').css(
            {
                'width':$('.blue-segment').parent().css('width'),
                'marginLeft': '-20px'
            }
        );
    });

    $('.remove_cart').click(function(e){
        e.preventDefault();
        var r_id = $(this).data('r_id');
        var newCart = [];
        $.each(cart, function(idx, dt){
            if(dt.id == r_id) return;
            newCart.push(dt);
        });
        $.cookie('cart', newCart, {'path': '/'});
        window.location.reload();
        return false;
    });

    $('#btn_signin').click(function(e){
        e.preventDefault();
        $('#curtain').show().css({
            'width'				: window.screen.width+200+'px',
            'height'			: window.screen.height+200+'px',
            'background'		: 'rgba(70,70,70,0.4)',
            'top'				: ($('#curtain').position().top * -1)+'px',
            'position'			: 'fixed',
            'z-index'			: 10000000
        });

        var $sgn_in = $('<div class="sign_form"></div>');
        var elmDimension = {
            width		: 500,
            height		: 250
        };
        $sgn_in.css({
            left				: Math.floor(window.screen.width/2)-(Math.floor(elmDimension.width/2))+'px',
            top					: Math.floor(window.screen.height/2)-(Math.floor(elmDimension.height/2))+'px',
            width				: elmDimension.width+'px',
            height				: elmDimension.height+'px',
            'position'			: 'absolute',
            'backgroundColor'	: '#eee',
            'color'				: '#333',
            'text-align'		: 'left',
            'border-radius'		: '10px'
        });
        console.log($sgn_in.css('left'));
        console.log($sgn_in.css('top'));
        $sgn_in.append($('#sign_in_fly').html());
        console.log($sgn_in.html());
        $('#curtain').append($sgn_in);

        return false;
    });
    $('#cek_diskon').click(function(e){
        e.preventDefault();

        $.get(base_url+'payment/transfer/cek_diskon',{
                'kode_diskon'	: $('#kode_diskon').val()
            },
            function(result) {
                if(result.status == 'OK') {
                    alert(result.data.message);
                    window.location.reload();
                } else if(result.status == 'NOK') {
                    alert(result.data.message);
                }
            },
            'json'
        ).error(function(jqxhr){
                console.log(jqxhr);
            });

        var kode_diskon = $.cookie('kode_diskon');
        var key_exists = false;
        Object.keys(kode_diskon).reduce(
            function(kode, nextKey) {
                if(kode == $('#kode_diskon').val()) {
                    key_exists = true;
                }
                return nextKey;
            }
        );
        if(!key_exists) {

        }

        $.cookie('kode_diskon', $('#kode_diskon').val(), {'path':'/'});
        window.location.reload();
        return false;
    });
    $('.add_schd').click(function(e){
        e.preventDefault();
        var $id = $(this).data('id').split('|');
        $id[0] = parseInt($id[0]);
        $id[1] = parseInt($id[1]);
        var newCart = [];
        cart.forEach(function(d){
            var newCartElm = {
                id		: d.id,
                jadwal	: []
            };
            var added = false;
            d.jadwal.forEach(function(j){
                if(d.id == $id[0] && j > $id[1] && ! added) {
                    newCartElm.jadwal.push($id[1]);
                    added = true;
                }
                newCartElm.jadwal.push(j);
            });
            if(d.id == $id[0] && ! added) {
                newCartElm.jadwal.push($id[1]);
            }
            newCart.push(newCartElm);
        });
        $.cookie('cart', newCart, {'path': '/'});
        window.location.reload();
        return false;
    });
    $('.rmv_schd').click(function(e){
        e.preventDefault();
        var $id = $(this).data('id').split('|');
        var newCart = [];
        cart.forEach(function(d){
            var newCartElm = {
                id		: d.id,
                jadwal	: []
            };
            console.log('CART:',d);
            if(d.id != $id[0]) {
                newCartElm = d;
            } else {
                d.jadwal.forEach(function(j){
                    if(j != $id[1]){
                        newCartElm.jadwal.push(j);
                    }
                });
            }
            newCart.push(newCartElm);
        });
        console.log(newCart);
        $.cookie('cart', newCart, {'path': '/'});
        window.location.reload();
        return false;
    });
    $('.add_wait').click(function(e) {
        e.preventDefault();
        var $id = $(this).data('id').split('|');
        $id[1] = parseInt($id[1]);
        var newWait = [];
        var added = false;
        wait.forEach(function(d) {
            if(d == $id[1])
                added = true;
            newWait.push(d);
        });
        if(!added) newWait.push($id[1]);
        $.cookie('wait', newWait, {path: '/'});
        window.location.reload();
        return false;
    });
    $('.rmv_wait').click(function(e) {
        e.preventDefault();
        var $id = $(this).data('id').split('|');
        $id[1] = parseInt($id[1]);
        var newWait = [];
        var added = false;
        wait.forEach(function(d) {
            if(d != $id[1])
                newWait.push(d);
        });
        $.cookie('wait', newWait, {path: '/'});
        window.location.reload();
        return false;
    });
</script>
<script type="text/template" id="sign_in_fly">
    <form action="<?php echo base_url();?>payment/user/login" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="pull-right">
                    <label>Email</label>
                </div>
            </div>
            <div class="col-md-6">
                <input type="email" name="email"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="pull-right">
                    <label>Password</label>
                </div>
            </div>
            <div class="col-md-6">
                <input type="password" name="password"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <button class="btn-orange" type="submit">Submit</button>
            </div>
        </div>
    </form>
</script>

<?php
$this->load->view('vendor/general/footer');
