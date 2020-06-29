
   <!-- start content --> 
   <div class="container">
    <div class="row">
      <div class="com-md-12">
        <div class="col-md-2"></div>
      <div class="col-md-4 student">
        <form method="POST">
        <button class="btn btn-primary" type="submit" name="student" style="background-color: rgb(78, 115, 223);background-image: linear-gradient(10deg,#f70202 10%,#2e1897 100%);color:#fff;">Student</button>
        </form>
      </div>       
      <div class="col-md-4 teacher">
        <form method="POST">
        <button class="btn btn-info" type="submit" name="teacher" style="background-color: rgb(78, 115, 223);background-image: linear-gradient(90deg,#f70202 10%,#2e1897 100%);color:#fff;">Staff</button>
        </form>
      </div>
        </div>
        </div>
    </div>   

    <?php 
    if(isset($_POST['student'])){
       echo "<script>location.href='index.php?page=studentLogin'</script>";
    }
    if(isset($_POST['teacher'])){
       echo "<script>location.href='index.php?page=staffLogin'</script>";
    }

     ?> 
<!-- end of page  -->
