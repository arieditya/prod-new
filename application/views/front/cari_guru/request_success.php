<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
    function update_matpel(){
        id=$("#jenjangP").val();
        $.getJSON(base_url+"cari_guru/get_matpel/"+id,function(data){
            html = '<div class="bs-left">';i=1;
            $.each(data,function(i,item){
                if((i%6)==0 && i!=0){html+='</div><div class="bs-left">';}
                html+= '<div class="bs-row">';
                html+= '<input type="checkbox" name="matpel[]" value="'+item.matpel_id+'"/>'+item.matpel_title;
                html+= '</div>';i++;
            });
            html+= '</div>';$(".bidang-studi-wrap").html(html);
        })
    }
    $(document).ready(function(){
        $("#request-guru-form").validationEngine('attach');
    }); 
</script>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height:30px;"></div>
        <?php echo $progress;?>
        <div class="blank" style="height:30px;"></div>
        <table width="100%" id="request-guru">
            <tr>
                <td id="request-left">
                    <div id="request">
                        <div id="request-header">
                            <div id="request-header-wrap">
                                3. PESAN GURU
                            </div>
                        </div>
                        <div id="request-content">
                            <div class="blank" style="height:20px;"></div>
                            <div id="request-success">
                                <p>
                                    Pemesanan anda telah berhasil dimasukkan kedalam sistem, anda dapat melihat perkembangan permintaan anda melalui menu "Track Request" dengan memasukkan kode request yang telah kami kirimkan ke email anda.
                                </p>
                                <p>&nbsp;</p>
                            </div>
                        </div>
                    </div>
                    <div class="blank" style="height:30px;"></div>
                </td>
                <td id="request-right">
                    <div id="pemesanan-guru">
                        <div id="pg-header">
                            <div id="pg-header-wrap">
                                PEMESANAN GURU
                            </div>
                        </div>
                        <div id="pg-content">
                            <div class="blank" style="height: 20px;"></div>
                            <p>
                                <span class="bold">Bagaimana cara memesan guru?</span><br/>
                                Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting.
                            </p>
                            <p>
                                <span class="bold">Lorem Ipsum telah menjadi standar</span><br/>
                                contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf.
                            </p>
                            <p>
                                Med do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                        </div>
                    </div>
                    <div class="blank" style="height: 20px;"></div>
                    <div id="contact-info-request">
                        <div id="contact-info-header">
                            <div id="contact-info-header-wrap">
                                CONTACT US
                            </div>
                        </div>
                        <div id="contact-info-content">
                            <div class="blank" style="height: 20px;"></div>
                            <div class="cicc-p">
                                <p>Sudah merupakan fakta bahwa ada seorang pembaca akan terpengaruh oleh isi tulisan dari sebuah halaman saat ia melihat tata letaknya.</p>
                                <p>Telepon :  +62818807277</p>
                                <p>Email : custservice@ruangguru.com</p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
