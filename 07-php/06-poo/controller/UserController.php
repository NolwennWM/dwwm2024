<?php 
use Model\UserModel;
use Classes\AbstractController;
use Classes\Interface\CrudInterface;

require __DIR__."/../../ressources/service/_shouldBeLogged.php";
require __DIR__."/../../ressources/service/_csrf.php";

class UserController extends AbstractController implements CrudInterface
{
    use Classes\Trait\Debug;

    private UserModel $db;
    private string $regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";

    function __construct()
    {
        $this->db = new UserModel();
    }

    function create(){}
    function read()
    {
        $users = $this->db->getAllUsers();
        // $this->dump($users);
        $this->render("user/list.php", [
            "users"=>$users,
            "title"=> "POO - Liste Utilisateur"
        ]);
    }
    function update(){}
    function delete(){}
}
?>