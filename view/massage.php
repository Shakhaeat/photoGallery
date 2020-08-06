<?php

if (isset($_SESSION['create'])) {
    echo "<div class = 'hideDiv' id='hideDiv'>" . $_SESSION['create'] . '</div>';
    unset($_SESSION['create']);
} elseif (isset($_SESSION['delete'])) {
    echo "<div class = 'hideDiv' id='hideDiv'>" . $_SESSION['delete'] . '</div>';
    unset($_SESSION['delete']);
} elseif (isset($_SESSION['update'])) {
    echo "<div class = 'hideDiv' id='hideDiv'>" . $_SESSION['update'] . '</div>';
    unset($_SESSION['update']);
}

?>
