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
        //include the shared files.
        include_once('shared/connect_to_database.php');
        include_once('shared/appvar.php');
        require_once('shared/head.php');
        require_once('shared/header.php');

?>
       <!--===========start introduction area==================-->

       <div class="container-fluid margin_bottom_80">
         <div class="row">
            <div class="col-xs-12 col-md-6 introduction">
              <div class="introduction_inner">
                <h3>Start learning now</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus, quaerat beatae nulla debitis vitae.
                </p>
                <form method="post" action="login.php" class="login_form">
                  <input type="text" name="user_name" placeholder="Enter Your Name">
                  <input type="password" name="password" placeholder="Enter Password">
                  <input type="submit" name="submit" value="Log In">
                </form>
              </div>
            </div>
            <div class="col-6 introduction_img">
              <img class="img-fluid" src="static/images/1.jpg" alt="">
            </div>
         </div>
       </div>

       <!--===========end introduction area==============-->

       <!--===========start course slider area==============-->
       <div class="container margin_bottom_80">
         <div class="row">
           <div class="col-12 courses text-center">
             <h4>Popular Courses</h4>
             <p>TOP SOLD COURSES ARE NOW AVAILABLE IN A SUSTAINABLE PRICE.</p>
           </div>
           <div class="col-12">
             <div class="course_slider">
               <!-- fetch the latest added courses from database -->
               <?php
               $dbs = mysqli_connect(HOST_NAME, USER_NAME, PASSWORD, DATABASE_NAME) or die('fail to connect to database');
               //query to list all courses .
               $query = "SELECT * FROM courses ORDER BY date DESC LIMIT 5";
               $result = mysqli_query($dbs, $query) or die('fail to query');

                //select recent courses.
                while($row = mysqli_fetch_array($result)){
               ?>
               <div class="slider_item">
                 <a href="show_specific_course.php?course_name=<?php echo $course_name= str_replace(' ', '_', $row['course_name']); ?>">
                   <img class="img-fluid " src="<?php echo IMG_PATH . $row['thumbnail']  ?>" alt="c">
                   <h3><?php echo $row['course_name'];?></h3>
                   <div class="row">
                     <div class="col-8">
                       <span class="col-8 align-self-center "><?php echo $row['instructor_name'];?></span>
                     </div>
                   </div>
                 </a>
               </div>
             <?php } ?><!-- end of while loop -->
             </div>
           </div>
         </div>
       </div>

       <!--===========end course slider area==============-->

       <!--===========start about me area==============-->
       <div class="about_me_container margin_bottom_80">
         <div class="container">
           <div class="row">
             <div class="col-xs-12 col-md-6 about_me">
               <h4>About Our Company</h4>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. </p>
               <p>Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. </p>
               <p>Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.</p>
               <a href="list_courses.php">Go to courses</a>
             </div>
             <div class="col-6 about_me_img">
               <img class="img-fluid" src="static/images/2.jpg" alt="">
             </div>
           </div>
         </div>
       </div>

       <!--===========end about me area==============-->

    <?php
      //include footer and js files
      require_once('shared/footer.php');
     ?>
