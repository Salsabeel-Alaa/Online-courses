<?php
session_start();
//make sure the admin is logged in
if(isset($_SESSION['admin_id'])){
  //include the shared files.
  require_once('shared/head.php');
  require_once('shared/header.php');
  include_once('shared/connect_to_database.php');
  include_once('shared/appvar.php');
  $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');


  if(isset($_POST['submit'])){
    //grab form data.
    $initial_course_name = mysqli_real_escape_string($dbs, trim($_POST['course_name']));
    //replace the space with underscore
    $course_name = str_replace(' ', '_', $initial_course_name);
    $_SESSION['course_name'] = mysqli_real_escape_string($dbs, trim($_POST['course_name']));
    if(!empty($course_name)){

      //query to create a new table.
      $query = "CREATE TABLE $course_name (video_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, category_id int not null, video_name VARCHAR(1500), description VARCHAR(150), file_extension VARCHAR(4))";

      mysqli_query($dbs, $query) or die('fail to query ');
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/uploade_course_to_courses_tabel.php';
      header('Location:' . $home_url);
    }else{
      echo '<p class="empty_filels">please enter a course name</p>';
    }
  }
?>
 <div class=" container create_new_course_container">
   <div class="row">
     <div class="col-12 text-center">
       <h3 class="text-center">Create a new course</h3>
       <form class = "create_new_course_form"method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <label for="course_name">Enter Course Name</label>
          <input type="text" name="course_name">
          <input class="submit" type="submit" name="submit" value="Create New Course">
       </form>
     </div>
   </div>
 </div>



 <!--===========end footer area==============-->
<?php
  require_once('shared/footer.php');

 }else{

  echo 'Please  <a href="index.php">log in</a>';

}?>
