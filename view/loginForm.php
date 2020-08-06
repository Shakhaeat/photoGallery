<!DOCTYPE html>
<html>
  <head>
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
  <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/script.js"></script>

   </head> 
  <body>
    <!-- Header -->
    <header class="container">
      <div class="header">
        <h2>Welcome To The Photo Gallery.</h2>
      </div>   
    </header>
    <!-- Main Content -->
    <main class="container">

      <!-- Side Menu -->
      <div class="sec1">
        <div class="left">
          <ul>
            <li><a href="homepage.php">Home</a></li>  
            <li><a href="albumShow.php">Album</a></li>
            <!-- <li><a href="showMainGallaery.php">Gallery</a></li> -->
          </ul>
        </div>

        <div class="right">
            <?php
            session_start();
              if(isset($_SESSION['fail']))
              {
                  echo "<div class = 'hideDiv' id='hideDiv'>".$_SESSION['fail']."</div>";
              }
              unset($_SESSION['fail']);
            ?>
            <form action="../controller/loginController.php" method="post" >
            <div class="lbc">
              <table border="0" cellpadding="0" cellspacing="0">
                <tbody >
                  <tr>
                    <td></td>
                    <td><h3>Login form</h3></td>
                    
                  </tr>
                 
                  <tr>
                    <td class="label"><label for="email"><b>Email</b></label></td>
                    <td><input type="text" placeholder="Enter Email" name="email" required></td>
                  </tr>
                  <tr>
                    <td class="label"><label for="password"><b>Password</b></label></td>
                     <td><input type="password" placeholder="Enter Password" name="password" required></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><button type="submit" name="login" class="uploadbtn">Login</button></td>
                   
                  </tr>
               </tbody>
              </table>
            </div>
            
            <!-- <div>
              <?php //requrire('footer.php'); ?>
            </div> -->
            
          </form>
        </div>
      </div>
    </main>
    <!-- Footer -->   
    <footer class="container">
      <div class="footer"><p >This is footer</p></div>
    </footer>

  </body>
</html>