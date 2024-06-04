<?php 
namespace Classes;

abstract class AbstractController
{
    /**
     * Affiche les messages flash.
     *
     * @return void
     */
    protected function getFlash(): void
    {
        if(isset($_SESSION["flash"]))
        {
            echo "<div class='flash'>{$_SESSION['flash']}</div>";
            unset($_SESSION["flash"]);
        }
    }
    /**
     * Enregistre un message en session
     *
     * @param string $message
     * @return void
     */
    protected function setFlash(string $message): void
    {
        $_SESSION["flash"] = $message;
    }
    /**
     * Affiche la vue demandé en premier paramètre
     * 
     * En option le tableau peut accueillir des variables à transmètre à la vue;
     *
     * @param string $view
     * @param array $options Doit être un tableau associatif
     * @return void
     */
    protected function render(string $view, array $options = []): void
    {
        foreach($options as $name=>$value)
        {
            $$name = $value;
        }

        require __DIR__."/../../ressources/template/_header.php";
        require __DIR__."/../view/".$view;
        require __DIR__."/../../ressources/template/_footer.php";
    }
}
?>