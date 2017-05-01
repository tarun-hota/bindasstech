<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $title;?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo CSSPATH?>bootstrap.min.css">
<!--flaty css styles-->
<link rel="stylesheet" href="<?php echo CSSPATH?>flaty.css">
<link rel="stylesheet" href="<?php echo CSSPATH?>flaty-responsive.css">

<!-- include jquery library -->
  <script src="<?php echo JSPATH. 'jquery.min.js'; ?>"></script>

<!-- include bootstrap js file -->
  <script src="<?php echo JSPATH. 'bootstrap.min.js'; ?>"></script>

</head>

<body>
<div class="#main-wrapper">
  <div class="wrapper-in">
    <div class="body-warpin">
      <div class="login-form-section">
        <div class="login-top-logo"><img src="<?php echo IMAGEPATH; ?>logo12.png" alt="logo"/></div>
        <div class="login-fildbox">

          <!-- hidden field data to get in login.js page -->
          <input type="hidden" id="base_url" value="<?= base_url() ?>">
          <input type="hidden" id="csrf" csrftokenname="<?php echo $this->security->get_csrf_token_name()?>" csrftokenhash="<?php echo $this->security->get_csrf_hash() ?>">

          <div class="login-details-text" id="details_text">Please enter your login details</div>
            <div class="login-fildbox-section">
              <div class="login-fildbox-in" id="login_section">
                <div id="errorMsg" style="display:none; color: #a64240;">Invalid username or password.<br><br></div>
                <div class="user-name">
                  <input type="text" id="username" class="usernamefild" placeholder="Username">
                </div>
                <div class="password">
                  <input type="password" id="password" class="passwordtypefild" placeholder="password">
                </div>
                <div class="login-btn-section">
                  <div class="login-btn" id="login_btn">
                    <img src="<?php echo IMAGEPATH; ?>login-btn.png"/>
                  </div>
                  <div class="login-checkbox">
                    <div class="check-btn">
                      <input type="checkbox">
                    </div>
                    <div class="check-btn-text">Remember me next time<br/>
                      Forgot passwoprd</div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <footer>
<p align="center"><?php echo date('Y');?> &copy; Rationing system.</p>
</footer>
</div>
</body>
</html>

<!-- include js file -->
<script src="<?php echo JSPATH. 'site/login.js?ver='. JSVERSION; ?>" ></script>
