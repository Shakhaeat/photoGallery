<?php
  require_once '../controller/userController.php';
  $users = new User();
 // session_start();
//  if (!isset($_SESSION['email'])) {
//    header('Location: view/homepage.php');
//  }
?>
  <?php
  $id = !empty($_POST['id']) ? $_POST['id'] : 0;
  //echo $id;
  //$sql = "SELECT * FROM districts WHERE div_id = " . $id;
  //echo $sql;
  $condition = 'WHERE div_id = ' . $id;
  $result = $users->getDistricts('*', $condition, '');
 // $result = $conn->query($sql);
  ?>
  <tr>
    <td class="label"><label for="districtId"><b>District</b></label></td>
    <td>
      <select name="district" id="districtId">

        <option>Select District</option>
        <?php
        if (!empty($result) && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
            <?php
            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>"; ?>
        <?php
          }
        } ?>
      </select>
    </td>
  </tr>
  <tr>
    <td class="label"><label for="thanaId"><b>Thana</b></label></td>
    <td id="thana">
      <select name="thana" id="thanaId">
        <option value=0>Select Thana</option>
      </select>
    </td>
  </tr>