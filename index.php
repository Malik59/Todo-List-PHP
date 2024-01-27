<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once __DIR__ . "/php/head.php" ?>
    <title>Todo list</title>
</head>
<body>
    <div class="container">
    <?php require_once __DIR__ . "/php/header.php" ?>
        

        <div class="content">
            <div class="todo-container">
                <h1>Ma Liste</h1>
                <div class="todo-form">
                    <form action="">
                        <input type="text">
                        <button type="submit">Valider</button>
                    </form>
                </div>
                <div class="todo-list">

                </div>
            </div>
        </div>
    <?php require_once __DIR__ . "/php/footer.php" ?>
    
        
    </div>

</body>
</html>