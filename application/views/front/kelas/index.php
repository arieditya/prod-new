<html>
<head>
<title>Galeri Kelas</title>
<meta name="description" content="Dengan tagline 'Belajar Apapun dari Siapapun', Ruangguru merupakan portal dimana kamu bisa mencari atau menjadi guru di Indonesia. Ini mekanisme dan kriterianya." />
<link rel="canonical" href="http://www.ruangguru.com/kelas" />

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

</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="teacher-driven">
          <div id="teacher-driven-wrap">
               <div id="bf-header">
                    <div id="bf-header-wrap">
                         KELAS RUANGGURU
                    </div>
               </div>
          <div id="bf-content">
               <div class="blank" style="height: 20px;"></div>
                    <div class="bfc-wrap">
                         <div class="bfc-title">
						<table id="class-list">
							<?php $n=1;?>
							<tr>
							<?php foreach($kelas->result() as $k){ ?>
								<?php $id = md5($k->kelas_guru_id);
									$hash_id = substr($id,0,2).substr($id,30,32).$k->kelas_guru_id;
								?>
								<?php if(!empty ($k->kelas_guru_image)){ ?>
								<td><a href="<?php echo base_url().'kelas/detil/'.$hash_id;?>"><img src="<?php echo base_url().'images/class/'.$k->kelas_guru_image;?>" height="200px"/></a>
								<?php } else { ?>
								<td><a href="<?php echo base_url().'kelas/detil/'.$hash_id;?>"><img src="<?php echo base_url().'images/default_profile_image.png';?>" height="200px"/></a>
								<?php } ?>
								<a href="<?php echo base_url().'kelas/detil/'.$hash_id;?>" class="normal-link"><p class="center"><?php echo $k->kelas_guru_nama;?></p></a><br/>
							<?php	if((($n%3) == 0) && ($n<$kelas->num_rows())){  ?>
								</td>
								</tr>
								<tr>
							<?php	} 
								$n++;	
									} ?>
							</tr>
						</table>
                    </div>
               </div>
          </div>
          </div>
    </div>
</div>
<div class="blank" style="height:310px;"></div>
</body>
=======
<html>
<head>
<title>Kelas Terbuka</title>
<meta name="description" content="Dengan tagline 'Belajar Apapun dari Siapapun', Ruangguru merupakan portal dimana kamu bisa mencari atau menjadi guru di Indonesia. Ini mekanisme dan kriterianya." />
<link rel="canonical" href="http://www.ruangguru.com/kelas" />

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

</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="teacher-driven">
          <div id="teacher-driven-wrap">
               <div id="bf-header">
                    <div id="bf-header-wrap">
                         KELAS RUANGGURU
                    </div>
               </div>
          <div id="bf-content">
               <div class="blank" style="height: 20px;"></div>
                    <div class="bfc-wrap">
                         <div class="bfc-title">
						<table id="class-list">
							<?php $n=1;?>
							<tr>
							<?php foreach($kelas->result() as $k){ ?>
								<?php $id = md5($k->kelas_guru_id);
									$hash_id = substr($id,0,2).substr($id,30,32).$k->kelas_guru_id;
								?>
								<?php if(!empty ($k->kelas_guru_image)){ ?>
								<td><a href="<?php echo base_url().'kelas/detil/'.$hash_id;?>"><img src="<?php echo base_url().'images/class/'.$k->kelas_guru_image;?>" height="200px"/></a>
								<?php } else { ?>
								<td><a href="<?php echo base_url().'kelas/detil/'.$hash_id;?>"><img src="<?php echo base_url().'images/default_profile_image.png';?>" height="200px"/></a>
								<?php } ?>
								<a href="<?php echo base_url().'kelas/detil/'.$hash_id;?>" class="normal-link"><p class="center"><?php echo $k->kelas_guru_nama;?></p></a><br/>
							<?php	if((($n%3) == 0) && ($n<$kelas->num_rows())){  ?>
								</td>
								</tr>
								<tr>
							<?php	} 
								$n++;	
									} ?>
							</tr>
						</table>
                    </div>
               </div>
          </div>
          </div>
    </div>
</div>
<div class="blank" style="height:310px;"></div>
</body>
>>>>>>> .r88
</html>