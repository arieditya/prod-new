<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 3/13/15
 * Time: 6:02 PM
 */
$this->load->helper('text');
$this->load->view('vendor/general/header2');
?>
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
        var c_filter = get_cookie['filter'];

        var _filter_ = !c_filter?{}:$.parseJSON(get_cookie('filter'));
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

    <div class="container content">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="block-title text-center">Daftar Seluruh Kelas</h3>
            </div>
        </div>
        <div class="row">
            <?php
            $i = 0;
            $j = 0;
            if(!empty($class)):
            foreach($class as $kelas):
            if($i % 3 == 0 && $i > 0):
            $j++;
            ?>
        </div>
        <div class="row">
            <?php
            endif;
            $imgparts = explode('.',$kelas->class_image);
            $ext = array_pop($imgparts);
            array_push($imgparts, $ext);
            $img = empty($kelas->class_image)?'images/default_profile_image.png':('images/class/'.$kelas->id.'/'
                .implode('.', $imgparts));
            $price = (int)$kelas->price_per_session;
            $disc = (int)$kelas->discount;
            if($kelas->class_paket == 2) {
                $_price = rupiah_format($price * $kelas->count_session).' /paket';
            } else {
                $_price = rupiah_format($price).' /sesi';
            }
            ?>
            <div class="col-sm-4">
                <div class="content-grid <?php if($disc>0){ echo 'diskon';} ?>">
                    <a href="<?php echo base_url().'kelas/'.$kelas->class_uri?>">
                        <div class="grid-top" style="background-image: url('<?php echo base_url().$img;?>');">
                            <div class="grid-title-wrap" style="width: 100%">
                                <h3 class="grid-title"><?php echo $kelas->class_nama?></h3>
                            </div><!-- grid-title-wrap -->
                        </div><!-- grid-top -->
                    </a>
                    <div class="grid-bottom">
                        <span class="price"><?php echo $_price; ?></span>
                        <a href="<?php echo base_url().'kelas/'.$kelas->class_uri?>">
                            <span class="details">Details</span>
                        </a>
                        <div class="description">
                            <div class="icon"><i class="fa fa-calendar-o"></i></div>
							<span class="date"> <?php echo date('d M Y', strtotime($kelas->class_tanggal));?> |
                                <?php echo double_digit($kelas->class_jam_mulai).'.'.double_digit($kelas->class_menit_mulai)?> -
                                <?php echo double_digit($kelas->class_jam_selesai).'.'.double_digit($kelas->class_menit_selesai)?> WIB
							</span>
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
                        </div><!-- description -->
                        <div class="review">
                            <div class="vendor-name">
                                <div class="icon tag"><i class="fa fa-shopping-cart"></i></div>
                                <a href="#"><?php echo character_limiter($kelas->vendor['profile']->name,12);?></a>
                            </div>
                            <div class="rating">
                                <div class="icon tag"><i class="fa fa-star"></i></div>
                                <b><?php echo (int)$kelas->rating->rate;?></b> (<?php echo $kelas->rating->counter?> review)
                            </div>
                        </div>
                    </div><!-- grid-bottom -->
                </div> <!-- content-grid -->
            </div><!-- col-sm-4 -->
            <?php
            $i++;
            endforeach;
            endif;
            ?>

        </div>
    </div> <!-- /container -->
<?php
$this->load->view('vendor/general/footer2');