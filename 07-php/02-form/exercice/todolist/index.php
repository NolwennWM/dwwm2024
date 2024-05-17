<?php 

$todo = "";
session_start();
if(!isset($_SESSION["todo"]))
{
    $_SESSION["todo"] = [];
}
if($_SERVER['REQUEST_METHOD']=='GET')
{
    if(isset($_GET['delete'], $_SESSION["todo"][$_GET['delete']]))
        unset($_SESSION["todo"][$_GET['delete']]);
    if(isset($_GET['update'], $_SESSION["todo"][$_GET['update']]))
        $_SESSION["todo"][$_GET["update"]]["checked"] = !$_SESSION["todo"][$_GET["update"]]["checked"];
}
if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['todo']))
{
    $todo = htmlspecialchars($_POST['todo']);
    $_SESSION['todo'][time()] = [
        "task"=>$todo,
        "checked"=>false
    ];
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link rel="stylesheet" href="todolist.css">
</head>
<body>
<div id="todo">
    <div class="headerTodo">
        <h2>Liste de choses à faire</h2>
        <div class="formTodo">
            <form action="" method="post">
                <input type="text" id="addTodo" placeholder="Titre..." name="todo">
                <button type="submit">
                    <span class="addBtn">Ajouter</span>
                </button>
            </form>
        </div>
        
    </div>
    
    <ul id="list">
        <?php foreach($_SESSION["todo"] as $k => $do): ?>
            <li>
                <div class="<?php echo $do["checked"]?"checked":"" ?>">
                    <a href="?update=<?php echo $k ?>">
                        <?php echo $do["task"] ?>
                    </a>
                    <a class="close" href="?delete=<?php echo $k ?>">
                        &times;
                    </a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul> 
</div>
</body>
</html>