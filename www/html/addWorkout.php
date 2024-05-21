<?php require __DIR__ . '/../inc/header.php';
include "$INC/nav.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workoutName = $_POST['workout'];
    $xml = simplexml_load_file('workout/$workoutName.xml');
    $workouts = $xml->addChild('workouts');
    $workout = $workouts->addChild('workout');
    $workout->addChild('name', $_POST['name']);
    $workout->addChild('description', $_POST['description']);
    $exercises = $workout->addChild('exercises');
    
    foreach ($_POST['exercises'] as $exercise) {
        $ex = $exercises->addChild('exercise');
        $ex->addChild('name', $exercise['name']);
        $ex->addChild('reps', $exercise['reps']);
        $ex->addChild('sets', $exercise['sets']);
        $ex->addChild('duration', $exercise['duration']);
    }

    $xml->asXML('workout/workouts.xml');
    echo "<p class='text-green-500'>Cvičební program byl úspěšně přidán!</p>";
}
?>
<div class="container mx-auto">
<h2 class="text-2xl font-bold my-4">Přidat nový cvičební program</h2>
<form method="POST">
    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Název programu:</label>
        <input type="text" id="name" name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><br>
    </div>
    <div class="mb-4">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Popis:</label>
        <textarea id="description" name="description" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea><br>
    </div>

    <h3 class="text-xl font-bold my-3">Cviky:</h3>
    <div id="exercises" class="space-y-4">
        <div class="exercise bg-gray-100 p-4 rounded-lg shadow">
            <label for="exercise_name" class="block text-sm font-medium text-gray-700">Název cviku:</label>
            <input type="text" name="exercises[0][name]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

            <label for="reps" class="block text-sm font-medium text-gray-700">Opakování:</label>
            <input type="number" name="exercises[0][reps]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

            <label for="sets" class="block text-sm font-medium text-gray-700">Série:</label>
            <input type="number" name="exercises[0][sets]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

            <label for="duration" class="block text-sm font-medium text-gray-700">Trvání (min):</label>
            <input type="number" name="exercises[0][duration]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
    </div>
    <button type="button" id="add-exercise" onclick="addExercise()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Přidat další cvik</button><br><br>
    <input type="submit" value="Přidat program" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
</form>

<script>
    function addExercise(){
            const exercisesDiv = document.getElementById('exercises');
            const exerciseCount = exercisesDiv.getElementsByClassName('exercise').length;
            const newExercise = document.createElement('div');
            newExercise.className = 'exercise bg-gray-100 p-4 rounded-lg shadow';
            newExercise.innerHTML = `
                <label for="exercise_name" class="block text-sm font-medium text-gray-700">Název cviku:</label>
                <input type="text" name="exercises[${exerciseCount}][name]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                <label for="reps" class="block text-sm font-medium text-gray-700">Opakování:</label>
                <input type="number" name="exercises[${exerciseCount}][reps]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                <label for="sets" class="block text-sm font-medium text-gray-700">Série:</label>
                <input type="number" name="exercises[${exerciseCount}][sets]" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
                <label for="duration" class="block text-sm font-medium text-gray-700">Trvání (min):</label>
                <input type="number" name="exercises[${exerciseCount}][duration]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><br>
            `;
            exercisesDiv.appendChild(newExercise);
    }
</script>
</div>
<?php
include "$INC/footer.php";
?>
