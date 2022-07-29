<?php

namespace Database\Seeders;

use App\Models\TaskList;
use Illuminate\Database\Seeder;

class TaskListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasklist = new TaskList();
        $tasklist->board_id = 1;
        $tasklist->task_title = "Backlog";
        $tasklist->save();

        $tasklist = new TaskList();
        $tasklist->board_id = 1;
        $tasklist->task_title = "To do";
        $tasklist->save();

        $tasklist = new TaskList();
        $tasklist->board_id = 1;
        $tasklist->task_title = "In progress";
        $tasklist->save();

        $tasklist = new TaskList();
        $tasklist->board_id = 1;
        $tasklist->task_title = "Designed";
        $tasklist->save();
    }
}
