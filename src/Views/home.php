<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <?= $this->css([
        'bootstrap-grid',
        'style',
        'iziToast.min'
    ]) ?>
</head>
<body>
<div class="card-outer">
    <div class="card">
        <div class="container">
            <h1>Cidadãos</h1>
            <a href="/cidadao/cadastrar" class="button button-blue size-medium">Cadastrar</a>
            <a href="/cidadaos" class="button button-blue size-medium">Listar</a>
            <a href="/buscar" class="button button-blue size-medium">Buscar</a>
        </div>
    </div>
</div>
</body>
</html>