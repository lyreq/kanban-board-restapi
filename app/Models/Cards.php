<?php

namespace App\Models;

use App\Casts\RequestCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Cards extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "cards"; // tablo adını atadım
    protected $fillable = ["list_id", "card_row", "card_title", "card_text"]; // tablo sutunlarını atadım
    public $timestamps = true; // timestamps'ı true yaptım teker teker created_at ve updated_at sutunlarını fillable'a atamaya gerek yok

  
    // Kartlara eklenilen tüm verileri XSS atacklarını vs engellemek için cast ile oluşturduğum RequestCast sınıfında filtereden geçiriyorum.
    protected $casts = [
        'list_id' => RequestCast::class,
        'card_row' => RequestCast::class,
        'card_title' => RequestCast::class,
        'card_text' => RequestCast::class
    ];
}
