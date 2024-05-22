<?php require __DIR__ . '/../inc/header.php';

require "$INC/nav.php";
require "$INC/tools.php";

/*if (!isset($_SESSION["prezdivka"]))
    die; */?>

<div class="flex justify-center m-12">
    <form class="bg-zinc-50 rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data" method="POST">
        <div class="mb-4">
            Nahrajte workout:
        </div>
        <div class="mb-4" id="drop-div">
            <input title="tt" id="fileInput" name="xml" type="file" accept="text/xml" data-max-file-size="2M">
        </div>
        <input class="bg-blue-500 text-white font-bold rounded py-2 px-4" type="submit" value="Odeslat" />
    </form>
</div>

<?php

if (($xmlFile = @$_FILES['xml']) && ($tmpName = @$xmlFile['tmp_name'])) {
    // $isValid = xmlValidateDTD($xmlFile, "$XML/recept.dtd");
    $isValid = xmlValidateXSD($tmpName, "$XML/plan.xsd");
    if (!$isValid)
        addError('XML soubor není validní.');
    else {
        $name = $xmlFile['name'];
        $target = "$WORKOUT/$name";
        if (file_exists($target))
            addError('Recept už máme.');
        elseif (rename($tmpName, $target))
            addMessage("OK - $name nahráno");

    }
}

require "$INC/footer.php";
