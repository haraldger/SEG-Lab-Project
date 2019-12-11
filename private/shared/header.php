<!doctype html>

<?php
  if(!isset($page_title)) { $page_title = 'KCLCS'; }
?>


<html lang="en" style="position: relative;">
  <head>
    <title><?php echo h($page_title) ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <!-- needs link to css -->
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../public/index.php">KCLSU</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
          <li class="nav-item">
          <a class="nav-link" href="<?php echo(url_for('index.php')); ?>">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
          <a class="nav-link" href="/SEG-Lab-Project/public/about.php">About</a>
            </li>
            <li class="nav-item">
          <a class="nav-link" href="/SEG-Lab-Project/public/contact.php">Contact</a>
            </li>
            <li class="nav-item">
          <a class="nav-link" href="/SEG-Lab-Project/public/news.php">News</a>
            </li>
          </ul>
          <div class="collapse navbar-collapse justify-content-end">
           <ul class="navbar-nav">


          <?php
          if(!am_logged_in()){
            echo(
              '<li class="nav-item px-md-1">
                <a href="/SEG-Lab-Project/public/login.php"><button type="button" class="btn btn-secondary">Login</button></a>
              </li>
              <li class="nav-item px-md-1">
                <a href="/SEG-Lab-Project/public/register.php"><button type="button" class="btn btn-primary ">Register</button></a>
              </li>'
            );
          }

          if(am_officer() || am_sysadmin()){
            echo(
              '
                <li class="nav-item px-md-1">
                  <a class="nav-link" href="' . url_for('officer/index.php') . '">Admin</button></a>
                </li>
              '
            );
          }

          if(am_logged_in()){ 
            echo( /*Links to profile page*/
              '
                <li class="nav-item px-md-1">
                  <a class="nav-link" href="/SEG-Lab-Project/public/member/profiles/index.php?id=' . get_session_id() . '">Profile</a>
                </li>
                <li class="nav-item px-md-1">
                  <a href="/SEG-Lab-Project/public/logout.php"><button type="button" class="btn btn-secondary">Log out</button></a>
                </li>
              '
            );
          }



          
          ?>

          </ul>
          </div>
        </div>
      </nav>
    </header>
