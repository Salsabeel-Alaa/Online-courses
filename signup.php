<?php
  //include the shared files.
  require_once('shared/connect_to_database.php');
  require_once('shared/appvar.php');
  require_once('shared/head.php');
  require_once('shared/header.php');

  $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');
  if(isset($_POST['submit'])){
    //grab form data.
    $first_name = mysqli_real_escape_string($dbs, trim($_POST['first_name']));
    $last_name = mysqli_real_escape_string($dbs, trim($_POST['last_name']));
    $email = mysqli_real_escape_string($dbs, trim($_POST['email']));
    $password = mysqli_real_escape_string($dbs, trim($_POST['password']));
    $user_name = mysqli_real_escape_string($dbs, trim($_POST['user_name']));
    //check to see if the user already exist.
    $query = "SELECT * from users where user_name = '$user_name'";
    $result = mysqli_query($dbs, $query) or die('fail to query');
    if(mysqli_num_rows($result) == 0){
      //he is a new user.
      $query = "INSERT INTO users (first_name, last_name, user_name, email, password) VALUES ('$first_name', '$last_name', '$user_name', '$email', SHA('$password'))" ;

      mysqli_query($dbs, $query) or die ("fail to query");
      //redirect user to home page.
      $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
      header('Location:' . $home_url);

    }


  }

?>
<!--===========end header area=============-->

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="sign_up_form_container">
        <h3 class="h1 text-center">Sign Up</h3>
        <form class="sign_up_form " method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
          <label for="first_name">enter your first name</label>
          <input type="text" name="first_name">
          <label for="last_name">enter your last name</label>
          <input type="text" name="last_name">
          <label for="user_name">enter your username</label>
          <input type="text" name="user_name">
          <label for="email">enter your email</label>
          <input type="email" name="email">
          <label for="password">enter your password</label>
          <input type="password" name="password">
          <input class ="submit"type="submit" name="submit" value="Sign Up">
        </form>
        <div class="link_to_log_in">
          <span>already a member</span>
          <a href="index.php">Log In</a>
        </div>
      </div>
    </div>
  </div>
</div>


 <!--===========start footer area==============-->
 <footer class="footer">
   <span>Coded By SMG</span>
 </footer>

<!--===========end footer area==============-->
<?php
  require_once('shared/footer.php');
 ?>
