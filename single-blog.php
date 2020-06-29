<?php 
  if(isset($_GET["news"])){
    $newsId =  $_GET['id'];
    if ($newsId=="") {
      echo "<script>location.href='index.php'</script>";
      
    }
    $sql = "SELECT * FROM `news_table` WHERE news_id=$newsId";
    $result = mysqli_query($conn,$sql);
    $blog = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach ($blog as $blog) {

 // $count=  strlen($blog['content']);
 //            echo "$count";
       if (strlen($blog['content']) > 1350) {
              $class ="overflow-y:scroll;height: 495px";

                    }
?>


<div class="container" style="color: #55147a;<?php echo "$class"; ?>">
  <div class="col-lg-12">
      <h1 style="color: #55147a"> <u><?php echo $blog['title'] ;?> </u></h1>
    </div>
    <?php
     $ext = explode(".", $blog['file']);
      $arr = ["jpg","png","jpeg","svg"];
      if(in_array($ext[1],$arr,TRUE)){ ?>
        <div class="col-md-8" >
        <p style="color: #55147a"> <?php echo $blog['content']; ?></p> 
        <p><u>News Of :  <?php echo  $blog['semester']; ?> on  <?php echo  date_format(date_create($blog['date']),"d M Y h:i a"); ?></u></p>
      </div>
      <div class="col-md-4">
         <?php  echo '<img class="out_img" src="admin_panel/img/'.  $blog['file'].'" alt="" width="250px" height="250px">';?>
      </div>
    <?php } else{ ?>
    <div class="col-md-12" >
      <p> <?php echo $blog['content']; ?></p> 
      <p><u>News Of :  <?php echo  $blog['semester']; ?> on  <?php echo  date_format(date_create($blog['date']),"d M Y h:i a"); ?></u></p>
    </div>
  <?php } ?>
    </div>
    
 <?php } }else { 
  if(isset($_GET["notice"]))
    $noticeId =  $_GET['id'];
    if ($noticeId=="") {
      echo "<script>location.href='index.php'</script>";
    }
    $sql = "SELECT * FROM `notice_table` WHERE notice_id=$noticeId";
    $result = mysqli_query($conn,$sql);
    $blog = mysqli_fetch_all($result,MYSQLI_ASSOC);
    foreach ($blog as $blog) {
      if (strlen($blog['content']) > 1350) {
              $class ="overflow-y:scroll;height: 495px";
            }

?>

 <div class="container" style="color: #55147a;<?php echo "$class"; ?>">
  <div class="col-lg-12">
      <h1 > <u><?php echo $blog['title'] ;?> </u></h1>
    </div>
    <?php
     $ext = explode(".", $blog['file']);
      $arr = ["jpg","png","jpeg","svg"];
      if(in_array($ext[1],$arr,TRUE)){ ?>
        <div class="col-md-8" >
        <p> <?php echo $blog['content']; ?></p> 
        <p><u>Notice Of :  <?php echo  $blog['semester']; ?> on  <?php echo  date_format(date_create($blog['date']),"d M Y h:i a"); ?></u></p>
      </div>
      <div class="col-md-4">
         <?php  echo '<img class="out_img" src="admin_panel/img/'.  $blog['file'].'" alt="" width="250px" height="250px">';?>
      </div>
    <?php } else{ ?>
    <div class="col-md-12" >
      <p> <?php echo $blog['content']; ?></p> 
      <p><u>Notice Of :  <?php echo  $blog['semester']; ?> on  <?php echo  date_format(date_create($blog['date']),"d M Y h:i a"); ?></u></p>
    </div>
  <?php } ?>
    </div>

 <?php } } ?>
