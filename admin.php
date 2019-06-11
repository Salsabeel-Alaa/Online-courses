<?php
session_start();
if(!isset($_SESSION['admin_id'])){
  if(isset($_COOKIE['admin_id'])){
    $SESSION['admin_id'] = $_COOKIE['admin_id'];
  }
}
//link to create a new course
if(isset($_SESSION['admin_id'])){
//include the shared files.
require_once('shared/head.php');
require_once('shared/header.php');
include_once('shared/connect_to_database.php');
//connect to the database
$dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');


?>
 <div class="container admin_page text-center">
   <div class="row" >
     <div class="col-xs-12 col-md-4">
       <a href="create_new_course.php">Create New Course</a>
     </div>
     <div class="col-xs-12 col-md-4">
       <a href="delete_course.php">Delete Course</a>
     </div>
     <div class="col-xs-12 col-md-4">
       <a href="list_users.php">Users</a>
     </div>
   </div>
 </div>
<?php } else{
  ?>
  <!-- if the user is not loged in ask them to log in -->
  <div class="container">
    <div class="row">
      <div class="col-12">
        <p>Please Log in first</p>
        <a href="index.php">Log In</a>
      </div>
    </div>
  </div>
  <?php
}
?>
<!--===========start footer area==============-->
<footer class="container-fluid footer" style="position:fixed; bottom:0">
  <div class="row inner_footer">
    <div class="col-12">
      <span>Coded By SMG</span>
    </div>
  </div>
</footer>

<!--===========end footer area==============-->

<!--js files-->
<script src="static/js/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="static/js/bootstrap.min.js"></script>
<script src="static/js/slick.min.js"></script>
<script src="static/js/custom.js"></script>

</body>
</html>
