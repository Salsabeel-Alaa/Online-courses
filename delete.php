<?php
  //include the shared files.
  require_once('shared/header.php');
  include_once('shared/connect_to_database.php');
  include_once('shared/appvar.php');
  $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');
  //query to list all courses.
  if (isset($_GET['course_id']) && isset($_GET['course_name']) && isset($_GET['thumbnail']) && isset($_GET['category_id'])){
    $course_id = $_GET['course_id'];
    $course_name = $_GET['course_name'];
    $thumbnail = $_GET['thumbnail'];
    $category_id = $_GET['category_id'];
  }
  $query = "DELETE FROM courses WHERE course_id = $course_id";
  mysqli_query($dbs, $query);
  $query2 = "DROP TABLE $course_name";
  mysqli_query($dbs, $query2);
  $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/delete_course.php';
  header('Location:' . $home_url);
?>
