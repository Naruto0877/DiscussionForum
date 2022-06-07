<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!--<title></title>-->
  <link rel="stylesheet" href="css/trystyle.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body style="position:absolute;top:0;">
  <div class="wrapper">
    <nav>
      <input type="checkbox" id="show-search">
      <input type="checkbox" id="show-menu">
      <label for="show-menu" class="menu-icon"><i class="fas fa-bars"></i></label>
      <div class="content" >
      <div class="logo"><a style=" font-family:Cursive;" href="https://infelearn.com/">Infe<span style="color:red">L</span>e<span style="color:red">a</span>rn</a></div>
        <ul class="links" >

          <li >  <a href="home.php">HOME</a> </li>
          <li>  <a href="discussion.php" >All TOPICS</a> </li>
          <li> <a href= "addtopic.php" >ADD TOPIC</a></li>
          <li> <a href="search.php" >SEARCH TOPIC</a></li>
          <li> <a href='profile.php?id=<?php echo($_SESSION['userid']); ?>'>MY PROFILE</a></li>
          <li> <a href="logout.php">LOGOUT</a></li>



    </nav>
  </div>

  <div class="dummy-text">
 </div>

</body>
</html>
