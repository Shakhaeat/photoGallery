<?php
require_once '../controller/galleryController.php';
require_once '../controller/pagination.php';

$pagination = new Pagination();

$gallery = new Gallery();
$returnArr = $gallery->getGalleries('*', '');
?>


<!DOCTYPE html>
<html>

    <head>
        <title>Gallery</title>
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
                <h3>Photo Gallery</h3>
            </div>
            <?php
            if (isset($_SESSION['email'])) {
                ?>
                <div>
                    <a href="galleryForm.php" class="btn3">Create Gallery</a>
                </div>
                <?php
            }
            ?>
            <!-- Side Menu -->
            <div class="sec1">
                <div class="left">
                    <ul>
                        <li><a href="homepage.php">Home</a></li>
                        <li><a href="userShow.php">User</a></li>
                        <li><a href="registrationForm.php">Registration</a></li>
                        <!--  <li><a href="editAlbum.php">Create Album</a></li> -->
                        <li><a href="albumShow.php">Album</a></li>
                        <li><a href="showMainGallery.php">Gallery</a></li>
                    </ul>
                </div>

                <div class="right">
                    <table class="editTable">
                        <tr>
                            <th class="box" width="10%">Serial</th>
                            <th class="box" width="15%">Event Name</th>
                            <th class="box" width="10%">Gallery Photo</th>
                            <?php
                            if (isset($_SESSION['email'])) {
                                ?>
                                <th class="box" width="15%">Action</th>
                                <?php
                            }
                            ?>
                        </tr>

                        <?php
                        if (!empty($returnArr['result2']) && $returnArr['num_result'] > 0) {
                            $var = $returnArr['offset'] + 1;
                            foreach ($returnArr['result'] as $row) {
                                // echo "event: " . $row["event_name"] ."<br>";
                                $src = !empty($row['image']) ? '../uploads/gallery/' . $row['image'] : 'uploads/noAvailable.jpg';
                                ?>



                                <tr>
                                    <td class='box'> <?php echo $var; ?> </td>
                                    <td class='box'> <?php echo $row['event_name']; ?></td>
                                    <td class="box" >
                                        <img width="80" height="40" src="<?php echo $src; ?>"/>
                                    </td>
                                    <?php
                                    if (isset($_SESSION['email'])) {
                                        ?>
                                        <td class="box">
                                            <a class='btn2' href='./editGalleryForm.php?id=<?php echo $row['id']; ?>'>Edit</a>
                                            <form class="display" method="POST" action="../controller/galleryController.php">
                                                <input type="hidden" name="del_id" value="<?php echo $row['id']; ?>">
                                                <button name ="delete" type="submit" onclick="return confirm('Are You Sure?');" class="btnDel"> Delete</button>
                                            </form>
                                        </td>
                                        <?php
                                    }
                                   
                                    $var++;
                                }
                            } else {
                                echo "<tr><td><h2 class = 'msg'>No Gallery Photo Found</h2></td></tr>";
                            }
                            ?>

                    </table>

                    <?php
                    if (!empty($returnArr['result2']) && $returnArr['num_result'] > 0) {
                        //$requestArr = ['key' => 'id', 'value' => $album_id];
                        $pagination->paginate($returnArr);
                    }
                    ?>
                    
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