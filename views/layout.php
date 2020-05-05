<html lang="pl">
<head>
    <title><?= $this['title']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
<div class="card-panel green row">
    <div class="col s12">
        <?php if ($this['request']->session->has('user')): ?>
            <a href="<?= $this->router->generate(\Recruitment\Actions\Logout::class) ?>" class="btn right">Wyloguj</a>
        <?php elseif ($this->router->generate(\Recruitment\Actions\Login::class) !== $this['request']->server->get('REQUEST_URI')): ?>
            <a href="<?= $this->router->generate(\Recruitment\Actions\Login::class) ?>" class="btn right">Zaloguj</a>
        <?php endif ?>
        <?php if (!$this['request']->session->has('user') && $this->router->generate(\Recruitment\Actions\Register::class) !== $this['request']->server->get('REQUEST_URI')): ?>
            <a href="<?= $this->router->generate(\Recruitment\Actions\Register::class); ?>" class="btn right " style="margin-right: 2em;">Register as new
                user</a>
        <?php endif ?>

    </div>
</div>
<div class="container">
    <?= $this['content']; ?>
</div>
</body>
</html>
