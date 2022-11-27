<?php

$success = \Projeto\Flash::message('success');
$error = \Projeto\Flash::message('error');

?>
<?= $this->script('iziToast.min') ?>
<script>

    <?php if (isset($success)): ?>
    iziToast.success({
        title: 'Sucesso',
        message: '<?= $success ?>',
    });
    <?php endif ?>
    <?php if (isset($error)): ?>
    iziToast.error({
        title: 'Erro',
        message: '<?= $error ?>',
    });
    <?php endif; ?>

</script>