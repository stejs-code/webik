<?php

namespace App\Component;

use App\Module\Task;

class TasksGrid extends Component
{
    public array $tasks = [];

    public function compute()
    {
        $this->tasks = Task::$tasks;
    }

    public function render()
    {
?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 auto-rows-[1fr]">
            <?php foreach ($this->tasks as $task) { ?>
                <a spa="prefetch" href="<?= $task['url'] ?>"
                    class="block p-4 border border-border rounded-sm hover:shadow-md transition-all">
                    <div class="">
                        <h3 class="text-lg font-bold"><?= $task['name'] ?></h3>
                        <p class="text-gray-600"><?= $task['description'] ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>

<?php
    }
}
