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
                <li>Cadastrar</li>
            </ul>
        </div>
    </nav>
    <main class="row">
        <section class="col-12">
            <form method="post">
                <div class="row">
                    <div class="col-12">
                        <label for="nome">Nome</label>
                        <input type="text" placeholder="Nome do cidadão" name="nome" id="nome">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="button button-green size-medium">Cadastrar</button>
                    </div>
                </div>
            </form><br>
        </section>
    </main>

    <?php $this->render('flash/flash_message'); ?>

</body>
</html>