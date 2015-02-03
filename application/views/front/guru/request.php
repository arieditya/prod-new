<div id="content">
    <div id="content-wrap">
        <div class="blank" style="height: 30px;"></div>
        <div id="request-guru">
            <div id="request-guru-header">
                <div id="request-guru-header-wrap">
                    REQUEST
                </div>
            </div>
            <div id="request-guru-content" class="guru-content">
                <div class="blank" style="height: 20px;"></div>
                <?php if($this->session->flashdata('request_notif')):?>
                <div class="request-notif">
                    <?php echo $this->session->flashdata('request_notif');?>
                </div>
                <?php endif;?>
                <div id="request-guru-list">
                    <?php foreach($request->result() as $row):?>
                    <div style="margin-bottom: 10px;">
                        <?php var_dump($this->guru_model->get_request_by_id($row->request_id));?>
                    </div>
                    <?php endforeach;?>
                </div>
                <div class="blank" style="height: 20px;"></div>
            </div>
            <div class="blank" style="height: 10px;"></div>
        </div>
        <div class="blank" style="height: 30px;"></div>
    </div>
</div>