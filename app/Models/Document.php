<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    /**
     * отключение автоинкремента
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * тип первичного ключа
     *
     * @var string
     */
    protected $keyType = 'string';

    // значение полей по умолчанию
    protected $attributes = [
        'status' => 'draft',
        'payload' => '{}'
    ];

    /**
     * отслеживание событий жизненного цикла модели
     *
     * @return void
     */
    protected static function booted()
    {
        // генерация uuid перед созданием
        static::creating(function ($document) {
            $document->id = (string) Str::uuid();
        });    
    }
}
