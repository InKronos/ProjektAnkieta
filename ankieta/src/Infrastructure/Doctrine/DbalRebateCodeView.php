<?php

namespace App\Infrastructure\Doctrine;

use App\Application\Query\RebateCode\RebateCodeQuery;
use App\Application\Query\RebateCode\RebateCodeView;
use Doctrine\DBAL\Connection;

class DbalRebateCodeView implements RebateCodeQuery
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

   public function getNoneUsedCodes(): ?RebateCodeView
   {
       $result = $this->connection->fetchAssoc('
            SELECT rC.id, rC.code, rC.used FROM rebateCodes AS rC 
            WHERE rC.used = false'
       );
       if(!$result){
           return null;
       } else{
           return new RebateCodeView($result['id'], $result['code'], $result['used']);
       }

   }

}