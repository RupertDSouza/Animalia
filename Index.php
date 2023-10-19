<?php 
require('db.conn.php');
            
  if(isset($_POST['search']) && isset($_POST['input'])){
    $input = $_POST['input'];
    $query="SELECT * FROM Animal where name LIKE '%$input%' UNION SELECT * FROM Bird where name LIKE '%$input%' UNION SELECT * FROM Insect where name LIKE '%$input%' ";
    $_SESSION['input']=$query;
    header('Location:./pages/User');
        die();
  }

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./style/style.css?v=201023.1.9">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="./style/search-bar-pages.css">
<!-- <link rel="stylesheet" href="./style/cards.css"> -->

</head>
<body>
<script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
<!--logo-->
<!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand">
    <img src="./images/lo.png" width="250" height="40" class="d-inline-block align-top" alt="">
</a>
</nav>
<!--logo end-->
  <!--search-->
  <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
    <div class="search-box">
      <input class="search-input" type="text" name="input" placeholder="Search something..">
      <button class="search-btn" type="submit" name="search"><i class="fas fa-search"></i></button>
    </div>
  </form>
<!-- END search -->
<!--hamburger menu button-->
<div id="menu">
  <div id="menu-bar" onclick="menuOnClick()">
    <div id="bar1" class="bar"></div>
    <div id="bar2" class="bar"></div>
    <div id="bar3" class="bar"></div>
  </div>

  <nav class="nav" id="nav">
    <ul>
      <?php if(isset($_SESSION['ROLE']) && $_SESSION['ROLE']==1){ ?>
      <li><a href="./pages/Admin">Home</a></li> 
      <?php } else {?>
      <li><a href="./">Home</a></li> 
      <?php } ?>
      <li><a href="./pages/User/Contactus.php">Contact</a></li>
      <?php 
            if(isset($_SESSION['UNAME'])){ ?>
              <li style='color:#eee;'><?php echo $_SESSION['UNAME']; ?></li>
              <li><button class="log" onClick="location.href='./pages/Login/logout.php'">LOGOUT</a></button></li>
        <?php }else{ $_SESSION['NAME'] = "";?>
                <li><button class="log" onClick="location.href='./pages/Login/'">LOGIN</button></li>
        <?php } ?>
    </ul>
  </nav> 
</div>
<div class="menu-bg" id="menu-bg"></div>
<script src="./java/script.js"></script>
<!--hamburger menu button end-->

<!--profile grid-->

<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap -mx-4 -mb-10 text-center">
      
      <?php

            if(isset($_POST['new'])) {
              $_SESSION['name']= $_POST['new'];
              header("Location:./pages/User");
              die();
              }

        $sql="SELECT * FROM Animal where id = 1 UNION SELECT * FROM Bird where id = 1 UNION SELECT * FROM Insect where id = 1";
        $result = $con->query($sql) or die($con->error);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

        echo "<div class='sm:w-1/2 mb-10 px-4'>";
        //echo "<div class='rounded-lg h-64 overflow-hidden'>";
        echo "<form method='post'>";
            echo "<button class='rounded-lg h-64 w-full overflow-hidden' name='new' value='".$row['name']."' type='submit'>";
            echo "<img alt='content' class='object-cover object-center h-full w-full' src='data:image/jpeg;base64,".base64_encode( $row['image'] )."'/>";
            echo "</button>";
            echo "<h2 class='title-font text-2xl font-medium text-900 mt-6 mb-3' style='color: #DC5F00;'>".$row['name']."</h2>";
            echo "</form>";
        //echo "</div>";
        echo "</div>";
            }
            $con->close();
          }
?>

    </div>
  </div>
</section>


<!--end profile grid-->
<!-- footer -->
<footer class="text-gray-600 body-font">
  <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
    <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
     
        <img src="./images/lo.png" width="100px" height="100px" style="right:50%"> <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
     

    </a>
    <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2023 Mini Project —
      <a href="#" class="text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">@Anet</a>
      <a href="#" class="text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">@Anish</a>
    </p>
    <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
      <a class="text-gray-500">
        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
          <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
        </svg>
      </a>
      <a class="ml-3 text-gray-500">
        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
          <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
        </svg>
      </a>
      <a class="ml-3 text-gray-500">
        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
          <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
          <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
        </svg>
      </a>
      <a class="ml-3 text-gray-500">
        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
          <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
          <circle cx="4" cy="4" r="2" stroke="none"></circle>
        </svg>
      </a>
    </span>
  </div>
</footer>
<!-- footerend -->
</body>
</html>