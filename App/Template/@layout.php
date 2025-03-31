<?php

$menuItems = [
    [
        "name" => "Úkoly",
        "url" => "/task",
        "active" => str_starts_with($context->dc->request->getUri()->getPath(), "/task"),
    ],
];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $context->title ?></title>
    <link rel="stylesheet" href="/css/global.css">
</head>

<body>
    <div class="bg-white border-b border-border tm-mavigation">
        <nav class="flex justify-between items-center mx-auto max-w-screen-md px-4 py-2">
            <a href="/" class="text-primary font-bold text-lg">
                Webík
            </a>

            <ul class="flex gap-4">
                <? foreach ($menuItems as $item) { ?>
                    <li>
                        <a href="<?= $item['url'] ?>" <?= $item['active'] ? 'data-active' : '' ?>
                            class="text-primary relative block py-2 before:content-[''] before:absolute before:bottom-1 before:left-0 before:transition-all before:right-[100%] hover:before:right-0 data-active:before:right-0 before:h-[2px] before:bg-primary">
                            <?= $item['name'] ?>
                        </a>
                    </li>
                <? } ?>
            </ul>
        </nav>
    </div>
    <main class="mx-auto max-w-screen-md px-4 mt-4">
        <?= $children ?>
    </main>
    <script src="/js/main.js"></script>
</body>

</html>