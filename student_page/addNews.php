<?php include"includes/header.php"; 
// connect to database
include"includes/config.php";

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
  $semester = test_input($_POST['semester']);
    $title = test_input($_POST['title']);
    $content = nl2br($_POST['content']);
    $filename = $_FILES['file']['name'];
    $errors= array();
    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    // destination of the file on the server
    $destination = 'img/' . $filename;

    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    if(empty($title)){
         $errors[] = "News Title Should Not Be Empty !!!!!";
      }
      if(empty($content)){
         $errors[] = "Description Should Not Be Empty !!!!!";
      }
      if(empty($filename)){
         $errors[] = "File Should Not Be Empty !!!!!";
      }
      // get the file extension
    if (!in_array($extension, ['zip', 'pdf', 'docx', 'txt','jpg','png'])) {
        $errors[] = "You file extension must be .zip, .pdf, .txt or .docx";
    } 
    if ($_FILES['file']['size'] > 104580000) { // file shouldn't be larger than 100Megabyte
        $errors[] = "File too large!";
    } 
    if(empty($errors)==true) {
        // move the uploaded (temporary) file to the specified destination
        move_uploaded_file($file, $destination);
            $sql = "INSERT INTO news_table (title,content,semester,file,value) VALUES ('$title','$content','$semester','$filename', 1)";
            if (mysqli_query($conn, $sql)) {
                echo "<h4><span class='alert alert-success'>News Inserted successfully !!!!!</span></h4><br>";
        } else{
            echo "Error" .$sql. "<br>" . mysqli_error($conn);
          }
        mysqli_close($conn);
    } else{
        echo ("<h4><span class='alert alert-danger'>".$errors[0]."</span></h4><br>");
    }
}
function test_input($data) {
    global $conn;
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysqli_real_escape_string($conn,$data);
  return $data;
}
?>
<!-- Begin Page Content -->
<div class="container">
  <div class="row">
    <div class="col-md-7"> 
    <h1 class="font-weight-bold" style="">Wants to add News</h1><br>
    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                <div class="form-group">
                    <div class="form-check form-check-inline col-md-12">
                        <select class="custom-select none" name="semester"id="semester">
                        <option selected value="" class="text-white">-----------Select Semester-------------</option>
                                  <?php 
                        include "includes/config.php";
                                $sql = "SELECT * FROM semester where value=1";
                                $result = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($result)>0) {
                                  while($row=mysqli_fetch_array($result)) {
                                    $sem_id = $row['sem_id'];
                                   $semester = $row['semester'];
                                    ?>
                      <option value="<?php echo"$semester";?>"><?php echo "$semester"; ?></option>
                        <?php 
                      }
                    }else{
                      echo "";
                    }
                         ?>
                      </select>
                    </div><br>
                    <label for="comment" class="text-danger">News <i class="fas fs-fw fa-newspaper"></i></label><br>
                     News Title:
                     <input class="form-control border border-primary" name="title" placeholder="Add Title">
                      <div class="form-group">
                        <label for="details">Content</label>
                        <textarea type="text" class="form-control border border-primary" name="content" placeholder="Enter content" rows="5" id="content"></textarea>
                      </div>
                 </div>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text border border-success" id="inputGroupFileAddon01">Upload</span>
                      </div>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="file">
                          <label class="custom-file-label font-weight-bold border border-success" for="inputGroupFile01">Choose file</label>
                      </div>
                  </div><br>
                  <input type="submit" value="Upload News" name="save" class="btn btn-success btn-lg btn-block">
                  <br>
            </div>
            <!-- end of col-md-7 -->
            <div class="col-md-1"></div>
            <div class="col-md-4">
                  <div class="card shadow mb-4">
                      <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-danger">Recent News&nbsp;<i class="fas fs-fw fa-newspaper"></i></h6>
                      </div>
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                    <?php 
                  include "includes/config.php";
                  $sql = "SELECT * FROM news_table where value=1 order by date desc LIMIT 8";
                  $result = mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result)>0) {
                    while($row=mysqli_fetch_array($result)) {
                     $title = $row['title'];
                     $date = $row['date'];
                      $current = explode(" ",$date);
                      $d = date("M d", strtotime($current[0]));
                      $dte = explode(" ", $d);
                      $month = $dte[0];
                      $day = $dte[1];
                      ?>
                                        <tr>
                                          <td><u style="color:red"><?php echo $month." ".$day; ?></u>: <?php echo $title; ?></td>
                                        </tr>
                                        
                                    <?php
                    }
                  } else {
                    echo "";
                  }
                  ?>
                                </table>
                            </div>
                        </div>
                    </div>
              </div>
            <!-- end of col-md-4 -->
       <!--  </div> -->
        <!-- end of form row -->
    </form>
     <!-- end of form -->
  </div>
  <!-- end of row -->
</div>
    <!-- end of container -->
     <?php include'includes/footer.php'?>
   

  

