<?php

use App\Component\Navigation;

$buildTime = $config->isDev ? (microtime(true) * 10000) : $config->buildTime;

?>
<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title><?= $context->title ?></title>
    <link rel="stylesheet" href="/css/global.css?buildTime=<?= $buildTime ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <? (new Navigation())->render(); ?>

    <? if ($context->container) { ?>
        <main class="mx-auto max-w-screen-lg px-4 mt-4">
            <?= $children ?>
        </main>
    <? } else {
        echo $children;
    } ?>

    <footer>
        <div class="max-w-screen-lg mx-auto px-4 py-8">
            <p class="text-sm text-gray-500 text-right">
                &copy; <?= date('Y') ?> Webík
            </p>
        </div>

    </footer>

    <script type="module" src="/js/main.js?buildTime=<?= $buildTime ?>" defer></script>
</body>

</html>