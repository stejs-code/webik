<?php

$context->container = false;

?>

<main>
    <div class="bg-slate-100">
        <div class="max-w-screen-lg mx-auto px-4 py-20">

            <h1 class="mt-0 text-6xl sm:text-7xl">Webík</h1>
            <p class="text-lg max-w-screen-md">
                Webík je místo pro skvělé php related úkoly. Vytvořeno s&nbsp;láskou v&nbsp;srdci a
                zcela bez donucení.
            </p>

        </div>
    </div>

    <div class="bg-white">
        <div class="max-w-screen-lg mx-auto px-4 py-12">


            <?= $tasksComponent ?>
        </div>
    </div>
</main>