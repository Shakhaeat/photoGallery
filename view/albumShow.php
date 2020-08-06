<?php
require_once '../controller/albumController.php';
require_once '../controller/pagination.php';

$pagination = new Pagination();
$album = new Album();
$returnArr = $album->getAlbums('*', '', '');
//session_start();
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Album Show</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="../js/jquery-3.5.1.min.js"></script>
        <script src="../js/script.js"></script>

    </head>

    <body>
        <!-- Header -->
        <header class="container">
            <div class="header">
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

        <!-- For massage show -->
        <?php
//        if (isset($_SESSION['create'])) {
//            echo "<div class = 'hideDiv' id='hideDiv'>" . $_SESSION['create'] . '</div>';
//            unset($_SESSION['create']);
//        } elseif (isset($_SESSION['delete'])) {
//            echo "<div class = 'hideDiv' id='hideDiv'>" . $_SESSION['delete'] . '</div>';
//            unset($_SESSION['delete']);
//        } elseif (isset($_SESSION['update'])) {
//            echo "<div class = 'hideDiv' id='hideDiv'>" . $_SESSION['update'] . '</div>';
//            unset($_SESSION['update']);
//        }
        require_once 'massage.php';
        ?>

        <!-- Main Content -->
        <main class="container">
            <div class="tle">
                <h3>Photo Album</h3>
            </div>
            <?php
            if (isset($_SESSION['email'])) {
                ?>

                <div>
                    <a href="albumForm.php" class="btn3">Create Album</a></li>
                    <!-- <a href="deleteAlbum.php" class="btnDel">Delete Album</a></li> -->

                </div>
                <?php
            }
            ?>
            <!-- Side Menu -->
            <div class="sec1">
                <div class="left">
                    <ul>
                        <li><a href="homepage.php">Home</a></li>
                        <?php
                        //echo $_SESSION['email'];
                        if (isset($_SESSION['email'])) {
                            echo '<li><a href="userShow.php">User</a></li>';
                            echo '<li><a href="registrationForm.php">Registration</a></li>';
                            // echo '<li><a href="editAlbum.php">Create Album</a></li>';
                        }
                        ?>
                        <li><a href="albumShow.php">Album</a></li>
                        <?php if (isset($_SESSION['email'])) { ?>
                            <li><a href="showMainGallery.php">Gallery</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>

                <div class="right">


                    <?php
                    if (!empty($returnArr['result2']) && $returnArr['num_result']>0) {
                        $var = $returnArr['offset'] + 1;
                        foreach ($returnArr['result'] as $row) {
                            $src = !empty($row['image']) ? '../uploads/cover/' . $row['image'] : 'uploads/noAvailable.jpg';
                            ?>
                            <div class="gallery">
                                <a href="galleryShow.php?id=<?php echo $row['id']; ?> "> <img src="<?php echo $src; ?>"/> </a>
                                <h4>Event Name: <?php echo $row["event_name"]; ?></h4>
                                <?php
                                if (isset($_SESSION['email'])) {
                                    ?>
                                    <div class='desc'>
                                        <a type="button" class='btn2' href='./editAlbumForm.php?id=<?php echo $row['id']; ?>'>Edit</a>
                                        <form class="display" method="POST" action="../controller/albumController.php">
                                            <input type="hidden" name="del_id" value="<?php echo $row['id']; ?>">
                                            <button name ="delete" type="submit" onclick="return confirm('Are You Sure?');" class="btnDel"> Delete</button>
                                        </form>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<h2 class = 'msg'>No Album Found</h2>";
                    }
                    //exit;
                    if (!empty($returnArr['result2']) && $returnArr['num_result']>0) {
                        $pagination->paginate($returnArr);
                    }
                    ?>

                </div>

            </div>

        </main>

        <!-- Footer -->
        <footer class="container">
            <div class="footer">
                <p>This is footer</p>
            </div>
        </footer>


    </body>

</html>