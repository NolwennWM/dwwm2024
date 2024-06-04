<?php 
/* 
    Un autoloader est fait pour require les classes que l'on appelle dans notre code automatiquement.
    Cela nous évitera de devoir faire de multiple require à chaque fichier.
*/
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class){

            $file = 
            str_replace("\\", DIRECTORY_SEPARATOR, $class).".php";
            if(file_exists($file))
            {
                require $file;
                return true;
            }
            return false;
        });
    }
}
?>