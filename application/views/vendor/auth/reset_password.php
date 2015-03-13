<?php
/**
 * Created by :
 *
 * User: Saqib
 * Date: 3/13/15
 * Time: 3:35 PM
 * Proj: prod-new
 */
$this->load->view('vendor/general/header2');
?>
<div class="container content">
    <div class="row">
        <div class="col-sm-6 log-reg">
            <div class="panel panel-default panel-big">
                <div class="panel-heading heading-label">Reset Password Vendor</div>
                <div class="panel-body">
                    <form class="form-horizontal"
                          role="form"
                          action="<?php echo base_url();?>vendor/auth/reset_password_submit"
                          method="post">
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       id="login_email"
                                       placeholder="Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default main-button register">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- panel -->
        </div><!-- col-sm-6 -->
    </div>
</div> <!-- /container -->

<?php
$this->load->view('vendor/general/footer2');
