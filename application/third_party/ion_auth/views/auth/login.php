<div id="infoMessage"><?php echo $message;?></div>

<div class="row">
  <div class="col-sm-4 col-sm-offset-4">
    <div class="text-center" id="login-header">
      <h1><img alt="Mediatik" src="<?= $app_logo_url ?>" height="50" width="50" class="logo" /> <?= $app_name ?></h1>
    </div>

    <div class="page-header">
      <h3>Login</h3>
    </div>
<?php echo form_open("auth/login");?>

  <div class="form-group">
    <?php echo form_input($identity, "",
      array(
      "class" => "form-control",
      "placeholder" => "e-mail",
    ));?>
  </div>

  <div class="form-group">
    <?php echo form_input($password, "", array(
    "class" => "form-control",
    "placeholder" => "password",
  ));?>
  </div>

<?php /*
  <div class="form-group">
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </div>
  */ ?>


  <div class="form-group">
    <?php echo form_submit('submit', lang('login_submit_btn'), array(
      "class" => "btn btn-primary btn-block"
    ));?>
  </div>

<?php echo form_close();?>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>

</div>
</div>

<div id="login-footer">Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
