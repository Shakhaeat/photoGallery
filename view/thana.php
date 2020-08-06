<?php
require_once '../controller/userController.php';
$users = new User();
//    session_start();
//    if(!isset($_SESSION['email'])){
//      header('Location: homepage.php');
//    }
?>

<!DOCTYPE html>
<html>
    <head>
    </head>


    <body>

        <?php
        //$id = intval($_POST['id']);
        $id = !empty($_POST['id']) ? $_POST['id'] : 0;
        //echo $id;
        $condition = 'WHERE dis_id = ' . $id;
        $result = $users->getThana('*', $condition, '');
        //echo $sql;
        //$result = $conn->query($sql);
        ?>
        <select name="thana" id="thanaId"> 
            <option value="">Select Thana</option>
            <?php
            if (!empty($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                }
            }
            ?>
        </select>


    </body>
</html>