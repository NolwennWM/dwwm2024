<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title??"Cours PHP"?></title>
    <link rel="stylesheet" href="/ressources/style/style.css">
    <script src="/ressources/script/script.js" defer></script>
    <!-- captacha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
    function onSubmit(token) 
    {
        document.querySelector("form").submit();
    }
    </script>

</head>
<body class="<?= $bodyClass ?? "" ?>">
    <header>
        <h1><?php echo $title??"Cours PHP"?></h1>
    </header>
    <main>