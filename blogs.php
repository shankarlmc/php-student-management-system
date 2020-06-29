<style type="text/css"> 
.myContentarea {
    /*border: 2px solid red;*/
    border-bottom: 1px solid #ddd;
    
    margin-bottom: 20px;
}
.myContentarea  .s-content{ 
    text-align: center;
    padding: 20px;
    /*border: 2px solid green;*/
}
  

</style>  
 <div class="container" style="height: 495px;overflow-y: scroll;">
    <?php 
        $sql = "SELECT * FROM `news_table`  ORDER BY `date` DESC";
        $result = mysqli_query($conn, $sql);
        $blog = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($blog as $result) { 
    if (strlen($result['content']) > 350) {
        $stringCut = substr($result['content'], 0, 350);
        $endPoint = strrpos($stringCut, '');
        $result['content'] = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);

        $result['content'] .= "...
        <a style='cursor: pointer;' href='index.php?page=singleblog&&news&&id=".$result['news_id']."'> Read More</a>";
        } 

    ?>
     <div class="myContentarea col-lg-12">
            <div class="row">
                <div class="col-sm-2 s-content" >
                    <span class="fa fa-calendar-o" style="font-size: 55px">
                        
                    </span>  
                      <h5 class="myTitle"><?php echo date_format(date_create($result['date']),'M d, Y'); ?></h5>
                </div>
                <div class="col-sm-10">
                    <div style="font-size: 25px;font-weight: bold;color: #000;margin-bottom: 5px;">
                    <a style="text-decoration: none;">
                    <?php echo $result["title"] ;?> [News] 
                    </a>
                    </div> 
                    <div class="row contentbody">
                        <div class="col-sm-12">
                          <p> <?php echo $result['content']; ?></p> 
                        </div>
                    
                        <div class="col-sm-12 ">
                            <p>News Of :  <?php echo  $result['semester']; ?> on  <?php echo  date_format(date_create($result['date']),"d M Y h:i a"); ?></p>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
            <?php 
                $sql = "SELECT * FROM `notice_table`  ORDER BY `date` DESC";
                $result = mysqli_query($conn, $sql);
                $blog = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($blog as $result) { 
            if (strlen($result['content']) > 350) {
        $stringCut = substr($result['content'], 0, 350);
        $endPoint = strrpos($stringCut, '');
        $result['content'] = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);

        $result['content'] .= "...
        <a style='cursor: pointer;' href='index.php?page=singleblog&&notice&&id=".$result['notice_id']."'> Read More</a>";
        }  

            ?>
            <div class="myContentarea col-lg-12">
                <div class="row">
                    <div class="col-sm-2 s-content" >
                        <span class="fa fa-calendar-o" style="font-size: 55px">
                            
                        </span>  
                          <h5 class="myTitle"><?php echo date_format(date_create($result['date']),'M d, Y'); ?></h5>
                    </div>
                    <div class="col-sm-10">
                        <div style="font-size: 25px;font-weight: bold;color: #000;margin-bottom: 5px;">
                        <a style="text-decoration: none;">
                        <?php echo $result["title"] ;?> [Notice] 
                        </a>
                        </div> 
                        <div class="row contentbody">
                            <div class="col-sm-12">
                              <p> <?php echo $result['content']; ?></p> 
                            </div>
                        
                            <div class="col-sm-12 ">
                                <p>Notice Of :  <?php echo  $result['semester']; ?> on  <?php echo  date_format(date_create($result['date']),"d M Y h:i a"); ?></p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        <?php } ?>
          <?php } ?> 

</div> 