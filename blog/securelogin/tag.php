<?php include '../common.php';  if(!isset($_SESSION['ADMIN_NAME'])){$f->redirect(APP_URL);exit();} ?>

<!-- DELETE -->
<?php
if(isset($_REQUEST['delete']) && $_REQUEST['delete']!='delete')
{
$updated = $db->delete( 'tags', array('cid' =>$_REQUEST['delete']));
$msg= '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Delete Successfully</div>';
}
if(isset($_POST['Submit']) && $_POST['Submit'] == "Delete")
{
foreach($_POST[idDelete] as $value){
$updated = $db->delete( 'tags', array('cid' =>$value));
$msg= '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> Delete Successfully</div>';
}
}
?>
<!-- DELETE -->
<!-- STATUS -->
<?php 
if(isset($_GET['unp_id']) && $_GET['unp_id']!='')
{
$updated = $db->update( 'tags', array('cStatus' => 'Enable'),array('cid' =>$_GET['unp_id']));
}
if(isset($_GET['p_id']) && $_GET['p_id']!='')
{
$updated = $db->update( 'tags', array('cStatus' => '0'),array('cid' =>$_GET['p_id']));
}
?>
<!-- STATUS  -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Tags</title>
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
        <h1><i class="fa fa-list"></i> Tags</h1>
      </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php APP_URL; ?>welcome.php">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active">Tags</li>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    <?php if(isset($msg)){ echo $msg;}?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-black">
          <div class="box-title">
            <h3><i class="fa fa-table"></i>Tags</h3>
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
               <!-- <br>
                <button class="btn btn-danger" style="float:right;" type="submit" name="Submit" value="Delete" onClick="return confirm('Are you sure you want to Delete?')" >Delete Selected</button>
                <br>
                <br>-->
                <div style="clear:both;"></div>
                <table class="table table-advance" id="table1">
                  <thead>
                    <tr>
                      <th width="10"><input type="checkbox" name="chkall" /></th>
                      <th width="100">Title</th>
                      <th width="100">Status</th>
                      <th width="100">Action</th>
                    </tr>
                  </thead>
                </table>
                <ul id="pagebox" style="list-style:none; padding:0; margin:0;">
                  <?php
					$Filter = "";
					if(isset($_GET['keyword'])){$Filter = (trim($_GET['Keyword']) != '')?" AND cName like '%".trim($_GET['Keyword'])."%' " : "";}
					$sql = "SELECT * FROM tags WHERE cIsactive = 1 ".$Filter." ORDER BY corder ASC  ";
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
					$self="tag.php?";
					$Serial = 1;
					if($numrows != 0){
					foreach($Query as $get ){ 
					?>
                  <li id="recordsArray_<?php echo $get['cid'];?>" style="cursor:move">
                    <table class="table table-advance" style=" padding:0; margin-bottom:5px;">
                      <tr class="table-flag-blue">
                        <td  width="10"><input type="checkbox" name="idDelete[]" value="<?php echo $get['cid']; ?>" /></td>
                        <td  width="100"><?php echo $get['cName']; ?></td>
                        <td  width="100"><?php if($get['cStatus']=='Enable'){ echo '<a href="tag.php?p_id='.$get['cid'].'"><span class="badge badge-success">Enable</span></a>';}else{echo'<a href="tag.php?unp_id='.$get['cid'].'"><span class="badge badge-important">Disable</span></a>';} ?>
                        </td>
                        <td  width="100"><a href="<?php echo APPC_URL; ?>update-tag.php?ref=<?php echo $get['cid']; ?>" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i> </a> <a onClick="return confirm('Are you sure you want to Delete?')" href="<?php echo APPC_URL; ?>tag.php?delete=<?php echo $get['cid']; ?>" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash-o"></i> </a> </td>
                      </tr>
                      </tbody>
                      
                    </table>
                  </li>
                  <?php $Serial++;  } } else { echo '<li class="massege" style="text-align:center;  height:30px; line-height:30px;"><span class="searchMessage">No data have been posted</span></li>';} ?>
                </ul>
              </form>
              <!-- PAGINATION -->
              <?php $f->pageThis($rowsPerPage, $maxPage, $sql, $self);?>
              <!-- PAGINATION -->
            </div>
          </div>
        </div>
      </div>
    </div>
      <script type="text/javascript">
$(document).ready(function(){ 
	$(function() {
		$("#pagebox").sortable({ opacity: 0.6, cursor: 'move', update: function() {
		var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			$.post("tagupdate.php", order, function(theResponse){
			}); 															 
		}								  
		});
	});
});	
</script>
    <!-- BEGIN Tiles -->
    <!-- END Main Content -->
    <?php include 'bottom.php'; ?>
  </div>
  <!-- END Content -->
</div>
<!-- END Container -->
</body>
</html>
