<?php
  //include the shared files.
  require_once('shared/header.php');
  include_once('shared/connect_to_database.php');
  require_once('shared/appvar.php');
  $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');
  if (isset($_GET['user_id']) && isset($_GET['user_name']) && isset($_GET['first_name']) && isset($_GET['last_name'])&&isset($_GET['email'])){

    $user_id = $_GET['user_id'];
    $user_name = $_GET['user_name'];
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $email = $_GET['email'];
  }
  //query to delete a user.
  $query = "DELETE FROM users WHERE user_id = $user_id";
  mysqli_query($dbs, $query);
  //redirect the admin to list users page.
  $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/list_users.php';
  header('Location:' . $home_url);
?>
