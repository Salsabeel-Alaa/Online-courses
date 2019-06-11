<?php

session_start();
//make sure the user is logged in
if(isset($_SESSION['admin_id'])){
  //include the shared files.
  require_once('shared/head.php');
  require_once('shared/header.php');
  include_once('shared/connect_to_database.php');
  include_once('shared/appvar.php');
  $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');
  //query to list all courses.
  $query = "SELECT * from courses";
  $result = mysqli_query($dbs, $query) or die('fail to query');
  // loop through courses.
  while($row = mysqli_fetch_array($result)){

?>
  <div class="container remove_course_container">
    <div class="row">
      <div class="col-9">
        <div class="row">
          <div class="col-3">
            <img class="img-fluid" src="<?php echo IMG_PATH . $row['thumbnail']  ?>" alt="">
          </div>
          <div class="col-9 align-middle">
            <h3 class="align-middle"><?php echo $row['course_name'] ;?></h3>
          </div>
        </div>

      </div>
      <div class="col-3 ">
        <?php
         echo '<a class= "remove_course" href="delete.php?course_id=' . $row['course_id'] . '&amp;course_name='.$row['course_name'].'&amp;thumbnail='.$row['thumbnail'].'&amp;category_id='.$row['category_id'].'">remeove</a>'
        ?>
      </div>
    </div>
  </div>
<?php
  }
   }
?>
