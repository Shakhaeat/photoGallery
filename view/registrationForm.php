<?php
require_once '../controller/userController.php';
if (!isset($_SESSION['email'])) {
  header('Location:homepage.php');
}
$users = new User();
?>
<!DOCTYPE html>
<html>

    <head>
        <title>User Form</title>
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
                    <form action="../controller/userController.php" method="post" enctype="multipart/form-data">

                        <table border="0" cellpadding="0" cellspacing="0">
                            <tbody>


                                <tr>
                                    <td></td>
                                    <td>
                                        <h3>Register form</h3>
                                    </td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Please fill in this form to create an account.</td>

                                </tr>

                                <tr>
                                    <td class="label"><label for="first_name"><b>First Name</b></label></td>
                                    <td><input type="text" placeholder="Enter First Name" name="first_name" required /></td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="last_name"><b>Last Name</b></label></td>
                                    <td><input type="text" placeholder="Enter Last Name" name="last_name" required /></td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="email"><b>Email</b></label></td>
                                    <td><input type="text" placeholder="Enter Email" name="email" id="email" required /></td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="password"><b>Password</b></label></td>
                                    <td><input type="password" placeholder="Enter Password" name="password" id="password" required /></td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="phone"><b>Phone Number</b></label></td>
                                    <td><input type="text" placeholder="Phone Number" name="phone" /></td>
                                </tr>

                                <tr>
                                    <td class="label"><label for="image"><b>Image</b></label></td>
                                    <td><input type="file" id="img_file" name="image" /></td>
                                </tr>

                                <tr>
                                    <td class="label"><label for="divisionId"><b>Division</b></label></td>

                                    <td>
                                        <select name="division" id="divisionId" >
                                            <option value=''> Select Division</option>
                                            <?php
                                            $result = $users->getDivision('*', '', ''); //ORDER BY name ASC
                                            //echo $result;
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value='" . $row['id'] . "'" . ((!empty($divisionID) && $divisionID == $row['id']) ? 'selected' : '') . ">" . $row['name'] . "</option>";
                                                }
                                            }
                                            ?>

                                        </select>
                                    </td>
                                </tr>

                            </tbody>
                            <tbody id="district">
                                <tr>
                                    <td class="label"><label for="districtId"><b>District</b></label></td>
                                    <td>
                                        <select name="district" id="districtId">
                                            <option value=0> Select District</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label"><label for="thanaId"><b>Thana</b></label></td>
                                    <td id="thanaId">
                                        <select name="thana" id="thanaId">
                                            <option value='0'> Select Thana</option>

                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                            <tr>
                                <td></td>
                                <td><button type="submit" class="uploadbtn" name="create">Register</button></td>

                            </tr>

                        </table>



                        <!-- <div>
                        <?php //requrire('footer.php'); 
                        ?>
                          </div> -->

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