<?php include"includes/header.php"; 
include "includes/config.php";
if(isset($_POST['insert'])){
    $year = test_input($_POST['year']);
    $errors= array();
    if(empty($year)){
         $errors[] = "Academic Year Should Not Be Empty !!!!!";
      }
      if(empty($errors)==true) {
        $sql = " INSERT INTO academic_year (academic_year) values ('')";
        if(mysqli_query($conn, $sql)){
             echo "<br><h4><span class='alert alert-success' role='alert'>Academic Year Added successfully !!!!</span></h4><br>";
          }
          else{
            echo "Error" .$sql. "<br>" . mysqli_error($conn);
          }
        mysqli_close($conn);
    } else{
        echo ("<span class='alert-link text-danger' align='center'><h3>".$errors[0]."</h3></span><br>");
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
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary" style="font-size:18px">List Of Academic Year <a href="#"  class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#addAcademicyear">  <i class="fa fa-plus-circle fw-fa"></i> New</a></h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
          <table class="table" >
              <thead>
                  <tr>
                      <th>Academic Year</th>
                      <th>Edit</th>
                      <th>Delete</th>
                  </tr>
              </thead>
              <?php 
                  include "includes/config.php";
                  $sql = "SELECT * FROM academic_year";
                  $result = mysqli_query($conn, $sql);
                  $years = mysqli_fetch_all($result, MYSQLI_ASSOC);
               ?>
               <?php foreach ($years as $year): ?>
                  <tr>
                      <td><?php echo $year['academic_year']; ?></td>
                      <td><a href="#"data-toggle="modal" data-target="#editAcademicyear" class="btn btn-primary btn-sm rounded" ><i class="fa fa-info-circle"></i> Edit</a>
                      </td>
                      <td><a href="viewdetails.php?id=<?php echo $year['s_id']; ?>"  class="btn btn-danger btn-sm rounded" >  <i class="fa fa-info-circle"></i> Delete</a>
                      </td>
                  </tr>
              <?php endforeach; ?>
          </table>
        </div>
    </div>
  </div>
</div>      

<?php include"includes/footer.php"; ?>
<!-- modal for add new semester -->
   <div class="modal fade" id="addAcademicyear" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h2 class="modal-title w-100 font-weight-bold">Add New Academic Year</h2>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="form-group">
                        <label for="title" class=" form-control-label">Academic Year: </label>
                        <input type="text" id="title" value="" name="year" class="form-control" placeholder="Academic Year">
                    </div>
                    <div class="footer">
                    <input type="submit" value="Add New Year" name="insert" class="btn btn-success btn-lg btn-block">
                    </div>
                </form>
                </div>            
            </div>
        </div>
    </div>
    