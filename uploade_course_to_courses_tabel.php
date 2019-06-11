<?php
session_start();

//make sure the admin is logged in.
if(isset($_SESSION['admin_id'])){
//include the shared files.
require_once('shared/head.php');
require_once('shared/header.php');
require_once('shared/connect_to_database.php');
require_once('shared/appvar.php');

if(isset($_POST['submit'])){
  $course_name = $_SESSION['course_name'];
  //check the form fields are not empty.
  if(!empty($thumbnail) &&!empty($description) &&!empty($instructor_name) && !empty($category_id)){
    //check the image extension is valid.
    if((($thumbnail_type == 'image/gif') || ($thumbnail_type == 'image/jpeg') || ($thumbnail_type == 'image/pjpeg') || ($thumbnail_type == 'image/png'))){
      //the image path
      $target = IMG_PATH . $thumbnail;
      //move the file from the temporary location to the specified path
      if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target)){
        //connect to the database
        $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');
        //grab the course data from the form
        $thumbnail = $_FILES['thumbnail']['name'];
        $tmp_name = $_FILES['thumbnail']['tmp_name'];
        $thumbnail_type = $_FILES['thumbnail']['type'];
        $description = mysqli_real_escape_string($dbs, trim($_POST['description']));
        $category_id = $_POST['category_id'];
        $instructor_name = mysqli_real_escape_string($dbs, trim($_POST['instructor_name']));
        //query to insert form data
        $query = "INSERT INTO courses VALUES (0, '$course_name', '$thumbnail', '$category_id', '$description', '$instructor_name', NOW())";
        $result = mysqli_query($dbs, $query) or die ('fail to query');
        //redirect the admin to uploade course content.
        $home_url = 'http://'  . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/uploade_new_course_content.php';
        header('Location:' . $home_url);
        mysqli_close($dbs);

      }else{
        echo '<div class="empty_filels"><span>Error uploading image </span></div>';
      }
    }else{
      //the video extension not in the right formate.
      echo '<div class="empty_filels"><span> Video extension must be jpg, png. </span></div>';
    }
  }else{
    echo '<div class="empty_filels"><span>fill the empty fields. </span></div>';
  }
}
?>
<div class="container uploade_new_course_container">
  <div class="row">
    <div class="col-12 text-center">
      <h3 class="text-center">uploade course describtion</h3>
      <form class="uploade_new_course_form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
        <label for="Category_id">Enter course category</label>
        <select name="category_id">
          <option name="category_id" value="1">Computer science</option>
          <option name="category_id" value="2">Physics</option>
          <option name="category_id" value="3">Geology</option>
        </select>

        <label for="thumbnail">enter Course thumbnail</label>
        <input type="file" name="thumbnail" >

        <label for="instructor_name">enter instructor name</label>
        <input type="text" name="instructor_name" >


        <label for="descriptin">Enter Description of the video</label>
        <input type="text" name="description" placeholder="EG: introduction to what you will learn">

        <input type="submit" value="Uploade course" name="submit">
      </form>

    </div>
  </div>

</div>
<!--===========start footer area==============-->
    <?php

      //include footer and js files
      require_once('shared/footer.php');

      }
    ?>
