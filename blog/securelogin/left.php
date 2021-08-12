<?php 
$page=basename($_SERVER['PHP_SELF']);
?>
<!-- BEGIN Sidebar -->

<div id="sidebar" class="navbar-collapse collapse">
  <!-- BEGIN Navlist -->
  <ul class="nav nav-list">
    <li <?php echo ($page=='welcome.php')?'class="active"':'';?> > <a href="welcome.php"> <i class="glyphicon glyphicon-home"></i> <span>Dashboard</span> </a> </li>
    <li <?php echo ($page=='add-article.php' || $page=='article.php' || $page=='update-article.php') ?'class="active"':'';?> > <a href="#" class="dropdown-toggle"> <i class="glyphicon glyphicon-th-list"></i> <span>Articles</span> <b class="arrow fa fa-angle-right"></b> </a>
      <ul class="submenu">
		<li <?php echo ($page=='article.php'|| $page=='update-article.php' )?'class="active"':'';?>><a href="article.php">View Articles</a></li>
        <li <?php echo ($page=='add-article.php')?'class="active"':'';?>><a href="add-article.php">Add Article</a></li>
      </ul>
    </li>
      <li <?php echo ($page=='ncategory.php' || $page=='add-ncategory.php' || $page=='update-ncategory.php') ?'class="active"':'';?> > <a href="#" class="dropdown-toggle"> <i class="glyphicon glyphicon-th-list"></i> <span>Categories</span> <b class="arrow fa fa-angle-right"></b> </a>
      <ul class="submenu">
		<li <?php echo ($page=='ncategory.php' || $page=='update-ncategory.php')?'class="active"':'';?>><a href="ncategory.php">View Category</a></li>
        <li <?php echo ($page=='add-ncategory.php')?'class="active"':'';?>><a href="add-ncategory.php">Add Category</a></li>
      </ul>
    </li>
      <li <?php echo ($page=='tag.php' || $page=='add-tag.php' || $page=='update-tag.php') ?'class="active"':'';?> > <a href="#" class="dropdown-toggle"> <i class="glyphicon glyphicon-th-list"></i> <span>Tags</span> <b class="arrow fa fa-angle-right"></b> </a>
      <ul class="submenu">
		<li <?php echo ($page=='tag.php' || $page=='update-tag.php')?'class="active"':'';?>><a href="tag.php">View Tags</a></li>
        <li <?php echo ($page=='add-tag.php')?'class="active"':'';?>><a href="add-tag.php">Add Tag</a></li>
      </ul>
    </li>
  <!-- END Navlist -->
  <!-- BEGIN Sidebar Collapse Button -->
  <div id="sidebar-collapse" class="visible-lg"> <i class="fa fa-angle-double-left"></i> </div>
  <!-- END Sidebar Collapse Button -->
</div>
<!-- END Sidebar -->
