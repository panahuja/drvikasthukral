<?php include '../common.php';  if(!isset($_SESSION['ADMIN_NAME'])){$f->redirect(APP_URL);exit();} ?>
<?php
if(isset($_POST['submit']) && $_POST['submit'] == "Submit")
{
foreach($_POST as $key=>$value){$$key = $db->filter( $value );}
if($pTitle != '') {

$pUrl=$f->seourl($pTitle);
$checkExists = $db->num_rows("SELECT pUrl FROM press WHERE pUrl = '".$pUrl."'");
if($checkExists==0){

if($_REQUEST['pDate']!='') { $DateTime = date('Y-m-d',strtotime($_REQUEST['pDate'])); }
$pDateTime = $DateTime.' '.$pTime; 

$add_query = $db->insert('press', array('pTitle'=>$pTitle,'pMTitle'=>$pMTitle,'pUrl'=>$pUrl,'pData'=>$pData,'pKeyword'=>$pKeyword,'pShort'=>$pShort,'pDesc'=>$pDesc,'pDateTime'=>$pDateTime));

$pid=$db->lastid();

if(isset($_POST['category']) && $_POST['category']!=''){foreach($_POST['category'] as $value){$addloc=$db->insert('categoryvalue',array('pid'=>$pid,'cid'=>$value));}}
if(isset($_POST['tag']) && $_POST['tag']!=''){foreach($_POST['tag'] as $value){$addloc=$db->insert('tagsvalue',array('pid'=>$pid,'cid'=>$value));}}

if($_FILES['pPic']['name']!='')
{
	$filen = $_FILES["pPic"]['name']; //file name 
	$id = rand();
	$e = explode(".", $filen);
	$n = count($e);
	$ext = $e[$n-1];
	$ext = strtolower($ext);
	$pPic = $id.basename(md5($filen).".".$ext);
	$path = '../uploads/'.$pPic; //generate the destination path
	if(move_uploaded_file($_FILES["pPic"]['tmp_name'],$path)) { //upload the fil
	$src=$path;
	$updatefire=$db->update('press',array('pPic'=>$pPic),array('pid'=>$pid));
	}
}

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
<title>Add New Article</title>
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
        <h1><i class="fa fa-list"></i> Add New Article</h1>
      </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php APP_URL; ?>welcome.php">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li> <a href="<?php APP_URL; ?>article.php">Articles</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active">Add New Article</li>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Tiles -->
    <?php if(isset($msg)){ echo $msg;}?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-black">
          <div class="box-title">
            <h3><i class="fa fa-bars"></i> Add New Article</h3>
            <div class="box-tool"> <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a> </div>
          </div>
          <div class="box-content">
            <form action="" class="form-horizontal form-bordered form-row-stripped" method="post" enctype="multipart/form-data" onSubmit="return Validate(this);">
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Title</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <input type="text" name="pTitle" id="pTitle" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Meta Title</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <textarea class="form-control col-md-12 " name="pMTitle" rows="3"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Meta Keyword</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <textarea class="form-control col-md-12 " name="pKeyword" rows="3"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Meta Description</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <textarea class="form-control col-md-12 " name="pData" rows="3"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Short Description </label>
                <div class="col-sm-9 col-lg-10 controls">
                  <textarea class="form-control col-md-12" name="pShort" rows="6"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="password5" class="col-sm-3 col-lg-2 control-label">Description </label>
                <div class="col-sm-9 col-lg-10 controls">
                  <textarea class="form-control col-md-12 ckeditor" name="pDesc" rows="6"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label">Featured Image</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"> <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
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
                  <select data-placeholder="Select Category" class="form-control chosen" multiple="multiple" name="category[]">
                    <?php
                 $Query = $db->get_results("SELECT * FROM newscategory WHERE cIsactive = 1 AND cStatus = 'Enable' ORDER BY cName ASC ");
				 foreach($Query as $get){
				 echo "<option value=".$get['cid'].">".$get['cName']."</option>";
				 }
				  ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label">Tags</label>
                <div class="col-sm-9 col-lg-10 controls">
                  <select data-placeholder="Select Tags" class="form-control chosen" multiple="multiple" name="tag[]">
                    <?php
                 $Query = $db->get_results("SELECT * FROM tags WHERE cIsactive = 1 AND cStatus = 'Enable' ORDER BY cName ASC ");
				 foreach($Query as $get){
				 echo "<option value=".$get['cid'].">".$get['cName']."</option>";
				 }
				  ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label">Published Date & Time</label>
                <div class="col-sm-5 col-lg-3 controls">
                  <input class="form-control date-picker" id="dp1" size="16" type="text" name="pDate" value="<?php echo date('d-m-Y'); ?>" />
                  <input class="form-control timepicker-24" type="text" name="pTime">
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
