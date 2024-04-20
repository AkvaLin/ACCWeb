<?php
session_start();
$sql = mysqli_connect('127.0.0.1', 'dbeaver', 'dbeaver', 'ACCCompanion', '3306');

$isLogedIn = ($_SESSION['admin'] ?? null) != null;
$admLgn = $_POST['lgn'] ?? null;
$admPswd = $_POST['pswd'] ?? null;

if ($admLgn and $admPswd) {
    $check = mysqli_query($sql, "SELECT * FROM Admins WHERE login='$admLgn' AND password='$admPswd'");
    if (mysqli_fetch_assoc($check)) {
        $isLogedIn = true;
        $_SESSION['admin'] = $admLgn;
    }
}

$exit = $_GET['exit'] ?? null;

if ($exit) {
    session_unset();
    session_destroy();
    $isLogedIn = ($_SESSION['admin'] ?? null) != false;
}

$classesToDelete = $_POST['classesToDelete'] ?? null;
$tracksToDelete = $_POST['tracksToDelete'] ?? null;
$pressureToDelete = $_POST['tireToDelete'] ?? null;
$admin = $_POST['admin'] ?? null;

if ($classesToDelete) {
    foreach ($classesToDelete as $class) {
        mysqli_query($sql, "DELETE FROM Classes WHERE id=$class");
    }
}
if ($tracksToDelete) {
    foreach ($tracksToDelete as $track) {
        mysqli_query($sql, "DELETE FROM Tracks WHERE id=$track");
    }
}
if ($pressureToDelete) {
    foreach ($pressureToDelete as $tire) {
        mysqli_query($sql, "DELETE FROM TirePressure WHERE id=$tire");
    }
}
if ($admin) {
    mysqli_query($sql, "DELETE FROM Admins WHERE id=$admin");
}

$newClass = $_POST['newClass'] ?? null;
$newTrack = $_POST['newTrack'] ?? null;
$classPres = $_POST['class'] ?? null;
$fmi = $_POST['fmi'] ?? null;
$fma = $_POST['fma'] ?? null;
$rmi = $_POST['rmi'] ?? null;
$rma = $_POST['rma'] ?? null;
$login = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;
$pressureToUpdate = $_POST['updateTire'] ?? null;

if ($newClass) {
    mysqli_query($sql, "INSERT INTO Classes VALUES (default, '$newClass')");
}
if ($newTrack) {
    mysqli_query($sql, "INSERT INTO Tracks VALUES (default, '$newTrack')");
}
if ($classPres and $fmi and $fma and $rmi and $rma and $pressureToUpdate==null) {
    mysqli_query($sql, "INSERT INTO TirePressure VALUES (default, '$classPres', '$fmi', '$fma', '$rmi', '$rma')");
}
if ($login and $password) {
    mysqli_query($sql, "INSERT INTO Admins VALUES (default, '$login', '$password')");
}

if ($pressureToUpdate and $classPres and $fmi and $fma and $rmi and $rma) {
    mysqli_query($sql, "UPDATE TirePressure SET class='$classPres', frontMin='$fmi', frontMax='$fma', rearMin='$rmi', rearMax='$rma' WHERE id=$pressureToUpdate");
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Dangerous</title>
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="../Modules/Profile/profile.css">
    <link rel="stylesheet" href="admn.css">
</head>
<body>
<div class="bck">
<?php
if ($isLogedIn) {
    include ".admnbd";
} else {
    echo "
    <form action='admnstrtrpnllnk.php' method='post'>
        <div><input type='text' name='lgn' placeholder='login' required></div>
        <div><input type='password' name='pswd' placeholder='password' required></div>
        <input type='submit'>
    </form>
    ";
}
?>
</div>
</body>
</html>
