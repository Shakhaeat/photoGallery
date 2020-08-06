<?php
session_start();
//echo $_SESSION['id'];
//exit;
?>
<!DOCTYPE html>
<html>

<head>
  <title>Homepage</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="../js/script.js"></script>


</head>

<body>

  <!-- Header -->
  <header class="header">
    <div class="container">
      <?php if (isset($_SESSION['email'])) { ?>
        <!--  <a href="profile.php"> -->
        <img src="../uploads/profile/<?php echo $_SESSION['image']; ?>" class="design">
        <!-- </a> -->
      <?php } ?>
      <h2 class="page-title">Welcome To The Photo Gallery.</h2>
      <?php if (!isset($_SESSION['email'])) { ?>
        <a href="loginForm.php" class="login">Login</a>
      <?php
      } else {
      ?>
        <form action="../controller/loginController.php" method="post">
            <button type="submit" class="login" name="logout">Logout</button>
        </form>

      <?php } ?>
    </div>
  </header>
  <main class="container">

    <!-- Side Menu -->
    <div class="sec1">
      <div class="left">
       <?php    
            require_once 'leftVar.php';
        ?>
      </div>

      <div class="right">
        <?php
        if (isset($_SESSION['success'])) {
          echo "<div class = 'hideDiv' id='hideDiv'>" . $_SESSION['success'] . '</div>';
          unset($_SESSION['success']);
        }
        ?>

        <p>A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully.A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully. A positive first impression is a vital start to forging a strong relationship with potential customers. Welcome messages act as a great strategy to be a part of the customer journey, understand them more, and provide better understanding of taking the next action to use the product successfully.</p>
      </div>

    </div>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>This is footer</p>
    </div>
  </footer>

</body>

</html>