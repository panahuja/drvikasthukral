<aside class="side-box">
  <div class="sidenav"><span>Categories</span>
   <ul>
    <?php $query = $db->get_results("SELECT DISTINCT cv.cid,nc.cName,nc.cUrl FROM categoryvalue cv LEFT JOIN newscategory nc ON (cv.cid=nc.cid) WHERE nc.cStatus = 'Enable' AND nc.cIsactive=1 ORDER BY corder ASC ");

foreach($query as $getcatlist){?>
    <li><a title="<?php echo $getcatlist['cName'];?>" 

    class="<?php if(isset($_REQUEST['url']) && $_REQUEST['url'] == $getcatlist['cUrl']){echo 'active';} ?>" href="<?php echo APP_URL; ?>category/<?php echo $getcatlist['cUrl'];?>"><?php echo $getcatlist['cName'];?></a></li>
    <?php } ?>
  </ul>
  </div>
  
  <div class="sidenav"><span>Archives</span>
    <?php 

$mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");

$qy=$db->get_results("SELECT DISTINCT year(pDateTime) as year FROM press WHERE pActive=1 AND pStatus='Enable' ORDER BY pDateTime DESC ");

foreach($qy as $y){



$ynum=$db->num_rows("SELECT pid FROM press WHERE pActive=1 AND pStatus='Enable' AND year(pDateTime)='".$y['year']."' ");?>
    <?php $qm=$db->get_results("SELECT DISTINCT month(pDateTime) as month FROM press WHERE pActive=1 AND pStatus='Enable' AND year(pDateTime)='".$y['year']."' ORDER BY pDateTime DESC ");

?>
    <ul  class="list02">
      <?php

foreach($qm as $m){

$mnum=$db->num_rows("SELECT pid FROM press WHERE pActive=1 AND pStatus='Enable' AND month(pDateTime)='".$m['month']."' ");

?>
      <li><a class="<?php if((isset($_REQUEST['year']) && $_REQUEST['year']==$y['year']) && (isset($_REQUEST['month']) && $_REQUEST['month'] == $m['month'])){echo 'active';} ?>" href="<?php echo APP_URL;?>archive.php?year=<?php echo $y['year'];?>&month=<?php echo $m['month'];?>" title="<?php echo $mons[$m['month']];?> <?php echo $y['year'];?>"><?php echo $mons[$m['month']];?> <?php echo $y['year'];?> (<?php echo $mnum;?> ) </a></li>
      <?php }?>
    </ul>
    <?php }?>
  </div>
</aside>
