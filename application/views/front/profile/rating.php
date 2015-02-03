<html>
<head>
<link rel="canonical" href="http://www.ruangguru.com/profile/rating" />
</head>
<body>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="profile-guru-wrap">
        <?php echo $menu;?>
        <div id="profile-guru">
            <div id="profile-guru-header">
                <div id="profile-guru-header-wrap">
                    RATING GURU
                </div>
            </div>
            <div id="profile-guru-content">
                <div id="pgc-wrap">
                    <div class="pgc-section">
                        <div id="profile-rating-left">
                            <p id="profile-rating-title">
                                Rating Anda Saat Ini :
                            </p>
                            <p>
                                Silahkan baca penjelasan lebih lanjut mengenai mekanisme rating guru <a href="<?php echo base_url()."guru/panduan_rating"?>">di sini</a>.
                            </p>
                        </div>
                        <div id="profile-rating-right">
                            <p><?php $rate = $this->guru_model->get_rating_by_feedback($guru->guru_id);  
								$rate2 = $this->guru_model->get_calculated_rating($guru->guru_id);
								echo ($rate+$rate2); ?>
						</p>
                        </div>
                        <div class="_blank" style="width:90px;height: 90px;float:left">
                        </div>
                        <div class="clear"></div>
                        <div class="blank" style="border-bottom: 1px solid #dddddd;height: 15px;"></div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Daftar Kualifikasi Anda Saat Ini</span>
                        </div>
                        <div class="content">
                            <table id="profile-rating-table">
                                <thead>
                                    <th>JENIS KUALIFIKASI</th>
                                    <th class="center">POIN BONUS</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Lulusan SMA</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_sma==0)?0:1;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lulusan Diploma</td>
                                        <td>
                                            <?php switch($guru->guru_rating_diploma){
                                                case 0 : echo '0';break;
                                                case 1 : echo '1';break;
                                                case 2 : echo '2';break;
                                                case 3 : echo '3';break;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lulusan S1 UI/ UGM/ ITB/ PT Luar Negeri</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_s1_top==0)?'0':'1';?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lulusan S1</td>
                                        <td>
                                            <?php switch($guru->guru_rating_s1){
                                                case 0 : echo '0';break;
                                                case 1 : echo '2';break;
                                                case 2 : echo '3';break;
                                                case 3 : echo '4';break;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lulusan S2 UI/ UGM/ ITB/ PT Luar Negeri</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_s2_top==0)?'0':'1';?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lulusan S2</td>
                                        <td>
                                            <?php switch($guru->guru_rating_s2){
                                                case 0 : echo '0';break;
                                                case 1 : echo '3';break;
                                                case 2 : echo '4';break;
                                                case 3 : echo '5';break;
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lulusan S3 UI/ UGM/ ITB/ PT Luar Negeri</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_s3_top==0)?'0':'1';?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lulusan S3</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_s3==0)?'0':'6';?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Beasiswa saat kuliah</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_beasiswa==0)?'0':'1';?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sertifikat Pelatihan</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_sertifikat==0)?'0':'2';?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nilai TOEFL IBT</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_toefl_ibt==0)?'0':'1';?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nilai TOEFL ITP</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_toefl_itp==0)?'0':'1';?>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nilai IELTS</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_ielts==0)?'0':'1';?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nilai GRE</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_gre==0)?'0':'1';?>   
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nilai GMAT</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_gmat==0)?'0':'1';?>    
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nilai CFA</td>
                                        <td>
                                            <?php echo ($guru->guru_rating_cfa==0)?'0':'1';?>   
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pgc-section">
                        <div class="header">
                            <span>Daftar Feedback Dari Murid</span>
                        </div>
				    <p class="text-13">Admin akan mengisi pengalaman mengajar Anda setelah Anda mengunakan Ruangguru dan mengajar selama 3 bulan atau lebih</p>
                        <div class="content">
				    	 <?php if($kelas->num_rows() > 0){ ?>
					 <?php foreach($kelas->result() as $k){ ?>
						<div class="bg-kelas-rating">
							<p><strong>ID Kelas</strong>: <?php echo $k->kelas_id;?></p>
							<p><strong>Mata Pelajaran</strong>: <?php echo $k->matpel_title;?></p>
							<p><strong>Tingkat</strong>: <?php echo $k->jenjang_pendidikan_title;?></p>
						</div>
                            <table id="profile-feedback-table">
                                <thead>
                                    <th class="center">FEEDBACK</th>
                                    <th class="center">POIN BONUS</th>
                                </thead>
                                <tbody>	    
							<?php $feedback = $this->kelas_model->get_feedback_by_kelas_id($k->kelas_id);?>
							<?php if($feedback->num_rows > 0){ ?>
							<?php foreach($feedback->result() as $feeds){ ?>
							<tr>
								<td><?php echo $feeds->feedback_question_title;?></td>
								<td  class="center">
									<?php $score = floatval($feeds->feedback_answer_score);
										$duration = intval($k->kelas_total_jam);
										if($feeds->feedback_answer_sort <= 3){
											$rate = -($score) * $duration;
										}else{
											$rate = $score * $duration;
										}
										echo $rate;
									?>
								</td>
							</tr>
							<?php } ?>
							<?php } else { ?>
                                    <tr>
                                        <td colspan="2">
                                            <span class="italic">Belum ada <i>feedback</i> dari murid Anda.</span>
                                        </td>
                                    </tr>
							<?php } ?>
                                </tbody>
                            </table>
					   <div class="blank" style="height:20px;"></div>
					   	<?php } ?>
						<?php } else { ?>
					      <table id="profile-feedback-table">
                                 <thead>
                                    <th class="center">FEEDBACK</th>
                                    <th class="center">POIN BONUS</th>
                                 </thead>
                                 <tbody>	    
                                    <tr>
                                        <td colspan="2">
                                            <span class="italic">Belum ada <i>feedback</i> dari murid Anda.</span>
                                        </td>
                                    </tr>
						    </tbody>
                               </table>
						<?php } ?>
                        </div>
                    </div>
                </div>
                <div class="clear" ></div>
                
            </div>
            <div class="blank" style="height:10px;"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>
</body>
</html>