<?php
const ERROR_REQUIRED = "Veuillez renseigner ce champ";
const ERROR_TOO_SHORT = "Veuillez saisir au moins 5 caractères";
$filename = __DIR__ . "/data/todos.json";
$error = "";
$todos = [];

if (file_exists($filename)) {
    $data = file_get_contents($filename);
    $todos = json_decode($data, true) ?? [];
}


if($_SERVER["REQUEST_METHOD"] === "POST") {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $todo = $_POST["todo"] ?? "";

    if(!$todo) {
        $error = ERROR_REQUIRED;
    } else if (mb_strlen($todo) < 5){
        $error = ERROR_TOO_SHORT;
    }


    if(!$error) {
        $todos = [...$todos, [
            "name" => $todo,
            "done" => false,
            "id" => time()
        ]];
        file_put_contents($filename, json_encode($todos));
        header("Location: /");
    }
}



?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once __DIR__ . "/includes/head.php" ?>
    <title>Todo list PHP</title>
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
                        <button class="btn">Ajouter</button>
                    </form>
                    <?php if($error): ?>
                    <p class="text-error"><?= $error ?></p>
                    <?php endif; ?>
                </div>
                <ul class="todo-list">
                    <?php foreach($todos as $t): ?>
                        <li class=<?= $t["done"] ? "low-opacity" : ""  ?>>
                            <p class="todo-name"><?= $t["name"] ?></p>
                            <a href="edit-todo.php?id=<?= $t["id"] ?>">
                                <button class="btn btn-validate"><?= $t["done"] ? "Annuler" : "Valider" ?></button>
                            </a>
                            <a href="remove-todo.php?id=<?= $t["id"] ?>">
                                <button class="btn btn-delete">Supprimer</button>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php require_once __DIR__ . "/includes/footer.php" ?>
    
        
    </div>

</body>
</html>