<?php
session_start();
// If the session vars aren't set, try to set them with a cookie
if(!isset($_SESSION['admin_id'])){
  if(isset($_COOKIE['admin_id'])){
    $SESSION['admin_id'] = $_COOKIE['admin_id'];
  }
}
  //include the shared files.
  require_once('shared/head.php');
  require_once('shared/header.php');
  require_once('shared/connect_to_database.php');
  require_once('shared/appvar.php');
  if(isset($_SESSION['admin_id'])){

  $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');
  //query to list all users.
  $query = "SELECT * from users";
  $result = mysqli_query($dbs, $query) or die('fail to query');
  // loop through users.
  while($row = mysqli_fetch_array($result)){

?>
  <!-- display all users name-->
  <div class="container user_container">
    <div class="row">
      <div class="col-6 user_name">
        <h4><?php echo $row['user_name'] ;?></h4>
      </div>
      <!-- to delete user from database-->
      <div class="col-6">
        <?php
          echo '<a class="remove_user" href="remove_user.php?user_id='.$row['user_id'].'&amp;user_name='.$row['user_name'].'&amp;first_name='.$row['first_name'].'&amp;last_name='.$row['last_name'].'&amp;email='.$row['email'].'">Remove</a>';
         ?>
      </div>
    </div>
  </div>
<?php }

}?>
