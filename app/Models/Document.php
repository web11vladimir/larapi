<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * отслеживание событий жиизненного цикла модели
     *
     * @return void
     */
    protected static function booted()
    {
        // генерация данных перед созданием
        static::creating(function ($document) {
            // uuid
            $document->id = (string) Str::uuid();
            
            // статус по умолчанию
            $document->status = 'draft';

            // данные по умолчанию
            $document->payload = '{}';
        });    
    }
}
