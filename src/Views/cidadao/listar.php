<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?= ($message = \Projeto\Flash::message("success")) != null ? $message : "" ?>
<form method="get" action="/buscar">
    <input type="text" placeholder="Buscar um cidadao pelo nis" name="nis">
    <button type="submit">Buscar</button>
</form>
<?php if (isset($cidadaos)): ?>
    <?php foreach ($cidadaos as $cidadao) : ?>
        <div>
            <table>
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>NIS</th>
                    <th>Acao</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= $cidadao->nome ?></td>
                    <td><?= $cidadao->nis ?></td>
                    <td><a href="/cidadao/excluir/<?= $cidadao->id ?>">Deletar</a></td>
                </tbody>
            </table>
        </div>
    <?php endforeach;
else: ?>
    <h1>Nenhum cidadão cadastrado</h1>
<?php endif; ?>


<a href="/cidadao/cadastrar">Cadastrar</a>


</body>
</html>