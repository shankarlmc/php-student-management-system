
<!-- search -->  
<div class="panel panel-default">
    <div class="panel-body">
     <form action="" method="get">
       <div class="input-group custom-search-form">
            <input type="search" class="form-control" name="page" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" id="btnsearch" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>

    </div> 
</div>
<!-- end serch -->

<!-- recent news area -->
 <div class="panel panel-default" id="recentNews"> 
    <div class="panel-body">
    <div class="list-group">
     <div class="well well-sm " style="background-color: rgb(78, 115, 223);background-image: linear-gradient(10deg,#f70202 10%,#2e1897 100%);color:#fff;"><b> Recent News   </b> </div>
        <ul >
        <?php 
          include"includes/config.php";
          $sql = "SELECT  * FROM  `news_table` ORDER BY date  DESC LIMIT 3";
          $result = mysqli_query($conn, $sql);
          $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
          foreach ($posts as $result) { 
          if (strlen($result['title']) > 50) {
        $stringCut = substr($result['title'], 0, 50);
        $endPoint = strrpos($stringCut, '');
        $result['title'] = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);

        $result['title'] .= "........
        <a style='cursor: pointer;' href='index.php?page=singleblog&&news&&id=".$result['news_id']."'> Read More</a>";
        } 
            echo ' <li><a href="index.php?page=singleblog&&news&&id='.$result['news_id'].'" style="color: #55147a;text-decoration:none">'.$result['title'].'</a></li> ';
            }
        ?>
         </ul>
      </div>  
   </div> 
</div>
<!-- end recent news area -->
<!--  recent notice area -->
<div class="panel panel-default" id="recentNotice"> 
    <div class="panel-body">
    <div class="list-group">
     <div class="well well-sm " style="background-color: rgb(78, 115, 223);background-image: linear-gradient(10deg,#f70202 10%,#2e1897 100%);color:#fff;"><b> Recent Notice </b> </div>
        <ul >
        <?php 
          $sql = "SELECT  * FROM  `notice_table` ORDER BY date  DESC LIMIT 3";
          $result = mysqli_query($conn, $sql);
          $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
          foreach ($posts as $result) {
          if (strlen($result['title']) > 40) {
        $stringCut = substr($result['title'], 0, 40);
        $endPoint = strrpos($stringCut, '');
        $result['title'] = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);

        $result['title'] .= "........
        <a style='cursor: pointer;' href='index.php?page=singleblog&&notice&&id=".$result['notice_id']."'> Read More</a>";
        }   
            echo ' <li><a href="index.php?page=singleblog&&notice&&id='.$result['notice_id'].'" style="color: #55147a;text-decoration:none">'.$result['title'].'</a></li> ';
            }
        ?>
         </ul>
      </div>  
   </div> 
</div>
<!--  end recent notice area -->
