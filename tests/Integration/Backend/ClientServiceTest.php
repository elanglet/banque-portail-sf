<?php

namespace App\Tests\Integration\Backend;

use PHPUnit\Framework\TestCase;
use App\Backend\ClientService;
use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use function PHPUnit\Framework\assertEquals;

class ClientServiceTest extends KernelTestCase
{
    private static $cnx;
    
    private $clientService;
    
    private $client;

    public static function setUpBeforeClass(): void
    {
        self::$cnx = new \PDO('mysql:host=localhost;port=3306;dbname=banquesf_test', 'banquesf', 'banquesf');
    }

    public function setUp(): void
    {
        self::$cnx->exec(file_get_contents('tests/scripts/init.sql'));
        
        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()->get('doctrine')->getManager();
        
        $this->clientService = new ClientService($entityManager);
    }

    public function tearDown(): void
    {
        self::$cnx->exec(file_get_contents('tests/scripts/clean.sql'));
    }
    
    public function testAjouterClient(): void
    {
        $this->client = new Client();
        $this->client->setNom("DUPONT");
        $this->client->setPrenom("Robert");
        $this->client->setAdresse("40 rue de la Paix");
        $this->client->setCodepostal("75005");
        $this->client->setVille("Paris");
        $this->client->setMotdepasse("secret");
        
        $this->clientService->ajouterClient($this->client);
        
    }
    
    public function testRechercherClientParId(): void 
    {
        $client = $this->clientService->rechercherClientParId(1);
        assertEquals("DUPONT", $client->getNom());
    }
}
