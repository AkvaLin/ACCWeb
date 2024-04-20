<?php
    session_start();
    $exit = $_POST['exit'] ?? null;

    if ($exit == 'exit') {
        session_unset();
        session_destroy();
    }

    $isSignedIn = ($_SESSION['id'] ?? null) != null;
    $userName = $_SESSION['login'] ?? null;
    $isRegistration = $_GET['register'] ?? 'false';

    $login = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;
    $password2 = $_POST['password2'] ?? null;
    $reg = $_POST['register'] ?? null;

    $unmatched = false;
    $loginTaken = false;
    $wrongCred = false;

    $sql = mysqli_connect("127.0.0.1", "dbeaver", "dbeaver", "ACCCompanion", "3306");

    if (isset($_GET['delete'])) {
        if ($_GET['delete'] = 'true') {
            $id = intval($_SESSION['id']);
            mysqli_query($sql, "DELETE FROM Users WHERE id=$id");
            $isSignedIn = false;
            $userName = "";
            session_unset();
            session_destroy();
        }
    }

    if (isset($_GET['deleteEventWithId'])) {
        $eventIdToDelete = intval($_GET['deleteEventWithId']);
        mysqli_query($sql, "DELETE FROM Events WHERE id=$eventIdToDelete");
    }

    $eventId = $_POST['eventId'] ?? null;
    $userId = $_POST['userId'] ?? null;
    $eventIdEx = $_POST['eventIdEx'] ?? null;
    $userIdEx = $_POST['userIdEx'] ?? null;

    if ($eventId != null and $userId != null) {
        $eventId = intval($eventId);
        $userId = intval($userId);
        mysqli_query($sql, "INSERT INTO Registration VALUES (default, $eventId, $userId)");
    }

    if ($eventIdEx != null and $userIdEx != null) {
        $eventIdEx = intval($eventIdEx);
        $userIdEx = intval($userIdEx);
        mysqli_query($sql, "DELETE FROM Registration WHERE event_id=$eventIdEx and user_id=$userIdEx");
    }

    if ($login != null) {

        if ($reg == 'true') {
            if ($password == $password2) {
                $isLoginTaken = mysqli_query($sql, "SELECT login FROM Users WHERE login='$login'");
                $loginsDict = mysqli_fetch_assoc($isLoginTaken);
                if ($loginsDict) {
                    $loginTaken = true;
                } else {
                    mysqli_query($sql,"INSERT INTO Users (id, login, password) VALUES (default, '$login', '$password')");
                }
            } else {
                $unmatched = true;
            }
        } else {
            $check = mysqli_query($sql, "SELECT id, login FROM Users WHERE login='$login' and password='$password'");
            $checkDict = mysqli_fetch_assoc($check);
            if ($checkDict) {
                $_SESSION['id'] = $checkDict['id'];
                $_SESSION['login'] = $checkDict['login'];
                $userName = $checkDict['login'];
                $isSignedIn = true;
            } else {
                $wrongCred = true;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ACC Companion</title>
    <link rel="stylesheet" href="../../main.css">
    <link rel="stylesheet" href="profile.css">
</head>
<body>

<?php
    include '../NavBar/navbar.php';

    if ($isSignedIn) {
        echo "
            <div class='profileBackground glass'>
            <div class='profileContainer'>
                <div class='profileInfo'>
                    <h1>$userName</h1>
                    <a href='http://localhost:8080/Modules/Event/addEvent.php' class='addEventButton'>Add event</a>
                    <form action='profile.php' method='post'>
                        <input type='hidden' name='exit' value='exit'>
                        <input type='submit' value='Exit' class='exit'>
                    </form>
                    <a href='http://localhost:8080/Modules/Profile/profile.php?delete=true' class='delete'>Delete account</a>
                </div>
                <div class='eventsInfo'>
                    <h1>Created events</h1>
                    <div class='eventsInfoContainer'>
        ";
        $createdBy = $_SESSION['id'];
        $events = mysqli_query($sql, "SELECT * FROM Events WHERE createdBy=$createdBy");
        while ($event = mysqli_fetch_assoc($events)) {
            $data = mysqli_query($sql, "SELECT * FROM Registration WHERE event_id=$event[id] AND user_id=$createdBy");
            $track = mysqli_query($sql, "SELECT track FROM Tracks WHERE id=$event[track]");
            $trackDict = mysqli_fetch_assoc($track);
            $class = mysqli_query($sql, "SELECT class FROM Classes WHERE id=$event[class]");
            $classDict = mysqli_fetch_assoc($class);
            echo "
                <div class='event'>
                <h4>$event[title]</h4>
                <table>
                    <tr>
                        <td>Track</td>
                        <td>Class</td>
                    </tr>
                    <tr>
                        <td>$trackDict[track]</td>
                        <td>$classDict[class]</td>
                    </tr>
                </table>
                <span>Slots: $event[slots]</span>    
                <span>Duration: $event[duration] min</span>
                <span>Race starts at $event[start]</span>
                ";

            if (!mysqli_fetch_assoc($data)) {
                echo "
                <form action='profile.php' method='post'>
                    <input type='hidden' name='eventId' value='$event[id]'>
                    <input type='hidden' name='userId' value='$createdBy'>
                    <input type='submit' value='Enter now'>
                </form>
                ";
            } else {
                echo "
                <form action='profile.php' method='post'>
                    <input type='hidden' name='eventIdEx' value='$event[id]'>
                    <input type='hidden' name='userIdEx' value='$createdBy'>
                    <input type='submit' value='Exit event' class='exit'>
                </form>
                ";
            }

            echo "
                <a href='http://localhost:8080/Modules/Profile/profile.php?deleteEventWithId=$event[id]' class='deleteEvent'>Delete event</a>
            ";

            echo "  
                </div>         
            ";
        }
        echo "</div><h1>Entered events</h1><div class='eventsInfoContainer'>";

        $assignedEvents = mysqli_query($sql, "SELECT * FROM Events join ACCCompanion.Registration R on Events.id = R.event_id WHERE user_id=$createdBy");
        while ($assignEvent = mysqli_fetch_assoc($assignedEvents)) {
            $trackA = mysqli_query($sql, "SELECT track FROM Tracks WHERE id=$assignEvent[track]");
            $trackDictA = mysqli_fetch_assoc($trackA);
            $classA = mysqli_query($sql, "SELECT class FROM Classes WHERE id=$assignEvent[class]");
            $classDictA = mysqli_fetch_assoc($classA);
            echo "
                <div class='event'>
                <h4>$assignEvent[title]</h4>
                <table>
                    <tr>
                        <td>Track</td>
                        <td>Class</td>
                    </tr>
                    <tr>
                        <td>$trackDictA[track]</td>
                        <td>$classDictA[class]</td>
                    </tr>
                </table>
                <span>Slots: $assignEvent[slots]</span>    
                <span>Duration: $assignEvent[duration] min</span>
                <span>Race starts at $assignEvent[start]</span>
                ";
            echo "
                <form action='profile.php' method='post'>
                    <input type='hidden' name='eventIdEx' value='$assignEvent[event_id]'>
                    <input type='hidden' name='userIdEx' value='$createdBy'>
                    <input type='submit' value='Exit event' class='exit'>
                </form>
                ";
            echo "</div>";
        }

        echo "</div></div></div>";
    } else {
        echo "<div class='background glass'>";
        if ($isRegistration == 'true' or $reg == 'true') {
            if ($unmatched) {
                echo "<span>Passwords are not matched</span>";
            }
            if ($loginTaken) {
                echo "<span>This login has already been taken</span>";
            }
            echo "
                <form action='profile.php' method='post'>
                    <input type='text' name='login' placeholder='login' required>
                    <input type='password' name='password' placeholder='password' required>
                    <input type='password' name='password2' placeholder='repeat password' required>
                    <input type='submit' value='Sign Up'>
                    <input type='hidden' name='register' value=$isRegistration>
                </form>
                <a href='profile.php' class='light'>Sign In</a>
            ";
        } else {
            if ($wrongCred) {
                echo "<span>Wrong login or password</span>";
            }
            echo "
                <form action='profile.php' method='post'>
                    <input type='text' name='login' placeholder='login' required>
                    <input type='password' name='password' placeholder='password' required>
                    <input type='submit' value='Sign In'>
                    <input type='hidden' name='register' value=$isRegistration>
                </form>
                <a href='profile.php?register=true' class='light'>Sign Up</a>
            ";
        }
    }

    echo "</div>";
?>

</body>
</html>