<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
// xamppConnect();

$unlocked = "unlocked";

echo $unlocked;

//! unLocked
//* First Daily
$stmt1 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `first-daily`=? WHERE `first-daily`='images/badges/first-daily-color.webp'");
    
$stmt2 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `first-daily`=? WHERE `first-daily`='images/badges/first-daily-color.png'");

//* quarter-quomplete
$stmt3 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `quarter-quomplete`=? WHERE `quarter-quomplete`='images/badges/quarter-quomplete-color.webp'");

$stmt4 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `quarter-quomplete`=? WHERE `quarter-quomplete`='images/badges/quarter-quomplete-color.png'");

//* half-way
$stmt5 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `half-way`=? WHERE `half-way`='images/badges/half-way-color.webp'");

$stmt6 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `half-way`=? WHERE `half-way`='images/badges/half-way-color.png'");

//* all-downhill
$stmt7 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `all-downhill`=? WHERE `all-downhill`='images/badges/all-downhill-color.webp'");

$stmt8 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `all-downhill`=? WHERE `all-downhill`='images/badges/all-downhill-color.png'");

//* cross-finish
$stmt9 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `cross-finish`=? WHERE `cross-finish`='images/badges/cross-finish-color.webp'");

$stmt10 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `cross-finish`=? WHERE `cross-finish`='images/badges/cross-finish-color.png'");

//* on-track
$stmt11 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `on-track`=? WHERE `on-track`='images/badges/on-track-color.webp'");

$stmt12 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `on-track`=? WHERE `on-track`='images/badges/on-track-color.png'");

//* streak-two
$stmt13 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-two`=? WHERE `streak-two`='images/badges/streak-two-color.webp'");

$stmt14 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-two`=? WHERE `streak-two`='images/badges/streak-two-color.png'");

//* streak-three
$stmt15 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-three`=? WHERE `streak-three`='images/badges/streak-three-color.webp'");

$stmt16 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-three`=? WHERE `streak-three`='images/badges/streak-three-color.png'");

//* streak-seven
$stmt17 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-seven`=? WHERE `streak-seven`='images/badges/streak-seven-color.webp'");

$stmt18 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-seven`=? WHERE `streak-seven`='images/badges/streak-seven-color.png'");

//* streak-fourteen
$stmt19 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-fourteen`=? WHERE `streak-fourteen`='images/badges/streak-fourteen-color.webp'");

$stmt20 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-fourteen`=? WHERE `streak-fourteen`='images/badges/streak-fourteen-color.png'");

//* streak-twentyOne
$stmt21 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-twentyOne`=? WHERE `streak-twentyOne`='images/badges/streak-twentyOne-color.webp'");

$stmt22 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-twentyOne`=? WHERE `streak-twentyOne`='images/badges/streak-twentyOne-color.png'");

//* every-streak
$stmt23 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `every-streak`=? WHERE `every-streak`='images/badges/every-streak-color.webp'");

$stmt24 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `every-streak`=? WHERE `every-streak`='images/badges/every-streak-color.png'");

//* back-it-up
$stmt25 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `back-it-up`=? WHERE `back-it-up`='images/badges/back-it-up-color.webp'");

$stmt26 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `back-it-up`=? WHERE `back-it-up`='images/badges/back-it-up-color.png'");

//* outline
$stmt27 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `outline`=? WHERE `outline`='images/badges/outline-color.webp'");

$stmt28 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `outline`=? WHERE `outline`='images/badges/outline-color.png'");

$stmt71 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `outline`=? WHERE `outline`='images/badges/outline-color-v2.webp'");

//* journey
$stmt29 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `journey`=? WHERE `journey`='images/badges/journey-color.webp'");

$stmt30 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `journey`=? WHERE `journey`='images/badges/journey-color.png'");

//* dual-wielder
$stmt31 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `dual-wielder`=? WHERE `dual-wielder`='images/badges/dual-wielder-color.webp'");

$stmt32 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `dual-wielder`=? WHERE `dual-wielder`='images/badges/dual-wielder-color.png'");

//* gathering
$stmt33 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `gathering`=? WHERE `gathering`='images/badges/gathering-color.webp'");

$stmt34 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `gathering`=? WHERE `gathering`='images/badges/gathering-color.png'");

//* hear-ye
$stmt35 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `hear-ye`=? WHERE `hear-ye`='images/badges/hear-ye-color.webp'");

$stmt36 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `hear-ye`=? WHERE `hear-ye`='images/badges/hear-ye-color.png'");

//* breakthrough
$stmt37 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `breakthrough`=? WHERE `breakthrough`='images/badges/breakthrough-color.webp'");

$stmt38 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `breakthrough`=? WHERE `breakthrough`='images/badges/breakthrough-color.png'");

//* starting-fresh
$stmt39 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `starting-fresh`=? WHERE `starting-fresh`='images/badges/starting-fresh-color.webp'");

$stmt40 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `starting-fresh`=? WHERE `starting-fresh`='images/badges/starting-fresh-color.png'");

//* ever-persist
$stmt41 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `ever-persist`=? WHERE `ever-persist`='images/badges/ever-persist-color.webp'");

$stmt42 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `ever-persist`=? WHERE `ever-persist`='images/badges/ever-persist-color.png'");

//* touch-grass
$stmt43 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `touch-grass`=? WHERE `touch-grass`='images/badges/touch-grass-color.webp'");

$stmt44 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `touch-grass`=? WHERE `touch-grass`='images/badges/touch-grass-color.png'");

//* business
$stmt45 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `business`=? WHERE `business`='images/badges/business-color.webp'");

$stmt46 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `business`=? WHERE `business`='images/badges/business-color.png'");

//* tears-wept
$stmt47 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `tears-wept`=? WHERE `tears-wept`='images/badges/tears-wept-color.webp'");

$stmt48 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `tears-wept`=? WHERE `tears-wept`='images/badges/tears-wept-color.png'");

//* finish-him
$stmt49 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `finish-him`=? WHERE `finish-him`='images/badges/finish-him-color.webp'");

$stmt50 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `finish-him`=? WHERE `finish-him`='images/badges/finish-him-color.png'");


//* complete-one-project
$stmt51 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-one-project`=? WHERE `complete-one-project`='images/badges/complete-one-project-color.webp'");

$stmt52 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-one-project`=? WHERE `complete-one-project`='images/badges/complete-one-project-color.png'");

//* complete-five-project
$stmt53 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-five-project`=? WHERE `complete-five-project`='images/badges/complete-five-project-color.webp'");

$stmt54 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-five-project`=? WHERE `complete-five-project`='images/badges/complete-five-project-color.png'");

//* complete-ten-project
$stmt55 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-ten-project`=? WHERE `complete-ten-project`='images/badges/complete-ten-project-color.webp'");

$stmt56 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-ten-project`=? WHERE `complete-ten-project`='images/badges/complete-ten-project-color.png'");

//* streak-fiend
$stmt57 = $_SESSION["conn"] -> prepare("UPDATE users SET `streak-fiend`=? WHERE `streak-fiend`='images/badges/streak-fiend-color.webp'");

$stmt58 = $_SESSION["conn"] -> prepare("UPDATE users SET `streak-fiend`=? WHERE `streak-fiend`='images/badges/streak-fiend-color.png'");

//* hydra-slayer
$stmt59 = $_SESSION["conn"] -> prepare("UPDATE users SET `hydra-slayer`=? WHERE `hydra-slayer`='images/badges/hydra-slayer-color.webp'");

$stmt60 = $_SESSION["conn"] -> prepare("UPDATE users SET `hydra-slayer`=? WHERE `hydra-slayer`='images/badges/hydra-slayer-color.png'");

//* vet-streaker
$stmt61 = $_SESSION["conn"] -> prepare("UPDATE users SET `vet-streaker`=? WHERE `vet-streaker`='images/badges/vet-streaker-color.webp'");

$stmt62 = $_SESSION["conn"] -> prepare("UPDATE users SET `vet-streaker`=? WHERE `vet-streaker`='images/badges/vet-streaker-color.png'");

//* vet-guild
$stmt63 = $_SESSION["conn"] -> prepare("UPDATE users SET `vet-guild`=? WHERE `vet-guild`='images/badges/vet-guild-color.webp'");

$stmt64 = $_SESSION["conn"] -> prepare("UPDATE users SET `vet-guild`=? WHERE `vet-guild`='images/badges/vet-guild-color.png'");

//* start-first-project
$stmt65 = $_SESSION["conn"] -> prepare("UPDATE users SET `start-first-project`=? WHERE `start-first-project`='images/badges/start-first-project-color.webp'");

$stmt66 = $_SESSION["conn"] -> prepare("UPDATE users SET `start-first-project`=? WHERE `start-first-project`='images/badges/start-first-project-color.png'");

//* spicy-spicy
$stmt67 = $_SESSION["conn"] -> prepare("UPDATE users SET `spicy-spicy`=? WHERE `spicy-spicy`='images/badges/spicy-spicy-color.webp'");

$stmt68 = $_SESSION["conn"] -> prepare("UPDATE users SET `spicy-spicy`=? WHERE `spicy-spicy`='images/badges/spicy-spicy-color.png'");

//* tears-alltime
$stmt69 = $_SESSION["conn"] -> prepare("UPDATE users SET `tears-alltime`=? WHERE `tears-alltime`='images/badges/tears-alltime-color.webp'");

$stmt70 = $_SESSION["conn"] -> prepare("UPDATE users SET `tears-alltime`=? WHERE `tears-alltime`='images/badges/tears-alltime-color.png'");

    $stmt1->bind_param("s",$unlocked);
    $stmt2->bind_param("s",$unlocked);
    $stmt3->bind_param("s",$unlocked);
    $stmt4->bind_param("s",$unlocked);
    $stmt5->bind_param("s",$unlocked);
    $stmt6->bind_param("s",$unlocked);
    $stmt7->bind_param("s",$unlocked);
    $stmt8->bind_param("s",$unlocked);
    $stmt9->bind_param("s",$unlocked);
    $stmt10->bind_param("s",$unlocked);
    $stmt11->bind_param("s",$unlocked);
    $stmt12->bind_param("s",$unlocked);
    $stmt13->bind_param("s",$unlocked);
    $stmt14->bind_param("s",$unlocked);
    $stmt15->bind_param("s",$unlocked);
    $stmt16->bind_param("s",$unlocked);
    $stmt17->bind_param("s",$unlocked);
    $stmt18->bind_param("s",$unlocked);
    $stmt19->bind_param("s",$unlocked);
    $stmt20->bind_param("s",$unlocked);
    $stmt21->bind_param("s",$unlocked);
    $stmt22->bind_param("s",$unlocked);
    $stmt23->bind_param("s",$unlocked);
    $stmt24->bind_param("s",$unlocked);
    $stmt25->bind_param("s",$unlocked);
    $stmt26->bind_param("s",$unlocked);
    $stmt27->bind_param("s",$unlocked);
    $stmt28->bind_param("s",$unlocked);
    $stmt29->bind_param("s",$unlocked);
    $stmt30->bind_param("s",$unlocked);
    $stmt31->bind_param("s",$unlocked);
    $stmt32->bind_param("s",$unlocked);
    $stmt33->bind_param("s",$unlocked);
    $stmt34->bind_param("s",$unlocked);
    $stmt35->bind_param("s",$unlocked);
    $stmt36->bind_param("s",$unlocked);
    $stmt37->bind_param("s",$unlocked);
    $stmt38->bind_param("s",$unlocked);
    $stmt39->bind_param("s",$unlocked);
    $stmt40->bind_param("s",$unlocked);
    $stmt41->bind_param("s",$unlocked);
    $stmt42->bind_param("s",$unlocked);
    $stmt43->bind_param("s",$unlocked);
    $stmt44->bind_param("s",$unlocked);
    $stmt45->bind_param("s",$unlocked);
    $stmt46->bind_param("s",$unlocked);
    $stmt47->bind_param("s",$unlocked);
    $stmt48->bind_param("s",$unlocked);
    $stmt49->bind_param("s",$unlocked);
    $stmt50->bind_param("s",$unlocked);
    $stmt51->bind_param("s",$unlocked);
    $stmt52->bind_param("s",$unlocked);
    $stmt53->bind_param("s",$unlocked);
    $stmt54->bind_param("s",$unlocked);
    $stmt55->bind_param("s",$unlocked);
    $stmt56->bind_param("s",$unlocked);
    $stmt57->bind_param("s",$unlocked);
    $stmt58->bind_param("s",$unlocked);
    $stmt59->bind_param("s",$unlocked);
    $stmt60->bind_param("s",$unlocked);
    $stmt61->bind_param("s",$unlocked);
    $stmt62->bind_param("s",$unlocked);
    $stmt63->bind_param("s",$unlocked);
    $stmt64->bind_param("s",$unlocked);
    $stmt65->bind_param("s",$unlocked);
    $stmt66->bind_param("s",$unlocked);
    $stmt67->bind_param("s",$unlocked);
    $stmt68->bind_param("s",$unlocked);
    $stmt69->bind_param("s",$unlocked);
    $stmt70->bind_param("s",$unlocked);
    $stmt71->bind_param("s",$unlocked);

    if ($stmt1 -> execute() 
        && $stmt2 -> execute()
        && $stmt3 -> execute()
        && $stmt4 -> execute()
        && $stmt5 -> execute()
        && $stmt6 -> execute()
        && $stmt7 -> execute()
        && $stmt8 -> execute()
        && $stmt9 -> execute()
        && $stmt10 -> execute()
        && $stmt11 -> execute()
        && $stmt12 -> execute()
        && $stmt13 -> execute()
        && $stmt14 -> execute()
        && $stmt15 -> execute()
        && $stmt16 -> execute()
        && $stmt17 -> execute()
        && $stmt18 -> execute()
        && $stmt19 -> execute()
        && $stmt20 -> execute()
        && $stmt21 -> execute()
        && $stmt22 -> execute()
        && $stmt23 -> execute()
        && $stmt24 -> execute()
        && $stmt25 -> execute()
        && $stmt26 -> execute()
        && $stmt27 -> execute()
        && $stmt28 -> execute()
        && $stmt29 -> execute()
        && $stmt30 -> execute()
        && $stmt31 -> execute()
        && $stmt32 -> execute()
        && $stmt33 -> execute()
        && $stmt34 -> execute()
        && $stmt35 -> execute()
        && $stmt36 -> execute()
        && $stmt37 -> execute()
        && $stmt38 -> execute()
        && $stmt39 -> execute()
        && $stmt40 -> execute()
        && $stmt41 -> execute()
        && $stmt42 -> execute()
        && $stmt43 -> execute()
        && $stmt44 -> execute()
        && $stmt45 -> execute()
        && $stmt46 -> execute()
        && $stmt47 -> execute()
        && $stmt48 -> execute()
        && $stmt49 -> execute()
        && $stmt50 -> execute()
        && $stmt51 -> execute()
        && $stmt52 -> execute()
        && $stmt53 -> execute()
        && $stmt54 -> execute()
        && $stmt55 -> execute()
        && $stmt56 -> execute()
        && $stmt57 -> execute()
        && $stmt58 -> execute()
        && $stmt59 -> execute()
        && $stmt60 -> execute()
        && $stmt61 -> execute()
        && $stmt62 -> execute()
        && $stmt63 -> execute()
        && $stmt64 -> execute()
        && $stmt65 -> execute()
        && $stmt66 -> execute()
        && $stmt67 -> execute()
        && $stmt68 -> execute()
        && $stmt69 -> execute()
        && $stmt70 -> execute()
        && $stmt71 -> execute()) {
        exit;
    } else {
        die("an unexpected error occured");
    }