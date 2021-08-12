<?php include '../common.php';  if(!isset($_SESSION['ADMIN_NAME'])){$f->redirect(APP_URL);exit();} ?>

<?php
if(isset($_POST['submit']) && $_POST['submit'] == "Submit")
{
foreach($_POST as $key=>$value){$$key = $db->filter( $value );}
if($cName != '') {

$cUrl=$f->seourl($cName);
$checkExists = $db->num_rows("SELECT cUrl FROM tags WHERE cUrl = '".$cUrl."'");
if($checkExists==0){

$num= $db->num_rows("SELECT corder FROM tags");
$corder=$num+1;
$add_query = $db->insert('tags',array('cUrl'=>$f->seourl($cName),'cName' => $cName,'corder'=>$corder));
$msg= '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Added Successfully</div>';
}else {$msg= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Failed!</strong> Already exist</div>';}

}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Add New Tag</title>
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
        <h1><i class="fa fa-list"></i> Add New Tag</h1>
      </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php APP_URL; ?>welcome.php">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li> <a href="<?php APP_URL; ?>tag.php">Tags</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active">Add New Tag</li>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Tiles -->
    <?php if(isset($msg)){ echo $msg;}?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-black">
          <div class="box-title">
            <h3><i class="fa fa-bars"></i> Add New Tag</h3>
            <div class="box-tool"> <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a> </div>
          </div>
          <div class="box-content">
            <form action="" class="form-horizontal form-bordered form-row-stripped" method="post" enctype="multipart/form-data" onSubmit="return Validate(this);">
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Title</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <input type="text" name="cName" id="cName"  class="form-control" required>
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
