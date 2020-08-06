<?php
require_once '../controller/galleryController.php';
require_once '../controller/pagination.php';

$pagination = new Pagination();
$gallery = new Gallery();
$album_id = $_REQUEST['id'];
//echo $album_id;
$returnArr = $gallery->getGallerry('*', '', '');

//if (!isset($_SESSION['email'])) {
//    header('Location: homepage.php');
//}
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Gallery Show</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
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
       
        ?>
        <!-- Main Content -->

        <main class="container">
            <div class="tle">
                <h3>Gallery</h3>
            </div>
            <!-- Side Menu -->
            <div class="sec1">
                <div class="left">
                    <?php
                    require_once 'leftVar.php';
                    ?>
                </div>

                <div class="right">

                    <?php
                    
                    if (!empty($returnArr['result2']) && $returnArr['num_result']>0) {
                       // $var = $returnArr['offset'] + 1;
                        foreach ($returnArr['result'] as $row) {
                            echo "<div class='gallery'>";

                            //	echo "event: " . $row["event_name"] ."<br>";
                            echo '<img src="../uploads/gallery/' . $row['image'] . '"/>';
                            if (isset($_SESSION['email'])) {
                                ?>
                                <div class='desc'>
                                    <a class='btn2' href='./editGalleryForm.php?id=<?php echo $row['id']; ?>'>Edit</a>
                                    <form class="display" method="POST" action="../controller/galleryController.php">
                                        <input type="hidden" name="del_id" value="<?php echo $row['id']; ?>">
                                        <button name ="delete" type="submit" onclick="return confirm('Are You Sure?');" class="btnDel"> Delete</button>
                                    </form>

                                </div>
                                <?php
                            }
                            //echo "<br>";
                            // echo "id: " . $row["id"] ."<br>";
                            echo "</div>";
                        }
                    } else {
                        echo "<h2 class='msg'>No gallery photo Uploaded..</h2>";
                    }
                    //exit;
                    // $conn->close();
                    if (!empty($returnArr['result2']) && $returnArr['num_result']>0) {
                        $requestArr = ['key' => 'id', 'value' => $album_id];
                        $pagination->paginate($returnArr, $requestArr);
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