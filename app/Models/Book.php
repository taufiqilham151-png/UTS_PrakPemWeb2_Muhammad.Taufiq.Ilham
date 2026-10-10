<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model

{
    
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

        /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'author',
        'publication_year',
        'publisher',
        'published_year',
        'price',
        'stock',
        'description',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_year' => 'integer',
            'price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }

}
