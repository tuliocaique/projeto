<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <?= $this->css([
        'bootstrap-grid',
        'style',
        'iziToast.min'
    ]) ?>

</head>
<body class="container">
    <nav class="row">
        <div class="col-10">
            <ul class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/cidadaos">Cidadãos</a></li>
                <li>Busca</li>
            </ul>
        </div>
        <div class="col-2">
            <a href="/cidadao/cadastrar" class="button button-blue size-small">Cadastrar</a>
        </div>
    </nav>

    <main class="row">
        <section class="col-12">
            <form method="get" action="/buscar">
                <div class="row">
                    <div class="col-10">
                        <input type="number" placeholder="Buscar um cidadao pelo nis" name="nis"
                               value="<?= isset($busca) ? $busca : '' ?>">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="button button-green size-medium">Buscar</button>
                    </div>
                </div>
            </form><br>
        </section>

        <section class="col-12">
            <?php if (isset($cidadao)): ?>
                <h1><?= $cidadao->nome ?></h1>
                <h2 style="font-weight: lighter"><?= $cidadao->nis ?></h2>
                <a href="/cidadao/excluir/<?= $cidadao->id ?>" class="button button-red size-small">Deletar</a>
            <?php else: ?>
                <center><h1>Nenhum cidadão encontrado</h1></center>
            <?php endif; ?>
        </section>
    </main>

    <?php $this->render('flash/flash_message'); ?>
</body>
</html>