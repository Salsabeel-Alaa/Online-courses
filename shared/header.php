    <body class="site">
      <!--==========start header===============-->
      <header class="container-fluid ">
        <div class="upper_header">
          <ul class="contact_info">

            <li>
              <a href="#">hello@support.com</a>
            </li>
            <li>
              <a href="#">+(20) 000 1010 2761</a>
            </li>
          </ul>
          <ul class="social_media">
          <li>
            <a href="">
              <i class="icofont-facebook"></i>
            </a>
          </li>
          <li>
            <a href="">
              <i class="icofont-google-plus"></i>
            </a>
          </li>
          <li>
            <a href="">
              <i class="icofont-twitter"></i>
            </a>
          </li>
          <li>
            <a href="">
              <i class="icofont-snapchat"></i>
            </a>
          </li>
          <li>
            <a href="">
              <i class="icofont-envelope"></i>
            </a>
          </li>
          <li>
            <a href="">
              <i class="icofont-flikr"></i>
            </a>
          </li>
          <li>
            <a href="">
              <i class="icofont-rss"></i>
            </a>
          </li>
        </ul>
        </div>
        <!--====start navbar-->
        <nav class="navbar navbar-expand-md navbar-light bg-light">
          <a class="navbar-brand" href="#">Phoenix</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="list_courses.php">Courses</a>
              </li>
              <?php
                if(isset($_SESSION['admin_id'])){


              ?>
              <li class="nav-item">
                <a class="nav-link" href="admin.php">Admin</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
              </li>
            <?php }
                elseif(isset($_SESSION['user_id'])){
              ?>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
              </li>
              <?php
            }else{
              ?>
               <li class="nav-item">
                 <a class="nav-link" href="signup.php">Sign Up</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="index.php">Log In</a>
               </li>
             <?php } ?>
            </ul>
          
          </div>
        </nav>
        <!--===end navbar-->
      </header>


       <!--===========end header area==================-->
