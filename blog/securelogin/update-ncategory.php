<?php include '../common.php';  if(!isset($_SESSION['ADMIN_NAME'])){$f->redirect(APP_URL);exit();} ?>

<?php

if(isset($_POST['submit']) && $_POST['submit'] == "Submit")
{
foreach($_POST as $key=>$value){$$key = $db->filter( $value );}
if($cName != '') {
$checkExists = $db->num_rows("SELECT cUrl FROM newscategory WHERE cUrl = '".$cUrl."' AND cid != '".$_GET['ref']."' ");
if($checkExists==0){
if(isset($cStatus) && $cStatus=='Enable'){$cStatus='Enable';}else{$cStatus='Disable';} 
$update = $db->update('newscategory',array('cUrl'=>$f->seourl($cUrl),'cName' => $cName,'cStatus'=>$cStatus),array('cid'=>$_GET['ref']));
$msg= '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Updated Successfully</div>';
}else {$msg= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Failed!</strong> URL already exist</div>';}
}
}


 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Update Category</title>
<?php include "head.php"; ?>
</head>
<body>
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
        <h1><i class="fa fa-list"></i> Update Category</h1>
      </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php APP_URL; ?>welcome.php">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li> <a href="<?php APP_URL; ?>ncategory.php">Categories</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active">Update Category</li>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Tiles -->
    <?php if(isset($msg)){ echo $msg;}?>
    <?php $get=$db->get_row("Select * from newscategory where cid='".$_REQUEST['ref']."'"); ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-black">
          <div class="box-title">
            <h3><i class="fa fa-bars"></i>Update Category</h3>
            <div class="box-tool"> <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a> </div>
          </div>
          <div class="box-content">
            <form action="" class="form-horizontal form-bordered form-row-stripped" method="post" enctype="multipart/form-data" onSubmit="return Validate(this);">
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Title</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <input type="text" name="cName" id="cName" required class="form-control" value="<?php echo $get['cName']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">URL</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <input type="text" name="cUrl" id="cUrl" required class="form-control" value="<?php echo $get['cUrl']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Status</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <div class="make-switch switch-large">
                    <input type="checkbox" name="cStatus" value="Enable" <?php if($get['cStatus'] == 'Enable' ){ echo 'checked';} ?>  />
                  </div>
                </div>
              </div>
              <div class="form-group last">
                <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                  <button type="submit" name="submit" value="Submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
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
