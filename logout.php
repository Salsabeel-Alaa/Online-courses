<?php
  session_start();
  //what to do delete the sessions and cookies so the user will be loged out.
  if((isset($_SESSION['user_id'])) || (isset($_SESSION['admin_id']))){
    //to delete the session assign it to empty arrray
    $_SESSION['user_id'] = array();
    $_SESSION['admin_id'] = array();
    //delete the session that stored in cookie.

    if(isset($_COOKIE[session_name()])){
      setcookie(session_name(), '', time() - 3600);
    }
    session_destroy();
  }
  //to delete the cookies as fllowing.
  setcookie('user_id', '', time() -3600);
  setcookie('user_name', '', time() -3600);
  setcookie('admin_id', '', time() -3600);
  //direct the user to home page.
  $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
  header('Location:' . $home_url);

 ?>
