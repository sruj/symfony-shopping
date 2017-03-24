<?php
namespace Tests\AppBundle\Integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntegrationAbstract extends KernelTestCase
{
    protected static $em;

    public static function setUpBeforeClass()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        static::$kernel = $kernel;

        static::$em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    public static function tearDownAfterClass()
    {
        static::$em->close();
    }
}