<?php

class BookRent
{
    // Association
    private Rent $rent;

    // Optional attribute
    private $error;

    public function makeRent(string $memberID)
    {
        // find member
        $member = Member::findMember($memberID);

        if( $member==false ){
            $this->error[] = 'Member not found.';
            return false;
        }

        // check member's active rent status
        $hasRent = Rent::checkRentStatus($memberID);

        if( $hasRent==true ){
            $this->error[] = 'Member have active rent.';
            return false;
        }

        $this->rent = new Rent($memberID);
    }

    public function addBook(string $bookID)
    {
        return $this->rent->addBook($bookID);
    }

    public function saveRent()
    {
        // update Rent status
        $this->rent->saveRent();

        // get total rent price
        return $this->rent->calculateRentTotal();
    }

    public function savePayment(float $amount)
    {
        $this->rent->makePayment($amount);
    }
}