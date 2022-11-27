<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form method="get" action="/buscar">
    <input type="text" placeholder="Buscar um cidadao pelo nis" name="nis"
           value="<?= isset($busca) ? $busca : '' ?>">
    <button type="submit">Buscar</button>
</form>
<?php if (isset($cidadao)): ?>
    <h1><?= $cidadao->nome ?></h1>
    <p><?= $cidadao->nis ?></p>
<?php else: ?>
    <h1>Nenhum cidadão encontrado</h1>
<?php endif; ?>


<a href="/cidadao/cadastrar">Cadastrar</a>


</body>
</html>