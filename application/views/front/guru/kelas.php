<script src="<?php echo base_url(); ?>js/bantuan.js" type="text/javascript" charset="utf-8"></script>
<div id="content">
    <div class="blank" style="height:30px;"></div>
    <div id="bantuan-rating">
        <table>
            <tr>
                <td>
                    <div id="bantuan-faq">
                        <div id="bf-header">
                            <div id="bf-header-wrap">
                                KELAS
                            </div>
                        </div>
                        <div id="bf-content">
                            <div class="blank" style="height: 20px;"></div>
                            <div class="bfc-wrap">
                                <div class="bfc-title">
								Berikut adalah kelas terbuka yang dapat Anda hadiri. Silahkan mendaftarkan diri Anda untuk mengikuti kelas ini.<br/><br/>
								<table>
									<tr>
										<td class="bold">Kelas</td>
										<td>: </td>
										<td><?php echo $kelas->kelas_guru_nama; ?></td>
									</tr>
									<tr>
										<td class="bold">Penyelenggara</td>
										<td>: </td>
										<td><?php echo $guru->guru_nama; ?></td>
									</tr>
									<tr>
										<td class="bold">Deskripsi Kelas</td>
										<td>: </td>
										<td><?php echo $kelas->kelas_guru_deskripsi; ?></td>
									</tr>
									<tr>
										<td class="bold">Lokasi</td>
										<td>: </td>
										<td><?php echo $kelas->kelas_guru_lokasi; ?></td>
									</tr>
									<tr>
										<td class="bold">HTM</td>
										<td>: </td>
										<td><?php echo 'Rp '.$kelas->kelas_guru_harga.',-'; ?></td>
									</tr>
									<tr>
										<td class="bold">Tanggal Acara</td>
										<td>: </td>
										<td><?php echo $kelas->kelas_guru_tanggal_mulai.' s/d '.$kelas->kelas_guru_tanggal_selesai; ?></td>
									</tr>
									<tr>
										<td class="bold">Jam</td>
										<td>: </td>
										<td><?php echo $kelas->kelas_guru_jam_mulai.' - '.$kelas->kelas_guru_jam_selesai;?></td>
									</tr>
									<tr><td>&nbsp;</td></tr>
									<tr>
										<td>
											<?php if($this->session->userdata('murid_id')){ ?>
												<a href="<?php echo base_url().'guru/daftar_kelas/'.$kelas->kelas_guru_id.'/'.$this->session->userdata('murid_id');?>" class="diy-button-mini">Murid Ruangguru</a>
											<?php } else { ?>
												<a href="<?php echo base_url().'guru/daftar_kelas/'.$kelas->kelas_guru_id;?>" class="diy-button-mini">Murid Ruangguru</a>
											<?php } ?>
										</td>
										<td>&nbsp;</td>
										<td><a href="<?php echo base_url().'murid/daftar';?>" class="diy-button-mini">Bukan Murid Ruangguru</a></td>
										<td>&nbsp;</td>
									</tr>
								</table>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <?php $this->load->view('front/layout/contact');?>
                    <div class="blank clear" style="height: 20px;"></div>
                    <div class="social-side-box">
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fruanggurucom&amp;width=300&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false&amp;appId=151390271591966" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:290px;" allowTransparency="true"></iframe>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="blank" style="height:30px;"></div>
</div>