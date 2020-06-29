<?php include"includes/header.php"; 
include "includes/config.php";
if(isset($_POST['insert'])){
    $subCode = test_input($_POST['sub_code']);
    $description = test_input($_POST['description']);
    $unit = test_input($_POST['unit']);
    $pre_requisite = test_input($_POST['pre_requisite']);
    $course = test_input($_POST['course']);
    $yearlevel = test_input($_POST['yearlevel']);
    $academic_year = test_input($_POST['academic_year']);
    $semester = test_input($_POST['semester']);
    $errors= array();
    if(empty($subCode)){
         $errors[] = "Subject Code Should Not Be Empty !!!!!";
      }
      if(empty($description)){
         $errors[] = "Description Should Not Be Empty !!!!!";
      }
      if(empty($unit)){
         $errors[] = "Unit Should Not Be Empty !!!!!";
      }
      if(empty($course)){
         $errors[] = "Course Name Should Not Be Empty !!!!!";
      }
      if(empty($academic_year)){
         $errors[] = "Academic Year Should Not Be Empty !!!!!";
      }
      if(empty($semester)){
         $errors[] = "Semester Should Not Be Empty !!!!!";
      }
      if(empty($errors)==true) {
        $sql = "INSERT INTO `subject`(`sub_code`, `sub_desc`, `unit`, `pre_requisite`, `course_id`, `yearlevel`, `academic_year`, `semester`, `setVal`)  values ('$subCode','$description','$unit','$pre_requisite','$course','$yearlevel','$academic_year','$semester','1')";
        if(mysqli_query($conn, $sql)){
            echo "<h4><span class='alert alert-Success'>Subject Added successfully !!!!</span></h4><br>";

          }
          else{
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
<div class="container-fluid">
  <div class="row ">
    <div class="col-md-12">
                        <div class="card">
                             <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary" style="font-size:18px">List Of Subjects <a href="#"  class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#addDepartment">  <i class="fa fa-plus-circle fw-fa"></i> New</a></h6>
                    </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Subject Code</th>
                                            <th>Description</th>
                                            <th>Unit</th>
                                            <th>Pre-Requisite</th>
                                            <th>Year Level</th>
                                            <th>Semester</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                      <tr>
                                            <th>Subject Code</th>
                                            <th>Description</th>
                                            <th>Unit</th>
                                            <th>Pre-Requisite</th>
                                            <th>Year Level</th>
                                            <th>Semester</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <?php 
                                      include"includes/config.php";
                                        $sql = "SELECT * FROM `subject` s, `course` c WHERE s.course_id = c.course_id";
                                        $result = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($result)>0) {
                                      while($row=mysqli_fetch_array($result)) {
                                            $sub_id = $row['sub_id'];
                                            $sub_code = $row['sub_code'];
                                            $sub_desc = $row['sub_desc'];
                                            $unit = $row['unit'];
                                            $pre_requisite = $row['pre_requisite'];
                                            $yearlevel = $row['yearlevel'];
                                            $semester = $row['semester'];
                                            $course_name = $row['course_name'];
                                        ?>
                                        <tbody>
                                        <tr>
                                            
                                            <td><?php echo "$sub_code"; ?></td>
                                            <td><?php echo "$sub_desc"; ?></td>
                                            <td><?php echo "$unit"; ?></td>
                                            <td><?php echo "$pre_requisite"; ?></td>
                                            <td><?php echo "$yearlevel"; ?></td>
                                            <td><?php echo "$semester"; ?></td>
                                            <td><?php echo "$course_name"; ?></td>
                                            <td><a href="viewdetails.php?id=<?php echo $row['sub_id']; ?>" class="btn btn-primary btn-sm rounded" ><i class="fa fa-info-circle"></i> View</a>&nbsp;&nbsp;<a href="department.php?delete=true&&id=<?php echo $row['sub_id'];?>"class="btn btn-danger btn-sm rounded" > <i class="fa fa-info-circle"></i> Delete</a></td>
                                        </tr>
                                        </tbody>
                                    <?php 
                                      }
                                    }
                                     ?>
                                </table>
                              </div>
                            </div>
                        </div>
                    </div>
      
  </div>
</div>

  
    <?php include"includes/footer.php"; ?>
    <div class="modal fade" id="addDepartment" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h2 class="modal-title w-100 font-weight-bold">Add New Subject</h2>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="form-group">
                        <input type="text" id="code" name="sub_code" class="form-control" placeholder="Subject Code">
                    </div>
                    <div class="form-group">
                        <input type="text" id="name" name="description" class="form-control"  placeholder="Subject Name">
                    </div>
                    <div class="form-group">
                        <input type="text" id="unit" name="unit" class="form-control" placeholder="unit">
                    </div>
                    <div class="form-group">
                        <input type="text" id="pre_requisite" name="pre_requisite" class="form-control" placeholder="Pre_requisite">
                    </div>
                    <div class="form-group">
                        <select class="form-control input-sm" name="course">
               <option selected class="text-white">----------Select Course--------</option>
                <option value="Bsc.CSIT">Bsc.CSIT</option>
            </select> 
                    </div>
                    <div class="form-group">
                        <select class="form-control input-sm" name="yearlevel">
               <option selected class="text-white">----------Select Year Level--------</option>
                  <?php 
                          include "includes/config.php";
                          $sql = "SELECT * FROM year_level";
                          $result = mysqli_query($conn, $sql);
                          if(mysqli_num_rows($result)>0) {
                            while($row=mysqli_fetch_array($result)) {
                             $yearlevel = $row['yearlevel'];
                              ?>
                <option value="<?php echo"$yearlevel";?>"><?php echo "$yearlevel"; ?></option>
                <?php 
              }
            }else{
              echo "";
            }
                 ?>
            </select> 
                    </div>
                    <div class="form-group">
                        <select class="form-control input-sm" name="academic_year">
               <option selected class="text-white">----------Select Academic Year--------</option>
                  <?php 
                          include "includes/config.php";
                          $sql = "SELECT * FROM academic_year";
                          $result = mysqli_query($conn, $sql);
                          if(mysqli_num_rows($result)>0) {
                            while($row=mysqli_fetch_array($result)) {
                             $academic_year = $row['academic_year'];
                              ?>
                <option value="<?php echo"$academic_year";?>"><?php echo "$academic_year"; ?></option>
                <?php 
              }
            }else{
              echo "";
            }
                 ?>
            </select> 
                    </div>
                    <div class="form-group">
                        <select class="form-control input-sm" name="semester">
               <option selected class="text-white">----------Select Semester--------</option>
                  <?php 
                          include "includes/config.php";
                          $sql = "SELECT * FROM semester";
                          $result = mysqli_query($conn, $sql);
                          if(mysqli_num_rows($result)>0) {
                            while($row=mysqli_fetch_array($result)) {
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
                    </div>
                    <div class="footer">
                    <input type="submit" value="Add New Subject" name="insert" class="btn btn-info btn-lg btn-block">
                    </div>
                </form>
                </div>            
            </div>
        </div>
    </div>