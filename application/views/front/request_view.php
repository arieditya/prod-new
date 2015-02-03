<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/main/view_request_guru" />
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
                        <div class="maincontent-form-content">
                            <div class="blank" style="height: 20px;"></div>
                            <div class="sp20 justify">
                                <h2 class="no-margin fcrgs3 fffo fs1p2"><?php echo $request_guru->request_guru_home_title;?></h2>
                                <span class="fs0p8">
                                   Diinput tanggal: <?php echo date("j/n/Y", strtotime($request_guru->request_guru_home_date));?><br/><b><?php echo $request_guru->lokasi_title;?></b>
                                </span>
                                <p class="fs0p8">
                                    <?php echo $request_guru->request_guru_home_text;?>
                                </p>
						  <div class="fs0p8 right">
							<span class="fs0p9 left">Status: <?php if($request_guru->request_guru_home_active == 0){ echo "Sudah tidak tersedia";} else { echo "Tersedia";}?></span>&nbsp;
							<?php if($request_guru->request_guru_home_active == 1){ ?>
								|&nbsp;&nbsp;<a href="<?php echo base_url().'profile/lamar_request/'.$request_guru->request_guru_home_id;?>" class="normal-link">Lamar lowongan ini</a>&nbsp;|&nbsp;<a href="<?php echo base_url().'guru';?>" class="normal-link">Daftar jadi guru untuk lowongan ini</a>
							<?php	} ?>
						  </div>
                            </div>
                        </div>
                    </div>
                    <div class="_blank" style="height: 20px;"></div>
                </td>
                <td>
                    <?php $this->load->view('front/layout/contact');?>
                </td>
            </tr>
        </table>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</body>
</html>