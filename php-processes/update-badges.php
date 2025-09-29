<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

echo "connected successfully".'<br>';

$userID = $_SESSION["user_id"];
$id = $_POST["id"];

$id1 = "start-1st-project";
$id2 = "first-daily";
$id3 = "quarter-quomplete";
$id4 = "half-way";
$id5 = "all-downhill";
$id6 = "cross-finish";
$id7 = "on-track";
$id8 = "out-gate";
$id9 = "streak-two";
$id10 = "streak-three";
$id11 = "streak-seven";
$id12 = "streak-fourteen";
$id13 = "streak-twentyOne";
$id14 = "every-streak";
$id15 = "back-it-up";
$id16 = "outline";
$id17 = "journey";
$id18 = "dual-wielder";
$id19 = "gathering";
$id20 = "hear-ye";
$id21 = "breakthrough";
$id22 = "starting-fresh";
$id23 = "ever-persist";
$id24 = "touch-grass";
$id25 = "business";
$id26 = "tears-wept";
$id27 = "overachiever";
$id28 = "finish-him";
$id29 = "complete-one-project";
$id30 = "complete-five-project";
$id31 = "complete-ten-project";
$id32 = "streak-fiend";
$id33 = "hydra-slayer";
$id34 = "vet-streaker";
$id35 = "vet-guild";
$id36 = "start-first-project";
$id37 = "spicy-spicy";
$id38 = "tears-alltime";

echo "badge id set".'<br>';

switch ($id) {
    case $id1:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `start-1st-project`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id2:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `first-daily`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id3:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `quarter-quomplete`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id4:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `half-way`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id5:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `all-downhill`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id6:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `cross-finish`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id7:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `on-track`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id8:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `out-gate`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id9:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-two`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id10:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-three`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id11:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-seven`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id12:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-fourteen`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id13:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-twentyOne`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id14:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `every-streak`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id15:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `back-it-up`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id16:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `outline`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id17:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `journey`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id18:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `dual-wielder`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id19:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `gathering`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id20:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `hear-ye`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id21:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `breakthrough`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id22:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `starting-fresh`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id23:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `ever-persist`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id24:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `touch-grass`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id25:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `business`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id26:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `tears-wept`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id27:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `overachiever`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id28:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET `finish-him`=? WHERE users_id=$userID AND current_state='current'");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id29:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-one-project`=? WHERE id=$userID");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id30:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-five-project`=? WHERE id=$userID");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id31:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-ten-project`=? WHERE id=$userID");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id32:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `streak-fiend`=? WHERE id=$userID");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id33:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `hydra-slayer`=? WHERE id=$userID");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id34:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `vet-streaker`=? WHERE id=$userID");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id35:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `vet-guild`=? WHERE id=$userID");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id36:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `start-first-project`=? WHERE id=$userID");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id37:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `spicy-spicy`=? WHERE id=$userID");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    case $id38:
        $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `tears-alltime`=? WHERE id=$userID");
        $stmt->bind_param("s",
                                $_POST["badge"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
        break;
    default:
      echo "Something went wrong";
  }
$stmt -> close();
mysqli_close($conn);
?>