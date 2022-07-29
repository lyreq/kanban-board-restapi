<?php

namespace App\Models;

use App\Casts\RequestCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class BoardList extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "board_list";
    protected $fillable = ["board_name"];
    public $timestamps = true;

    protected $casts = [
        'board_list' => RequestCast::class,
    ];
}
