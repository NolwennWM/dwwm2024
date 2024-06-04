<?php 
namespace Classes\Trait;

trait Debug{

    public function dump(...$values)
    {
        ini_set("highlight.comment", "#008000");
        ini_set("highlight.default", "#000000");
        ini_set("highlight.html", "#808080");
        ini_set("highlight.keyword", "#0000BB; font-weight: bold");
        ini_set("highlight.string", "#DD0000");
        $style = 
        "background-color: gray;
        color: white;
        width: fit-content;
        padding: 1rem;
        border: 2px solid green;
        margin: 1rem auto;";
        foreach($values as $v)
        {
            echo "<pre style='$style'>". highlight_string("<?php \n ".var_export($v, 1)." \n?>", 1) ."</pre>";
        }

    }
    /**
     * Affiche la valeur à debug puis stop le code.
     *
     * @param [type] ...$values
     * @return void
     */
    public function dd(...$values)
    {
        $this->dump(...$values);
        die;
    }
}
?>