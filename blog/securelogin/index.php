<?php include '../common.php';
if(isset($_POST['submit']) && $_POST['submit'] == 'Login'){
	foreach($_POST as $key=>$value) {
		if($value != '') $$key = str_replace("'","&prime;",$value);
	}
	$password = md5($upass);
	$sql = "SELECT count(id) as total, username FROM admin WHERE username = '".$uname."' AND password = '".$password."' ";
	$rows = $db->get_results($sql);
	foreach($rows as $row){
	if($row['total']=='1'){
	$_SESSION['ADMIN_NAME'] = $row['username'];
	$_SESSION['auth']='1';
	$f->redirect(APPC_URL.'welcome.php');
	}else{
	$msg = '<p style="background-color:#FF0000; padding:5px; color:#FFFFFF; text-align:center; font-weight:bold;">Authentication Failure</p>';
	}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Login - Admin Panel</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<!--base css styles-->
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
<!--page specific css styles-->
<!--flaty css styles-->
<link rel="stylesheet" href="css/flaty.css">
<link rel="stylesheet" href="css/flaty-responsive.css">
<link rel="shortcut icon" href="img/favicon.png">
</head>
<body class="login-page">
<!-- BEGIN Main Content -->
<div class="login-wrapper" >
  <!-- BEGIN Login Form -->
  <form id="form-login" action="<?php APPC_URL?>" method="post" >
    <div align="center"><img title="Admin Logo" alt="Admin Logo" src="<?php APPC_URL?>images/logo.png"></div>
    <h3 style="color:#002e63; padding:10px 0 ">Administrator Login</h3>
    <hr/>
    <?php if(isset($msg)){ echo $msg;}?>
    <div class="form-group">
      <div class="controls">
        <input type="text"  name="uname" id="username" placeholder="Username" class="form-control" title="Username" />
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
        <input type="password"  name="upass" id="password" placeholder="Password" class="form-control" title="Password" />
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
        <button style="background-color:#3592cb;" name="submit" value="Login" type="submit" class="btn btn-primary form-control" title="Login">LOGIN</button>
      </div>
    </div>
    <hr/>
  </form>
  <!-- END Login Form -->
</div>
<!-- END Main Content -->
<!--basic scripts-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="assets/jquery/jquery-2.0.3.min.js"><\/script>')</script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
            function goToForm(form)
            {
                $('.login-wrapper > form:visible').fadeOut(500, function(){
                    $('#form-' + form).fadeIn(500);
                });
            }
            $(function() {
                $('.goto-login').click(function(){
                    goToForm('login');
                });
                $('.goto-forgot').click(function(){
                    goToForm('forgot');
                });
                $('.goto-register').click(function(){
                    goToForm('register');
                });
            });
        </script>
</body>
</html>
