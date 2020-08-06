<?php
require_once '../controller/galleryController.php';
//session_destroy();
require_once '../controller/albumController.php';
$album = new Album();
$gallery = new Gallery();
if (!isset($_SESSION['email'])) {
    header('Location:homepage.php');
}
?>


<!DOCTYPE html>
<html>

    <head>
        <title>Edit Gallery</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="../js/jquery-3.5.1.min.js"></script>
        <script src="../js/script.js"></script>
    </head>

    <body>

        <!-- Header -->
        <header class="container">
            <div class="header">
                <h2 class="page-title">Welcome To The Photo Gallery.</h2>
                <form action="../controller/loginController.php" method="post">
                    <button type="submit" class="login" name="logout">Logout</button>
                </form>
            </div>
        </header>

        <!-- Main content -->
        <main class="container">

            <!-- Side Menu -->
            <div class="sec1">
                <div class="left">
                    <ul>
                        <li><a href="homepage.php">Home</a></li>
                        <li><a href="userShow.php">User</a></li>
                        <li><a href="registrationForm.php">Registration</a></li>
                        <li><a href="albumShow.php">Album</a></li>
                        <!-- <li><a href="editAlbum.php">Create Album</a></li> -->
                        <li><a href="showMainGallery.php">Gallery</a></li>
                    </ul>
                </div>

                <div class="right">
                    <form action="../controller/galleryController.php" method="post" enctype="multipart/form-data">

                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td></td>
                                <td>
                                    <h3>Edit Gallery</h3>
                                </td>

                            </tr>
                            <?php
                            $id = $_GET['id'];
                            //Query For EditUser
                            // $condition = 'WHERE id = ' . $id;
                            $albumResult = $album->getAlbum('*', 'album', '', '');

//                            $albumSql = "SELECT * FROM `album`";
//                            $albumResult = $conn->query($albumSql);
                            //START:: Code for Gallery All
                            //$id = $_GET['id'];
                            //Query For EditUser
                            $condition = 'WHERE id = ' . $id;
                            $galleryResult = $gallery->getGalleryPhoto('*', $condition, '');
//                            $gallerySql = "SELECT * FROM `gallery` where id = $id";
//                            //echo $sql;
//                            $galleryResult = $conn->query($gallerySql);
                            $galleryRow = $galleryResult->fetch_assoc();
                            //END:: Code for Gallery All
                            ?>

                            <tr>
                                <td class="label"><label><b>Event Name: </b></label></td>

                                <td>


                                    <select name="event" required>
                                        <option value="">---- Select Album ----</option>
<?php
if ($albumResult->num_rows > 0) {
    // output data of each row
    while ($albumRow = $albumResult->fetch_assoc()) {
        ?>
                                                <option value="<?php echo $albumRow['id']; ?>" <?php echo (!empty($galleryRow['album_id']) && ($galleryRow['album_id'] == $albumRow['id']) ? 'selected' : '') ?>>
                                                <?php echo $albumRow['event_name'] ?>
                                                </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                    </select>
                                    </select>

                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $galleryRow['id'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td class="label"></td>
                                <td class="">
                                    <img width="100" height="70" src="../uploads/gallery/<?php echo $galleryRow['image'] ?>" id="img_url" alt="your image" />
                                  <!-- <img src="" id="img_url" alt="your image"> -->
                                    <!-- <br>
                                      <input type="file" id="img_file" onChange="img_pathUrl(this);"> -->
                                </td>
                            </tr>
                            <tr>
                                <td class="label">
                                    <label for="image"><b>Image</b></label>
                                </td>
                                <td>
                                    <input type="file" id="img_file" onChange="img_pathUrl(this);" name="image">
                                    <input type="hidden" name="prev_image" value="<?php echo $galleryRow['image']; ?>" /> 
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button type="submit" name="update" class="uploadbtn">Update</button></td>

                            </tr>

                        </table>






                    </form>
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