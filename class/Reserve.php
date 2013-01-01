<?php

class Reserve
{
    private $dummyReserve = array(
        'M0003' => array('bookID'=>'M0003', 'bookName'=>'Dragon Ball', 'memberID'=>'201201001'),
    );

    public static function findReserve(string $memberID)
    {
        $reserve = false;

        // find reserve
        foreach ($this->dummyReserve as $bookID => $item) {
            if( $item['memberID']==$memberID ){
                $reserve[$bookID] = $item;
            }
        }

        return $reserve;
    }
}
