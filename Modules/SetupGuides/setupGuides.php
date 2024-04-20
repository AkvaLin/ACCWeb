<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Setup Guides</title>
    <link rel="stylesheet" href="../../main.css">
    <link rel="stylesheet" href="setupGuides.css">
</head>
<body>

<div>
    <?php
        $warning = "<span>Set the tire pressure so that after warming up it fits into the range of optimal values.</span>
                    <br>
                    <span class='bold'>Make no more than one change at a time.</span>
                    <br>
                    <span>Settings in order of decreasing influence on the behavior of the machine:</span>";

        include '../NavBar/navbar.php';
    ?>
    <div class='background glass'>
        <h1>CAR SETUP GUIDE IN ASSETTO CORSA COMPETIZIONE</h1>
        <h2>How to use it</h2>
        <div class='text'>
            <span>
                Determine which problem is plaguing your car, and in which mode it manifests itself.
            </span>
            <br>
            <span>
                Determine how much you need to change the behavior of the machine in a particular mode.
            </span>
            <br>
            <span>
                If strongly, start at the beginning of the list of instructions for the appropriate mode.
            </span>
            <ul>
                <li>
                    Start with the first point. Make the appropriate change to the car settings and drive 3 laps.
                </li>
                <li>
                    If the problem is not completely resolved, think again about whether you need to change the behavior
                    of the machine much. If strongly, repeat the current point. If not, then go to the next item in the
                    list. If you need a very small change, go to the end of the list.
                </li>
            </ul>
            <span>
                If a small change in the behavior of the machine is required, then start at the end of the list.
            </span>
            <ul>
                <li>
                    Start with the last point. Make the appropriate change to the car settings and drive 3 laps.
                </li>
                <li>
                    If the problem is not completely resolved, repeat the step or go to the penultimate one.
                    Keep in mind that the higher up the list you go,
                    the more the changes will affect the behavior of the machine.
                </li>
            </ul>
        </div>
        <h2>Important points</h2>
        <div class='text'>
            <ul>
                <li>
                    Tire pressure is the most important setting. First check the pressure,
                    then proceed to change the other settings of the car. As you change other settings,
                    do not forget to check the pressure, because other settings may indirectly affect it.
                </li>
                <li>
                    Before you start setting up the car in depth, make sure that you can drive 10 laps at a steady pace.
                    If initially you cannot maintain a stable pace, but have already started tuning,
                    subsequent stability improvements and lap time improvements may be due to “rolling in” rather
                    than successful tuning of the car; erroneous conclusions regarding the latest settings
                    (which allegedly improved the overall picture) will complicate further work.
                </li>
                <li>
                    Having achieved the optimal behavior of the car in a particular turn,
                    you can worsen its behavior on other sections of the route. The setup is a compromise.
                </li>
            </ul>
        </div>
        <h2>Tire pressure</h2>
        <div class='text'>
            <span>
                Tire pressure is a variable value depending on the tire temperature.
                In turn, the temperature of the tire depends on:
            </span>
            <ul>
                <li>air temperature;</li>
                <li>roadway temperatures;</li>
                <li>
                    the volume of air supplied to the blowing of the brake discs
                    (i.e. from the settings of the brake blowing ducts);
                </li>
                <li>the aggressiveness of driving.</li>
            </ul>
            <br><br>
            <span>
                The tire pressure set in the “Tires” settings section is the pressure in the unheated tires,
                which will change during the race in accordance with the above factors. In hot weather,
                the initial pressure should be reduced, and in cold weather, it should be increased.
            </span>
            <br><br>
            <span>
                You can determine the correct pressure in each of the four tires using the tire and
                brake widget of the user interface, where each tire is symbolized by three columns:
            </span>
            <ul>
                <li>
                    if all three columns are of the same height,
                    the pressure in the corresponding tire is in the range of optimal values;
                </li>
                <li>
                    if the central column is higher than two adjacent columns, the pressure is excessive;
                </li>
                <li>
                    if the central column is lower than two adjacent columns, the pressure is insufficient.
                </li>
            </ul>
            <br><br>
            <span>At the time of the game version 1.9.2, the limits of the optimal pressure range are as follows:</span>
            <div class='tableContainer'>
                <table>
                    <tbody>
                    <tr>
                        <td rowspan='2'>Tires</td>
                        <td colspan='2'>Front</td>
                        <td colspan='2'>Rear</td>
                    </tr>
                    <tr>
                        <td class='min'>Min psi</td>
                        <td class='max'>Max psi</td>
                        <td class='min'>Min psi</td>
                        <td class='max'>Max psi</td>
                    </tr>
                    <?php
                    $sql = mysqli_connect('127.0.0.1', 'dbeaver', 'dbeaver', 'ACCCompanion', '3306');
                    $tires = mysqli_query($sql, 'select * from TirePressure');
                    while ($pressure = mysqli_fetch_assoc($tires)) {
                        echo "
                    <tr>
                        <td>$pressure[class]</td>
                        <td class='min'>$pressure[frontMin]</td>
                        <td class='max'>$pressure[frontMax]</td>
                        <td class='min'>$pressure[rearMin]</td>
                        <td class='max'>$pressure[rearMax]</td>
                    </tr>
                ";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <h2>Brakes</h2>
        <div class='text'>
            <span>
                The wear of the pads and brake discs depends on the selected pads, temperature, aerobatics,
                brake force balance and the degree of ABS engagement.
                The wear of the pads and brake discs following the results of the racing session
                can be viewed in the “Tires” settings section in the “Recent readings” columns or
                in the “Fuel and Strategy” section.
            </span>
            <br><br><br>
            <span>
                The critical wear of the brake pads (when less than 10 mm of their thickness remains)
                is shown in the tire and brake widget of the user interface and is symbolized by a red dot
                in the center of the brake disc temperature indicator.
            </span>
            <br><br><br>
            <span class="bold">Available brake kits:</span>
            <ol>
                <li>
                    The highest coefficient of friction, the fastest wear of brake discs and pads.
                    When working outside the optimal temperature range and as they wear out,
                    they lose more linearity and predictability than other kits, they are relatively difficult to dose.
                    They are recommended for qualifying races and races lasting no more than 3 hours.
                </li>
                <li>
                    The average coefficient of friction and wear.
                    When working outside the optimal temperature range and as they wear out,
                    they lose significantly less linearity and predictability than the 1st set,
                    they are quite easily dosed. They are recommended for races lasting up to 12 hours,
                    with proper skills they can last 24 hours. They can also be used in qualifying races,
                    compensating for slightly lower braking efficiency with linearity and predictability.
                </li>
                <li>
                    The lowest coefficient of friction and wear.
                    They are linear and predictable, perfectly dosed. Unlike other kits,
                    they retain linearity and predictability at temperatures below optimal,
                    which makes them an excellent choice for rain races or just very long races.
                    Due to the lower coefficient of friction, it will make sense to cover the brake air ducts.
                </li>
                <li>
                    Identical to the 1st set, but have accelerated wear:
                    introduced into the game to demonstrate brake wear. It is not advisable to use it in racing.
                </li>
            </ol>
        </div>
        <h2>Understeer</h2>
        <h3>At the entrance to the high-speed turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Reduce the ground clearance at the front by 1 mm.</li>
                <li>Reduce the rear wing by 1 point.</li>
                <li>Increase the rear ground clearance by 2 mm.</li>
                <li>Increase the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Reduce the stiffness of the front suspension travel limiters by 1 point.</li>
                <li>Reduce the brake balance (shift towards the rear axle).</li>
                <li>Reduce the preload of the differential.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Increase the negative camber in front.</li>
                <li>Reduce the negative camber at the rear.</li>
                <li>Reduce the positive convergence from behind.</li>
            </ul>
        </div>
        <h3>At the apex of a high-speed turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Reduce the ground clearance at the front by 1 mm.</li>
                <li>Reduce the rear wing by 1 point.</li>
                <li>Increase the rear ground clearance by 2 mm.</li>
                <li>Increase the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Reduce the stiffness of the front suspension travel limiters by 1 point.</li>
                <li>Reduce the preload of the differential.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Increase the negative camber in front.</li>
                <li>Reduce the negative camber at the rear.</li>
                <li>Reduce the positive convergence from behind.</li>
            </ul>
        </div>
        <h3>At the exit of a high-speed turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Reduce the ground clearance at the front by 1 mm.</li>
                <li>Reduce the rear wing by 1 point.</li>
                <li>Increase the rear ground clearance by 2 mm.</li>
                <li>Reduce the free travel of the rear suspension all the way to the limiters to 15 and reduce by 1 point until the desired result is achieved (try to keep the stiffness of the rear suspension travel limiters as low as possible).</li>
                <li>Increase the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Reduce the stiffness of the front suspension travel limiters by 1 point.</li>
                <li>Reduce the TC.</li>
                <li>Reduce the preload of the differential.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Increase the negative camber in front.</li>
                <li>Reduce the negative camber at the rear.</li>
                <li>Reduce the positive convergence from behind.</li>
            </ul>
        </div>
        <h3>At the entrance to a slow turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Reduce the brake balance (shift towards the rear axle).</li>
                <li>Increase the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Reduce the stiffness of the front suspension travel limiters by 1 point.</li>
                <li>Reduce the stiffness of the front springs by 1 point.</li>
                <li>Reduce the stiffness of the front stabilizer by 1 point.</li>
                <li>Reduce the ground clearance at the front by 1 mm.</li>
                <li>Increase the rear ground clearance by 2 mm.</li>
                <li>Reduce the preload of the differential.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Increase the negative camber in front.</li>
                <li>Reduce the negative camber at the rear.</li>
                <li>Reduce the positive convergence from behind.</li>
            </ul>
        </div>
        <h3>At the apex of a slow turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Increase the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Reduce the stiffness of the front suspension travel limiters by 1 point.</li>
                <li>Reduce the stiffness of the front springs by 1 point.</li>
                <li>Reduce the stiffness of the front stabilizer by 1 point.</li>
                <li>Reduce the ground clearance at the front by 1 mm.</li>
                <li>Increase the rear ground clearance by 2 mm.</li>
                <li>Reduce the preload of the differential.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Increase the negative camber in front.</li>
                <li>Reduce the negative camber at the rear.</li>
                <li>Reduce the positive convergence from behind.</li>
            </ul>
        </div>
        <h3>At the exit of a slow turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Increase the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Reduce the stiffness of the front suspension travel limiters by 1 point.</li>
                <li>Reduce the TC.</li>
                <li>Reduce the stiffness of the front springs by 1 point.</li>
                <li>Reduce the stiffness of the front stabilizer by 1 point.</li>
                <li>Increase the stiffness of the rear stabilizer by 1 point.</li>
                <li>Reduce the ground clearance at the front by 1 mm.</li>
                <li>Increase the rear ground clearance by 2 mm.</li>
                <li>Increase the preload of the differential.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Increase the negative camber in front.</li>
                <li>Reduce the negative camber at the rear.</li>
                <li>Reduce the positive convergence from behind.</li>
            </ul>
        </div>
        <h2>Oversteer</h2>
        <h3>At the entrance to the high-speed turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Increase the rear wing by 1 point.</li>
                <li>Increase the ground clearance at the front by 1 mm.</li>
                <li>Reduce the rear ground clearance by 2 mm.</li>
                <li>Reduce the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Increase the stiffness of the front suspension travel limiters by 1 point.</li>
                <li>Increase the brake balance (shift towards the front axle).</li>
                <li>Increase the preload of the differential.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Reduce the negative camber in the front.</li>
                <li>Increase the negative camber at the rear.</li>
                <li>Increase the positive convergence from behind.</li>
            </ul>
        </div>
        <h3>At the apex of a high-speed turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Increase the rear wing by 1 point.</li>
                <li>Increase the ground clearance at the front by 1 mm.</li>
                <li>Reduce the rear ground clearance by 2 mm.</li>
                <li>Reduce the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Increase the stiffness of the front suspension travel limiters by 1 point.</li>
                <li>Increase the preload of the differential.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Reduce the negative camber in the front.</li>
                <li>Increase the negative camber at the rear.</li>
                <li>Increase the positive convergence from behind.</li>
            </ul>
        </div>
        <h3>At the exit of a high-speed turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Increase the rear wing by 1 point.</li>
                <li>Reduce the rear ground clearance by 2 mm.</li>
                <li>Increase the ground clearance at the front by 1 mm.</li>
                <li>Reduce the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Increase the stiffness of the front suspension travel limiters by 1 point.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Reduce the negative camber in the front.</li>
                <li>Increase the positive convergence from behind.</li>
            </ul>
        </div>
        <h3>At the entrance to a slow turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Increase the brake balance (shift towards the front axle).</li>
                <li>Reduce the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Increase the stiffness of the front suspension travel limiters by 1 point.</li>
                <li>Increase the stiffness of the front springs by 1 point.</li>
                <li>Reduce the rear ground clearance by 2 mm.</li>
                <li>Increase the stiffness of the front stabilizer by 1 point.</li>
                <li>Increase the ground clearance at the front by 1 mm.</li>
                <li>Increase the preload of the differential.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Reduce the negative camber in the front.</li>
                <li>Increase the negative camber at the rear.</li>
                <li>Increase the positive convergence from behind.</li>
            </ul>
        </div>
        <h3>At the apex of a slow turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Increase the stiffness of the front springs by 1 point.</li>
                <li>Reduce the rear ground clearance by 2 mm.</li>
                <li>Increase the stiffness of the front stabilizer by 1 point.</li>
                <li>Increase the ground clearance at the front by 1 mm.</li>
                <li>Reduce the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Increase the stiffness of the front suspension travel limiters by 1 point.</li>
                <li>Increase the preload of the differential.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Reduce the negative camber in the front.</li>
                <li>Increase the negative camber at the rear.</li>
                <li>Increase the positive convergence from behind.</li>
            </ul>
        </div>
        <h3>At the exit of a slow turn</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Increase the TC.</li>
                <li>
                    Maximize the free travel of the rear suspension all the way to the limiters
                    (to ensure that you do not sit on them during acceleration).
                </li>
                <li>Reduce the rear ground clearance by 2 mm.</li>
                <li>Increase the stiffness of the front springs by 1 point.</li>
                <li>Increase the stiffness of the front stabilizer by 1 point.</li>
                <li>Increase the ground clearance at the front by 1 mm.</li>
                <li>Reduce the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Increase the stiffness of the front suspension travel limiters by 1 point.</li>
                <li>Increase the preload of the differential.</li>
                </ul><span class='bold'>General:</span><ul>
                <li>Reduce the negative camber in the front.</li>
                <li>Increase the positive convergence from behind.</li>
            </ul>
        </div>
        <h2>Instability</h2>
        <div class='text'>
            <h4>The behavior of the machine varies greatly from understeer to
                oversteer (and vice versa) as the gas is released (added).</h4>
        </div>
        <h3>At high speed</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Increase the stiffness of the front and rear springs by 1 point.</li>
                <li>Reduce the free travel of the front suspension all the way to the limiters by 1 point.</li>
                <li>Increase the stiffness of the front and rear shock absorbers for slow compression and slow rebound by 2 points.</li>
                <li>Increase the rear wing by 1 point.</li>
            </ul>
        </div>
        <h3>At low speed</h3>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Increase the stiffness of the front and rear springs by 1 point.</li>
                <li>Reduce the stiffness of the front and rear shock absorbers by slow compression and slow release by 1 point.</li>
                <li>Reduce the rear ground clearance by 2 mm.</li>
            </ul>
        </div>
        <h2>Jumping on curbs/bumps</h2>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Increase the free travel of the front suspension all the way to the limiters by 2 points.</li>
                <li>Reduce the stiffness of the front suspension travel limiters by 2 points.</li>
                <li>Reduce the stiffness of the front stabilizer by 1 point.</li>
                <li>Reduce the stiffness of the rear stabilizer by 1 point.</li>
                <li>Change the stiffness of the shock absorbers to fast compression and fast release.
                    In general, a quick release should be tougher than a quick compression.
                    The softer the suspension springs,
                    the stiffer the rapid compression may be required and the softer the rapid release.
                    Too hard rapid compression will prevent the spring from partially contracting and
                    working out the curb / bump, too soft - will allow the spring to contract completely;
                    in both cases, the energy of the push not absorbed by the spring will be transferred to the car body,
                    hence the jump. Too hard a quick release will not allow the spring to straighten out quickly enough,
                    which is why the spring may shrink to the end on a series of bumps. Too soft, fast rebound,
                    without extinguishing the energy stored in the compressed spring, will allow it to straighten out
                    too quickly, which is why after overcoming the bump / curb, the car will swing up and down for
                    some time until the spring vibrations are stopped by the shock absorber on the next c
                    ompression-decompression cycle.
                </li>
            </ul>
        </div>
        <h2>Tire overheating</h2>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Maybe you're driving too aggressively;</li>
                <li>Open the brake air ducts (heat from the brake discs is transmitted to the tires);</li>
                <li>Reduce negative camber;</li>
                <li>Reduce the convergence modulo;</li>
                <li>Reduce the rigidity of the “fast” characteristics of shock absorbers by 2 points;</li>
                <li>Reduce the stiffness of the “slow” characteristics of shock absorbers by 2 points;</li>
                <li>Increase ABS and TC.</li>
            </ul>
        </div>
        <h2>Tire underheating</h2>
        <div class='text'>
            <?php echo "$warning" ?>
            <ul>
                <li>Perhaps you are driving too slowly;</li>
                <li>Cover the brake air ducts (heat from the brake discs is transmitted to the tires);</li>
                <li>Increase negative camber;</li>
                <li>Increase the convergence modulo;</li>
                <li>Increase the rigidity of the “fast” characteristics of shock absorbers by 2 points;</li>
                <li>Increase the stiffness of the “slow” characteristics of shock absorbers by 2 points;</li>
                <li>Reduce ABS and TC.</li>
            </ul>
        </div>
        <br><br>
    </div>
</div>

</body>
</html>