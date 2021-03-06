<?php

namespace App\Services;

use App\Book;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookshelfService
{
	/**
	 * @var Authenticatable
	 */
	private $user;

	private $book;

	public function __construct(Authenticatable $user, Book $book)
	{
		$this->user = $user;
		$this->book = $book;
	}

	/**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllBooks()
    {
        $books = $this->book->all();
        return $books;
    }

    /**
     * @param $bookId
     */
    public function checkoutBookById($bookId)
    {
        $book = $this->book->findOrFail($bookId);
        /** @var Book $book */
        $book->available = false;
        $book->save();
        $book->checkoutHistories()
        ->create([
            'user_id' => $this->user->id,
            ]);
    }

    /**
     * @param $bookId
     */
    public function returnBookById($bookId)
    {
        $book = $this->book->findOrFail($bookId);
        /** @var Book $book */
        $book->available = true;
        $book->save();
        
        $checkHistory = $book->checkoutHistories()
            ->notReturnedByUser($this->user->id)
            ->first();
        $checkHistory->returned = true;
        $checkHistory->save();
    }

    public function isMaxLimitOfCheckout()
    {

        $count = $this->user->checkoutHistories()
            ->notReturned()
            ->count();

        if ($count >= 2) {
            return false;
        }

        return true;
    }

}