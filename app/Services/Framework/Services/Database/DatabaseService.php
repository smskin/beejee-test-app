<?php


namespace App\Services\Framework\Services\Database;

use App\Seeds\Kernel;
use App\Services\Framework\Contracts\IDatabaseService;
use App\Services\Framework\Contracts\ISeed;
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

    public function runSeeds(): void
    {
        $seeds = Kernel::$seeds;
        foreach ($seeds as $class){
            $seed = $this->getSeed($class);
            $seed->run();
        }
    }

    private function getSeed(string $class): ISeed
    {
        return new $class;
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
            app_path('DBContext')
        ];
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => fix_path(base_path().'/storage/framework/db/db.sqlite'),
        );
        $this->entityManager = EntityManager::create($conn, $config);
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}