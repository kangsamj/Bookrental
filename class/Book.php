<?php

class Book
{
    // Attribute
    private $bookID;
    private $bookName;
    private $bookStatus;
    private $bookPrice;
    private $rentPrice;

    private $dummyBook = array(
        'M0001' => array('bookID'=>'M0001', 'bookName'=>'Naruto', 'bookStatus'=>'Available', 'bookPrice'=>'40.00', 'rentPrice'=>'4.00'),
        'M0002' => array('bookID'=>'M0002', 'bookName'=>'Bleach', 'bookStatus'=>'Available', 'bookPrice'=>'40.00', 'rentPrice'=>'4.00'),
        'M0003' => array('bookID'=>'M0003', 'bookName'=>'Dragon Ball', 'bookStatus'=>'Reserved', 'bookPrice'=>'40.00', 'rentPrice'=>'4.00'),
    );

    public function pushBook()
    {
        // code
    }

    public static function findBook(string $bookID)
    {
        // find Book
        if( !isset($this->dummyBook[$bookID]) ){
            return throw new Exception("Error Book not found.");
        }else{
            list(
                $this->bookID,
                $this->bookName,
                $this->bookStatus,
                $this->bookPrice,
                $this->rentPrice
            ) = $this->dummyBook[$bookID];
        }

        return $this;
    }

    public function checkReserve(string $memberID)
    {
        $member_reserved = Reserve::findReserve($memberID);

        // This member didn't reserve any book
        if( $member_reserved==false ){
            return false;
        }

        if( $member_reserved[$this->bookID] ){
            return true;
        }
    }

    public function getRentPrice()
    {
        return $this->rentPrice;
    }
}
