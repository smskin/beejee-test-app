<?php


namespace App\Services\Framework\Services\Database;

use App\Services\Framework\Contracts\IDatabaseService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

class DatabaseService implements IDatabaseService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * DatabaseService constructor.
     * @throws ORMException
     */
    public function __construct(){
        $this->prepareEntityManager();
    }


    /**
     * @throws ORMException
     */
    private function prepareEntityManager(): void
    {
        $isDevMode = true;
        $proxyDir = '';
        $cache = null;
        $useSimpleAnnotationReader = false;
        $paths = [
            app_path().DIRECTORY_SEPARATOR.'DBContext'
        ];
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => base_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR.'db'. DIRECTORY_SEPARATOR. 'db.sqlite',
        );
        $this->entityManager = EntityManager::create($conn, $config);
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}