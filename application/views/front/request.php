<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/main/request_guru" />
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="request_guru" class="maincontent">
        <table>
            <tr>
                <td>
                    <div class="maincontent-form">
                        <div class="maincontent-form-header">
                            <div class="maincontent-form-header-wrap">
                                REQUEST GURU 			 				
                            </div>
                        </div>
                        <?php foreach($request_guru->result() as $row):?>
                        <div class="maincontent-form-content">
                            <div class="blank" style="height: 20px;"></div>
                            <div class="sp20 left">
                                <h2 class="no-margin fcrgs3 fffo fs1p2"><?php echo $row->request_guru_home_title;?></h2>
                                <span class="fs0p8">
							Diinput tanggal: <?php echo date("j/n/Y", strtotime($row->request_guru_home_date));?><br/><b><?php echo $row->lokasi_title;?></b>
                                </span>
                                <p class="fs0p8 ">
                                    <?php echo $row->request_guru_home_text;?>
                                </p>
						  <div class="fs0p8 right">
							<span class="fs0p9 left">Status: <?php if($row->request_guru_home_active == 0){ echo "Sudah tidak tersedia";} else { echo "Tersedia";}?></span>&nbsp;
							<?php if($row->request_guru_home_active == 1){ ?>
								|&nbsp;&nbsp;<a href="<?php echo base_url().'profile/lamar_request/'.$row->request_guru_home_id;?>" class="normal-link">Lamar lowongan ini</a>&nbsp;|&nbsp;<a href="<?php echo base_url().'guru';?>" class="normal-link">Daftar jadi guru untuk lowongan ini</a>
							<?php	} ?>
						  </div>
                                <div class="blank" style="height: 20px;border-bottom: 1px solid #d2d2d2;"></div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <div class="_blank" style="height: 20px;"></div>
				<div id="page-request-guru"><?php echo $pagination;?>
                </td>
                <td>
                    <?php $this->load->view('front/layout/contact');?>
                    <div class="blank" style="height: 20px;"></div>
                    <div class="social-side-box">
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fruanggurucom&amp;width=300&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false&amp;appId=151390271591966" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:290px;" allowTransparency="true"></iframe>
                    </div>
                    <div class="blank" style="height: 20px;"></div>
                    <div class="social-side-box">
                        <a class="twitter-timeline"  href="https://twitter.com/ruangguru"  data-widget-id="371164555830779904"></a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</body>
</html>