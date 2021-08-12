<?php include 'common.php'; ?>
<?php
$count=$db->num_rows("SELECT * FROM press WHERE pActive = 1 AND pStatus = 'Enable' AND year(pDateTime) = ".$_GET['year']." AND month(pDateTime) = ".$_GET['month']." ORDER BY pDateTime DESC "); 
if($count==0){$f->redirect(APP_URL);}
$arctitle = 'Archive - '.date("F",mktime(0, 0, 0, $_REQUEST['month'], 10)).'&nbsp;'.$_REQUEST['year'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $arctitle; ?></title>
<?php include 'head.php';?>
<body>
<?php include 'header.php';?>
<section class="in-banner"> <img src="<?php echo APP_URL; ?>images/in-banner.jpg" />
  <div class="heading-text">
    <div class="container">
      <ul>
      <li><a href="<?php echo APPX_URL; ?>" title="Home">Home</a></li>
      <li><a href="<?php echo APP_URL; ?>" title="Blog">Blog</a></li>
      <li><?php echo $arctitle; ?></li>
      </ul>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <article class="content-box">
      <div class="in-text">
        <h1><?php echo $arctitle; ?></h1>
         <?php
					$sql = "SELECT * FROM press WHERE pActive = 1 AND pStatus = 'Enable' AND year(pDateTime) = ".$_GET['year']." AND month(pDateTime) = ".$_GET['month']." ORDER BY pDateTime DESC  ";
					$Displaysql = $db->get_results($sql);
					$rowsPerPage = 10;
					$pageNum = 1;
					if(isset($_GET['page']))
					$pageNum = $_GET['page'];
					$offset = ($pageNum - 1) * $rowsPerPage;
					$pagingQuery = "LIMIT $offset, $rowsPerPage ";
					$Query = $db->get_results($sql.$pagingQuery);
					$numrows = $db->num_rows($sql);
					$maxPage = ceil($numrows/$rowsPerPage);
					$self = APP_URL.'archive.php?year='.$_GET['year'].'&month='.$_GET['month'].'&';
					$Serial = 1;
					if($numrows != 0){
					foreach($Query as $get ){ 
					?> 
        <div class="bloglisting-box">
          <?php if($get['pPic']!='') { ?>
          <div class="left"><a title="<?php echo $get['pTitle']; ?>" href="<?php echo APP_URL.$get['pUrl']; ?>"><img title="<?php echo $get['pTitle']; ?>" src="<?php echo APP_URL; ?>uploads/<?php echo $get['pPic']; ?>" alt="<?php echo $get['pTitle']; ?>"></a></div>
          <?php } ?>
          <div class="right">
            <h2><a title="<?php echo $get['pTitle']; ?>" href="<?php echo APP_URL.$get['pUrl']; ?>"><?php echo $get['pTitle']; ?></a></h2>
            <h5><?php echo date("d M, Y",strtotime($get['pDateTime'])); ?></h5>
            <p><?php echo $get['pShort']; ?> <a  href="<?php echo APP_URL.$get['pUrl']; ?>" title="Read More - <?php echo $get['pTitle']; ?>">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></p>
          </div>
          <div class="clear"></div>
        </div>
        <?php $Serial++; } } ?>
        <?php if($numrows==0){echo '<p class="fail">No article found</p>';} ?>
        <ul class="paging">
          <?php $f->pageThis($rowsPerPage, $maxPage, $sql, $self);?>
        </ul>
      </div>
    </article>
    <?php include 'sidebar.php'; ?>
  </div>
</section>
<?php include 'footer.php'; ?>
</body>
</html>