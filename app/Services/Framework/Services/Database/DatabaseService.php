<?php


namespace App\Services\Framework\Services\Database;

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
        foreach (glob(base_path() . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'seeds'. DIRECTORY_SEPARATOR. '*.php') as $file) {
            $class = $this->resolveClass($file);
            $seed = $this->getSeed($class);
            $seed->run();
        }
    }

    private function getSeed(string $class): ISeed
    {
        return new $class;
    }

    private function resolveClass(string $file): string
    {
        /** @noinspection PhpIncludeInspection */
        require_once $file;
        $classes = get_declared_classes();
        return end($classes);
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