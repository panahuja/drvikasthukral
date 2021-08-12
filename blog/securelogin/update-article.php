<?php include '../common.php';  if(!isset($_SESSION['ADMIN_NAME'])){$f->redirect(APP_URL);exit();} ?>

<?php
// DATABASE INSERT QURIES
if(isset($_POST['submit']) && $_POST['submit'] == "Submit")
{
foreach($_POST as $key=>$value){$$key = $db->filter( $value );}
if($pTitle!=''){	

$checkExists = $db->num_rows("SELECT pUrl FROM press WHERE pUrl = '".$pUrl."' AND pid != '".$_GET['ref']."' ");
if($checkExists==0){


if(isset($pStatus) && $pStatus=='Enable'){$pStatus='Enable';}else{$pStatus='Disable';} 

if($_REQUEST['pDate']!='') { $pDateTime = date('Y-m-d',strtotime($_REQUEST['pDate'])); }
$DateTime = $pDateTime.' '.$pTime; 

$udpate = $db->update('press', array('pUrl'=>$f->seourl($pUrl),'pTitle'=>$pTitle,'pMTitle'=>$pMTitle,'pData'=>$pData,'pKeyword'=>$pKeyword,'pShort'=>$pShort,'pDesc'=>$pDesc,'pStatus'=>$pStatus,'pDateTime'=>$DateTime),array('pid'=>$_GET['ref']));

$delete = $db->delete('categoryvalue', array('pid'=>$_GET['ref']));
if(isset($_POST['category']) && $_POST['category']!=''){
foreach($_POST['category'] as $value){$addloc=$db->insert('categoryvalue',array('pid'=>$_GET['ref'],'cid'=>$value));}
}

$delete = $db->delete('tagsvalue', array('pid'=>$_GET['ref']));
if(isset($_POST['tag']) && $_POST['tag']!=''){
foreach($_POST['tag'] as $value){$addloc=$db->insert('tagsvalue',array('pid'=>$_GET['ref'],'cid'=>$value));}
}


if($_FILES['pPic']['name']!='')
{
	$filen = $_FILES["pPic"]['name']; //file name 
	$piName = $_FILES["pPic"]['name']; //file name 
	$id = rand();
	$e = explode(".", $filen);
	$n = count($e);
	$ext = $e[$n-1];
	$ext = strtolower($ext);
	$pPic = $id.basename(md5($filen).".".$ext);
	$path = '../uploads/'.$pPic; //generate the destination path
	if(move_uploaded_file($_FILES["pPic"]['tmp_name'],$path)) { //upload the fil
	$src=$path;
	$updatefire=$db->update('press',array('pPic'=>$pPic),array('pid'=>$_GET['ref']));
	}
}

$msg = '<div class="alert alert-success">Updates sucessfully</div>';
}else {$msg= '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Failed!</strong> URL already exist</div>';}



}
}
// DATABASE INSERT QURIES

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Update Article</title>
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
        <h1><i class="fa fa-list"></i> Update Article</h1>
      </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php APP_URL; ?>welcome.php">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li> <a href="<?php APP_URL; ?>article.php">Articles</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active">Update Article</li>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Tiles -->
    <?php if(isset($msg)){ echo $msg;}?>
    <?php $get=$db->get_row("Select * from press where pid='".$_REQUEST['ref']."'"); ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-black">
          <div class="box-title">
            <h3><i class="fa fa-bars"></i>Update Article</h3>
            <div class="box-tool"> <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a> </div>
          </div>
          <div class="box-content">
            <form action="" class="form-horizontal form-bordered form-row-stripped" method="post" enctype="multipart/form-data" onSubmit="return Validate(this);">
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Title</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <input type="text" name="pTitle" id="pTitle" class="form-control" value="<?php echo $get['pTitle']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">URL</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <input type="text" name="pUrl" id="pUrl" class="form-control" value="<?php echo $get['pUrl']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Meta Title</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <input type="text" name="pMTitle" id="pMTitle" class="form-control" value="<?php echo $get['pMTitle']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Meta Keyword</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <textarea class="form-control col-md-12 " name="pKeyword" rows="3"><?php echo $get['pKeyword']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Meta Description</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <textarea class="form-control col-md-12 " name="pData" rows="3"><?php echo $get['pData']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Short Description </label>
                <div class="col-sm-9 col-lg-10 controls">
                  <textarea class="form-control col-md-12" name="pShort" rows="6"><?php echo $get['pShort']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Description </label>
                <div class="col-sm-9 col-lg-10 controls">
                  <textarea class="form-control col-md-12 ckeditor" name="pDesc" rows="6"><?php echo $get['pDesc']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label">Featured Image</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                      <?php if($get['pPic']!='') { ?>
                      <img src="<?php echo APP_URL; ?>/uploads/<?php echo $get['pPic']; ?>" alt="" />
                      <?php } ?>
                      <?php if($get['pPic']=='') { ?>
                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                      <?php } ?>
                    </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                    <div> <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span> <span class="fileupload-exists">Change</span>
                      <input type="file" class="file-input" name="pPic" id="pPic" />
                      </span> <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a> </div>
                  </div>
                  <span class="label label-important">NOTE!</span> <span>Attached image img-thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only</span> </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label">Category</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <select data-placeholder="Select Category" class="form-control chosen" multiple="multiple" name="category[]" >
                    <?php
                 $Query = $db->get_results("SELECT * FROM newscategory WHERE cIsactive = 1 ORDER BY cName ASC ");
				 foreach($Query as $row){
				 $num=$db->get_row("select pid from categoryvalue where pid='".$_GET['ref']."' and cid=".$row['cid']." "); 
				 ?>
                    <option value="<?php echo $row['cid'];?>" <?php if($num >0) {echo 'selected';} ?> ><?php echo $row['cName']; ?></option>
                    <?php }  ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label">Tags</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <select data-placeholder="Select Tags" class="form-control chosen" multiple="multiple" name="tag[]" >
                    <?php
                 $Query = $db->get_results("SELECT * FROM tags WHERE cIsactive = 1 ORDER BY cName ASC ");
				 foreach($Query as $row){
				 $num=$db->get_row("select pid from tagsvalue where pid='".$_GET['ref']."' and cid=".$row['cid']." "); 
				 ?>
                    <option value="<?php echo $row['cid'];?>" <?php if($num >0) {echo 'selected';} ?> ><?php echo $row['cName']; ?></option>
                    <?php }  ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label">Change Date</label>
                <div class="col-sm-5 col-lg-3 controls">
                  <input class="form-control date-picker" id="dp1" size="16" type="text" name="pDate" value="<?php echo date('d-m-Y',strtotime($get['pDateTime'])); ?>" />
                  <input class="form-control timepicker-24" value="<?php echo date('H-i-S',strtotime($get['pDateTime'])); ?>" type="text" name="pTime">
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Status</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <div class="make-switch switch-large">
                    <input type="checkbox" name="pStatus" value="Enable" <?php if($get['pStatus'] == 'Enable' ){ echo 'checked';} ?>  />
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
