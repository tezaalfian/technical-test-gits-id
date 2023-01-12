<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Book::list()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'total_pages' => 'integer',
            'price' => 'numeric',
            'isbn' => 'string|max:13|unique:books',
            'publisher_id' => 'required|integer',
            'published_date' => 'required|date',
            'author_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        try {
            $book = Book::create([
                'title' => $request->title,
                'total_pages' => $request->total_pages,
                'price' => $request->price,
                'isbn' => $request->isbn,
                'publisher_id' => $request->publisher_id,
                'published_date' => $request->published_date,
                'author_id' => $request->author_id
            ]);
            return response()->json([
                'data' => $book
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        return response()->json([
            'data' => Book::list($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'total_pages' => 'integer',
            'price' => 'numeric',
            'isbn' => 'string|max:13|unique:books',
            'publisher_id' => 'required|integer',
            'published_date' => 'required|date',
            'author_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        try {
            $book = Book::find($id);
            $book->update([
                'title' => $request->title,
                'total_pages' => $request->total_pages,
                'price' => $request->price,
                'isbn' => $request->isbn,
                'publisher_id' => $request->publisher_id,
                'published_date' => $request->published_date,
                'author_id' => $request->author_id
            ]);
            return response()->json([
                'data' => $book
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Book::destroy($id);
            return response()->json([
                'message' => 'Book deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
