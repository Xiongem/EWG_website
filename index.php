<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');


ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

//* If user is logged in
if (isset($_SESSION["user_id"])) {
    $userID = htmlspecialchars($_SESSION["user_id"]);

    //* Pull User Info
    $sql = "SELECT * FROM users WHERE id=$userID";
        $result = $_SESSION["conn"]->query($sql);
        $user = $result->fetch_assoc();
            $pfp = $user["pfp"];
            $username = $user["username"];
                
            //* Setting pfp
            if ($pfp) {
                $pfp_set = $pfp;
            } else {
                $pfp_set = "images/pfp-icon.webp";
            }

    //* Pull Project Info
    $sql = "SELECT display FROM current_project WHERE users_id='$userID' AND current_state='current'";
        $result = $_SESSION["conn"]->query($sql);
        if ($result->num_rows > 0) {
            while ($display = $result->fetch_assoc()) {

            //* if user has selected a project to be active from project selection
            if (in_array("active", $display)) { 
                $sql = "SELECT * FROM current_project WHERE users_id='$userID' AND current_state='current' AND display='active'";
                $result = $_SESSION["conn"]->query($sql);
                $project = $result->fetch_assoc();
                    $displayTitle = $project["title"];
                    $displayProjectID = $project["id"];
                    $displayGenre = $project["genre"];
                    $displayGenrePicture = 'images/genre-covers/genre-covers'.$displayGenre.'.webp';
                    $displayInfo = $project["info"];
                    $displayCount = $project["current_count"];
                    $displayGoal = $project["goal"];
                    $displayGoalDate = $project["goal_date"];
                    $update_date = $project["update_date"];
                    $streak = $project["streak"];
                    $displayDailyGoal = $project["daily_goal"];
                    $dailyStreak = $project["daily_goal_streak"];
                    $created = $project["created_at"];
                    $displayPercentage = floor($displayCount / $displayGoal * 100);
                    //* Badges

                    //? PROGRESS BADGES
                    //* Quarter Quomplete
                    if (isset($project["quarter-quomplete"])) {
                    $badge1 = $project["quarter-quomplete"];
                        if ($displayPercentage >= 25 && $project["quarter-quomplete"] !== "unlocked") {
                            $sql = "UPDATE current_project SET `quarter-quomplete`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                            $stmt = $_SESSION["conn"]->prepare($sql);
                            $stmt->execute();
                            $badge1 = "images/badges/quarter-quomplete-color.webp";
                        } elseif ($badge1 == "unlocked" && $displayPercentage >= 25) {
                            $badge1 = "images/badges/quarter-quomplete-color.webp";
                        } elseif ($badge1 == "unlocked" && $displayPercentage < 25) {
                            $sql = "UPDATE current_project SET `quarter-quomplete`= 'locked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                            $stmt = $_SESSION["conn"]->prepare($sql);
                            $stmt->execute();
                            $badge1 = "images/badges/quarter-quomplete-mono.webp";
                        } elseif ($badge1 == "locked") {
                            $badge1 = "images/badges/quarter-quomplete-mono.webp";
                        }
                    }
                    //* Half Way
                    if (isset($project["half-way"])) {
                    $badge2 = $project["half-way"];
                        if ($displayPercentage >= 50 && $project["half-way"] !== "unlocked") {
                            $sql = "UPDATE current_project SET `half-way`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                            $stmt = $_SESSION["conn"]->prepare($sql);
                            $stmt->execute();
                            $badge2 = "images/badges/half-way-color.webp";
                        } elseif ($badge2 == "unlocked" && $displayPercentage >= 50) {
                            $badge2 = "images/badges/half-way-color.webp";
                        } elseif ($badge2 == "unlocked" && $displayPercentage < 50) {
                            $sql = "UPDATE current_project SET `half-way`= 'locked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                            $stmt = $_SESSION["conn"]->prepare($sql);
                            $stmt->execute();
                            $badge2 = "images/badges/half-way-mono.webp";
                        } elseif ($badge2 == "locked") {
                            $badge2 = "images/badges/half-way-mono.webp";
                        }
                    }
                    //* All Downhill
                    if (isset($project["all-downhill"])) {
                    $badge3 = $project["all-downhill"];
                        if ($displayPercentage >= 75 && $project["all-downhill"] !== "unlocked") {
                            $sql = "UPDATE current_project SET `all-downhill`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                            $stmt = $_SESSION["conn"]->prepare($sql);
                            $stmt->execute();
                            $badge3 = "images/badges/all-downhill-color.webp";
                        } elseif ($badge3 == "unlocked" && $displayPercentage >= 75) {
                            $badge3 = "images/badges/all-downhill-color.webp";
                        } elseif ($badge3 == "unlocked" && $displayPercentage < 75) {
                            $sql = "UPDATE current_project SET `all-downhill`= 'locked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                            $stmt = $_SESSION["conn"]->prepare($sql);
                            $stmt->execute();
                            $badge3 = "images/badges/all-downhill-mono.webp";
                        } elseif ($badge3 == "locked") {
                            $badge3 = "images/badges/all-downhill-mono.webp";
                        }
                    }
                    //* Cross Finish
                    if (isset($project["cross-finish"])) {
                    $badge4 = $project["cross-finish"];
                        if ($displayPercentage >= 100 && $project["cross-finish"] !== "unlocked") {
                            $sql = "UPDATE current_project SET `cross-finish`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                            $stmt = $_SESSION["conn"]->prepare($sql);
                            $stmt->execute();
                            $badge4 = "images/badges/cross-finish-color.webp";
                        } elseif ($badge4 == "unlocked" && $displayPercentage >= 100) {
                            $badge4 = "images/badges/cross-finish-color.webp";
                        } elseif ($badge4 == "unlocked" && $displayPercentage < 100) {
                            $sql = "UPDATE current_project SET `cross-finish`= 'locked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                            $stmt = $_SESSION["conn"]->prepare($sql);
                            $stmt->execute();
                            $badge4 = "images/badges/cross-finish-mono.webp";
                        } elseif ($badge4 == "locked") {
                            $badge4 = "images/badges/cross-finish-mono.webp";
                        }
                    }
                    

                    //? STREAK BADGES
                    $nows = time();
                    $your_dates = strtotime($update_date);
                    $datediffer = $nows - $your_dates;
                    $intervals = round($datediffer / (60 * 60 * 24));
                    //* if time since last word count update is one day or less
                    if ($intervals <= 1) {
                        //* 2 Day Streak
                        if ($streak >= 2) {
                            if ($project["streak-two"] !== "unlocked") {
                                $sql = "UPDATE current_project SET `streak-two`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                    $stmt = $_SESSION["conn"]->prepare($sql);
                                    $stmt->execute();
                            }
                            $badge5 = "images/badges/streak-two-color.webp";
                        }
                        //* 3 Day Streak
                        if ($streak >= 3) {
                            if ($project["streak-three"] !== "unlocked") {
                                $sql = "UPDATE current_project SET `streak-three`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                    $stmt = $_SESSION["conn"]->prepare($sql);
                                    $stmt->execute();
                            }
                            $badge6 = "images/badges/streak-three-color.webp";
                        }
                        //* Seven Day Streak
                        if ($streak >= 7) {
                            if ($project["streak-seven"] !== "unlocked") {
                                $sql = "UPDATE current_project SET `streak-seven`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                    $stmt = $_SESSION["conn"]->prepare($sql);
                                    $stmt->execute();
                            }
                            $badge7 = "images/badges/streak-seven-color.webp";
                        }
                        //* Fourteen Day Streak
                        if ($streak >= 14) {
                            if ($project["streak-fourteen"] !== "unlocked") {
                                $sql = "UPDATE current_project SET `streak-fourteen`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                    $stmt = $_SESSION["conn"]->prepare($sql);
                                    $stmt->execute();
                            }
                            $badge8 = "images/badges/streak-fourteen-color.webp";
                        }
                        //* Twenty-One Day Streak
                        if ($streak >= 21) {
                            if ($project["streak-twentyOne"] !== "unlocked") {
                                $sql = "UPDATE current_project SET `streak-twentyOne`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                    $stmt = $_SESSION["conn"]->prepare($sql);
                                    $stmt->execute();
                            }
                            $badge9 = "images/badges/streak-twentyOne-color.webp";
                        }
                    } else {
                        //* if it has been more than 1 day since word count was updated
                        if ($streak > 1 || $streak < 0 && $project["streak-two"] !== "locked") {
                            $sql = "UPDATE current_project SET `streak-two`= 'locked', `streak-three`= 'locked', `streak-seven`= 'locked', `streak-fourteen`= 'locked', `streak-twentyOne`= 'locked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                    $stmt = $_SESSION["conn"]->prepare($sql);
                                    $stmt->execute();
                        }
                        $badge5 = "images/badges/streak-two-mono.webp";
                        $badge6 = "images/badges/streak-three-mono.webp";
                        $badge7 = "images/badges/streak-seven-mono.webp";
                        $badge8 = "images/badges/streak-fourteen-mono.webp";
                        $badge9 = "images/badges/streak-twentyOne-mono.webp";
                    }
                    //* First Daily
                    $badge10 = $project["first-daily"];
                        if ($badge10 == "unlocked") {
                            $badge10 = "images/badges/first-daily-color.webp";
                        } elseif ($badge10 == "locked") {
                            $badge10 = "images/badges/first-daily-mono.webp";
                        }
                    //* Full Streak Math
                        $created_date = strtotime($created);
                        $endDate = strtotime($displayGoalDate);
                        $totalDays = $endDate - $created_date;
                        $streakMath = round($totalDays / (60 * 60 * 24));
                        //* Every Streak
                        if ($streak == $streakMath) {
                            if ($project["every-streak"] !== "unlocked") {
                                $sql = "UPDATE current_project SET `every-streak`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                    $stmt = $_SESSION["conn"]->prepare($sql);
                                    $stmt->execute();
                            }
                            $badge11 = "images/badges/every-streak-color.webp";
                        } elseif ($streak !== $streakMath && $project["every-streak"] == "unlocked") {
                            $sql = "UPDATE current_project SET `every-streak`= 'locked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                    $stmt = $_SESSION["conn"]->prepare($sql);
                                    $stmt->execute();
                            $badge11 = "images/badges/every-streak-mono.webp";
                        } else {
                            $badge11 = "images/badges/every-streak-mono.webp";
                        }
                        //* On track
                        echo "$dailyStreak"."<br>";
                        echo $streakMath;
                        if ($dailyStreak == $streakMath) {
                            if ($project["on-track"] !== "unlocked") {
                                $sql = "UPDATE current_project SET `on-track`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                    $stmt = $_SESSION["conn"]->prepare($sql);
                                    $stmt->execute();
                            }
                            $badge12 = "images/badges/on-track-color.webp";
                        } elseif ($dailyStreak !== $streakMath && $project["on-track"] == "unlocked") {
                            $sql = "UPDATE current_project SET `on-track`= 'locked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                    $stmt = $_SESSION["conn"]->prepare($sql);
                                    $stmt->execute();
                            $badge12 = "images/badges/on-track-mono.webp";
                        } elseif (isset($project["on-track"])) {
                            $badge12 = $project["on-track"];
                                if ($badge12 == "unlocked") {
                                    $badge12 = "images/badges/on-track-color.webp";
                                } elseif ($badge12 == "locked") {
                                    $badge12 = "images/badges/on-track-mono.webp";
                                }
                        }
                        

                    //? TOGGLEABLE BADGES
                    //* Outline
                    $badge13 = $project["outline"];
                        if ($badge13 == "unlocked") {
                            $badge13 = "images/badges/outline-color-v2.webp";
                        } elseif ($badge13 == "locked") {
                            $badge13 = "images/badges/outline-mono-v2.webp";
                        }
                    //* Journey
                    $badge14 = $project["journey"];
                        if ($badge14 == "unlocked") {
                            $badge14 = "images/badges/journey-color.webp";
                        } elseif ($badge14 == "locked") {
                            $badge14 = "images/badges/journey-mono.webp";
                        }
                    //* Dual Wielder
                    $badge15 = $project["dual-wielder"];
                        if ($badge15 == "unlocked") {
                            $badge15 = "images/badges/dual-wielder-color.webp";
                        } elseif ($badge15 == "locked") {
                            $badge15 = "images/badges/dual-wielder-mono.webp";
                        }
                    //* Starting Fresh
                    $badge16 = $project["starting-fresh"];
                        if ($badge16 == "unlocked") {
                            $badge16 = "images/badges/starting-fresh-color.webp";
                        } elseif ($badge16 == "locked") {
                            $badge16 = "images/badges/starting-fresh-mono.webp";
                        }
                    //* Ever Persist
                    $badge17 = $project["ever-persist"];
                        if ($badge17 == "unlocked") {
                            $badge17 = "images/badges/ever-persist-color.webp";
                        } elseif ($badge17 == "locked") {
                            $badge17 = "images/badges/ever-persist-mono.webp";
                        }
                    //* Back It Up
                    $badge18 = $project["back-it-up"];
                        if ($badge18 == "unlocked") {
                            $badge18 = "images/badges/back-it-up-color.webp";
                        } elseif ($badge18 == "locked") {
                            $badge18 = "images/badges/back-it-up-mono.webp";
                        }
                    //* Gathering
                    $badge19 = $project["gathering"];
                        if ($badge19 == "unlocked") {
                            $badge19 = "images/badges/gathering-color.webp";
                        } elseif ($badge19 == "locked") {
                            $badge19 = "images/badges/gathering-mono.webp";
                        }
                    //* Hear Ye
                    $badge20 = $project["hear-ye"];
                        if ($badge20 == "unlocked") {
                            $badge20 = "images/badges/hear-ye-color.webp";
                        } elseif ($badge20 == "locked") {
                            $badge20 = "images/badges/hear-ye-mono.webp";
                        }
                    //* Breakthrough
                    $badge21 = $project["breakthrough"];
                        if ($badge21 == "unlocked") {
                            $badge21 = "images/badges/breakthrough-color.webp";
                        } elseif ($badge21 == "locked") {
                            $badge21 = "images/badges/breakthrough-mono.webp";
                        }
                    //* Touch Grass
                    $badge22 = $project["touch-grass"];
                        if ($badge22 == "unlocked") {
                            $badge22 = "images/badges/touch-grass-color.webp";
                        } elseif ($badge22 == "locked") {
                            $badge22 = "images/badges/touch-grass-mono.webp";
                        }
                    //* Business
                    $badge23 = $project["business"];
                        if ($badge23 == "unlocked") {
                            $badge23 = "images/badges/business-color.webp";
                        } elseif ($badge23 == "locked") {
                            $badge23 = "images/badges/business-mono.webp";
                        }
                    //* Tears Wept
                    $badge24 = $project["tears-wept"];
                        if ($badge24 == "unlocked") {
                            $badge24 = "images/badges/tears-wept-color.webp";
                        } elseif ($badge24 == "locked") {
                            $badge24 = "images/badges/tears-wept-mono.webp";
                        }
                    //* Finish Him
                    $badge25 = $project["finish-him"];
                        if ($badge25 == "unlocked") {
                            $badge25 = "images/badges/finish-him-color.webp";
                        } elseif ($badge25 == "locked") {
                            $badge25 = "images/badges/finish-him-mono.webp";
                        }


                        //* Days left math
                        $now = time();
                        $your_date = strtotime($displayGoalDate);
                        $divideDate = $your_date - $now;
                        $math = round($divideDate / (60 * 60 * 24));
                            if ($displayGoalDate == "0000-00-00" || !$displayGoalDate) {
                                $displayDays = "No Goal Date Set";
                            } elseif (isset($displayGoalDate) && $displayGoalDate !== "0000-00-00") {
                                $displayDays = $math;
                                if ($displayDays == 0) {
                                    $displayDays = "Final Day!";
                                } elseif ($displayDays < 0) {
                                    $displayDays = "Project Past Due!";
                                }
                            }
                        //* Percentage bar math
                            if (empty($displayCount) || empty($displayGoal)) {
                                $displayProgress = 4;
                                $displayPercentage = 0;
                            } elseif (floor($displayCount / $displayGoal * 100)<=4) {
                                $displayProgress = 4;
                                $displayPercentage = $displayPercentage;
                            } else {
                                $displayProgress = floor($displayCount / $displayGoal * 100);
                                $displayPercentage = $displayProgress;
                            }
            }                
            }
        } else {
            //* User has no active projects yet
            $sql = "SELECT * FROM current_project WHERE users_id='$userID' AND current_state='current'";
            $result = $_SESSION["conn"]->query($sql);
            $project = $result->fetch_assoc();
                $displayTitle = $project["title"];
                $displayProjectID = $project["id"];
                $displayGenre = $project["genre"];
                $displayGenrePicture = 'images/genre-covers/genre-covers'.$displayGenre.'.webp';
                $displayInfo = $project["info"];
                $displayCount = $project["current_count"];
                $displayGoal = $project["goal"];
                $displayGoalDate = $project["goal_date"];
                $update_date = $project["update_date"];
                $streak = $project["streak"];
                $created = $project["created_at"];
                $displayDailyGoal = $project["daily_goal"];
                $displayPercentage = floor($displayCount / $displayGoal * 100);
                //* Badges

                //? PROGRESS BADGES
                //* Quarter Quomplete
                if (isset($project["quarter-quomplete"])) {
                $badge1 = $project["quarter-quomplete"];
                    if ($badge1 == "unlocked") {
                        $badge1 = "images/badges/quarter-quomplete-color.webp";
                    } elseif ($badge1 == "locked") {
                        $badge1 = "images/badges/quarter-quomplete-mono.webp";
                    }
                }
                if ($displayPercentage >= 25 && $project["quarter-quomplete"] !== "unlocked") {
                    $sql = "UPDATE current_project SET `quarter-quomplete`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                    $stmt = $_SESSION["conn"]->prepare($sql);
                    $stmt->execute();
                    $badge1 = "images/badges/quarter-quomplete-color.webp";
                }
                //* Half Way
                if (isset($project["half-way"])) {
                $badge2 = $project["half-way"];
                    if ($badge2 == "unlocked") {
                        $badge2 = "images/badges/half-way-color.webp";
                    } elseif ($badge2 == "locked") {
                        $badge2 = "images/badges/half-way-mono.webp";
                    }
                }
                if ($displayPercentage >= 50 && $project["half-way"] !== "unlocked") {
                    $sql = "UPDATE current_project SET `half-way`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                    $stmt = $_SESSION["conn"]->prepare($sql);
                    $stmt->execute();
                    $badge2 = "images/badges/half-way-color.webp";
                }
                //* All Downhill
                if (isset($project["all-downhill"])) {
                $badge3 = $project["all-downhill"];
                    if ($badge3 == "unlocked") {
                        $badge3 = "images/badges/all-downhill-color.webp";
                    } elseif ($badge3 == "locked") {
                        $badge3 = "images/badges/all-downhill-mono.webp";
                    }
                }
                if ($displayPercentage >= 75 && $project["all-downhill"] !== "unlocked") {
                    $sql = "UPDATE current_project SET `all-downhill`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                    $stmt = $_SESSION["conn"]->prepare($sql);
                    $stmt->execute();
                    $badge3 = "images/badges/all-downhill-color.webp";
                }
                //* Cross Finish
                if (isset($project["cross-finish"])) {
                $badge4 = $project["cross-finish"];
                    if ($badge4 == "unlocked") {
                        $badge4 = "images/badges/cross-finish-color.webp";
                    } elseif ($badge4 == "locked") {
                        $badge4 = "images/badges/cross-finish-mono.webp";
                    }
                }
                if ($displayPercentage >= 100 && $project["cross-finish"] !== "unlocked") {
                    $sql = "UPDATE current_project SET `cross-finish`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND display='active'";
                    $stmt = $_SESSION["conn"]->prepare($sql);
                    $stmt->execute();
                    $badge4 = "images/badges/cross-finish-color.webp";
                }

                //? STREAK BADGES
                $nows = time();
                $your_dates = strtotime($update_date);
                $datediffer = $nows - $your_dates;
                $intervals = round($datediffer / (60 * 60 * 24));
                if ($intervals <= 1) {
                    //* Two Day Streak
                    if ($streak >= 2) {
                        $sql = "UPDATE current_project SET `streak-two`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                    $stmt = $_SESSION["conn"]->prepare($sql);
                                    $stmt->execute();
                        $badge5 = "images/badges/streak-two-color.webp";
                    }else {
                        $badge5 = "images/badges/streak-two-mono.webp";
                    }
                    //* Three Day Streak
                    if ($streak >= 3) {
                        if ($project["streak-three"] !== "unlocked") {
                            $sql = "UPDATE current_project SET `streak-three`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                $stmt = $_SESSION["conn"]->prepare($sql);
                                $stmt->execute();
                        }
                        $badge6 = "images/badges/streak-three-color.webp";
                    } else {
                        $badge6 = "images/badges/streak-three-mono.webp";
                    }
                    //* Seven Day Streak
                    if ($streak >= 7) {
                        if ($project["streak-seven"] !== "unlocked") {
                            $sql = "UPDATE current_project SET `streak-seven`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                $stmt = $_SESSION["conn"]->prepare($sql);
                                $stmt->execute();
                        }
                        $badge7 = "images/badges/streak-seven-color.webp";
                    } else {
                        $badge7 = "images/badges/streak-seven-mono.webp";
                    }
                    //* Fourteen Day Streak
                    if ($streak >= 14) {
                        if ($project["streak-fourteen"] !== "unlocked") {
                            $sql = "UPDATE current_project SET `streak-fourteen`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                $stmt = $_SESSION["conn"]->prepare($sql);
                                $stmt->execute();
                        }
                        $badge8 = "images/badges/streak-fourteen-color.webp";
                    } else {
                        $badge8 = "images/badges/streak-fourteen-mono.webp";
                    }
                    //* Twenty-One Day Streak
                    if ($streak >= "21") {
                        if ($project["streak-twentyOne"] !== "unlocked") {
                            $sql = "UPDATE current_project SET `streak-twentyOne`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                $stmt = $_SESSION["conn"]->prepare($sql);
                                $stmt->execute();
                        }
                        $badge9 = "images/badges/streak-twentyOne-color.webp";
                    } else {
                        $badge9 = "images/badges/streak-twentyOne-mono.webp";
                    }
                }else {
                    //* if it has been more than 1 day since word count was updated
                    if ($streak > 1 || $streak < 0 && $project["streak-two"] !== "locked") {
                        $sql = "UPDATE current_project SET `streak-two`= 'locked', `streak-three`= 'locked', `streak-seven`= 'locked', `streak-fourteen`= 'locked', `streak-twentyOne`= 'locked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                                $stmt = $_SESSION["conn"]->prepare($sql);
                                $stmt->execute();
                    }
                    $badge5 = "images/badges/streak-two-mono.webp";
                    $badge6 = "images/badges/streak-three-mono.webp";
                    $badge7 = "images/badges/streak-seven-mono.webp";
                    $badge8 = "images/badges/streak-fourteen-mono.webp";
                    $badge9 = "images/badges/streak-twentyOne-mono.webp";
                }
                $badge10 = $project["first-daily"];
                    if ($badge10 == "unlocked") {
                        $badge10 = "images/badges/first-daily-color.webp";
                    } elseif ($badge10 == "locked") {
                        $badge10 = "images/badges/first-daily-mono.webp";
                    }
                //* Full Streak Math
                $created_date = strtotime($created);
                $endDate = strtotime($displayGoalDate);
                $totalDays = $endDate - $created_date;
                $streakMath = round($totalDays / (60 * 60 * 24));
                
                if ($streak == $streakMath) {
                    if ($project["every-streak"] !== "unlocked") {
                        $sql = "UPDATE current_project SET `every-streak`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                            $stmt = $_SESSION["conn"]->prepare($sql);
                            $stmt->execute();
                    }
                    $badge11 = "images/badges/every-streak-color.webp";
                } else {
                    $badge11 = "images/badges/every-streak-mono.webp";
                }
                //* On track
                if ($dailyStreak == $streakMath) {
                    echo $hello;
                    if ($project["on-track"] !== "unlocked") {
                        $sql = "UPDATE current_project SET `on-track`= 'unlocked' WHERE users_id=$userID AND current_state='current' AND id=$displayProjectID";
                            $stmt = $_SESSION["conn"]->prepare($sql);
                            $stmt->execute();
                    }
                    $badge12 = "images/badges/on-track-color.webp";
                } else {
                    $badge12 = "images/badges/on-track-mono.webp";
                }
                if (isset($project["on-track"])) {
                    $badge12 = $project["on-track"];
                        if ($badge12 == "unlocked") {
                            $badge12 = "images/badges/on-track-color.webp";
                        } elseif ($badge12 == "locked") {
                            $badge12 = "images/badges/on-track-mono.webp";
                        }
                }
                
                //? TOGGLEABLE BADGES
                //* Outline
                $badge13 = $project["outline"];
                    if ($badge13 == "unlocked") {
                        $badge13 = "images/badges/outline-color-v2.webp";
                    } elseif ($badge13 == "locked") {
                        $badge13 = "images/badges/outline-mono-v2.webp";
                    }
                //* Journey
                $badge14 = $project["journey"];
                    if ($badge14 == "unlocked") {
                        $badge14 = "images/badges/journey-color.webp";
                    } elseif ($badge14 == "locked") {
                        $badge14 = "images/badges/journey-mono.webp";
                    }
                //* Dual Wielder
                $badge15 = $project["dual-wielder"];
                    if ($badge15 == "unlocked") {
                        $badge15 = "images/badges/dual-wielder-color.webp";
                    } elseif ($badge15 == "locked") {
                        $badge15 = "images/badges/dual-wielder-mono.webp";
                    }
                //* Starting Fresh
                $badge16 = $project["starting-fresh"];
                    if ($badge16 == "unlocked") {
                        $badge16 = "images/badges/starting-fresh-color.webp";
                    } elseif ($badge16 == "locked") {
                        $badge16 = "images/badges/starting-fresh-mono.webp";
                    }
                //* Ever Persist
                $badge17 = $project["ever-persist"];
                    if ($badge17 == "unlocked") {
                        $badge17 = "images/badges/ever-persist-color.webp";
                    } elseif ($badge17 == "locked") {
                        $badge17 = "images/badges/ever-persist-mono.webp";
                    }
                //* Back It Up
                $badge18 = $project["back-it-up"];
                    if ($badge18 == "unlocked") {
                        $badge18 = "images/badges/back-it-up-color.webp";
                    } elseif ($badge18 == "locked") {
                        $badge18 = "images/badges/back-it-up-mono.webp";
                    }
                //* Gathering
                $badge19 = $project["gathering"];
                    if ($badge19 == "unlocked") {
                        $badge19 = "images/badges/gathering-color.webp";
                    } elseif ($badge19 == "locked") {
                        $badge19 = "images/badges/gathering-mono.webp";
                    }
                //* Hear Ye
                $badge20 = $project["hear-ye"];
                    if ($badge20 == "unlocked") {
                        $badge20 = "images/badges/hear-ye-color.webp";
                    } elseif ($badge20 == "locked") {
                        $badge20 = "images/badges/hear-ye-mono.webp";
                    }
                //* Breakthrough
                $badge21 = $project["breakthrough"];
                    if ($badge21 == "unlocked") {
                        $badge21 = "images/badges/breakthrough-color.webp";
                    } elseif ($badge21 == "locked") {
                        $badge21 = "images/badges/breakthrough-mono.webp";
                    }
                //* Touch Grass
                $badge22 = $project["touch-grass"];
                    if ($badge22 == "unlocked") {
                        $badge22 = "images/badges/touch-grass-color.webp";
                    } elseif ($badge22 == "locked") {
                        $badge22 = "images/badges/touch-grass-mono.webp";
                    }
                //* Business
                $badge23 = $project["business"];
                    if ($badge23 == "unlocked") {
                        $badge23 = "images/badges/business-color.webp";
                    } elseif ($badge23 == "locked") {
                        $badge23 = "images/badges/business-mono.webp";
                    }
                //* Tears Wept
                $badge24 = $project["tears-wept"];
                    if ($badge24 == "unlocked") {
                        $badge24 = "images/badges/tears-wept-color.webp";
                    } elseif ($badge24 == "locked") {
                        $badge24 = "images/badges/tears-wept-mono.webp";
                    }
                //* Finish Him
                $badge25 = $project["finish-him"];
                    if ($badge25 == "unlocked") {
                        $badge25 = "images/badges/finish-him-color.webp";
                    } elseif ($badge25 == "locked") {
                        $badge25 = "images/badges/finish-him-mono.webp";
                    }



                    //* Days left math
                    $now = time();
                    $your_date = strtotime($displayGoalDate);
                    $divideDate = $your_date - $now;
                    $math = round($divideDate / (60 * 60 * 24));
                        if ($displayGoalDate == "0000-00-00" || !$displayGoalDate) {
                            $displayDays = "No Goal Date Set";
                        } elseif (isset($displayGoalDate) && $displayGoalDate !== "0000-00-00") {
                            $displayDays = $math;
                            if ($displayDays == 0) {
                                $displayDays = "Final Day!";
                            } elseif ($displayDays < 0) {
                                $displayDays = "Project Past Due!";
                            }
                        }
                        //* Percentage bar math
                        if (empty($displayCount) || empty($displayGoal)) {
                            $displayProgress = 4;
                            $displayPercentage = 0;
                        } elseif (floor($displayCount / $displayGoal * 100)<=4) {
                            $displayProgress = 4;
                            $displayPercentage = $displayPercentage;
                        } else {
                            $displayProgress = floor($displayCount / $displayGoal * 100);
                            $displayPercentage = $displayProgress;
                        }
        }


//* increase or reset streak count
if ($intervals == 1) {
    $streak = $streak + 1;
} elseif ($intervals >= 2) {
    $streak = 1;
} else {
    $streak = $streak;
}
$update_date = date("Y-m-d");

//* Set Session Tokens
$_SESSION["pfp"] = $pfp_set;
$_SESSION["username"] = $username;
$_SESSION["streak"] = $streak;
$_SESSION["update_date"] = $update_date;
}  
//* User is not logged in
else {
    $pfp_set = "images/pfp-icon.webp";
    $displayGenrePicture = "images/genre-covers/placeholder.webp";
}
//* Default Badges
    $default1 = "images/badges/quarter-quomplete-mono.webp";
    $default2 = "images/badges/half-way-mono.webp";
    $default3 = "images/badges/all-downhill-mono.webp";
    $default4 = "images/badges/cross-finish-mono.webp";
    $default5 = "images/badges/streak-two-mono.webp";
    $default6 = "images/badges/streak-three-mono.webp";
    $default7 = "images/badges/streak-seven-mono.webp";
    $default8 = "images/badges/streak-fourteen-mono.webp";
    $default9 = "images/badges/streak-twentyOne-mono.webp";
    $default10 = "images/badges/first-daily-mono.webp";
    $default11 = "images/badges/every-streak-mono.webp";
    $default12 = "images/badges/on-track-mono.webp";
    $default13 = "images/badges/outline-mono-v2.webp";
    $default14 = "images/badges/journey-mono.webp";
    $default15 = "images/badges/dual-wielder-mono.webp";
    $default16 = "images/badges/starting-fresh-mono.webp";
    $default17 = "images/badges/ever-persist-mono.webp";
    $default18 = "images/badges/back-it-up-mono.webp";
    $default19 = "images/badges/gathering-mono.webp";
    $default20 = "images/badges/hear-ye-mono.webp";
    $default21 = "images/badges/breakthrough-mono.webp";
    $default22 = "images/badges/touch-grass-mono.webp";
    $default23 = "images/badges/business-mono.webp";
    $default24 = "images/badges/tears-wept-mono.webp";
    $default25 = "images/badges/cross-finish-mono.webp";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.webp"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/progressBar.css">
    <link rel="website icon" type="webp" href="images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <script src="js/badges.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php if ($_SESSION["user_id"]== 7 || $_SESSION["user_id"]== 60) { ?>
<body id="body">
    <!-- //* POPUP FOR CHOOSING ACTIVE PROJECTS-->
    <?php if (isset($_SESSION["user_id"])) { ?>
    <div class="project-select-popup-wrapper" id="project-popup">
        <div class="project-select-popup">
            <div class="close-wrapper">
                <i class="fa fa-close" onclick="hideProjectPopup()"></i>
            </div>
            <?php
            //* Pull active project data
            $sql = "SELECT * FROM current_project WHERE users_id='$userID' AND current_state='current'";
                $result = $_SESSION["conn"]->query($sql);
                    if ($result->num_rows > 0) {
                        while ($rows = $result->fetch_assoc()) {
                            $projectID = $rows["id"];
                            $title = $rows["title"];
                            $genre = $rows["genre"];
                            $currentDisplay = $rows["display"];
                            $genre_picture = 'images/genre-covers/genre-covers'.$genre.'.webp';
                            $current_count = $rows["current_count"];
                            $goal = $rows["goal"];
                            $goalDate = $rows["goal_date"];
                            $progress = floor($current_count / $goal * 100);
                            $now = time();
                            $your_date = strtotime($goalDate);
                            $datediff = $your_date - $now;
                            $interval = round($datediff / (60 * 60 * 24)); 
                                if ($goalDate == "0000-00-00" || !$goalDate) {
                                    $days = "No Goal Date Set";
                                } elseif (isset($goalDate)&& $goalDate !== "0000-00-00") {
                                    $days = $interval;
                                    if ($days == 0) {
                                        $days = "Final Day!";
                                    } elseif ($days < 0) {
                                        $days = "Project Past Due!";
                                    }
                                }
                        ?>
            <div class="project-select-content" onclick="projectSelect('<?= $projectID ?>', '<?= $currentDisplay ?>')">
                <img class="popup-image" src=<?= $genre_picture ?> alt="genre cover image">
                <div class="project-info">
                    <h3 id="popup-project-title">
                        <i class="fa fa-star <?= $currentDisplay ?>" id="<?= $projectID ?>" alt="star icon"></i> 
                        <?= $title ?></h3>
                    <div class="project-stats">
                        <p id="popup-goal">Goal: <?= $current_count ?>/<?= $goal ?></p>
                        <p><?= $progress ?>%</p>
                        <?php if ($days !== "No Goal Date Set") { ?>
                            <p id="popup-days-left">Days Left: <?= $days ?></p>
                        <?php }else { ?>
                            <p id="popup-days-left"><?= $days ?></p>
                            <?php } ?>
                    </div>
                </div>
            </div>
            <?php }} ?>
            <script>
                var project = id;
                    const boxes = document.querySelectorAll('.fa-star');
                    for (const box of boxes) {
                        box.classList.add('inactive');
                    }
                function projectSelect(id, display) {
                    //assign values
                    var project = id;
                    const boxes = document.querySelectorAll('.fa-star');
                    for (const box of boxes) {
                        box.classList.add('inactive');
                    }

                    var i = document.getElementById(project);
                    i.classList.remove("inactive");
                    //begin post method
                    $.post("php-processes/update-activeProject", {
                        //DATA
                        project: project
                    });
                }
            </script>
            <div class="button-wrapper">
                <script>
                    //* reloads the page after selecting a project through ajax
                    function refresh(){
                        location.reload();
                    }
                </script>
                <button id="save" onclick="refresh()">Save</button>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="count-update-wrapper" id="count-update-popup">
        <div class="count-update-popup">
            <div class="close-wrapper">
                <i class="fa fa-close" onclick="hideUpdateWords()"></i>
            </div>
            <h2>Update Word Count</h2>
            <form action="php-processes/update-wordCount" method="post">
                <div class="count-type-select-wrapper">
                    <select class="count-type-select" id="wordCount" name="wordCount">
                        <p>Add/Replace Total <i class="fa fa-caret-down" id="down-icon" alt="down icon"></i></p>
                        <div class="count-type-dropdown">
                            <option class="count-type-list" id="replace" value="replace">replace total</option>
                            <option class="count-type-list" id="add" value="add">Add to total</option>
                        </div>
                    </select>
                    <input type="text" pattern="^\d+(,\d+)?$" id="updateWordCount" name="updateWordCount">
                    <input type="hidden" name="projectID" id="projectID" value="<?=$displayProjectID?>">
                </div>
                <div class="button-wrapper">
                    <button class="save" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <!-- //* NAVIGATION FOR BOTH MOBILE AND DESKTOP--> 
    <header>
        <?php makeNav() ?>
    </header>
    <?php if ($result->num_rows > 1) { ?>
    <!-- //* BUTTON FOR SELECTING ACTIVE PROJECT TO SEE -->
    <div class="project-select-wrapper">
        <div class="project-select" onclick="showProjectPopup()">Switch Project <i class="fa fa-caret-down" id="down-icon" alt="down icon"></i>
        </div>
    </div>
    <?php } ?>
    <!-- //* PROGRESS BAR-->
    <div class="pb-wrapper">
        <div class="pb-background">
            <h1>Project Progress</h1>
            <div class="progress-bar">
                <div class="border"></div>
                <div id="percentage" class="percentage clickable" style="width: <?= $displayProgress ?>%;"></div>
            </div>
            <div class="progress-info-wrapper">
                <div id="current" class="progress-info">
                    <h2>Current:</h2>
                    <p><?= $displayCount ?>/<?= $displayGoal ?></p>
                </div>
                <?php if (isset($displayGoalDate) && $displayGoalDate !== "0000-00-00") {?>
                <!-- //* displays days left only if user has a goal date set -->
                <div id="daysLeft" class="progress-info">
                    <h2>Days Left:</h2>
                    <p><?= $displayDays ?></p>
                </div>
                <?php } ?>
                <div id="dailyGoal" class="progress-info">
                    <h2>Daily Goal:</h2>
                    <p><?= $displayDailyGoal ?></p>
                </div>
                <div id="goal" class="progress-info">
                    <h2>Percentage:</h2>
                    <p><?= $displayPercentage ?>%</p>
                </div>
            </div>
            <div class="added">
                <span class="fa fa-plus" id="updateCount" onclick="showUpdateWords()"></span>
            </div>
        </div>
    </div>
    <!-- //* CURRENT PROJECT OVERVIEW AND INFO-->
    <div class="main-wrapper">
        <div class="current-project-wrapper">
            <div class="current-project-container">
                <div id="area-title">
                    <h1>Your Current Project</h1>
                </div>
                <div class="progress-info-container">
                    <div id="project-img">
                        <a href="project.php?projectID=<?=$displayProjectID?>">
                            <img src=<?= $displayGenrePicture ?> id="theme-img">
                        </a>
                    </div>
                    <div id="project-title">
                        <a href="project.php?projectID=<?=$displayProjectID?>">
                            <h2><?= $displayTitle ?></h2>
                        </a>
                    </div>
                    <div id="project-summary">
                        <!-- <p>Looks like you don't have any active projects.
                            <br><br>
                            Click <a href="newProject.php">here</a> to get started!
                        </p> -->
                        <p id="summary-text"><?= $displayInfo ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- //* BADGES-->
        <div class="badge-container">
            <h1 id="badge-title">Badges</h1>
            <h4 class="instruction">These badges are earned automatically</h4>
        <!-- //* Automatic Badges -->
            <div class="auto-badges">
            <!-- //* Row One -->
                <div class="auto-row rows">
                    <!-- //* First Daily-->
                    <div class="badge-wrapper" id="first-daily-wrapper">
                        <img src="<?php if($badge10) {
                            echo $badge10;
                        }else{
                            echo $default10;
                        } ?>" id="first-daily" class="badge">
                        <div class="badgeToPopup" id="first-daily-popup">
                            <h4>First Daily</h4>
                            <p>Reached your daily goal for the first time on this project</p>
                        </div>
                    </div>
                    <!-- //* Quarter Quomplete-->
                    <div class="badge-wrapper" id="quarter-quomplete-wrapper">
                        <img src="<?php if($badge1) {
                            echo $badge1;
                        }else{
                            echo $default1;
                        } ?>" id="quarter-quomplete" class="badge">
                        <div class="badgeToPopup" id="quarter-quomplete-popup">
                            <h4>Quarter Quomplete</h4>
                            <p>Reached the 25% mark! That's a quarter of the way there!</p>
                        </div>
                    </div>
                    <!-- //* Half Way-->
                    <div class="badge-wrapper" id="half-way-wrapper">
                        <img src="<?php if($badge2) {
                            echo $badge2;
                        }else{
                            echo $default2;
                        } ?>" id="half-way" class="badge">
                        <div class="badgeToPopup" id="half-way-popup">
                            <h4>Half-Way There, Woah!<br>Livin' on a-</h4>
                            <p>Reached the 50% mark<br>on your current project.<br>Good job!</p>
                        </div>
                    </div>
                    <!-- //* All Downhill-->
                    <div class="badge-wrapper" id="all-downhill-wrapper">
                        <img src="<?php if($badge3) {
                            echo $badge3;
                        }else{
                            echo $default3;
                        } ?>" id="all-downhill" class="badge">
                        <div class="badgeToPopup" id="all-downhill-popup">
                            <h4>All Downhill From Here</h4>
                            <p>Reached 75%!<br>You're so close!</p>
                        </div>
                    </div>
                    <!-- //* Cross Finish-->
                    <div class="badge-wrapper" id="cross-finish-wrapper">
                        <img src="<?php if($badge4) {
                            echo $badge4;
                        }else{
                            echo $default4;
                        } ?>" id="cross-finish" class="badge">
                        <div class="badgeToPopup" id="cross-finish-popup">
                            <h4>Crossed the Finish Line!</h4>
                            <p>Reached 100% on your current project!<br>YOU DID IT, YAY!!!</p>
                        </div>
                    </div>
                </div>
            <!-- //* Row Two -->
                <div class="auto-row rows">
                    <!-- //* 2 Day Streak-->
                    <div class="badge-wrapper" id="streak-two-wrapper">
                        <img src="<?php if($badge5) {
                            echo $badge5;
                        }else{
                            echo $default5;
                        } ?>" id="streak-two" class="badge">
                        <div class="badgeToPopup" id="streak-two-popup">
                            <h4>2-Day Streak</h4>
                            <p>The start of a beautiful streak</p>
                        </div>
                    </div>
                    <!-- //* 3 Day Streak-->
                    <div class="badge-wrapper" id="streak-three-wrapper">
                        <img src="<?php if($badge6) {
                            echo $badge6;
                        }else{
                            echo $default6;
                        } ?>" id="streak-three" class="badge">
                        <div class="badgeToPopup" id="streak-three-popup">
                            <h3>3-Day Streak</h3>
                            <p>Third time's the charm</p>
                        </div>
                    </div>
                    <!-- //* 7 Day Streak-->
                    <div class="badge-wrapper" id="streak-seven-wrapper">
                        <img src="<?php if($badge7) {
                            echo $badge7;
                        }else{
                            echo $default7;
                        } ?>" id="streak-seven" class="badge">
                        <div class="badgeToPopup" id="streak-seven-popup">
                            <h4>7-Day Streak</h4>
                            <p>One whole week!</p>
                        </div>
                    </div>
                    <!-- //* 14 Day Streak-->
                    <div class="badge-wrapper" id="streak-fourteen-wrapper">
                        <img src="<?php if($badge8) {
                            echo $badge8;
                        }else{
                            echo $default8;
                        } ?>" id="streak-fourteen" class="badge">
                        <div class="badgeToPopup" id="streak-fourteen-popup">
                            <h4>14-Day Streak</h4>
                            <p>TWO whole weeks!!</p>
                        </div>
                    </div>
                    <!-- //* 21 Day Streak-->
                    <div class="badge-wrapper" id="streak-twentyOne-wrapper">
                        <img src="<?php if($badge9) {
                            echo $badge9;
                        }else{
                            echo $default9;
                        } ?>" id="streak-twentyOne" class="badge">
                        <div class="badgeToPopup" id="streak-twentyOne-popup">
                            <h4>21-Day Streak</h4>
                            <p>THREE WHOLE WEEKS!!!</p>
                        </div>
                    </div>
                </div>
            <?php if ($displayGoalDate !== "0000-00-00") { ?>
            <!-- //* Row Three -->
                <div class="auto-row rows">
                    <!-- //* Full Streak-->
                    <div class="badge-wrapper" id="every-streak-wrapper">
                        <img src="<?php if($badge11) {
                            echo $badge11;
                        }else{
                            echo $default11;
                        } ?>" id="every-streak" class="badge">
                        <div class="badgeToPopup" id="every-streak-popup">
                            <h4>Every Day Streak</h4>
                            <p>Congrats, you've worked on your project every day!</p>
                        </div>
                    </div>
                    <!-- //* Stayed on Track-->
                    <div class="badge-wrapper" id="on-track-wrapper">
                        <img src="<?php if($badge12) {
                            echo $badge12;
                        }else{
                            echo $default12;
                        } ?>" id="on-track" class="badge">
                        <div class="badgeToPopup" id="on-track-popup">
                            <h4>Stayed on Track</h4>
                            <p>Reached your daily goal every day over the course of the project</p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        <!-- //* Toggleable Badges -->
            <div class="toggle-badges">
                <h4 class="instruction">You can award yourself these badges</h4>
            <!-- //* Row One -->
                <div class="toggle-row rows">
                    <!-- //* Outlined-->
                    <div class="badge-wrapper" id="outline-wrapper">
                        <img src="<?php if($badge13) {
                            echo $badge13;
                        }else{
                            echo $default13;
                        } ?>" id="outline" class="badge pulse"
                        onclick="checkToggle('outline')">
                        <div class="badgeToPopup" id="outline-popup">
                            <h4>Know Where Ya Goin'</h4>
                            <p>Started your project with an outline.</p>
                        </div>
                    </div>
                    <!-- //* Pantser/Journey-->
                    <div class="badge-wrapper" id="journey-wrapper">
                        <img src="<?php if($badge14) {
                            echo $badge14;
                        }else{
                            echo $default14;
                        } ?>" id="journey" class="badge pulse"
                        onclick="checkToggle('journey')">
                        <div class="badgeToPopup" id="journey-popup">
                            <h4>It's All About The Journey</h4>
                            <p>The only plan you have is to explore and discover the project along the way</p>
                        </div>
                    </div>
                    <!-- //* Dual Wielding-->
                    <div class="badge-wrapper" id="dual-wielder-wrapper">
                        <img src="<?php if($badge15) {
                            echo $badge15;
                        }else{
                            echo $default15;
                        } ?>" id="dual-wielder" class="badge pulse"
                        onclick="checkToggle('dual-wielder')">
                        <div class="badgeToPopup" id="dual-wielder-popup">
                            <h4>Dual Wielder</h4>
                            <p>Your special sauce is ??% planning and ??% exploration, you'll never tell how much of each</p>
                        </div>
                    </div>
                    <!-- //* Fresh Project-->
                    <div class="badge-wrapper" id="starting-freshl-wrapper">
                        <img src="<?php if($badge16) {
                            echo $badge16;
                        }else{
                            echo $default16;
                        } ?>" id="starting-fresh" class="badge pulse"
                        onclick="checkToggle('starting-fresh')">
                        <div class="badgeToPopup" id="starting-fresh-popup">
                            <h4>Starting Fresh</h4>
                            <p>Created a brand new project!</p>
                        </div>
                    </div>
                </div>
            <!-- //* Row Two -->
                <div class="toggle-row rows">
                    <!-- //* Returning to WIP-->
                    <div class="badge-wrapper" id="ever-persist-wrapper">
                        <img src="<?php if($badge17) {
                            echo $badge17;
                        }else{
                            echo $default17;
                        } ?>" id="ever-persist" class="badge pulse"
                        onclick="checkToggle('ever-persist')">
                        <div class="badgeToPopup" id="ever-persist-popup">
                            <h4>Ever Persistent</h4>
                            <p>You Returned to a WIP!</p>
                        </div>
                    </div>
                    <!-- //* Backed up Project-->
                    <div class="badge-wrapper" id=back-it-up-wrapper">
                        <img src="<?php if($badge18) {
                            echo $badge18;
                        }else{
                            echo $default18;
                        } ?>" id="back-it-up" class="badge pulse"
                        onclick="checkToggle('back-it-up')">
                        <div class="badgeToPopup" id="back-it-up-popup">
                            <h4>Back It Up!</h4>
                            <p>You never know when The Horrors will hit your computer, but you're 
                                ready!<br>Project backed up!</p>
                        </div>
                    </div>
                    <!-- //* Guild Hall Gathering-->
                    <div class="badge-wrapper" id="gathering-wrapper">
                        <img src="<?php if($badge19) {
                            echo $badge19;
                        }else{
                            echo $default19;
                        } ?>" id="gathering" class="badge pulse"
                        onclick="checkToggle('gathering')">
                        <div class="badgeToPopup" id="gathering-popup">
                            <h4>Guildhall Gathering</h4>
                            <p>You participated in a Write In or Sprint!</p>
                        </div>
                    </div>
                    <!-- //* Hear Ye-->
                    <div class="badge-wrapper" id="hear-ye-wrapper">
                        <img src="<?php if($badge20) {
                            echo $badge20;
                        }else{
                            echo $default20;
                        } ?>" id="hear-ye" class="badge pulse"
                        onclick="checkToggle('hear-ye')">
                        <div class="badgeToPopup" id="hear-ye-popup">
                            <h4>Hear Ye! Hear Ye!</h4>
                            <p>You've told someone about your goal, whether a close friend or the whole world!</p>
                        </div>
                    </div>
                    <!-- //* Breakthrough-->
                    <div class="badge-wrapper" id="breakthrough-wrapper">
                        <img src="<?php if($badge21) {
                            echo $badge21;
                        }else{
                            echo $default21;
                        } ?>" id="breakthrough" class="badge pulse"
                        onclick="checkToggle('breakthrough')">
                        <div class="badgeToPopup" id="breakthrough-popup">
                            <h4>Breakthrough Moment</h4>
                            <p>Whatever was giving you trouble on this project, you've just figured it out!</p>
                        </div>
                    </div>
                </div>
            <!-- //* Row Three -->
                <div class="toggle-row rows">
                    <!-- //* Touch Grass-->
                    <div class="badge-wrapper" id="touch-grass-wrapper">
                        <img src="<?php if($badge22) {
                            echo $badge22;
                        }else{
                            echo $default22;
                        } ?>" id="touch-grass" class="badge pulse"
                        onclick="checkToggle('touch-grass')">
                        <div class="badgeToPopup" id="touch-grass-popup">
                            <h4>Touched Grass</h4>
                            <p>You made sure to go outside and get some of that sweet, sweeet vitamin D.</p>
                        </div>
                    </div>
                    <!-- //* Took Care of Business-->
                    <div class="badge-wrapper" id="business-wrapper">
                        <img src="<?php if($badge23) {
                            echo $badge23;
                        }else{
                            echo $default23;
                        } ?>" id="business" class="badge pulse"
                        onclick="checkToggle('business')">
                        <div class="badgeToPopup" id="business-popup">
                            <h4>Took Care of Business</h4>
                            <p>You took care of your other responsibilities, like dishes or homework. All those boring things no one wants to do.</p>
                        </div>
                    </div>
                    <!-- //* Tears Were Wept-->
                    <div class="badge-wrapper" id="tears-wept-wrapper">
                        <img src="<?php if($badge24) {
                            echo $badge24;
                        }else{
                            echo $default24;
                        } ?>" id="tears-wept" class="badge pulse"
                        onclick="checkToggle('tears-wept')">
                        <div class="badgeToPopup" id="tears-wept-popup">
                            <h4>Tears Were Wept</h4>
                            <p>Either the creation or the process itself made you cry.</p>
                        </div>
                    </div>
                    <!-- //* Finished Project-->
                    <div class="badge-wrapper" id="finish-him-wrapper">
                        <img src="<?php if($badge25) {
                            echo $badge25;
                        }else{
                            echo $default25;
                        } ?>" id="finish-him" class="badge pulse"
                        onclick="checkToggle('finish-him')">
                        <div class="badgeToPopup" id="finish-him-popup">
                            <h4><em>Finish Him</em></h4>
                            <p>You fully completed this project during this challenge.<br>WIP no more!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="instruction-wrapper">
                <p class="instruction">
                    To give yourself a badge, simply activate the toggle and click on a badge. 
                    Click again to remove the badge.
                </p>
                <div class="slider-container">
                    <i class="fa fa-lock" alt="lock icon"></i>
                    <label class="switch">
                        <input type="checkbox" id="badgeEdit" value="off" onclick="clickCheckbox()">
                        <span class="slider round"></span>
                    </label>
                    <i class="fa fa-unlock" alt="unlocked icon"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- //* FOOTER-->
    <!-- //! Keep link to logo artist for permission to use-->
    <?php makeFooter() ?>
    <script>
    //* round end of percentage bar when it hits 100%
    var percentageBar = document.getElementById("percentage");
    var percentage = <?=$displayPercentage?>;
    if (percentage >= 100) {
        percentageBar.style['border-radius'] = '14px';
    } else {
        percentageBar.style['border-radius'] = '14px 0px 0px 14px';
    }
    //* Check if badge toggle is checked
    var badgeToggle = document.getElementById("badgeEdit");
    function clickCheckbox() {
        var badgeToggle = document.getElementById("badgeEdit");
        if (badgeToggle.value == "off") {
            badgeToggle.value = "on";
            console.log(badgeToggle.value);
        }else if (badgeToggle.value == "on") {
            badgeToggle.value = "off";
            console.log(badgeToggle.value);
        }
        
    }
    //* calls correct image toggle function for ajax
    function checkToggle(name) {
        console.log(name);
        var badgeToggle = document.getElementById("badgeEdit");
        if (badgeToggle.value == "on") {
            console.log(name);
            switch(name) {
            case 'back-it-up':
                toggleImage15();
                break;
            case 'outline':
                toggleImage16();
                break;
            case 'journey':
                toggleImage17();
                break;
            case 'dual-wielder':
                toggleImage18();
                break;
            case 'gathering':
                toggleImage19();
                break;
            case 'hear-ye':
                toggleImage20();
                break;
            case 'breakthrough':
                toggleImage21();
                break;
            case 'starting-fresh':
                toggleImage22();
                break;
            case 'ever-persist':
                toggleImage23();
                break;
            case 'touch-grass':
                toggleImage24();
                break;
            case 'business':
                toggleImage25();
                break;
            case 'tears-wept':
                toggleImage26();
                break;
            case 'finish-him':
                toggleImage28();
                break;
            default:
                console.log("something went wrong");
            } 
        }
    }
    
// BADGE POPUPS
    const elementToHover1 = document.getElementById('first-daily');
    const elementToPopup1 = document.getElementById('first-daily-popup');
    if (elementToHover1) {
    elementToHover1.addEventListener('mouseenter',
        () => {
        elementToPopup1.classList.add('showFlex');
        });
        
    elementToHover1.addEventListener('mouseleave',
        () => {
        elementToPopup1.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover2 = document.getElementById('quarter-quomplete');
    const elementToPopup2 = document.getElementById('quarter-quomplete-popup');
    if (elementToHover2) {
    elementToHover2.addEventListener('mouseenter',
        () => {
        elementToPopup2.classList.add('showFlex');
        });
        
    elementToHover2.addEventListener('mouseleave',
        () => {
        elementToPopup2.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover3 = document.getElementById('half-way');
    const elementToPopup3 = document.getElementById('half-way-popup');
    if (elementToHover3) {
    elementToHover3.addEventListener('mouseenter',
        () => {
        elementToPopup3.classList.add('showFlex');
        });
        
    elementToHover3.addEventListener('mouseleave',
        () => {
        elementToPopup3.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover4 = document.getElementById('all-downhill');
    const elementToPopup4 = document.getElementById('all-downhill-popup');
    if (elementToHover4) {
    elementToHover4.addEventListener('mouseenter',
        () => {
        elementToPopup4.classList.add('showFlex');
        });
        
    elementToHover4.addEventListener('mouseleave',
        () => {
        elementToPopup4.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover5 = document.getElementById('cross-finish');
    const elementToPopup5 = document.getElementById('cross-finish-popup');
    if (elementToHover5) {
    elementToHover5.addEventListener('mouseenter',
        () => {
        elementToPopup5.classList.add('showFlex');
        });
        
    elementToHover5.addEventListener('mouseleave',
        () => {
        elementToPopup5.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover6 = document.getElementById('streak-two');
    const elementToPopup6 = document.getElementById('streak-two-popup');
    if (elementToHover6) {
    elementToHover6.addEventListener('mouseenter',
        () => {
        elementToPopup6.classList.add('showFlex');
        });
        
    elementToHover6.addEventListener('mouseleave',
        () => {
        elementToPopup6.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover7 = document.getElementById('streak-three');
    const elementToPopup7 = document.getElementById('streak-three-popup');
    if (elementToHover7) {
    elementToHover7.addEventListener('mouseenter',
        () => {
        elementToPopup7.classList.add('showFlex');
        });
        
    elementToHover7.addEventListener('mouseleave',
        () => {
        elementToPopup7.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover8 = document.getElementById('streak-seven');
    const elementToPopup8 = document.getElementById('streak-seven-popup');
    if (elementToHover8) {
    elementToHover8.addEventListener('mouseenter',
        () => {
        elementToPopup8.classList.add('showFlex');
        });
        
    elementToHover8.addEventListener('mouseleave',
        () => {
        elementToPopup8.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover9 = document.getElementById('streak-fourteen');
    const elementToPopup9 = document.getElementById('streak-fourteen-popup');
    if (elementToHover9) {
    elementToHover9.addEventListener('mouseenter',
        () => {
        elementToPopup9.classList.add('showFlex');
        });
        
    elementToHover9.addEventListener('mouseleave',
        () => {
        elementToPopup9.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover10 = document.getElementById('streak-twentyOne');
    const elementToPopup10 = document.getElementById('streak-twentyOne-popup');
    if (elementToHover10) {
    elementToHover10.addEventListener('mouseenter',
        () => {
        elementToPopup10.classList.add('showFlex');
        });
        
    elementToHover10.addEventListener('mouseleave',
        () => {
        elementToPopup10.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover11 = document.getElementById('every-streak');
    const elementToPopup11 = document.getElementById('every-streak-popup');
    if (elementToHover11) {
    elementToHover11.addEventListener('mouseenter',
        () => {
        elementToPopup11.classList.add('showFlex');
        });
        
    elementToHover11.addEventListener('mouseleave',
        () => {
        elementToPopup11.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover12 = document.getElementById('on-track');
    const elementToPopup12 = document.getElementById('on-track-popup');
    if (elementToHover12) {
    elementToHover12.addEventListener('mouseenter',
        () => {
        elementToPopup12.classList.add('showFlex');
        });
        
    elementToHover12.addEventListener('mouseleave',
        () => {
        elementToPopup12.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover13 = document.getElementById('outline');
    const elementToPopup13 = document.getElementById('outline-popup');
    if (elementToHover13) {
    elementToHover13.addEventListener('mouseenter',
        () => {
        elementToPopup13.classList.add('showFlex');
        });
        
    elementToHover13.addEventListener('mouseleave',
        () => {
        elementToPopup13.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover14 = document.getElementById('journey');
    const elementToPopup14 = document.getElementById('journey-popup');
    if (elementToHover14) {
    elementToHover14.addEventListener('mouseenter',
        () => {
        elementToPopup14.classList.add('showFlex');
        });
        
    elementToHover14.addEventListener('mouseleave',
        () => {
        elementToPopup14.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover15 = document.getElementById('dual-wielder');
    const elementToPopup15 = document.getElementById('dual-wielder-popup');
    if (elementToHover15) {
    elementToHover15.addEventListener('mouseenter',
        () => {
        elementToPopup15.classList.add('showFlex');
        });
        
    elementToHover15.addEventListener('mouseleave',
        () => {
        elementToPopup15.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover16 = document.getElementById('starting-fresh');
    const elementToPopup16 = document.getElementById('starting-fresh-popup');
    if (elementToHover16) {
    elementToHover16.addEventListener('mouseenter',
        () => {
        elementToPopup16.classList.add('showFlex');
        });
        
    elementToHover16.addEventListener('mouseleave',
        () => {
        elementToPopup16.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover17 = document.getElementById('ever-persist');
    const elementToPopup17 = document.getElementById('ever-persist-popup');
    if (elementToHover17) {
    elementToHover17.addEventListener('mouseenter',
        () => {
        elementToPopup17.classList.add('showFlex');
        });
        
    elementToHover17.addEventListener('mouseleave',
        () => {
        elementToPopup17.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover18 = document.getElementById('back-it-up');
    const elementToPopup18 = document.getElementById('back-it-up-popup');
    if (elementToHover18) {
    elementToHover18.addEventListener('mouseenter',
        () => {
        elementToPopup18.classList.add('showFlex');
        });
        
    elementToHover18.addEventListener('mouseleave',
        () => {
        elementToPopup18.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover19 = document.getElementById('gathering');
    const elementToPopup19 = document.getElementById('gathering-popup');
    if (elementToHover19) {
    elementToHover19.addEventListener('mouseenter',
        () => {
        elementToPopup19.classList.add('showFlex');
        });
        
    elementToHover19.addEventListener('mouseleave',
        () => {
        elementToPopup19.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover20 = document.getElementById('hear-ye');
    const elementToPopup20 = document.getElementById('hear-ye-popup');
    if (elementToHover20) {
    elementToHover20.addEventListener('mouseenter',
        () => {
        elementToPopup20.classList.add('showFlex');
        });
        
    elementToHover20.addEventListener('mouseleave',
        () => {
        elementToPopup20.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover21 = document.getElementById('breakthrough');
    const elementToPopup21 = document.getElementById('breakthrough-popup');
    if (elementToHover21) {
    elementToHover21.addEventListener('mouseenter',
        () => {
        elementToPopup21.classList.add('showFlex');
        });
        
    elementToHover21.addEventListener('mouseleave',
        () => {
        elementToPopup21.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover22 = document.getElementById('touch-grass');
    const elementToPopup22 = document.getElementById('touch-grass-popup');
    if (elementToHover22) {
    elementToHover22.addEventListener('mouseenter',
        () => {
        elementToPopup22.classList.add('showFlex');
        });
        
    elementToHover22.addEventListener('mouseleave',
        () => {
        elementToPopup22.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover23 = document.getElementById('business');
    const elementToPopup23 = document.getElementById('business-popup');
    if (elementToHover23) {
    elementToHover23.addEventListener('mouseenter',
        () => {
        elementToPopup23.classList.add('showFlex');
        });
        
    elementToHover23.addEventListener('mouseleave',
        () => {
        elementToPopup23.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover24 = document.getElementById('tears-wept');
    const elementToPopup24 = document.getElementById('tears-wept-popup');
    if (elementToHover24) {
    elementToHover24.addEventListener('mouseenter',
        () => {
        elementToPopup24.classList.add('showFlex');
        });
        
    elementToHover24.addEventListener('mouseleave',
        () => {
        elementToPopup24.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover25 = document.getElementById('finish-him');
    const elementToPopup25 = document.getElementById('finish-him-popup');
    if (elementToHover25) {
    elementToHover25.addEventListener('mouseenter',
        () => {
        elementToPopup25.classList.add('showFlex');
        });
        
    elementToHover25.addEventListener('mouseleave',
        () => {
        elementToPopup25.classList.remove('showFlex');
        });
    };
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    function disableBadgePopups() {
    var popup = document.getElementsByClassName("badgeToPopup");
    var slider = document.getElementById("badgeEdit").checked;
        if (slider == true) {
            var i;
            for (i = 0; i < popup.length; i++) {
                popup[i].classList.add('hide');
            }
        } else {
            var i;
            for (i = 0; i < popup.length; i++) {
                popup[i].classList.remove('hide');
            }
        }
    }
    
    </script>
<?php } else { ?>
    <div class="announce-wrapper">
        <h1>Attention!</h1>
        <h3>The Guild is currently closed for maintenance. Please check back later.</h3>
    </div>
<?php } ?>
</body>
</html>