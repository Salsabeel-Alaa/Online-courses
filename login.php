<?php
  //include the shared files.
  require_once('shared/connect_to_database.php');
  require_once('shared/appvar.php');

  session_start();

  if(!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])){
    if(isset($_POST['submit'])){
      //connect to the database.
      $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');

      //grab form data.
      $user_name = mysqli_real_escape_string($dbs, trim($_POST['user_name']));
      $password = mysqli_real_escape_string($dbs, trim($_POST['password']));
      $query = "SELECT user_id , user_name from users where user_name ='$user_name' AND password=SHA('$password')";
      $result = mysqli_query($dbs, $query) or die('fail to queryfirst one');
      //log in for admin.
      $query2 = "SELECT admin_id, admin_name from admin where admin_name ='$user_name' AND password=SHA('$password')";
      $result2 = mysqli_query($dbs, $query2) or die('fail to quer second one');
         //check to see if the user exist.
      if(mysqli_num_rows($result) == 1){
        //the user is in the database logthem in
        $row = mysqli_fetch_array($result);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_name'] = $row['user_name'];
        setcookie('user_id', $row['user_id'], time() + (24*60*60*10));//expire in 10 days
        setcookie('user_name', $row['user_name'], time() + (24*60*60*10));//expire in 10 days.
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/list_courses.php';

        header('Location:' . $home_url);
       //check to see if the admin exist or not.
      }elseif(mysqli_num_rows($result2) == 1){
        $row2 = mysqli_fetch_array($result2);
        $_SESSION['admin_id'] = $row2['admin_id'];
        $_SESSION['admin_name'] = $row2['admin_name'];
        setcookie('admin_id', $row2['admin_id'], time() + (24*60*60*10));//expire in 10 days
        setcookie('admin_name', $row2['admin_name'], time() + (24*60*60*10));//expire in 10 days.
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/admin.php';
        header('Location:' . $home_url);

      }
      else{
        //didn't sit the cookie
        echo 'incorrect user name or password';
      }

    }
  }else{
    echo 'sign in to enter';
  }
 ?>
