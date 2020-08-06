<?php
require_once '../controller/albumController.php';
$album = new Album();
if (!isset($_SESSION['email'])) {
    header('Location:homepage.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Gallery Form</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <!-- Header -->  
        <header class="header">
            <div class="container">
                <h2 class="page-title">Welcome To The Photo Gallery.</h2>
                <form action="../controller/loginController.php" method="post">
                    <button type="submit" class="login" name="logout">Logout</button>
                </form>
            </div>   
        </header>
        <!-- Main Content -->  
        <main class="container">
            <!-- Side Menu -->
            <div class="sec1">
                <div class="left">
                    <?php
                    require_once 'leftVar.php';
                    ?>
                </div>

                <div class="right">
                    <form action="../controller/galleryController.php" method="post" enctype="multipart/form-data">
                        <div class="container">
                            <h1>Upload Multiple Photo</h1>



                            <!-- <label ><b>Event Name</b></label>-->

                            <?php
                            $extra = "ORDER BY id DESC";
                            $result = $album->getAlbum('*', 'album', '', $extra);
//                            $sql = "SELECT * FROM `album`  ";
//                            $result = $conn->query($sql);
                            ?>

                            <label>Choose Event Name</label>

                            <select name = "id" required>
                                <option value="">---- Select Album ----</option>
                                <?php
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        ?>

                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['event_name'] ?></option>


                                        <?php
                                    }
                                }
                                ?>
                            </select><br>
                            </select>

                            <input type="file" name="image[]" class="custom-file-input" multiple>


                            <button type="submit" name="create" class="uploadbtn">Upload</button>
                        </div>


                    </form>
                </div>
            </div>
        </main>

        <!-- Footer -->   
        <footer class="footer">
            <div class="container"><p >This is footer</p></div>
        </footer>

    </body>
</html>