<?php

namespace App\Models;

use App\Casts\RequestCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Cards extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = "cards";
    protected $fillable = ["list_id", "card_row", "card_title", "card_text"];
    public $timestamps = true;


    protected $casts = [
        'list_id' => RequestCast::class,
        'card_row' => RequestCast::class,
        'card_title' => RequestCast::class,
        'card_text' => RequestCast::class
    ];
}
