<?php

namespace App\Models;

use App\Casts\RequestCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class TaskList extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "task_list"; // tablo adını atadım
    protected $fillable = [ "board_id", "task_title" ]; // tablo sutunlarını atadım
    public $timestamps = true; // timestamps'ı true yaptım teker teker created_at ve updated_at sutunlarını fillable'a atamaya gerek yok
 
    // Task List'e eklenilen tüm verileri XSS atacklarını vs engellemek için cast ile oluşturduğum RequestCast sınıfında filtereden geçiriyorum.
    protected $casts = [
        'board_id' => RequestCast::class,
        'task_title' => RequestCast::class,
    ];
}
