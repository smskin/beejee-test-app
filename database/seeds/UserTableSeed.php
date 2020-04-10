<?php

use App\DBContext\DBContextUser;
use App\Services\Framework\Contracts\ISeed;
use App\Services\Framework\Services\Database\Models\Seed;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/** @noinspection PhpUnused */
class UserTableSeed extends Seed implements ISeed
{
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function seed(): void
    {
        $this->createUser(
            'admin',
            '123'
        );
    }

    /**
     * @param string $userName
     * @param string $password
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function createUser(string $userName, string $password): void
    {
        $exists = $this->checkExists($userName);
        if ($exists){
            return;
        }

        $context = new DBContextUser();
        $context->setUserName($userName);
        $context->setPassword($password);
        $context->save();
    }

    /**
     * @param string $userName
     * @return bool
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    private function checkExists(string $userName): bool {
        $query = DBContextUser::builder()
            ->select('COUNT(t.id) as count')
            ->where('t.username = :username')
            ->setParameter('username', $userName)
            ->getQuery()
            ->getSingleResult();

        $count = (int) $query['count'];
        return $count === 0 ? false : true;
    }
}