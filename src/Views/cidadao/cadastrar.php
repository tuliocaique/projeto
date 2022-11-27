<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form method="post">
    <?= ($message = \Projeto\Flash::message("success")) != null ? $message : "" ?>
    <input type="text" placeholder="Nome do cidadão" name="nome">
    <button type="submit">Enviar</button>
    <a href="/cidadaos">Listar</a>
</form>

</body>
</html>