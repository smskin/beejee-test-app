<?php

namespace App\Commands;

use App\DBContext\DBContextUser;
use App\Services\Framework\Contracts\ICommand;
use App\Services\Framework\Services\Command\Commands\Command;

class TestCommand extends Command implements ICommand
{
    public static $signature = 'test:test';
    public static $description = 'test command';

    public function execute(): void
    {
//        $context = new DBContextUser();
//        $context->setName('test1223');
//        $context->save();

//        $users = DBContextUser::find(1);

//        $users->setName('asjbajbsas');
//        $users->save();

        $qb = DBContextUser::builder()
            ->getQuery()
            ->getDQL();
//        dd($qb);

        $qb = DBContextUser::builder()
            ->getQuery()
            ->execute();
        dd($qb);

        dd(DBContextUser::builder()->getFirstResult());
        $users = DBContextUser::builder()->where('id = :identifier')->setParameter('identifier',1)->getQuery();

        dd($users);
    }
}