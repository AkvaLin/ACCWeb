<?php
    session_start();

    $isSignedIn = ($_SESSION['id'] ?? null) != null;
    $sql = mysqli_connect("127.0.0.1", "dbeaver", "dbeaver", "ACCCompanion", "3306");

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Championships</title>
    <link rel="stylesheet" href="../Profile/profile.css">
    <link rel="stylesheet" href="../../main.css">
    <link rel="stylesheet" href="../SetupGuides/setupGuides.css">
    <link rel="stylesheet" href="championships.css">
</head>
<body>

<?php
    include '../NavBar/navbar.php';
?>

<div class="profileBackground glass">
    <h1>Championships</h1>
    <div class="eventsInfo">
        <div class="eventsInfoContainer">
        <?php
        $events = mysqli_query($sql, "SELECT * FROM Events ORDER BY start");
        while ($event = mysqli_fetch_assoc($events)) {
            $track = mysqli_query($sql, "SELECT track FROM Tracks WHERE id=$event[track]");
            $trackDict = mysqli_fetch_assoc($track);
            $class = mysqli_query($sql, "SELECT class FROM Classes WHERE id=$event[class]");
            $classDict = mysqli_fetch_assoc($class);
            $count = mysqli_query($sql, "SELECT COUNT(user_id) AS count FROM Registration WHERE event_id=$event[id]");
            $countDict = mysqli_fetch_array($count);
            echo "
                <div class='event'>
                <h3>$event[title]</h3>
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
                <span>Slots: $countDict[count]/$event[slots]</span>
                <span>Duration: $event[duration] min</span>
                <span>Race starts at $event[start]</span>
                ";

            if ($isSignedIn) {
                $userId = $_SESSION['id'];
                $data = mysqli_query($sql, "SELECT * FROM Registration WHERE event_id=$event[id] AND user_id=$userId");
                if (!mysqli_fetch_assoc($data)) {
                    echo "
                <form action='championships.php' method='post'>
                    <input type='hidden' name='eventId' value='$event[id]'>
                    <input type='hidden' name='userId' value='$userId'>
                    <input type='submit' value='Enter now'>
                </form>
                ";
                } else {
                    echo "
                <form action='championships.php' method='post'>
                    <input type='hidden' name='eventIdEx' value='$event[id]'>
                    <input type='hidden' name='userIdEx' value='$userId'>
                    <input type='submit' value='Exit event' class='exit'>
                </form>
                ";
                }
            }

            echo "</div>";
        }
        ?>
        </div>
    </div>
</div>

</body>
</html>