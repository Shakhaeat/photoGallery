<ul>
    <li><a href="homepage.php">Home</a></li>
    <?php
    //echo $_SESSION['email'];
    if (isset($_SESSION['email'])) {
        echo '<li><a href="userShow.php">User</a></li>';
        echo '<li><a href="registrationForm.php">Registration</a></li>';
    }
    ?>
    <li><a href="albumShow.php">Album</a></li>
    <?php
    if (isset($_SESSION['email'])) {
        ?>
        <!-- <li><a href="editAlbum.php">Create Album</a></li> -->
        <li><a href="showMainGallery.php">Gallery</a></li>
        <?php
    }
    ?>

</ul>

