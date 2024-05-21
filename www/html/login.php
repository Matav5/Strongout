<?php require __DIR__ . '/../inc/header.php';


require "$INC/db.php";
switch (@$_POST['akce']) {
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    case 'register':
        register();

}
function login(){
    $user = ziskej_uziv(@$_POST['email']);
if($user == null){
    echo "<script>setTimeout(()=>(alert('Uživatel s tímto emailem neexistuje')), 500);</script>";
    return;
}
    $_SESSION['id'] =  $user->id;
    $_SESSION['prezdivka'] =  $user->prezdivka;
}
function logout(){
    unset($_SESSION['id']);
    unset($_SESSION['prezdivka']);
}
function register(){
    $user = ziskej_uziv(@$_POST['email']);
    if($user){
        echo "<script>alert('Uživatel s tímto emailem již existuje');</script>";
        return;
    }
    uloz_uziv(@$_POST['email'], @$_POST['prezdivka'], @$_POST['heslo']);

    $user = ziskej_uziv(@$_POST['email']);
    $_SESSION["id"] = $user->id;
    $_SESSION["prezdivka"] = $user->prezdivka;
}

require "$INC/nav.php";

?>

<div class="flex justify-center m-12">
    <form class="bg-zinc-50 rounded px-8 pt-6 pb-8 mb-4" method="POST">
        <?php if (@$_SESSION['prezdivka']) { ?>
            <!-- odhlásit -->
            <div class="mb-4">
                Vítejte na svém profilu uživateli: <?= $_SESSION['prezdivka'] ?>
            </div>
            <div class="mb-4 text-center">
                <input type="hidden" name="akce" value="logout">
                <input class="bg-blue-500 text-white font-bold rounded py-2 px-4" type="submit" value="Odhlásit" />
            </div>
         
        <?php } else { ?>
            <!-- přihlásit -->
            <input type="hidden" name="akce" value="login">
            <div class="mb-4">
                Přihlášení
            </div>
            <div class="mb-4">
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="email" type="email" placeholder="email" required>
            </div>
            <div class="mb-4">
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    name="heslo" type="password" placeholder="heslo" required>
            </div>
            <input class="bg-blue-500 text-white font-bold rounded py-2 px-4" type="submit" value="Přihlásit" />
    </form>
    <form class="bg-zinc-50 rounded px-8 pt-6 pb-8 mb-4" method="POST">

            <!-- registrace -->
            <div class="mb-4">
                Registrace
            </div>
            <div class="mb-4">
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="email" type="email" placeholder="email" required>
            </div>
            <div class="mb-4">
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="prezdivka" type="text" placeholder="přezdívka" required>
            </div>
            <div class="mb-4">
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    name="heslo" type="password" placeholder="heslo" required>
            </div>
            <input type="hidden" name="akce" value="register">
            <input class="bg-green-500 text-white font-bold rounded py-2 px-4" type="submit" value="Registrovat" />
        <?php } ?>
    </form>
</div>

<?php require "$INC/footer.php";
