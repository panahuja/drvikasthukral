<?php include '../common.php';  if(!isset($_SESSION['ADMIN_NAME'])){$f->redirect(APP_URL);exit();} ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Dashboard - Blog Admin</title>
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
        <h1><i class="glyphicon glyphicon-home"></i> Dashboard - Blog Admin</h1>
      </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li class="active"><i class="fa fa-home"></i> Home</li>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN First Row -->
    <!-- END First Row -->
    <!-- BEGIN Second Row -->
    <div class="row">
      <div class="col-md-3">
        <div class="tile tile-red">
          <p class="title" style="margin-top:20px;"><a href="<?php echo APPC_URL; ?>article.php" style="color:#FFFFFF;">Articles</a></p>
          <div class="img img-bottom"> <i class=""></i> </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="tile tile-red">
          <div class="img img-center"> </div>
          <p class="title text-center"><a href="<?php echo APPC_URL; ?>ncategory.php" style="color:#FFFFFF;">Categories</a></p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="tile tile-red">
          <div class="img img-center"> </div>
          <p class="title text-center"><a href="<?php echo APPC_URL; ?>tag.php" style="color:#FFFFFF;">Tags</a></p>
        </div>
      </div>
    </div>
    <!-- END Second Row -->
    <!-- BEGIN Third Row -->
    <!-- END Third Row -->
    <?php include 'bottom.php'; ?>
  </div>
  <!-- END Content -->
</div>
<!-- END Container -->
</body>
</html>
