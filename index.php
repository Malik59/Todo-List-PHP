<?php
const ERROR_REQUIRED = "Veuillez renseigner ce champ";
const ERROR_TOO_SHORT = "Veuillez saisir au moins 5 caractères";
$error = "";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $_POST = filter_var(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $todo = $_POST["todo"] ?? "";

    if(!$todo) {
        $error = ERROR_REQUIRED;
    } else if (mb_strlen($todo) < 5){
        $error = ERROR_TOO_SHORT;
    }

}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once __DIR__ . "/includes/head.php" ?>
    <title>Todo list</title>
</head>
<body>
    <div class="container">
    <?php require_once __DIR__ . "/includes/header.php" ?>
        

        <div class="content">
            <div class="todo-container">
                <h1>Ma Liste</h1>
                <div class="todo-form">
                    <form action="/" method="POST">
                        <input type="text" name="todo">
                        <button>Ajouter</button>
                    </form>
                    <?php if($error): ?>
                    <p class="text-error"><?= $error ?></p>
                    <?php endif; ?>
                </div>
                <div class="todo-list">
                </div>
            </div>
        </div>
    <?php require_once __DIR__ . "/includes/footer.php" ?>
    
        
    </div>

</body>
</html>