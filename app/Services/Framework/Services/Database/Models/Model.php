<?php


namespace App\Services\Framework\Services\Database\Models;

use App\Services\Framework\Contracts\IModel;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;

abstract class Model implements IModel
{
    private static function getManager(): EntityManager
    {
        return app()->getDatabaseService()->getEntityManager();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(): IModel
    {
        $manager = $this->getManager();
        $manager->persist($this);
        $this->flush();
        return $this;
    }

    /**
     * @return IModel
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function flush(): IModel
    {
        $manager = $this->getManager();
        $manager->flush();
        return $this;
    }

    private static function getRepository(): EntityRepository
    {
        $manager = self::getManager();
        return $manager->getRepository(static::class);
    }

    public static function get(): array
    {
        $repository = self::getRepository();
        return $repository->findAll();
    }

    public static function find(int $id): ?IModel
    {
        $repository = self::getRepository();
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $repository->find($id);
    }

    public static function builder(): QueryBuilder
    {
        $repository = self::getRepository();
        return $repository->createQueryBuilder('t');
    }
}