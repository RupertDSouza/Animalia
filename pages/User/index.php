<?php
require('../../db.conn.php');
if (isset($_SESSION['UNAME'])==false) {
  header('location:../Login');
  die();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../style/style.css">
<script src="../../java/script.js"></script>
<link rel="stylesheet" href="../../style/animal-grid.css">
<link rel="stylesheet" href="../../style/search-bar-pages.css">
<script src="https://cdn.tailwindcss.com"></script>

<style>
   .click{
    transition: transform 450ms;
    cursor: pointer;
   }

   .click:hover{
  transform: scale(1.08);
  opacity: 1;
}

</style>
</head>
<body>
<!--logo-->
<!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="../../">
    <img src="../../images/lo.png" width="280" height="80" class="d-inline-block align-top" alt="">
    
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
      <li><a href="../../">Home</a></li>
      <li><a href="./Contactus.php">Contact</a></li>
      <li style='color:#eee;'><a><?php echo $_SESSION['UNAME']; ?><a></li>
      <li><a href="../Login/logout.php">LOGOUT</a></li>
    </ul>
  </nav> 
</div>
<div class="menu-bg" id="menu-bg"></div>

<!--hamburger menu button end-->
<!--grid-->
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <!-- <div class="flex flex-wrap -mx-4 -mb-10 text-center"> -->

  <?php
            
// this header is put here to avoid error hearder sent before ...
            if(isset($_POST['newimage'])) {
              $_SESSION['id']= $_POST['newimage'];
              header("Location:Display.php");
              die();
              }
              
              if(isset($_SESSION['name']))
                $name=$_SESSION['name'];

              if(isset($_SESSION['input'])){
                $sql=$_SESSION['input'];
                unset($_SESSION['input']);
              }
              elseif(isset($_POST['search']) && isset($_POST['input'])){
                $input = $_POST['input'];
                $sql="SELECT * FROM $name where name LIKE '%$input%' AND id > 1 ";
              }
              else{
                $sql="SELECT * FROM $name where id > 1 ";
              }
                $result = $con->query($sql) or die($con->error);
                $res=$result->num_rows;
              
                if ($res > 0) {
                  for($i=1;$i<=$res+1;$i++){
                  echo "<div class='image-row'>";
                  while($row = $result->fetch_assoc()) { 
                    echo "<form method='post'>";
                    echo "<button class='click' name='newimage' value='".$row['id']."' type='submit'>";
                    echo "<img class='image' src='data:image/jpeg;base64,".base64_encode($row["image"])."'>";//warning was shown here..
                    echo "</button>";
                    echo "</form>";
                      if($row['id']%5==0)
                      {
                        $i=$row['id'];
                        break;
                      }
                    }
                    echo "</div>";
            }
            $con->close(); 
          }
?>
<!-- </div> -->
        </div>
        </section>
<!--end grid-->
<!--java script for hover-->
<script>

</script>   

<!--End for script for hover-->

</body>
</html>