<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'total_pages',
        'price',
        'isbn',
        'publisher_id',
        'published_date',
        'author_id'
    ];

    public static function list($id = null)
    {
        $sql = self::select("books.*", "publishers.name as publisher_name", "authors.name as author_name")
            ->join("publishers", "publishers.id", "=", "books.publisher_id")
            ->join("authors", "authors.id", "=", "books.author_id");
        if ($id) {
            return $sql->where("books.id", $id)->first();
        } else {
            return $sql->get();
        }
    }
}
