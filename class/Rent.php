<?php

class Rent
{
    // Attribute
    private $rentStatus;
    private $totalRentPrice = 0;

    // Association
    private Member $member;
    private Book $book;
    private $rentItem;

    // Dummy data
    private $dummyRent = array(
        '0001' => array('memberID'=>'0001', 'bookID'=>'M004', 'bookName'=>'xXx', 'rentPrice'=>'4.00', 'rentStatus'=>'ACTIVE', 'rentDate'=>'2012-12-31', 'returnDate'=>'2013-01-01'),
    );

    public static function checkRentStatus(string $memberID)
    {
        foreach ($this->dummyRent as $rentID => $item) {
            // already rent
            if( $item['memberID']==$memberID ){
                return true;
            }
        }

        return false;
    }

    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    public function addBook(string $bookID)
    {
        $memberID = $this->member->getMemberID();
        $book = Book::findBook($bookID);

        if( $book==false ){
            return throw new Exception("Error: Book not found.");
        }

        if( $book->is_reserved() ){
            if( !$book->checkReserve($memberID) ){
                return throw new Exception("Error: Book already reserved.");
            }
        }

        $this->book = new Book($bookID);

        $this->rentItem[] = new RentItem($this->book);
    }

    public function saveRent()
    {
        // change rent status
        $this->rentStatus = 'ACTIVE';
    }

    public function calcylateRentTotal()
    {
        if( !empty($this->rentItem) ){
            foreach ($this->rentItem as $index => $rentItem) {
                $this->totalRentPrice = $this->totalRentPrice + $rentItem->getSubTotal();
            }
        }

        return $this->totalRentPrice;
    }

    public function makePayment(float $amount)
    {
        new Payment($amount);
    }

}
