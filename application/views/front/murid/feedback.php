<script src="<?php echo base_url(); ?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $("#feedback-form").validationEngine('attach');
});
</script>
<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="registrasi-murid">
            <div id="registrasi-murid-header">
                <div id="registrasi-murid-header-wrap">
                    FEEDBACK
                </div>
            </div>
            <div id="registrasi-murid-content" class="murid-content">
                <?php if ($this->session->flashdata('edit_kelas_feedback')): ?>
                    <div class="blank" style="height: 20px;"></div>    
                    <div class="profile-notif" style="margin-left:20px;">
                        <?php echo $this->session->flashdata('edit_kelas_feedback'); ?>
                    </div>
                <?php endif; ?>
                <div class="blank" style="height: 20px;"></div>
                <div class="center">
                    <table id="profile-rating-table" style="width: 95%;margin: 0 auto;" >
                        <thead>
                            <tr style="background-color: #99d6e4;color:#FFFFFF;">
                                <td style="width: 50%">
                                    <span class="bold">NAMA GURU :</span> <?php echo $kelas->guru_nama;?><br/>
                                    <span class="bold">MATA PELAJARAN :</span> <?php echo $kelas->matpel_title;?>
                                </td>
                                <td style="width: 50%" class="right">
                                    <span class="bold">JADWAL MULAI :</span> <?php echo date("l, j F Y", strtotime($kelas->kelas_mulai));?><br/>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="blank" style="height: 20px;"></div>
                <form id="feedback-form" class="guru-form" action="<?php echo base_url(); ?>murid/kelas_feedback_submit" method="post">
                    <table>
                        <?php $question_number = 0;?>
                        <?php foreach($feedback_question->result() as $row):?>
                        <tr>
                            <td colspan="99">
                                <div class="registrasi-guru-st">
                                    <?php echo ++$question_number.'. '.$row->feedback_question_title;?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <?php foreach($this->kelas_model->get_feedback_answer($row->feedback_question_id)->result() as $item):?>
                            <td style="width: 20px;">
                                <input id="answer[<?php echo $row->feedback_question_id;?>]" 
                                       type="radio" name="answer[<?php echo $row->feedback_question_id;?>]" 
                                       value="<?php echo $item->feedback_answer_id;?>" 
                                       class="validate[required]"/>
                            </td>
                            <td style="width: 160px;">
                                <?php echo $item->feedback_answer_title;?>
                            </td>
                            <?php endforeach;?>
                        </tr>
                        <?php endforeach;?>
                        <tr>
                            <td colspan="99">
                                <div class="registrasi-guru-st">
                                    <?php echo ++$question_number.'. ';?> TESTIMONI UNTUK GURU
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>
                                    Maksimum karakter : 75 
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="99">
                                <textarea class="text" name="testimoni" style="width: 600px;height:200px;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="blank" style="height:20px;"></div>
                                <input type="hidden" name="kelas_id" value="<?php echo $kelas->kelas_id;?>"/>
                                <input type="image" src="<?php echo base_url(); ?>images/simpan-button.png"/>
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="blank" style="height: 20px;"></div>
            </div>
        </div>
        <div class="blank" style="height: 30px;"></div>
    </div>
</div>