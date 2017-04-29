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
</head>

<body>
<div class="#main-wrapper">
  <div class="wrapper-in">
    <div class="body-warpin">
      <div class="login-form-section">
        <div class="login-top-logo"><img src="<?php echo base_url()?>27e93e32-9c96-4b50-a29a-53148f805197/images/logo12.png" alt="logo"/></div>
        <div class="login-fildbox">
          <div class="login-details-text">Please enter your login details</div>
          <div class="login-fildbox-section">
            <div class="login-fildbox-in">
              <div class="user-name">
                <input type="text" value="" class="usernamefild" placeholder="Username">
              </div>
              <div class="password">
                <input type="password" value="" class="passwordtypefild" placeholder="password">
              </div>
              <div class="login-btn-section">
                <div class="login-btn"><img src="<?php echo base_url()?>27e93e32-9c96-4b50-a29a-53148f805197/images/login-btn.png"/></div>
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
