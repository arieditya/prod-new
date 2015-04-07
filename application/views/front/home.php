
<head>

<script type="text/javascript" src="<?php echo base_url();?>js/home.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css_rg/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tinycarousel.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>css_rg/tinycarousel.css" type="text/css" media="screen"/>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.fancybox-media.js?v=1.0.6"></script>


<script>
	$(document).ready(function()
		{
			$("#slider1").tinycarousel({
				bullets  : true
		});
	});
	
	$(document).ready(function()
		{
			$("#slider2").tinycarousel({
				bullets  : true
		});
	});
    
	$(document).ready(function()
		{
			$("#slider3").tinycarousel({
				bullets  : true,
				interval : true,
				intervalTime : 8000
		});
	});
	
     $(document).ready(function(){
		/*
		 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
		*/
		$('.fancybox-media')
			.attr('rel', 'media-gallery')
			.fancybox({
			openEffect : 'none',
			closeEffect : 'none',
			prevEffect : 'none',
			nextEffect : 'none',

			arrows : false,
			helpers : {
			media : {},
			buttons : {}
			}
		});
		
        update_matpel_instan();
		update_provinsi_instan();
		update_matpel();
        update_provinsi();

        $.post("http://ruangguru.com/API/kelas/all",{},
        	function(data){
        		if(data.status=="ok"){
					console.log('Kelas Length:'+data.data.length);
        			$("#content-kelas-pilihan").html('');
        			var rowOpen = '<div class="row">';
        			var rowClose = '</div>';
        			$("#content-kelas-pilihan").append(rowOpen);
        			for(var i=0;i<data.data.length;i++){
						console.log('1');
        				var bulan = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Des'];
						console.log('2 : ');
						console.log(data.data[i]);
        				var price = data.data[i]['price_per_session'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
						console.log('3');
        				var tanggal = data.data[i]['class_tanggal'];
						console.log('4');
        				var exp_tanggal = tanggal.split('-');
						console.log('5');
        				tanggal = exp_tanggal[2]+" "+bulan[parseInt(exp_tanggal[1]-1)]+" "+exp_tanggal[0];
						console.log('6');
        				var jam_mulai = data.data[i]['class_jam_mulai'];
        				if(jam_mulai.length==1){
        					jam_mulai = '0'+jam_mulai;
        				}
						console.log('7');
        				var menit_mulai = data.data[i]['class_menit_mulai'];
        				if(menit_mulai.length==1){
        					menit_mulai = '0'+menit_mulai;
        				}
						console.log('8');
        				var mulai = jam_mulai+"."+menit_mulai;
						console.log('init mulai: '+mulai);
        				var jam_selesai = data.data[i]['class_jam_selesai'];
        				if(jam_selesai.length==1){
        					jam_selesai = '0'+jam_selesai;
        				}
        				var menit_selesai = data.data[i]['class_menit_selesai'];
        				if(menit_selesai.length==1){
        					menit_selesai = '0'+menit_selesai;
        				}
        				var selesai = jam_selesai+"."+menit_selesai;
						console.log('init selesau: '+selesai);

        				var image = data.data[i]['class_image'];
        				if(image=="No Image / Foto"){
        					image = "<?php echo base_url()?>images/kelas_placeholder.jpg";
        				}

        				console.log(image);
        				var offset ='';
        				if (i == 0) {
    						if (data.data.length == 1) {
	        					offset = 'col-md-offset-4 col-sm-offset-3';
	        				} else if (data.data.length == 2) {
	        					offset = 'col-md-offset-2';
	        				}
        				}

        				var content =	'<div class="col col-md-4 col-sm-6 '+ offset +'">'+
							                '<div class="content-grid">'+
							                    '<a href="http://kelas.ruangguru.com/kelas/'+data.data[i]['class_uri']+'" target="_blank">'+
							                        '<div class="grid-top" style="background-image: url(\''+image+'\');">'+
							                            '<div class="grid-title-wrap">'+
							                                '<h3 class="grid-title">'+data.data[i]['class_nama']+'</h3>'+
							                            '</div>'+
							                        '</div>'+
							                    '</a>'+
							                    '<div class="grid-bottom">'+
							                        '<span class="price">Rp'+price+',- /sesi</span>'+
							                        '<a href="http://kelas.ruangguru.com/kelas/'+data.data[i]['class_uri']+'" target="_blank"><span class="details">DETAILS</span></a>'+
							                        '<div class="description">'+
							                            '<div class="icon"><i class="fa fa-calendar-o"></i></div>'+
							                            '<span class="date"> '+tanggal+' | '+mulai+' - '+selesai+' WIB <br> dan <a href="http://kelas.ruangguru.com/kelas/'+data.data[i]['class_uri']+'" target="_blank"> '+data.data[i]['count_session']+' sesi lainnya</a> </span>'+
							                        '</div>'+
							                        '<div class="review">'+
							                            '<div class="tag"><i class="fa fa-shopping-cart"></i>kelas ruangguru</div>'+
							                            '<div class="rating">'+
							                                '<span class="rating-info"> <i class="fa fa-star"></i><strong>0</strong> (<strong>0</strong> review)</span>'+
							                            '</div>'+
							                        '</div>'+
							                    '</div>'+
							                '</div>'+
							            '</div>';
						$("#content-kelas-pilihan").append(content);
						$("#content-kelas-pilihan").append(rowClose);
						console.log('Kelas : '+i);
        			}
        		}
        	},'json');
    }); 
</script>

<!--  FBX -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '583152025127396']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=583152025127396&amp;ev=NoScript" /></noscript>

<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?2Rj08dTp3CXV4fff2CoA9ZnZZB916bwh';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->


</head>
<body>

<div id="content" style="padding-top: 0;">
<div id="section-slide">
    <div id="home-slider">
        <div id="home-slider-wrap">
			<div>
				<img style="float: left; margin-left: 64px; margin-top: 30px;" src="<?php echo base_url(); ?>images/banner-new-homepage-layer.png" alt="" />
				<div id="definisi-title-rg"><h1>Cari Guru Privat</h1></div>
	
				<div id="definisi-rg" class="text-16"><p><b>Dapatkan Guru Privat Berkualitas dengan harga terjangkau!<br>Pilih di antara <strong style="color: #FFF;"><?php echo $this->guru_model->get_jumlah_guru(); ?></strong> guru terdaftar di <a href="http://ruangguru.com">Ruangguru.com</a></b></p></div>
				<!--<img  src="<?php //echo base_url(); ?>images/3.jpg" alt="" class="home-banner"/>-->
			</div>

			<div id="btn-reg-wrap">	
				<form action="<?php echo base_url(); ?>cari_guru/result" method="post">		
				<table>
					<tbody>
    					<tr>
        					<td style="width:1%">
            					<p style="text-align:left; margin: 0 0 4px 8px;">Provinsi</p>
            						<?php $sesi = $this->session->userdata('cari_guru');?>
                						<select id="ddProvinsi" class="select form-control" name="provinsi" onchange="update_provinsi()">
                  							<option value="0">Pilih Provinsi</option>
                  							<option value="1" <?php if ($sesi['provinsi'] == 1 || $sesi['provinsi'] == 0){ echo 'selected';} else { echo ''; }?>>DKI Jakarta</option>
			                                <?php foreach ($this->guru_model->get_provinsi('provinsi')->result() as $row): ?>
				                                <?php if($row->provinsi_id != 1){?>
                            						<option value="<?php echo $row->provinsi_id; ?>" <?php if ($sesi['provinsi']==$row->provinsi_id){ echo 'selected';} else { echo '';};?>><?php echo $row->provinsi_title; ?></option>
		                                		<?php } ?>
			                                <?php endforeach; ?>
                						</select>

	                        </td>
	                        <td style="width:20%">
	                        	<p style="text-align:left; margin: 0 0 4px 8px;">Tingkat/Kategori</p>
	                            <select id="select-jenjang" class="select form-control" name="education" onchange="update_matpel();">
                					<option value="0">Pilih Tingkat</option>
            						<?php foreach ($this->guru_model->get_jenjang()->result() as $row): ?>
                    					<option class="<?php echo $row->jenjang_pendidikan_id;?>" value="<?php echo $row->jenjang_pendidikan_id; ?>" <?php if ($sesi['jenjang']==$row->jenjang_pendidikan_id){ echo 'selected';} else { echo '';};?>/><?php echo $row->jenjang_pendidikan_title; ?>
                					<?php endforeach; ?>
            					</select>
	                        </td>
	                    </tr>
	                    <tr>
	                        <td style="width:1%">   
	                        <p style="text-align:left; margin: 12px 0 4px 8px;">Kota</p>                         
            					<input type="hidden" name="sesi_kota" id="sesi_kota" value="<?php echo $sesi['lokasi'];?>"/>
	                            <select id="ddLokasi" class="select form-control" name="location"></select>
	                        </td>
	                        <td style="width:20%">
	                        	<p style="text-align:left; margin: 12px 0 4px 8px;">Mata Pelajaran</p>
            					<input type="hidden" name="sesi_matpel" id="sesi_matpel" value="<?php echo $sesi['matpel'];?>"/>
                				<select id="select-matpel" class="select form-control" name="matpel"></select>
	                        </td>
	                    </tr>
	                    <tr>
	                    	<td style="width:1%">                            
            					
	                        </td>
	                        <td style="width:1%; ">
	                            <div id="cari-submit">
	                            	<br>
	                                <button class="button" type="submit"  style="width:82%; margin-left:20px;" onclick="return checkSearchFields();">Cari Guru</button>
	                            </div>
	                        </td>
	                    </tr>
	                </tbody>
                </table>
                </form>
            </div>
		
		</form>
      	
    </div>
</div>
</div>
		

<div id="section-rgfeature">
		<div id="features-wrap">
			<h1><p class="text-24 bold" style="color:#9da340; margin-bottom: 20px;">Mengapa Memilih Ruangguru?</p></h1><br>
			
			<ul id="rg-features">
				<li>
					<img src="<?php echo base_url().'images/matpel-2.png';?>" />
					<br><br><p>Guru bisa diverifikasi</p>
				</li>
				<li>
					<img src="<?php echo base_url().'images/verified-2.png';?>" />
					<br><br><p>Pilihan guru bervariasi</p>
				</li>
				<li>
					<img src="<?php echo base_url().'images/garansi-2.png';?>" />
					<br><br><p>Garansi uang kembali 100% <br>bila tidak cocok</p>
				</li>
				<li>
					<img src="<?php echo base_url().'images/payment-2.png';?>" />
					<br><br><p>Bisa bayar dengan kartu<br> kredit, transfer, atau internet</p>
				</li>
			</ul>

		</div>
</div>

<div id="section-adv">
	<p style="padding-top: 26px;font-size:18px;">Belajar di Ruangguru.com sekarang! Harga mulai dari <b>Rp 50,000,-/jam</b> &nbsp; <a href="#" class="button" style="font-size: 16px;" onclick="$('#reg-murid-popup').modal('show');">Jadi Murid</a></p>
</div>

<div id="section-promo-blue">
<div style="width: 1080px; margin: 0 auto;">
<div id="wording-promo-wrap">
		<div id="wording-promo"> 
			<img src="<?php echo base_url(); ?>images/kelas-logo-beta.png" alt="" style="width: 270px; margin-top: 10px;" />
			<p class="text-20 bold"> Cari kelas-kelas menarik di sekitarmu dan <br> pelajari sesuatu yang baru hari ini </p>
			<a href="//kelas.ruangguru.com" class="button button-cancel" style="font-size: 16px; float:right; margin-right:190px;">Cari Kelas</a></p>

		</div>	
	</div>
	<div id="section-promo-blue-wrap">
		<img  src="<?php echo base_url(); ?>images/promo-ads-biru.png" alt="" style="margin-top: 50px;" />
	</div>
</div>
</div>
</div>

<div id="section-kelas">
	<div id="kelas-wrap"><br>
		<h1 class="text-24 orange">Kelas Pilihan di <strong>Kelas.</strong>Ruangguru</h1><br>
			<div id="content-kelas-pilihan">
	            <!-- ajax -->
            </div>
            <div class="col-sm-4 col-sm-offset-4">
                <a href="//kelas.ruangguru.com/kelas" class="button button-cancel" style=" display: inline-block; font-size: 16px;  color: #000 !important;" target="_blank">Lihat Semua Kelas</a>
            </div>
        </div>
    </div> <!-- /container -->
			
	</div>
</div>

<div id="section-testi-baru">
		<div id="testi-baru-wrap">
			<h1><p class="text-24 bold" style="color:#9da340">Testimonial Untuk Ruangguru.com</p></h1><br>
			<div id="rg-features-wrap">
			<ul id="testi-baru">
				<li>
					<h2 style="font-size:18px; color:#9da340">Thanks to Ruangguru,<br>nilai IELTS saya melebihi target!</h2>
					<p style="font-size:13px; color:#939598;"><i>"Saya dapat guru IELTS yang tahu persis dengan kebutuhan saya. Penjelasannya elaboratif dan juga mudah dipahami."</i> </p>
					<img style="height: 130px;" src="<?php echo base_url().'images/testimoni/rusydan.png';?>" />
					<br><br><p style="font-size:13px; color:#939598;">Rusydan</p>
				</li>
				<li>
					<h2 style="font-size:18px; color:#9da340">Memberi harapan baru<br>bagi keluarga yang sibuk!</h2>
					<p style="font-size:13px; color:#939598;"><i>"Gurunya sepenuh hati mengajar, sangat efektif untuk membangkitkan semangat belajar anak Saya"</i> </p>
					<img style="height: 130px;" src="<?php echo base_url().'images/testimoni/tri.png';?>" />
					<br><br><p style="font-size:13px; color:#939598;">Tri Mumpuni</p>
				</li>
				<li>
					<h2 style="font-size:18px; color:#9da340">Cari, Pilih, dan Bayar Gurunya Mudah!</h2>
					<p style="font-size:13px; color:#939598;"><i>"Berkat Ruangguru.com, anak Saya jadi lebih mahir bermain terompet sekarang. Customer service nya top!"</i> </p>
					<img style="height: 130px;" src="<?php echo base_url().'images/testimoni/veronica.png';?>" />
					<br><br><p style="font-size:13px; color:#939598;">Veronica</p>
				</li>
			</ul>
		</div>
		</div>
</div>

<div id="section-liputan">
	<div id="liputan-wrap">
		<p>Seperti diliput di</p>
		<ul id="liputan-list">
			<li><a href="http://www.metrotvnews.com" rel=nofollow><img src="<?php echo base_url();?>images/logo_metrotv.png"  /></a></li>
			<li><a href="http://www.jawapos.com/" rel=nofollow><img src="<?php echo base_url();?>images/jpos-logo.png" /></a></li>
			<li><a href="http://www.techinasia.com/indonesia-jakarta-ruangguru-belva-devara-iman-usman-east-ventures-seed-funding-investment/" rel=nofollow><img src="<?php echo base_url();?>images/techinasia-logo.png" /></a></li>
			<li><a href="http://e27.co/indonesias-ruangguru-raises-seed-funding-to-scale-up-services-locally/" rel=nofollow><img src="<?php echo base_url();?>images/e27-logo.png" /></a></li>
			<li><a href="http://startupbisnis.com/startup-indonesia-ruangguru-situs-yang-memudahkan-pencarian-guru-privat-bagi-murid-mendapatkan-pendanaan-dari-east-ventures/" rel=nofollow><img src="<?php echo base_url();?>images/logo-startupbisnis.png"; /></a></li>
			<li><a href="http://www.dailysocial.net/post/marketplace-les-privat-ruangguru-peroleh-investasi-dari-east-ventures" rel=nofollow><img src="<?php echo base_url();?>images/ds-logo.png" /></a></li>
			<li><img src="<?php echo base_url();?>images/logo-bloomberg.png"/></li>
			<li><a class="fancybox-media" href="https://www.youtube.com/watch?v=-LyB7PlFQhE" rel=nofollow><img src="<?php echo base_url();?>images/logo-berita-satu.png"/></a></li>
			<li><a href="http://tekno.kompas.com/read/2014/08/21/09593947/Ruangguru.com.Memperoleh.Pendanaan.dari.East.Ventures?utm_source=WP&utm_medium=box&utm_campaign=Ktkwp" rel=nofollow><img src="<?php echo base_url();?>images/logo-kompas.png" /></a></li>
		</ul>
	</div>
</div>

</div>
</body>
</html>