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
if(isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])){
  //include the shared files.
  require_once('shared/head.php');
  require_once('shared/header.php');
  require_once('shared/connect_to_database.php');
  require_once('shared/appvar.php');
  $course_name = $_GET['course_name'];
  $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');
  //the $course_name equal a table name in the database
  $query = "SELECT * from $course_name";
  $result = mysqli_query($dbs, $query) or die('fail to query');
  //select the first video from the course.
  $query2 = "SELECT video_name FROM $course_name where video_id = 1";
  $result2 = mysqli_query($dbs, $query2) or die('fail');
  $intro = mysqli_fetch_array($result2);
?>
<!--new slider start-->
    <div class=" video-area">
      <div class="container">
        <div class="row" id="video_player">
          <div class="col-3">
            <ul id="links">
              <?php
                while($row = mysqli_fetch_array($result)){
               ?>
              <li>
                <a href="<?php echo VIDEO_PATH.$row['video_name']?>"><?php echo $row['video_name']?></a>
              </li>
              <?php }?>
            </ul>
          </div>

          <div class="col-9" >
             <video controls width="100%">
               <source src="<?php echo VIDEO_PATH . $intro['video_name']?>" type="video/mp4"/>
                 <source src="<?php echo VIDEO_PATH . $intro['video_name']?>" type="video/ogg"/>
             </video>
          </div>
        </div>
      </div>
    </div>
    <!--new slider end-->
<?php require_once('shared/footer.php');

}else{
  echo 'please log in to see content';
}?>
