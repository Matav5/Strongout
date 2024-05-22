<?php require __DIR__ . '/../inc/header.php';

require "$INC/nav.php";
require "$INC/tools.php";
require "$INC/db.php";

xmlFileList($WORKOUT);
function jeFavorit($basename) {
    global $db;
    $id = @$_SESSION['id']; 
    if($id == null){
        return false;
    }
    $stmt = $db->prepare("SELECT * FROM favorites WHERE fk_uzivatel = ? AND soubor = ?");
    $stmt->bind_param("is", $id, $basename);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows > 0;
}

?>

<h1 class="py-6 text-center text-5xl">Workouty</h1>

<div class="bg-zinc-50 flex justify-center">
    <ol class="fa-ul">
        <?php foreach (xmlFileList($WORKOUT) as $basename) { ?>
            <?php $jeFavorit = jeFavorit($basename) ?>
            <li>
                <i class="fa fa-li <?=  $jeFavorit ? "fa-heart": "fa-heart-o"?> <?= $jePrihlaseny ? "text-red-500" : "" ?> " onclick="toggleFavorite(this,'<?= $basename ?>')"></i>
                <a class="hover:underline" href="?workout=<?= $basename ?>">
                    <?= $basename ?>
                </a>
            </li>
        <?php } ?>
    </ol>
</div>

<?php if ($workout = @$_GET['workout']) { ?>
    <hr>
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold my-4">Detaily plánu: <?= htmlspecialchars($workout) ?>
           <a href="editPlan.php?workout=<?= $workout ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit</a>
           <a href="deletePlan.php?workout=<?= $workout ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</a>
        </h2>
        <div class="border border-gray-300 p-4 rounded-lg">
            <div class="text-gray-700">
            <?= xmlTransform("$WORKOUT/$workout.xml", "$XML/plan.xsl") ?>
            </div>
        </div>
    </div>
   
<?php } ?>
<script>
    let beziRequest = false;
    function toggleFavorite(prvek,basename) {
        let action = prvek.classList.contains("fa-heart-o") ? 'add' : 'remove';
        const userId = <?= isset($_SESSION['id']) ? $_SESSION['id']: "null" ?>;
        if(userId == null){
            return;
        }
        beziRequest = true;
        fetch('favorite.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `akce=${action}&id=${userId}&nazevSouboru=${basename}`
        })
        .then(response => response.text())
        .then((data)=>{
            console.log(data);
            if(data == "200"){
                    if(action == "add"){
                        prvek.classList.add("fa-heart");
                        prvek.classList.remove("fa-heart-o");
                    }else{
                        prvek.classList.add("fa-heart-o");
                        prvek.classList.remove("fa-heart");
                    
                    
                    }
                }
                beziRequest = false;
            }
            )
        .catch((error) => {
            console.error('Error:', error);
            beziRequest = false;
        });
    }
</script>

<?php require "$INC/footer.php";
