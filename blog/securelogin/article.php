<?php include '../common.php';  if(!isset($_SESSION['ADMIN_NAME'])){$f->redirect(APP_URL);exit();} ?>

<!-- DELETE -->
<?php
if(isset($_REQUEST['delete']) && $_REQUEST['delete']!='delete')
{
$updated = $db->delete( 'press', array('pid' =>$_REQUEST['delete']));
$msg= '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Delete Successfully</div>';
}
if(isset($_POST['Submit']) && $_POST['Submit'] == "Delete")
{
foreach($_POST[idDelete] as $value){
$updated = $db->delete( 'press', array('pid' =>$value));
$msg= '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Delete Successfully</div>';
}
}
?>
<!-- DELETE -->
<!-- STATUS -->
<?php 
if(isset($_GET['unp_id']) && $_GET['unp_id']!='')
{
$updated = $db->update( 'press', array('pStatus' => 'Enable'),array('pid' =>$_GET['unp_id']));
}
if(isset($_GET['p_id']) && $_GET['p_id']!='')
{
$updated = $db->update( 'press', array('pStatus' => '0'),array('pid' =>$_GET['p_id']));
}
?>
<!-- STATUS  -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Articles</title>
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
        <h1><i class="fa fa-list"></i> Articles</h1>
      </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php APP_URL; ?>welcome.php">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active"> Articles</li>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    <?php if(isset($msg)){ echo $msg;}?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-black">
          <div class="box-title">
            <h3><i class="fa fa-table"></i> Articles</h3>
            <div class="box-tool"> <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a> </div>
          </div>
          <div class="box-content">
            <form name="form" id="form1" method="GET" action="" >
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"></label>
                <div class="col-sm-9 col-lg-10 controls">
                  <div class="input-group"> <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" placeholder="Search here..." class="form-control" value="<?php if(isset($_GET['keyword'])){echo $_GET['keyword'];} ?>" name="Keyword" >
                    <span class="input-group-btn">
                    <button class="btn btn-inverse" name="submit" value="Search" type="submit">Search</button>
                    </span> </div>
                </div>
              </div>
            </form>
            <br/>
            <br/>
            <br/>
            <div class="clearfix"></div>
            <div class="table-responsive" style="border:0">
              <form method="post" action="" enctype="" >
               
                <div style="clear:both;"></div>
                <table class="table table-advance" id="table1">
                  <thead>
                    <tr>
                      <th style="width:18px"><input type="checkbox" name="chkall" /></th>
                      <th>Image</th>
                      <th>Title </th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
					$Filter = "";
					if(isset($_GET['keyword'])){$Filter = (trim($_GET['Keyword']) != '')?" AND pTitle like '%".trim($_GET['Keyword'])."%' OR pDesc like '%".trim($_GET['Keyword'])."%'" : "";}
					$sql = "SELECT * FROM press WHERE pActive = 1 ".$Filter." ORDER BY pDateTime DESC  ";
					$Displaysql = $db->get_results($sql);
					$rowsPerPage = 100;
					$pageNum = 1;
					if(isset($_GET['page']))
					$pageNum = $_GET['page'];
					$offset = ($pageNum - 1) * $rowsPerPage;
					$pagingQuery = "LIMIT $offset, $rowsPerPage ";
					$Query = $db->get_results($sql.$pagingQuery);
					$numrows = $db->num_rows($sql);
					$maxPage = ceil($numrows/$rowsPerPage);
					$self="article.php?";
					$Serial = 1;
					if($numrows != 0){
					foreach($Query as $get ){ 
					?>
                    <tr class="table-flag-blue">
                      <td><input type="checkbox" name="idDelete[]" value="<?php echo $get['pid']; ?>" /></td>
                      <td><?php if($get['pPic']!='') { ?>
                        <img src="<?php echo APP_URL; ?>/uploads/<?php echo $get['pPic']; ?>" alt="" width="100" class="img-thumbnail" />
                        <?php } ?></td>
                      <td><?php echo $get['pTitle']; ?></td>
                      <td><?php echo $get['pDateTime']; ?></td>
                      <td><?php if($get['pStatus']=='Enable'){ echo '<a href="article.php?p_id='.$get['pid'].'"><span class="badge badge-success">Enable</span></a>';}else{echo'<a href="article.php?unp_id='.$get['pid'].'"><span class="badge badge-important">Disable</span></a>';} ?>
                      </td>
                      <td><a href="<?php echo APPC_URL; ?>update-article.php?ref=<?php echo $get['pid']; ?>" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i> </a> <a onClick="return confirm('Are you sure you want to Delete?')" href="<?php echo APPC_URL; ?>article.php?delete=<?php echo $get['pid']; ?>" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash-o"></i></a> </td>
                    </tr>
                    <?php $Serial++;  } } else { echo '<li class="massege" style="text-align:center;  height:30px; line-height:30px;"><span class="searchMessage">No data have been posted</span></li>';} ?>
                  </tbody>
                </table>
              </form>
              <!-- PAGINATION -->
              <?php $f->pageThis($rowsPerPage, $maxPage, $sql, $self);?>
              <!-- PAGINATION -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- BEGIN Tiles -->
    <!-- END Main Content -->
    <?php include 'bottom.php'; ?>
  </div>
  <!-- END Content -->
</div>
<!-- END Container -->
</body>
</html>
