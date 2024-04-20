<?php
session_start();

$isSignedIn = ($_SESSION['id'] ?? null) != null;

if ($isSignedIn) {
    $sql = mysqli_connect("127.0.0.1", "dbeaver", "dbeaver", "ACCCompanion", "3306");

    $createdBy = $_SESSION['id'] ?? null;
    $title = $_POST['title'] ?? null;
    $track = intval($_POST['track'] ?? -1);
    $class = intval($_POST['class'] ?? -1);
    $slots = intval($_POST['slots'] ?? -1);
    $duration = intval($_POST['duration'] ?? -1);
    $start = date("Y-m-d H:i:s",strtotime($_POST['start'] ?? ''));

    if ($createdBy != null and $title != null and $track > 0 and $class > 0 and $slots > 0 and $duration > 0) {
        $request = mysqli_query($sql,
            "INSERT INTO Events values (default, '$title', $track, $class, $slots, $duration, $createdBy, '$start');");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ACC Companion</title>
    <link rel="stylesheet" href="../../main.css">
    <link rel="stylesheet" href="../Profile/profile.css">
</head>
<body>

<?php include "../NavBar/navbar.php"?>

<div class="background glass">

    <form action="addEvent.php" method="post">
        <?php echo "<input type='hidden' name='createdBy' value='$isSignedIn'>"?>
        <input type="text" name="title" placeholder="Title" required>
        <select name="track">
            <?php
                if (isset($sql)) {
                    $tracks = mysqli_query($sql, "SELECT * FROM Tracks");
                    while ($track = mysqli_fetch_assoc($tracks)) {
                        echo "<option value='$track[id]'>$track[track]</option>";
                    }
                }
            ?>
        </select>
        <select name="class">
            <?php
            if (isset($sql)) {
                $classes = mysqli_query($sql, "SELECT * FROM Classes");
                while ($class = mysqli_fetch_assoc($classes)) {
                    echo "<option value='$class[id]'>$class[class]</option>";
                }
            }
            ?>
        </select>
        <input type="number" name="slots" placeholder="Slots amount" required>
        <input type="number" name="duration" placeholder="Duration (min)" required>
        <input type="datetime-local" name="start" required>
        <input type="submit" value="Add">
    </form>

    <?php
        if (isset($request)) {
            if ($request) {
                echo "<span>Event created</span>";
            } else {
                echo "<span>Error</span>";
            }
        } else if ($title != null) {
            echo "<span>Incorrect data</span>";
        }
    ?>

</div>

</body>
</html>