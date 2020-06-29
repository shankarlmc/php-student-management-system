<?php include"includes/header.php";
include "includes/config.php";
if(isset($_POST['insert'])){
    $yearlevel = test_input($_POST['yearlevel']);
    $errors= array();
    if(empty($yearlevel)){
         $errors[] = "Year Level Should Not Be Empty !!!!!";
      }
      if(empty($errors)==true) {
        $sql = " INSERT INTO year_level (yearlevel,value) values ('$yearlevel',1)";
        if(mysqli_query($conn, $sql)){
            echo "<h4><span class='alert alert-success'>New Year Level Inserted successfully !!!!!</span></h4><br>";
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
       <h6 class="m-0 font-weight-bold text-primary" style="font-size:18px">List Of Year Level <a href="#"  class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#addSemester">  <i class="fa fa-plus-circle fw-fa"></i> New</a></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Year Level</th>
              <th>Subjects</th>
              <th>Students</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Year Level</th>
              <th>Subjects</th>
              <th>Students</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </tfoot>
          <?php 
          include"includes/config.php";
            $sql = "SELECT * FROM year_level where value=1";
            $result = mysqli_query($conn, $sql);
            $semesters = mysqli_fetch_all($result, MYSQLI_ASSOC);
         ?>
         <?php foreach ($semesters as $semester): ?>
            
          <tbody>
            <tr>
                <td><?php echo $semester['yearlevel']; ?></td>
                <td><?php echo "10"; ?></td>
                <td><?php echo "72"; ?></td>
              <td><a href="setSemester.php?id=<?php echo $semester['year_id']; ?>"  class="btn btn-primary btn-sm rounded" ><i class="fa fa-info-circle"></i> Edit</a></td>
              <td><a href="setSemester.php?delete=true&&id=<?php echo $semester['year_id']; ?>"  class="btn btn-danger btn-sm rounded" >  <i class="fa fa-info-circle"></i> Delete</a></td>
            </tr>
            </tbody>
        <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</div>      

<?php include"includes/footer.php"; ?>
<!-- modal for add new semester -->
    <div class="modal fade" id="addSemester" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h2 class="modal-title w-100 font-weight-bold">Add New Year Level</h2>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="form-group">
                        <label for="yearlevel" class=" form-control-label">Add Year Level:</label>
                        <input type="text" id="yearlevel" name="yearlevel" class="form-control border border-primary" placeholder="Add Year Level eg.(1st Year)">
                    </div>
                    <div class="footer">
                    <input type="submit" value="Add New" name="insert" class="btn btn-success btn-lg btn-block">
                    </div>
                </form>
                </div>            
            </div>
        </div>
    </div>
    