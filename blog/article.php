<?php include 'common.php'; ?>
<?php 

$count=$db->num_rows("Select * from press where pUrl='".$_REQUEST['url']."'"); 

if($count==0){$f->redirect(APP_URL);}

$getpost=$db->get_row("Select * from press where pUrl='".$_REQUEST['url']."'"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $getpost['pMTitle']; ?></title>
<meta name="Description" content="<?php echo $getpost['pData']; ?>"/>
<meta name="Keywords" content="<?php echo $getpost['pKeyword']; ?>"/>
<?php include 'head.php';?>
<!-- Facebook -->
<meta property="og:url" content="<?php echo APP_URL.$getpost['pUrl'] ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo $getpost['pTitle']; ?>" />
<meta property="og:description" content="<?php echo $getpost['pShort']; ?>" />
<meta property="og:image" content="<?php echo APP_URL.'uploads/'.$getpost['pPic']; ?>" />
<!-- Facebook -->
<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@">
<meta name="twitter:title" content="<?php echo $getpost['pTitle']; ?>">
<meta name="twitter:description" content="<?php echo $getpost['pShort']; ?>">
<meta name="twitter:creator" content="@">
<meta name="twitter:image" content="<?php echo APP_URL.'uploads/'.$getpost['pPic']; ?>">
<meta name="twitter:domain" content="">
</head>
<body>
<?php include 'header.php';?>
<section class="in-banner"> <img src="<?php echo APP_URL ;?>images/in-banner.jpg" />
  <div class="heading-text">
    <div class="container">
      <ul>
        <li><a href="<?php echo APPX_URL; ?>" title="Home">Home</a></li>
        <li><a href="<?php echo APP_URL ;?>" title="Blog">Blog</a> </li>
        <li><?php echo $getpost['pTitle']; ?></li>
      </ul>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <article class="content-box">
      <div class="in-text">
        <h1><?php echo $getpost['pTitle']; ?></h1>
        <?php if($getpost['pPic']!='') { ?>
        <p> <img src="<?php echo APP_URL; ?>uploads/<?php echo $getpost['pPic']; ?>" alt="<?php echo $getpost['pTitle']; ?>" title="<?php echo $getpost['pTitle']; ?>" /></p>
        <?php } ?>
        <div class="clear20"></div>
        <h5><?php echo date("d M, Y",strtotime($getpost['pDateTime'])); ?></h5>
        <?php echo htmlspecialchars_decode($getpost['pDesc']); ?>
        <?php $j=$db->num_rows("SELECT * FROM categoryvalue cv LEFT JOIN newscategory nc ON (cv.cid=nc.cid) WHERE cv.pid='".$getpost['pid']."' ORDER BY pcid DESC ");

	if($j!=0){ ?>
        <div class="skills-area" style="margin-bottom:20px"> <strong> Categories >></strong>
          <?php $cat = $db->get_results("SELECT * FROM categoryvalue cv LEFT JOIN newscategory nc ON (cv.cid=nc.cid) WHERE cv.pid='".$getpost['pid']."' ORDER BY pcid DESC ");
		$k=1;
        foreach($cat as $getcat)

        {
		if($k!=1){echo ",";}
		echo  ' <a title="'.$getcat['cName'].'" href="'.APP_URL.'category/'.$getcat['cUrl'].'">'.$getcat['cName'].'</a>';

		$k++; } ?>
        </div>
        <?php } ?>
        <?php  $j=$db->num_rows("SELECT * FROM tagsvalue cv LEFT JOIN tags nc ON (cv.cid=nc.cid) WHERE cv.pid='".$getpost['pid']."' ORDER BY pcid DESC ");

	if($j!=0){  ?>
        <div class="skills-area" style="margin-bottom:35px;"> <strong> Tags >></strong>
          <?php $cat = $db->get_results("SELECT * FROM tagsvalue cv LEFT JOIN tags nc ON (cv.cid=nc.cid) WHERE cv.pid='".$getpost['pid']."' ORDER BY pcid DESC ");
$k=1;
        foreach($cat as $getcat)

        {
		if($k!=1){echo ",";}
		echo ' <a title="'.$getcat['cName'].'" href="'.APP_URL.'tag/'.$getcat['cUrl'].'">'.$getcat['cName'].'</a>';

		$k++; } ?>
        </div>
        <?php } ?>
        <div class="addthis_inline_share_toolbox"></div>
      </div>
    </article>
    <?php include 'sidebar.php'; ?>
  </div>
</section>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4f8419cc39234eb8"></script>
</body>
</html>
