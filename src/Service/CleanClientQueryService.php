<?php

namespace App\Service;

// We just want to delete Entries older that 7 days from the Client Query Table
// ALSO delete Old Firmwares ONLY if there is already one

use App\Repository\ClientQueryRepository;

class CleanClientQueryService
{

    private $repository;

    public function __construct(ClientQueryRepository $repository)
    {
               $this->repository = $repository;
    }

    public function CleanQueries()  {

        $num = $this->repository->deleteOldQueries();
        dump ("Items Deleted ;=" . strval($num));

    }

    public function CleanFirmware(){

    }

//DELETE FROM on_search
//WHERE search_date < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 180 DAY))


}