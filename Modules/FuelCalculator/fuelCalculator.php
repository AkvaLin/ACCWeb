<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fuel Calculator</title>
    <link rel="stylesheet" href="../../main.css">
    <link rel="stylesheet" href="fuelCalculator.css">
</head>
<body>

    <div>
        <?php
            include '../NavBar/navbar.php'
        ?>
    </div>

    <div class="background glass">
        <div class="container">
            <form>
                <label for="RaceLength">Race length (min)</label>
                <input type="text" name="RaceLength" id="RaceLength" placeholder="60" required>

                <label>Lap Time</label>

                <div>
                    <input type="text" name="Minutes" placeholder="1" class="time" required>
                    <label> : </label>
                    <input type="text" name="Seconds" placeholder="47" class="time" required>
                </div>

                <label for="Consumption">Consumption</label>
                <input type="text" name="Consumption" id="Consumption" placeholder="3.2" required>

                <input type="submit">
            </form>
            <?php

                $length = floatval($_GET['RaceLength'] ?? null ) ?? null;
                $minutes = floatval($_GET['Minutes'] ?? null) ?? null;
                $seconds = floatval($_GET['Seconds'] ?? null) ?? null;
                $consumption = floatval(str_replace(',', '.', $_GET['Consumption'] ?? '')) ?? null;


                if ($length != 0 and $consumption != 0 and ($minutes != 0 or $seconds != 0)) {

                    $totalLaps = intval(ceil($length * 60 / ($minutes * 60 + $seconds)));
                    $minimumFuel = intval(ceil($totalLaps * $consumption));
                    $fuelForWarmup = $consumption * 1.8;
                    $recommendedFuel = intval(ceil(($totalLaps+1) * $consumption));
                    $safe = intval(ceil(($totalLaps+1) * $consumption + $fuelForWarmup));

                    echo "
                        <div class='results'>
                            <label>Total Laps: $totalLaps</label>
                            <label>Minimum Fuel: $minimumFuel</label>
                            <label>Safe (Full formation lap): $safe</label>
                            <label>Recommended Fuel: $recommendedFuel</label>
                        </div>
                    ";
                }
            ?>
        </div>
    </div>
</body>
</html>