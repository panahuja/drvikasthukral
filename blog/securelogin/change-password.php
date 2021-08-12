<?php include '../common.php'; ?><?php if(!isset($_SESSION['ADMIN_NAME'])){$f->redirect(APP_URL);exit();} ?>
   <?php
if(isset($_POST['submit']) && $_POST['submit'] == "Submit")
{
foreach($_POST as $key=>$value){$$key = $db->filter( $value );}
$getop=$db->num_rows("select password from admin where username ='".$_SESSION['ADMIN_NAME']."' and password='".md5($opassword)."'");
if($getop == 0){$msg = '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Old password should be correct.</div>';} else {
if($pass != $cpassword){$msg = '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> New password and confirm new password should be same</div>';} else {
$pass=md5($pass);
$q=$db->update('admin',array('password'=>$pass),array('username'=>$_SESSION['ADMIN_NAME']));
$msg = '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Password changed successfully!.</div>';
}}}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Change Password</title>
<?php include "head.php"; ?>
</head>
 <body class="skin-black">
 
<?php include 'theme-changer.php'; ?>
<?php include 'top-bar.php'; ?>
<!-- BEGIN Container -->
<div class="container" id="main-container">
  <?php include 'left.php'; ?>
  <!-- BEGIN Content -->
  <div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
      <div>
        <h1><i class="fa fa-cog"></i> Change Password</h1>
      </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php APP_URL; ?>welcome.php">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active">Change Password</li>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Tiles -->
     
    <?php if(isset($msg)){ echo $msg;}?>
      
    <div class="row">
                    <div class="col-md-12">
                        <div class="box box-black">
                            <div class="box-title">
                                <h3><i class="fa fa-bars"></i>Change Password</h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                        

                             <form action="" method="post" class="form-horizontal form-bordered form-row-stripped">
                              
                                    <div class="form-group">
                                        <label for="textfield5" class="col-sm-3 col-lg-2 control-label"> Old Password </label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                           <input type="password" name="opassword" id="opassword" class="form-control" data-rule-required="true"  />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password5" class="col-sm-3 col-lg-2 control-label">  New Password </label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="password" name="pass" id="pass" class="form-control" data-rule-required="true"  />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="textarea5" class="col-sm-3 col-lg-2 control-label">  Confirm New Password</label>
                                        <div class="col-sm-9 col-lg-10 controls">
                                            <input type="password" name="cpassword" id="cpassword" class="form-control" data-rule-required="true"  />
                                        </div>
                                    </div>
                                    
                                    <div class="form-group last">
                                        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                           <button type="submit" class="btn btn-primary" value="Submit" name="submit"><i class="fa fa-check"></i> Save</button>
                                           <button type="button" class="btn">Cancel</button>
                                        </div>
                                    </div>
                                 </form>
                            </div>
                        </div>
                    </div>
                </div>
    
    <!-- END Tiles -->
    <!-- BEGIN Main Content -->
    <!-- END Main Content -->
    <?php include 'bottom.php'; ?>
  </div>
  <!-- END Content -->
</div>
<!-- END Container -->
</body>
</html>
