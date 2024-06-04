<?php 
// ignorer pour l'instant. cela sera expliquer dans la partie 2.
namespace Cours\POO;
/*
    Jusqu'ici on a fait de la programmation procédurale.
        - Le code est lu de haut en bas et c'est tout.
    De la programmation fonctionnelle.
        - Le code est lu de haut en bas mais de temps en temps,
        appelle une fonction déclaré ailleurs.
    Et maintenant on va faire de la programmation orienté objet.
        - On instancie (crée) des objets qui contiennent des propriétés (variable) et des méthodes (fonction).
        Ces objets sont instancié à partir de class (Plan de construction).

    les deux mots clefs les plus important à retenir sont:
        "class" qui permet de déclarer une nouvelle classe.
        et 
        "new" qui permet d'instancier une classe.

    Par convention on mettra une majuscule à nos classes.
*/
// Je déclare une classe.

class Chaussette{}
// J'instancie une classe.
$a = new Chaussette();
/*
    Comme dit plus haut, une classe peut contenir des propriétés et des méthodes.
    Pour les déclarer, cela ne change pas de la déclaration
    de variable et fonction classique.
    On devra cependant les faire précéder de certains mots clefs au choix entre :
        - public;
        - protected;
        - private;
    Commençons avec public et revenons sur les autres plus tard.
*/
class Fruit{
    public $famille = "végétal";
    public function talk()
    {
        echo "Je suis un fruit !<br>";
    }
}
/*
	Lorsque l'on instancie une class, pour faire appel à une méthode ou une propriété, on utilisera "->"
*/
// j'instancie ma classe.
$f = new Fruit();
// J'appelle la méthode talk de l'objet Fruit;
$f->talk();
// Lorsque l'on fait appel à la propriété d'un objet le "$" disparait.
echo $f->famille, "<br>";
// Je change la valeur de la propriété.
$f->famille = "être vivant";
# ------------------THIS et PRIVATE--------------------------- #
/*
    Parfois on a besoin que certaines propriétés n'acceptent pas n'importe quelle valeur. Prenons en exemple l'âge de quelqu'un.
    Cela devra être un chiffre uniquement pas négatif.

    Dans ce cas, on va passer la propriété en "private" c'est à dire qu'elle ne sera accessible qu'à l'interieur même de l'objet.

    Pour accèder à une propriété ou une méthode appartenant à la classe elle même, 
    on utilisera "$this" cet mot clef fera appel à lui même.
*/
class Humain{
    private $age;
    public function setAge(int $a):void
    {
        if($a<0)
        {
            $this->age = 0;
            return;
        }
        $this->age = (int)$a;
    }
    public function getAge():int
    {
        return $this->age;
    }
}
$h = new Humain();
// Ne fonctionne pas car age est privé.
// $h->age = 15;
// Mettre un négatif paramètra age à 0;
$h->setAge(-25);
// On ne pourra plus afficher directement l'âge donc on utilisera un getter.
echo $h->getAge(), "<br>";
#--------------------CONSTRUCT et DESTRUCT-----------------------------
/*
    Les fonctions "__construct" et "__destruct" sont des fonctions prédéfinies qui se lancent automatiquement à la création et à la destruction de l'objet.

    Lorsque que l'on instancie une classe, on utilise des parenthèses :
    new class();
    Ces parenthèses peuvent être rempli avec des arguments comme pour une fonction.
    Ceux ci seront automatiquement fourni à la fonction "__construct"
*/

class Humain2{
    function __construct($nom)
    {
        $this->nom = $nom;
        echo $this->nom . " est né(e). <br>";
    }
    function __destruct()
    {
        echo $this->nom . " est mort(e). <br>";
    }
}
// On remarquera que le message de construct et destruct apparaissent sans que je n'ai appelé de méthode.
$h2 = new Humain2("Maurice");
/*
    Les variables étant automatiquement détruite une fois le code fini d'interprété, le message de "__destruct" apparait après mon echo.
*/
echo "Bonjour <br>";
/* 
    En détruisant moi même la variable, je décide d'où est ce que le "__destruct" est lancé.
*/
unset($h2);
echo "Bonsoir <br>";
#---------------------------CHAINAGE des METHODES------------------------
/* 
    Si je reprend le premier exemple, si je souhaite faire parler mon fruit plusieurs fois je devrais 
    réécrire la variable qui contient mon objet à chaque fois :
*/
$f->talk();
$f->talk();
$f->talk();
/* 
    Mais lorsque l'on a une méthode comme celle ci qui ne retourne aucune valeur, ce qui se fait souvent
    c'est de lui faire retourner "$this". 
    De cette façon, l'objet va se retourner lui même.
    Il sera donc possible de faire appel à une prochaine méthode de l'objet sans réécrire sa variable 
    ni les ";".
*/
class Fruit2{
    public function talk(): self
    {
        echo "Je suis un fruit !<br>";
        return $this;
    }
}
$f2 = new Fruit2();
$f2 ->talk()
    ->talk()
    ->talk();
/*
    On aurait pu aussi l'écrire sur une seule ligne :
    $f2->talk()->talk()->talk();
*/
#---------------------CONSTANTE et STATIC-----------------------------
/*
    Une classe peut contenir des propriétés constante représenté par le mot clef "const". 
    Ainsi que des méthodes statique représenté par le mot clef "static". 

    Ces propriétés et méthodes ont la particularité d'être appelable même si la classe n'est pas instancié.
    
    Pour appeler une constante ou une fonction static, on n'utilisera pas "->" mais "::"
*/
class Humain3{
    public const MEMBRES = "2 bras, 2 jambes, un torse et une tête";
    public static function description()
    {
        /* 
            Pour appeler une propriété constante ou une méthode statique dans une fonction statique, on ne pourra pas utiliser "$this"
            Car la classe n'étant pas instancié, $this ne représente aucun objet.
            On utilisera alors le mot clef "self" qui lui fera référence à la classe et non à l'objet.
        */
        echo "Un humain a en général " . self::MEMBRES . "<br>";
    }
}
echo Humain3::MEMBRES, "<br>";
Humain3::description();
// Même instancié, elles restent utilisable :
$t = new Humain3();
$t::description();
#------------------------HERITAGE-------------------------------
/*
    Il est possible de faire hériter des classes à de nouvelles classes, 
    La classe "enfant" héritera alors de toute les méthodes et propriétés de son parent, à l'exception de celles marqué comme "private". 

    C'est là que rentre en jeu le dernier accesseur, on a parlé de public et private, 
    et bien "protected" offre les mêmes possibilités que private à l'exception que les propriétés et méthodes protected sont hérité. 
*/
class Humain4{
    private $age = 20;
    protected $nom = "Maurice";
    private function loisir()
    {
        echo "J'aime le bowling depuis mes ". $this->age ."<br>";
    }
    protected function talk()
    {
        echo "Bonjour, je me nomme " . $this->nom . ".<br>";
        $this->loisir();
    }
}
$h4 = new Humain4();
// $h4->talk();
/*
    Comme indiqué plus haut, protected réagit comme private, donc impossible d'utiliser les propriétés et méthodes protected 
    hors de la classe elle même.

    Grâce au mot clef "extends" nous allons faire pouvoir hériter notre classe et user des protected.
*/
class Pompier extends Humain4
{
    public function presentation()
    {
        echo "Je suis " . $this->nom . " le pompier. <br>";
        $this->talk();
        // $this->loisir();
        /*
            loisir() ne fonctionne pas car est en private.
            Par contre je peux utiliser $nom et talk() qui sont en protected.
            On notera que talk fait usage d'une méthode private, celle ci est bien prise en compte malgré qu'elle ne soit pas hérité.
        */
    }
}
$p = new Pompier();
$p->presentation();

/*
    On peut hériter une classe qui elle même hérite d'une autre classe et ainsi de suite tant que le mot clef "final" 
    n'est pas utilisé, celui ci indiquera que la classe ne peut pas être hérité. 
*/
final class Apprenti extends Pompier{}

$p2 = new Apprenti();
$p2->presentation();

/* 
    Aucun problème avec notre apprenti qui hérite de pompier qui hérite lui même de humain4

    Par contre impossible de donner notre apprenti en tant qu'héritage d'une nouvelle classe car il est marqué comme "final"
*/
// class enfant extends Apprenti{}

#-----------------------ABSTRACT---------------------------
/*
    les classes abstraites sont des classes qui ne peuvent pas être instancié. 
    Elles servent uniquement en tant qu'héritage. 
    Elles peuvent être utile si plusieurs de vos classes doivent avoir les même fonctions. 
*/
abstract class Humanity{
    protected $nom;
    public function talk()
    {
        echo "Je me nomme ". $this->nom . "<br>";
    }
    /* 
        Les classes abstraites peuvent contenir des méthodes abstraites.
        Ces méthodes servent de plan pour guider la construction de la classe qui héritera.
        La classe enfant devra absolument définir toute les méthodes abstraite hérité. 

        Par exemple ici j'indique que la classe enfant devra contenir une méthode public appelé "setName"
            Elle prendra un argument de type string. 

        Par contre on remarquera que si j'ai déclaré ma méthode, elle n'est pas défini.
        chaque class qui héritera de cette class abstraite pourra définir la fonction comme bon lui semble.
    */
    abstract public function setName(string $n);
}
# Provoque une erreur car c'est une classe abstraite.
// $nope = new Humanity();
class Policier extends Humanity{
    // provoque une erreur tant que setname n'est pas déclaré.
    public function setName(string $n): self
    {
        $this->nom = $n;
        return $this;
    }
}
$po = new Policier();
$po ->setName("Charle")
    ->talk();
#------------------------INTERFACES et TRAITS--------------------------
/* 
    Une interface est semblable à une classe abstraite, à la différence
    qu'elle ne contient que des méthodes non défini et public.

    Elle servira uniquement de plan pour construire une classe.
	Elles se déclarent avec le mot clef "interface".
*/
interface Ordinateur{
    public function youtube($url);
    public function excel();
}
/* 
    Un trait ressemble beaucoup à une classe abstraite, à la différence que dans un trait toute les propriétés et méthodes sont définie.

    On utilisera généralement une classe abstraite comme parent de plusieurs classes fonctionnant de la même façon.

    Alors qu'on utilisera les traits pour des classes qui ont des rôles totalement différent mais qui peuvent avoir besoin d'un même outil.
*/
trait Electricity{
    protected $volt = 230;
    public function description()
    {
        echo "Je me branche sur du ".$this->volt . " volts.<br>";
    }
}
/*
    Pour utiliser une interface on utilisera le mot clef "implements" après le mot clef "extends" si celui ci doit apparaître.

    Pour utiliser un trait, cela se fera à l'interieur de la classe avec le mot clef "use";
*/
class Asus implements Ordinateur{
    use Electricity;
    // Sans ces deux fonctions, j'aurais une erreur à cause de l'interface.
    function youtube($u){
        echo "Je regarde $u sur youtube.";
    }
    function excel(){
        echo "Je fais mes comptes.";
    }
}
$pc = new Asus();
$pc->description();

class MicroOnde{
    use Electricity;
}

/* 
    Un ordinateur et un micro onde ont des rôles totalement différent mais ont tous les deux un même trait.
*/
$mo = new MicroOnde();
$mo->description();
?>