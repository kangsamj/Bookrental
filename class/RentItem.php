<?php

class RentItem
{
    // Attribute
    private $subTotal;

    // Association
    private Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;

        return $this;
    }

    public function getSubTotal()
    {
        return $this->book->getRentPrice();
    }
}
