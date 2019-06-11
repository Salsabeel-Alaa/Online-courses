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
    $course_name = str_replace(' ', '_', $_SESSION['course_name']);
    //connect to the database
    $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');
    //grab the course data from the form
    $video_name = $_FILES['video_name']['name'];
    $tmp_name = $_FILES['video_name']['tmp_name'];
    $position = strpos($video_name, ".");
    $file_extension = substr($video_name, $position + 1);
    $file_extension = strtolower($file_extension);
    $description = mysqli_real_escape_string($dbs, trim($_POST['description']));

    //check the form fields are not empty.
    if(!empty($video_name) &&!empty($description)){
      //check the videos extension is valid.
      if(($file_extension == 'mp4') || ($file_extension == 'ogg') || ($file_extension == 'webm')){
        //the video path
        $target = VIDEO_PATH . $video_name;
        //move the file from the temporary location to the specified path
        if(move_uploaded_file($_FILES['video_name']['tmp_name'], $target)){

          $query = "INSERT INTO $course_name (video_name, description, file_extension) VALUES ('$video_name', '$description', '$file_extension')";
          mysqli_query($dbs, $query) or die ('fail sara');
          
          mysqli_close($dbs);

        }else{
          echo '<div class="empty_filels"><span>Error uploading video </span></div>';
        }
      }else{
        //the video extension not in the right formate.
        echo '<div class="empty_filels"><span> Video extension must be mp4 , ogg or webm. </span></div>';
      }
    }else{
      echo '<div class="empty_filels"><span>fill the empty fields. </span></div>';
    }
  }
  ?>
  <div class="container uploade_new_course_container">
    <div class="row">
      <div class="col-12">
        <h3 class="text-center">uploade course content</h3>
        <form class="uploade_new_course_form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">

          <label for="video_name">Uploade the video</label>
          <input type="file" name="video_name" >


          <label for="descriptin">Enter Description of the video</label>
          <input type="text" name="description" placeholder="EG: introduction to what you will learn">

          <input type="submit" value="Uploade Video" name="submit">
        </form>
      </div>
    </div>

  </div>
  <?php
    //include footer and js files
    require_once('shared/footer.php');
  }
   ?>
