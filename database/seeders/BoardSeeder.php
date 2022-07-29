<?php

namespace Database\Seeders;

use App\Models\BoardList;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $board = new BoardList();
        $board->board_name = "Roadmap";
        $board->save();
    }
}
