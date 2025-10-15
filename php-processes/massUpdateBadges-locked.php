<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

//! Locked
//* First Daily
$stmt1 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `first-daily`=? WHERE `first-daily`='images/badges/first-daily-mono.webp'");
    
$stmt2 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `first-daily`=? WHERE `first-daily`='images/badges/first-daily-mono.png'");

//* quarter-quomplete
$stmt3 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `quarter-quomplete`=? WHERE `quarter-quomplete`='images/badges/quarter-quomplete-mono.webp'");

$stmt4 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `quarter-quomplete`=? WHERE `quarter-quomplete`='images/badges/quarter-quomplete-mono.png'");

//* half-way
$stmt5 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `half-way`=? WHERE `half-way`='images/badges/half-way-mono.webp'");

$stmt6 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `half-way`=? WHERE `half-way`='images/badges/half-way-mono.png'");

//* all-downhill
$stmt7 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `all-downhill`=? WHERE `all-downhill`='images/badges/all-downhill-mono.webp'");

$stmt8 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `all-downhill`=? WHERE `all-downhill`='images/badges/all-downhill-mono.png'");

//* cross-finish
$stmt9 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `cross-finish`=? WHERE `cross-finish`='images/badges/cross-finish-mono.webp'");

$stmt10 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `cross-finish`=? WHERE `cross-finish`='images/badges/cross-finish-mono.png'");

//* on-track
$stmt11 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `on-track`=? WHERE `on-track`='images/badges/on-track-mono.webp'");

$stmt12 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `on-track`=? WHERE `on-track`='images/badges/on-track-mono.png'");

//* streak-two
$stmt13 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-two`=? WHERE `streak-two`='images/badges/streak-two-mono.webp'");

$stmt14 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-two`=? WHERE `streak-two`='images/badges/streak-two-mono.png'");

//* streak-three
$stmt15 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-three`=? WHERE `streak-three`='images/badges/streak-three-mono.webp'");

$stmt16 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-three`=? WHERE `streak-three`='images/badges/streak-three-mono.png'");

//* streak-seven
$stmt17 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-seven`=? WHERE `streak-seven`='images/badges/streak-seven-mono.webp'");

$stmt18 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-seven`=? WHERE `streak-seven`='images/badges/streak-seven-mono.png'");

//* streak-fourteen
$stmt19 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-fourteen`=? WHERE `streak-fourteen`='images/badges/streak-fourteen-mono.webp'");

$stmt20 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-fourteen`=? WHERE `streak-fourteen`='images/badges/streak-fourteen-mono.png'");

//* streak-twentyOne
$stmt21 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-twentyOne`=? WHERE `streak-twentyOne`='images/badges/streak-twentyOne-mono.webp'");

$stmt22 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `streak-twentyOne`=? WHERE `streak-twentyOne`='images/badges/streak-twentyOne-mono.png'");

//* every-streak
$stmt23 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `every-streak`=? WHERE `every-streak`='images/badges/every-streak-mono.webp'");

$stmt24 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `every-streak`=? WHERE `every-streak`='images/badges/every-streak-mono.png'");

//* back-it-up
$stmt25 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `back-it-up`=? WHERE `back-it-up`='images/badges/back-it-up-mono.webp'");

$stmt26 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `back-it-up`=? WHERE `back-it-up`='images/badges/back-it-up-mono.png'");

//* outline
$stmt27 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `outline`=? WHERE `outline`='images/badges/outline-mono.webp'");

$stmt28 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `outline`=? WHERE `outline`='images/badges/outline-mono.png'");

$stmt71 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `outline`=? WHERE `outline`='images/badges/outline-color-v2.webp'");

//* journey
$stmt29 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `journey`=? WHERE `journey`='images/badges/journey-mono.webp'");

$stmt30 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `journey`=? WHERE `journey`='images/badges/journey-mono.png'");

//* dual-wielder
$stmt31 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `dual-wielder`=? WHERE `dual-wielder`='images/badges/dual-wielder-mono.webp'");

$stmt32 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `dual-wielder`=? WHERE `dual-wielder`='images/badges/dual-wielder-mono.png'");

//* gathering
$stmt33 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `gathering`=? WHERE `gathering`='images/badges/gathering-mono.webp'");

$stmt34 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `gathering`=? WHERE `gathering`='images/badges/gathering-mono.png'");

//* hear-ye
$stmt35 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `hear-ye`=? WHERE `hear-ye`='images/badges/hear-ye-mono.webp'");

$stmt36 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `hear-ye`=? WHERE `hear-ye`='images/badges/hear-ye-mono.png'");

//* breakthrough
$stmt37 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `breakthrough`=? WHERE `breakthrough`='images/badges/breakthrough-mono.webp'");

$stmt38 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `breakthrough`=? WHERE `breakthrough`='images/badges/breakthrough-mono.png'");

//* starting-fresh
$stmt39 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `starting-fresh`=? WHERE `starting-fresh`='images/badges/starting-fresh-mono.webp'");

$stmt40 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `starting-fresh`=? WHERE `starting-fresh`='images/badges/starting-fresh-mono.png'");

//* ever-persist
$stmt41 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `ever-persist`=? WHERE `ever-persist`='images/badges/ever-persist-mono.webp'");

$stmt42 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `ever-persist`=? WHERE `ever-persist`='images/badges/ever-persist-mono.png'");

//* touch-grass
$stmt43 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `touch-grass`=? WHERE `touch-grass`='images/badges/touch-grass-mono.webp'");

$stmt44 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `touch-grass`=? WHERE `touch-grass`='images/badges/touch-grass-mono.png'");

//* business
$stmt45 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `business`=? WHERE `business`='images/badges/business-mono.webp'");

$stmt46 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `business`=? WHERE `business`='images/badges/business-mono.png'");

//* tears-wept
$stmt47 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `tears-wept`=? WHERE `tears-wept`='images/badges/tears-wept-mono.webp'");

$stmt48 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `tears-wept`=? WHERE `tears-wept`='images/badges/tears-wept-mono.png'");

//* finish-him
$stmt49 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `finish-him`=? WHERE `finish-him`='images/badges/finish-him-mono.webp'");

$stmt50 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `finish-him`=? WHERE `finish-him`='images/badges/finish-him-mono.png'");


//* complete-one-project
$stmt51 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-one-project`=? WHERE `complete-one-project`='images/badges/complete-one-project-mono.webp'");

$stmt52 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-one-project`=? WHERE `complete-one-project`='images/badges/complete-one-project-mono.png'");

//* complete-five-project
$stmt53 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-five-project`=? WHERE `complete-five-project`='images/badges/complete-five-project-mono.webp'");

$stmt54 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-five-project`=? WHERE `complete-five-project`='images/badges/complete-five-project-mono.png'");

//* complete-ten-project
$stmt55 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-ten-project`=? WHERE `complete-ten-project`='images/badges/complete-ten-project-mono.webp'");

$stmt56 = $_SESSION["conn"] -> prepare("UPDATE users SET `complete-ten-project`=? WHERE `complete-ten-project`='images/badges/complete-ten-project-mono.png'");

//* streak-fiend
$stmt57 = $_SESSION["conn"] -> prepare("UPDATE users SET `streak-fiend`=? WHERE `streak-fiend`='images/badges/streak-fiend-mono.webp'");

$stmt58 = $_SESSION["conn"] -> prepare("UPDATE users SET `streak-fiend`=? WHERE `streak-fiend`='images/badges/streak-fiend-mono.png'");

//* hydra-slayer
$stmt59 = $_SESSION["conn"] -> prepare("UPDATE users SET `hydra-slayer`=? WHERE `hydra-slayer`='images/badges/hydra-slayer-mono.webp'");

$stmt60 = $_SESSION["conn"] -> prepare("UPDATE users SET `hydra-slayer`=? WHERE `hydra-slayer`='images/badges/hydra-slayer-mono.png'");

//* vet-streaker
$stmt61 = $_SESSION["conn"] -> prepare("UPDATE users SET `vet-streaker`=? WHERE `vet-streaker`='images/badges/vet-streaker-mono.webp'");

$stmt62 = $_SESSION["conn"] -> prepare("UPDATE users SET `vet-streaker`=? WHERE `vet-streaker`='images/badges/vet-streaker-mono.png'");

//* vet-guild
$stmt63 = $_SESSION["conn"] -> prepare("UPDATE users SET `vet-guild`=? WHERE `vet-guild`='images/badges/vet-guild-mono.webp'");

$stmt64 = $_SESSION["conn"] -> prepare("UPDATE users SET `vet-guild`=? WHERE `vet-guild`='images/badges/vet-guild-mono.png'");

//* start-first-project
$stmt65 = $_SESSION["conn"] -> prepare("UPDATE users SET `start-first-project`=? WHERE `start-first-project`='images/badges/start-first-project-mono.webp'");

$stmt66 = $_SESSION["conn"] -> prepare("UPDATE users SET `start-first-project`=? WHERE `start-first-project`='images/badges/start-first-project-mono.png'");

//* spicy-spicy
$stmt67 = $_SESSION["conn"] -> prepare("UPDATE users SET `spicy-spicy`=? WHERE `spicy-spicy`='images/badges/spicy-spicy-mono.webp'");

$stmt68 = $_SESSION["conn"] -> prepare("UPDATE users SET `spicy-spicy`=? WHERE `spicy-spicy`='images/badges/spicy-spicy-mono.png'");

//* tears-alltime
$stmt69 = $_SESSION["conn"] -> prepare("UPDATE users SET `tears-alltime`=? WHERE `tears-alltime`='images/badges/tears-alltime-mono.webp'");

$stmt70 = $_SESSION["conn"] -> prepare("UPDATE users SET `tears-alltime`=? WHERE `tears-alltime`='images/badges/tears-alltime-mono.png'");

    $stmt1->bind_param("s","locked");
    $stmt2->bind_param("s","locked");
    $stmt3->bind_param("s","locked");
    $stmt4->bind_param("s","locked");
    $stmt5->bind_param("s","locked");
    $stmt6->bind_param("s","locked");
    $stmt7->bind_param("s","locked");
    $stmt8->bind_param("s","locked");
    $stmt9->bind_param("s","locked");
    $stmt10->bind_param("s","locked");
    $stmt11->bind_param("s","locked");
    $stmt12->bind_param("s","locked");
    $stmt13->bind_param("s","locked");
    $stmt14->bind_param("s","locked");
    $stmt15->bind_param("s","locked");
    $stmt16->bind_param("s","locked");
    $stmt17->bind_param("s","locked");
    $stmt18->bind_param("s","locked");
    $stmt19->bind_param("s","locked");
    $stmt20->bind_param("s","locked");
    $stmt21->bind_param("s","locked");
    $stmt22->bind_param("s","locked");
    $stmt23->bind_param("s","locked");
    $stmt24->bind_param("s","locked");
    $stmt25->bind_param("s","locked");
    $stmt26->bind_param("s","locked");
    $stmt27->bind_param("s","locked");
    $stmt28->bind_param("s","locked");
    $stmt29->bind_param("s","locked");
    $stmt30->bind_param("s","locked");
    $stmt31->bind_param("s","locked");
    $stmt32->bind_param("s","locked");
    $stmt33->bind_param("s","locked");
    $stmt34->bind_param("s","locked");
    $stmt35->bind_param("s","locked");
    $stmt36->bind_param("s","locked");
    $stmt37->bind_param("s","locked");
    $stmt38->bind_param("s","locked");
    $stmt39->bind_param("s","locked");
    $stmt40->bind_param("s","locked");
    $stmt41->bind_param("s","locked");
    $stmt42->bind_param("s","locked");
    $stmt43->bind_param("s","locked");
    $stmt44->bind_param("s","locked");
    $stmt45->bind_param("s","locked");
    $stmt46->bind_param("s","locked");
    $stmt47->bind_param("s","locked");
    $stmt48->bind_param("s","locked");
    $stmt49->bind_param("s","locked");
    $stmt50->bind_param("s","locked");
    $stmt51->bind_param("s","locked");
    $stmt52->bind_param("s","locked");
    $stmt53->bind_param("s","locked");
    $stmt54->bind_param("s","locked");
    $stmt55->bind_param("s","locked");
    $stmt56->bind_param("s","locked");
    $stmt57->bind_param("s","locked");
    $stmt58->bind_param("s","locked");
    $stmt59->bind_param("s","locked");
    $stmt60->bind_param("s","locked");
    $stmt61->bind_param("s","locked");
    $stmt62->bind_param("s","locked");
    $stmt63->bind_param("s","locked");
    $stmt64->bind_param("s","locked");
    $stmt65->bind_param("s","locked");
    $stmt66->bind_param("s","locked");
    $stmt67->bind_param("s","locked");
    $stmt68->bind_param("s","locked");
    $stmt69->bind_param("s","locked");
    $stmt70->bind_param("s","locked");
    $stmt71->bind_param("s","locked");

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