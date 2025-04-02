<h1 class="text-4xl font-bold mb-8">Úkoly</h1>

<div class="grid grid-cols-2 gap-4 sm:grid-cols-3 auto-rows-[1fr]">
    <? foreach ($tasks as $task) { ?>

        <a class="block p-4 border border-border rounded-sm hover:shadow-md transition-all "
            href="/task/<?= $task['url'] ?>">
            <h2 class="text-lg font-bold"><?= $task['name'] ?></h2>
            <p class="text-sm text-gray-500 mt-2"><?= $task['description'] ?></p>
        </a>

    <? } ?>
</div>