<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\BookshelfService;
use App\Book;
use Auth;

class BookShelfController extends Controller
{
    /**
     * @var BookshelfService
     */
    private $service;

    public function __construct(BookshelfService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

	public function index()
	{
		$books = $this->service->getAllBooks();
		return view('bookshelf/index', compact('books'));
	}

	public function checkout(Request $request)
    {
    	$bookId = $request->get('book_id');

        if ($this->service->isMaxLimitOfCheckout()) {
            try {
                $this->service->checkoutBookById($bookId);
            } catch (ModelNotFoundException $e) {
                abort(500);
            }
            return redirect('/');
        }

        
        return redirect('/')
            ->withErrors('每個帳號最多只能借 2 本書');
    }

    public function returnBook(Request $request)
    {
    	$bookId = $request->get('book_id');

        try {
            $this->service->returnBookById($bookId);
        } catch (ModelNotFoundException $e) {
            abort(500);
        }
        
        return redirect('/');
    }
}