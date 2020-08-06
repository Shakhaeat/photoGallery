<?php
require_once '../controller/userController.php';
require_once '../controller/pagination.php';
$pagination = new Pagination();
$users = new User();
$returnArr = $users->getResults('*', 'users', '', '');
if (!isset($_SESSION['email'])) {
    header('Location:homepage.php');
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>User</title>
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
            <div>
                <a href="registrationForm.php" class="btn">Create User</a>
            </div>
            <div class="tle">
                <h3>User list</h3>
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
                    require_once 'massage.php';
                    ?>
                    <div class="of">
                        <table>

                            <tr>
                                <th class="box" width="8%">Serial</th>
                                <th class="box">First Name</th>
                                <th class="box">Last Name</th>
                                <th class="box">Email</th>
                                <th class="box">Phone</th>
                                <th class="box">Photo</th>
                                <th class="box" width="17%">Action</th>
                            </tr>

                            <?php

                            if (!empty($returnArr['result2']) && $returnArr['num_result']>0) {
                                $var = $returnArr['offset'] + 1;
                                foreach ($returnArr['result'] as $row) {
                                    ?>
                                    <tr>
                                        <td class='box'><?php echo $var; ?> </td>
                                        <td class='box'><?php echo $row["first_name"]; ?> </td>
                                        <td class='box'><?php echo $row["last_name"]; ?></td>
                                        <td class='box'><?php echo $row["email"]; ?></td>
                                        <td class='box'><?php echo $row["phone"]; ?></td>
                                        <?php
                                        $src = !empty($row['image']) ? '../uploads/profile/' . $row['image'] : '../uploads/noAvailable.jpg';
                                        ?>
                                        <td class="box">
                                            <img class="image" width="80" height="40" src="<?php echo $src; ?>" alt=""/>
                                        </td>
                                        <td class='box'>
                                            <a class='btn2' href='./editUserForm.php?id=<?php echo $row['id']; ?>'>Edit</a>
                                            <form class="display" method="POST" action="../controller/userController.php">
                                                <input type="hidden" name="del_id" value="<?php echo $row['id']; ?>">
                                                <button name ="delete" type="submit" onclick="return confirm('Are You Sure?');" class="btnDel"> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                    $var++;
                                }
                            } else {
                                echo "<tr><td><h2 class = 'msg'>No User Found</h2></td></tr>";
                            }
                            ?>

                        </table>
                    </div>

                    <?php
                    if (!empty($returnArr['result2']) && $returnArr['num_result']>0) {
                        $pagination->paginate($returnArr);
                    }
//$conn->close();
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