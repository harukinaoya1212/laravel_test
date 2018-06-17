<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Book;
use Validator;
use Auth;
use Illuminate\Support\Facades\Input; //Input::getのため
//DB操作のため

class BooksController extends Controller
{
    public function __construct()
    {
            $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $books = Book::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(100);
        return view('books', ['books' => $books]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required|max:255',
            'item_number' => 'required | min:1 | max:3',
            'item_amount' => 'required | max:6',
            'published'   => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $books = Book::where('user_id',Auth::user()->id)->find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();   //「/」ルートにリダイレクト
        return redirect('/');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
        'item_name' => 'required|max:255',
        'item_number' => 'required | min:1 | max:3',
        'item_amount' => 'required | max:6',
        'published'   => 'required',
        ]);
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $books = new Book;
    $books->user_id = Auth::user()->id;
    $books->item_name = $request->item_name;
    $books->item_number = $request->item_number;
    $books->item_amount = $request->item_amount;
    $books->published = $request->published;

//    $books->item_name = Input::get('book_name');
//    $books->item_number = Input::get('book_number');
//    $books->item_amount = Input::get('book_amount');
//    $books->published = Input::get('book_published');
    $books->save();   //「/」ルートにリダイレクト
//    return redirect('/');
return Response::make('0');
    }

    public function edit($book_id)
    {
        $books = Book::where('user_id',Auth::user()->id)->find($book_id);
        return view('booksedit',['book' => $books]);
    }

    public function delete(Book $book)
    {
        $book->delete();
        return redirect('/');
    }
}
