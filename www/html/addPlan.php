<?php require __DIR__ . '/../inc/header.php';
require "$INC/tools.php";
require "$INC/nav.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $xml = new SimpleXMLElement('<plan></plan>');
    $nazev = $_POST['nazev'];
    $xml->addChild('nazev', $nazev);
    $xml->addChild('popis', $_POST['popis']);
    $xml->addChild('cil', $_POST['cil']);

    foreach ($_POST['workouts'] as $workoutData) {
        $workout = $xml->addChild('workout');
        $workout->addChild('nazev', $workoutData['nazev']);
        $workout->addChild('popis', $workoutData['popis']);
        $workout->addChild('trvani', $workoutData['trvani']);
        $cviky = $workout->addChild('cviky');
        
        foreach ($workoutData['cviky'] as $cvikData) {
            $cvik = $cviky->addChild('cvik');
            $cvik->addChild('nazev', $cvikData['nazev']);
            $cvik->addChild('sety', $cvikData['sety']);
            $cvik->addChild('repy', $cvikData['repy']);
            $cvik->addChild('odpocinek', $cvikData['odpocinek']);
        }
    }

    $xmlPath = "$WORKOUT/$nazev.xml";
    $xml->asXML($xmlPath);
    if (xmlValidateXSD($xmlPath, "$XML/plan.xsd")) {
        addMessage("Plán byl úspěšně přidán a validován.");
    } else {
        addError("Plán nebyl validní.");
    }
}
?>
<div class="container mx-auto">
    <h2 class="text-2xl font-bold my-4">Přidat nový plán</h2>
    <form method="POST">
        <div class="mb-4">
            <label for="nazev" class="block text-gray-700 text-sm font-bold mb-2">Název plánu:</label>
            <input type="text" id="nazev" name="nazev" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><br>
        </div>
        <div class="mb-4">
            <label for="popis" class="block text-gray-700 text-sm font-bold mb-2">Popis:</label>
            <textarea id="popis" name="popis" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea><br>
        </div>
        <div class="mb-4">
            <label for="cil" class="block text-gray-700 text-sm font-bold mb-2">Cíl:</label>
            <input type="text" id="cil" name="cil" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><br>
        </div>
        <div id="workouts" class="space-y-4">
            <!-- Workouts will be dynamically added here -->
        </div>
        <button type="button" id="add-workout" onclick="addWorkout()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Přidat další workout</button><br><br>
        <input type="submit" value="Odeslat plán" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
    </form>
</div>
<script>
    let workoutCount = 0;

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
        <label class="block text-sm font-medium text-gray-700">Odpočinek (min):</label>
        <input step="0.01" type="number" name="workouts[${workoutCount}][cviky][${exerciseCount}][odpocinek]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    `;
    workoutDiv.appendChild(exerciseDiv);
}

    function addWorkout() {
        const container = document.getElementById('workouts');
        const workoutDiv = document.createElement('div');
        workoutDiv.className = 'workout bg-gray-100 p-4 rounded-lg shadow';
        workoutDiv.innerHTML = `
        <label class="block text-sm font-medium text-gray-700">Název workoutu:</label>
        <input type="text" name="workouts[${workoutCount}][nazev]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <label class="block text-sm font-medium text-gray-700">Popis workoutu:</label>
        <input type="text" name="workouts[${workoutCount}][popis]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <label class="block text-sm font-medium text-gray-700">Trvání (min):</label>
        <input step="0.01" type="number" name="workouts[${workoutCount}][trvani]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <button type="button" onclick="addExercise(this.parentNode, ${workoutCount})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3">Přidat cvik</button>
        `;
        container.appendChild(workoutDiv);
        workoutCount++;
    }
</script>
<?php
require "$INC/footer.php";
?>