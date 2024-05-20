<?php require __DIR__ . '/../inc/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $xml = simplexml_load_file('data/workouts.xml');
    $workout = $xml->addChild('workout');
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

    $xml->asXML('data/workouts.xml');
    echo "<p>Cvičební program byl úspěšně přidán!</p>";
}
?>

<h2>Přidat nový cvičební program</h2>
<form method="POST">
    <label for="name">Název programu:</label>
    <input type="text" id="name" name="name" required><br>
    <label for="description">Popis:</label>
    <textarea id="description" name="description" required></textarea><br>

    <h3>Cviky:</h3>
    <div id="exercises">
        <div class="exercise">
            <label for="exercise_name">Název cviku:</label>
            <input type="text" name="exercises[0][name]" required><br>
            <label for="reps">Opakování:</label>
            <input type="number" name="exercises[0][reps]" required><br>
            <label for="sets">Série:</label>
            <input type="number" name="exercises[0][sets]" required><br>
            <label for="duration">Trvání (min):</label>
            <input type="number" name="exercises[0][duration]"><br>
        </div>
    </div>
    <button type="button" id="add-exercise" onclick="">Přidat další cvik</button><br><br>
    <input type="submit" value="Přidat program">
</form>

<script>
    function addExercise(){
            const exercisesDiv = document.getElementById('exercises');
            const exerciseCount = exercisesDiv.getElementsByClassName('exercise').length;
            const newExercise = document.createElement('div');
            newExercise.className = 'exercise';
            newExercise.innerHTML = `
                <label for="exercise_name">Název cviku:</label>
                <input type="text" name="exercises[${exerciseCount}][name]" required><br>
                <label for="reps">Opakování:</label>
                <input type="number" name="exercises[${exerciseCount}][reps]" required><br>
                <label for="sets">Série:</label>
                <input type="number" name="exercises[${exerciseCount}][sets]" required><br>
                <label for="duration">Trvání (min):</label>
                <input type="number" name="exercises[${exerciseCount}][duration]"><br>
            `;
            exercisesDiv.appendChild(newExercise);
    }
</script>

<?php
include('templates/footer.php');
?>