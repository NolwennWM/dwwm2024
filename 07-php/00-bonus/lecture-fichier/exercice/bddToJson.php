<?php 
require "../../../ressources/service/_pdo.php";

function db2json(string $fileName):void
{
    $bdd = [];
    $pdo = connexionPDO();
    $tables = getTables();
    
    foreach($tables as $t)
    {
        $sql = $pdo->query("SELECT * FROM $t");
        $result = $sql->fetchAll();
        $bdd[$t] = $result;
    }
    
    $file = fopen($fileName, "w");
    fwrite($file, json_encode($bdd));
    fclose($file);
    // Ou alors :
    // file_put_contents($fileName, json_encode($bdd));

}
function json2db(string $fileName)
{
    $pdo = connexionPDO();
    $tables = getTables();
    $json = file_get_contents($fileName);
    $data = json_decode($json, true);

    $pdo->query("SET FOREIGN_KEY_CHECKS = 0;");
    foreach($data as $tab=>$cols)
    {
        
        $pdo->query("TRUNCATE $tab");
        foreach($data[$tab] as $val)
        {
            $sql1 = "INSERT INTO $tab (";
            $sql2 = "VALUES (";
            foreach($val as $k => $v)
            {
                $sql1 .= "`$k`,";
                $sql2 .= "'$v',";
            }
            $sql1 = substr($sql1, 0, -1);
            $sql2 = substr($sql2, 0, -1);
            $sql1 .= ')';
            $sql2 .= ')';
            
            $pdo->query($sql1.$sql2);
        }
    }
    $pdo->query("SET FOREIGN_KEY_CHECKS = 1;");
}
function getTables(): array|false
{
    $pdo = connexionPDO();
    $sql = $pdo->query("SHOW TABLES");
    return $sql->fetchAll(PDO::FETCH_COLUMN, 0);
}
// db2json("blog.json");
json2db("blog.json");
?>