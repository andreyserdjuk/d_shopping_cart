<?php
use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\Tools\Setup;

require 'vendor/autoload.php';

Class Doctrine
{
    /**
     * @param array $connectionOptions
     *    ['driver'      => 'pdo_mysql',
     *     'user'        => 'user_name'
     *     'password'    => 'secret'
     *     'host'        => 'some host'
     *     'dbname'      => 'my_db'
     *     'charset'     => 'UTF-8'
     *     'driverOptions' => array(1002=>'SET NAMES UTF-8)]
     */
    public function __construct($connectionOptions) {
        
        require APP_PATH . 'config'. DIRECTORY_SEPARATOR .'database.php';
        
        /**
         * Autogenerate proxy classes, if TRUE.
         * Try to find cache (Apc, Memcached, Redis), if FALSE.
         */
        $isDevMode = ENVIRONMENT == 'development';

        // setup loaders
        $entitiesClassLoader = new \Doctrine\Common\ClassLoader('models', rtrim(APP_PATH, '/'));
        $entitiesClassLoader->register();

        // create configuration
        $proxiesDir = APP_PATH . 'models'. DIRECTORY_SEPARATOR .'proxies';
        $metadataPaths = array(APP_PATH . 'models');
        // vendor/doctrine/orm/lib/Doctrine/ORM/Tools/Setup.php
        $config = Setup::createAnnotationMetadataConfiguration($metadataPaths, $isDevMode, $proxiesDir, null, true);
        $config->setAutoGenerateProxyClasses(false);

         // SQL query logger
        // if (ENVIRONMENT != 'production') {
        //     $logger = new MyPreferedSQLLogger;
        //     $config->setSQLLogger($logger);
        // }
 
        // Create EntityManager
        $this->em = EntityManager::create($connectionOptions, $config);
    }
}