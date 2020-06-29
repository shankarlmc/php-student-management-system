<?php include"includes/header.php";
include "includes/config.php";
if(isset($_POST['insert'])){
    $name = test_input($_POST['name']);
    $description = test_input($_POST['description']);
    $errors= array();
    if(empty($name)){
         $errors[] = "Department Name Should Not Be Empty !!!!!";
      }
      if(empty($description)){
         $errors[] = "Description Should Not Be Empty !!!!!";
      }
      if(empty($errors)==true) {
        $sql = " INSERT INTO department (department_name,department_desc,value) values ('$name','$description',1)";
        if(mysqli_query($conn, $sql)){
            echo "<h4><span class='alert alert-success'>New Department Inserted successfully !!!!!</span></h4><br>";
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
       <h6 class="m-0 font-weight-bold text-primary" style="font-size:18px">List Of Departments <a href="#"  class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#addDepartment">  <i class="fa fa-plus-circle fw-fa"></i> New</a></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Department</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Department</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <?php 
          include"includes/config.php";
            $sql = "SELECT * FROM department where value=1";
            $result = mysqli_query($conn, $sql);
            $departments = mysqli_fetch_all($result, MYSQLI_ASSOC);
         ?>
         <?php foreach ($departments as $department): ?>
            
          <tbody>
            <tr>
                <td><?php echo $department['dept_id']; ?></td>
                <td><?php echo $department['department_name']; ?></td>
                <td><?php echo $department['department_desc']; ?></td>
              <td><a href="setSemester.php?id=<?php echo $department['dept_id']; ?>"  class="btn btn-primary btn-sm rounded" ><i class="fa fa-info-circle"></i> View</a>&nbsp;&nbsp;<a href="setSemester.php?delete=true&&id=<?php echo $department['dept_id']; ?>"  class="btn btn-danger btn-sm rounded" >  <i class="fa fa-info-circle"></i> Delete</a></td>
            </tr>
            </tbody>
        <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</div>      

   


  

<?php include"includes/footer.php"; ?>
<!-- modal for add new department -->
    <div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h2 class="modal-title w-100 font-weight-bold">Add New Department</h2>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="form-group">
                        <label for="name" class=" form-control-label">Department Name: </label>
                        <input type="text" id="name" name="name" class="form-control border border-primary" placeholder="Department name eg.(Science & Technology)">
                    </div>
                    <div class="form-group">
                        <label for="description" class=" form-control-label">Description:</label>
                        <textarea type="text" id="description" name="description" class="form-control border border-primary" placeholder="Enter Department Description" rows="5"></textarea>
                    </div>
                    <div class="footer">
                    <input type="submit" value="Add New Department" name="insert" class="btn btn-success btn-lg btn-block">
                    </div>
                </form>
                </div>            
            </div>
        </div>
    </div>
    