<?php
session_start();
// If the session vars aren't set, try to set them with a cookie
if (!isset($_SESSION['user_id'])) {
  if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])){
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['user_name'] = $_COOKIE['user_name'];
  }
}elseif(!isset($_SESSION['admin_id'])){
  if(isset($_COOKIE['admin_id'])){
    $SESSION['admin_id'] = $_COOKIE['admin_id'];
  }
}

  //include the shared files.
  require_once('shared/head.php');
  require_once('shared/header.php');
  include_once('shared/connect_to_database.php');
  include_once('shared/appvar.php');
  $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');
  //query to list all courses.
  $query = "SELECT * from courses";
  $result = mysqli_query($dbs, $query) or die('fail to querysa');

  // loop through courses.
  while($row = mysqli_fetch_array($result)){
  ?>
  <div class="container">
    <a class="course_link row" href="show_specific_course.php?course_name=<?php echo $course_name= str_replace(' ', '_', $row['course_name']); ?>">
      <div class="col-3">
        <img class="img-fluid" src="<?php echo IMG_PATH . $row['thumbnail']  ?>" alt="">
      </div>
      <div class="col-9 course_content">
        <h3><?php echo $row['course_name'] ;?></h3>
        <p><?php echo $row['describtion'] ;?></p>
      </div>
    </a>
  </div>
<?php } ?>
<?php
  require_once('shared/footer.php');
 ?>
