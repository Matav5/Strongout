<?php
require __DIR__ . '/../inc/header.php';
require "$INC/tools.php";
require "$INC/nav.php";
$workout = @$_GET['workout'];
$xmlPath = "$WORKOUT/$workout.xml";
echo $xmlPath;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //print_r($_POST["workouts"]);

    $plan = simplexml_load_file($xmlPath);
    if ($plan) {
        $plan->nazev = $_POST['nazev'];
        $plan->popis = $_POST['popis'];
        $plan->cil = $_POST['cil'];

        // Instead of unsetting all workouts, we will update or add new ones
        $existingWorkouts = [];
        foreach ($plan->workout as $existingWorkout) {
            $existingWorkouts[] = $existingWorkout;
        }

        // Clear existing workouts
        unset($plan->workout);

        foreach ($_POST['workouts'] as $workoutData) {
            $workout = $plan->addChild('workout');
            $workout->addChild('nazev', $workoutData['nazev']);
            $workout->addChild('popis', $workoutData['popis']);
            $workout->addChild('trvani', $workoutData['trvani']);
            $cviky = $workout->addChild('cviky');
            print_r($workoutData);
            foreach ($workoutData['cviky'] as $cvikData) {
                $cvik = $cviky->addChild('cvik');
                $cvik->addChild('nazev', $cvikData['nazev']);
                $cvik->addChild('sety', $cvikData['sety']);
                $cvik->addChild('repy', $cvikData['repy']);
                $cvik->addChild('odpocinek', $cvikData['odpocinek']);
            }
        }

        $plan->asXML($xmlPath);
        if (xmlValidateXSD($xmlPath, "$XML/workout.xsd")) {
            echo greenBox("Plán byl úspěšně upraven a validován.");
        } else {
            echo errorBox("Plán nebyl validní.");
        }
    } else {
        echo errorBox("Plán nebyl nalezen.");
    }
} 

if ($workout) {
    $xml = simplexml_load_file($xmlPath);
    var_dump($xml);
    $plan = $xml;
    if ($plan) {
        // Plan was found, proceed with the rest of the code
    } else {
        echo errorBox("Plán nebyl nalezen.");
    }
}
?>
<div class="container mx-auto">
    <h2 class="text-2xl font-bold my-4">Upravit plán</h2>
    <form method="POST">
        <div class="mb-4">
            <label for="nazev" class="block text-gray-700 text-sm font-bold mb-2">Název plánu:</label>
            <input type="text" id="nazev" name="nazev" value="<?php echo htmlspecialchars($plan->nazev); ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><br>
        </div>
        <div class="mb-4">
            <label for="popis" class="block text-gray-700 text-sm font-bold mb-2">Popis:</label>
            <textarea id="popis" name="popis" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($plan->popis); ?></textarea><br>
        </div>
        <div class="mb-4">
            <label for="cil" class="block text-gray-700 text-sm font-bold mb-2">Cíl:</label>
            <input type="text" id="cil" name="cil" value="<?php echo htmlspecialchars($plan->cil); ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><br>
        </div>
        <div id="workouts" class="space-y-4">
            <?php $index = 0; 
            foreach ($plan->workout as $workout) { 
                ?>
                <div class="workout bg-gray-100 p-4 rounded-lg shadow">
                    <label class="block text-sm font-medium text-gray-700">Název workoutu:</label>
                    <input type="text" name="workouts[<?php echo $index; ?>][nazev]" value="<?php echo htmlspecialchars($workout->nazev); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <label class="block text-sm font-medium text-gray-700">Popis:</label>
                    <textarea name="workouts[<?php echo $index; ?>][popis]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?php echo htmlspecialchars($workout->popis); ?></textarea>
                    <label class="block text-sm font-medium text-gray-700">Trvání:</label>
                    <input type="text" name="workouts[<?php echo $index; ?>][trvani]" value="<?php echo htmlspecialchars($workout->trvani); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div class="cviky space-y-2">
                        <?php foreach ($workout->cviky->cvik as $cvikIndex => $cvik) { ?>
                            <div class="cvik bg-white p-2 rounded-lg shadow mt-2">
                                <label class="block text-sm font-medium text-gray-700">Název cviku:</label>
                                <input type="text" name="workouts[<?php echo $index; ?>][cviky][<?php echo $cvikIndex; ?>][nazev]" value="<?php echo htmlspecialchars($cvik->nazev); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <label class="block text-sm font-medium text-gray-700">Série:</label>
                                <input type="number" name="workouts[<?php echo $index; ?>][cviky][<?php echo $cvikIndex; ?>][sety]" value="<?php echo htmlspecialchars($cvik->sety); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <label class="block text-sm font-medium text-gray-700">Opakování:</label>
                                <input type="number" name="workouts[<?php echo $index; ?>][cviky][<?php echo $cvikIndex; ?>][repy]" value="<?php echo htmlspecialchars($cvik->repy); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <label class="block text-sm font-medium text-gray-700">Odpočinek:</label>
                                <input type="text" name="workouts[<?php echo $index; ?>][cviky][<?php echo $cvikIndex; ?>][odpocinek]" value="<?php echo htmlspecialchars($cvik->odpocinek); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        <?php $index++;} ?>
                    </div>
                    <button type="button" onclick="addExercise(this.parentElement, '<?php echo $index; ?>')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2">Přidat cvik</button>
                </div>
            <?php } ?>
        </div>
        <button type="button" id="add-workout" onclick="addWorkout()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Přidat další workout</button><br><br>
        <input type="submit" value="Upravit plán" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
    </form>
</div>
<script>
    let workoutCount = <?php echo count($plan->workout); ?>;

    function addExercise(workoutDiv, workoutCount) {
        let exerciseCount = workoutDiv.querySelectorAll('.exercise').length;
        const exerciseDiv = document.createElement('div');
        exerciseDiv.className = 'exercise bg-white p-2 rounded-lg shadow mt-2';
        exerciseDiv.innerHTML = `
            <label class="block text-sm font-medium text-gray-700">Název cviku:</label>
            <input type="text" name="workouts[${workoutCount}][cviky][${exerciseCount}][nazev]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <label class="block text-sm font-medium text-gray-700">Série:</label>
            <input type="number" name="workouts[${workoutCount}][cviky][${exerciseCount}][sety]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <label class="block text-sm font-medium text-gray-700">Opakování:</label>
            <input type="number" name="workouts[${workoutCount}][cviky][${exerciseCount}][repy]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <label class="block text-sm font-medium text-gray-700">Odpočinek:</label>
            <input type="text" name="workouts[${workoutCount}][cviky][${exerciseCount}][odpocinek]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        `;
        workoutDiv.querySelector('.cviky').appendChild(exerciseDiv);
    }

    function addWorkout() {
        const workoutsDiv = document.getElementById('workouts');
        const workoutDiv = document.createElement('div');
        workoutDiv.className = 'workout bg-gray-100 p-4 rounded-lg shadow';
        workoutDiv.innerHTML = `
            <label class="block text-sm font-medium text-gray-700">Název workoutu:</label>
            <input type="text" name="workouts[${workoutCount}][nazev]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <label class="block text-sm font-medium text-gray-700">Popis:</label>
            <textarea name="workouts[${workoutCount}][popis]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            <label class="block text-sm font-medium text-gray-700">Trvání:</label>
            <input type="text" name="workouts[${workoutCount}][trvani]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <div class="cviky space-y-2"></div>
            <button type="button" onclick="addExercise(this.parentElement, ${workoutCount})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2">Přidat cvik</button>
        `;
        workoutsDiv.appendChild(workoutDiv);
        workoutCount++;
    }
</script>
<?php
require "$INC/footer.php";
?>