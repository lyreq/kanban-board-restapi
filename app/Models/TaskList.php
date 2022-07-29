<?php

namespace App\Models;

use App\Casts\RequestCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class TaskList extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "task_list";
    protected $fillable = [
        "board_id",
        "task_title"
    ];

    public $timestamps = true;

    protected $casts = [
        'board_id' => RequestCast::class,
        'task_title' => RequestCast::class,
    ];
}
