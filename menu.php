 
  <div class="panel-group" id="accordion">
  <ul>
 
<?php 
    $sql = "SELECT * FROM `department`";
        $result = mysqli_query($conn, $sql);
        $department = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($department as $result) {  

?>
<li>
  <!-- <div class="panel panel-default"> -->
    <div class="panel-heading">
      <h4 class="panel-title">
        <a id="load"  data-toggle="collapse" data-parent="#accordion" href="#<?php echo $result['dept_id']; ?>" data-id="<?php echo $result['dept_id']; ?>">
          <?php echo $result['department_desc'] . ' [ ' .$result['department_name'] . ' ] '; ?> <i class="fa fa-caret-down"></i>
        </a>
      </h4>
    </div>

 <div id="<?php echo $result['dept_id']; ?>" class="panel-collapse collapse out">
      <div class="panel-body">
      <div id="loaddata<?php echo $result['dept_id']; ?>">
        <?php
          $sql = "SELECT * FROM `course` WHERE `dept_id` = ".$result['dept_id'];
          $result = mysqli_query($conn, $sql);
          $desc = mysqli_fetch_all($result, MYSQLI_ASSOC);
          foreach ($desc as $result) {  
             echo '<ul>';
             echo '<li>'.$result['course_name'].' | '.$result['course_desc'].'</li>';
             echo '</ul>';
          }
        ?>
      </div>
      </div>
    </div>
 
 </li>

<?php } ?>
</ul> 

  
</div>
 
    
