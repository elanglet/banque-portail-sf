<?php

namespace App\Tests\Unit\Backend;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;
use App\Backend\ClientService;
use App\Entity\Client;

class ClientServiceUnitTest extends TestCase
{
    private $clientService;
    
    private $entityManager;
    private $repo;
    
    public function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->repo = $this->createMock(ObjectRepository::class);
    }
    
    public function testAjouterClient(): void
    {
        $client = new Client();
        
        $this->clientService = new ClientService($this->entityManager);
        
        $this->entityManager->expects($this->once())
             ->method('persist')
             ->with($client);
        
        $this->entityManager->expects($this->once())
             ->method('flush');
        
        $this->clientService->ajouterClient($client);
    }
    
//     public function testModifierClient(): void
//     {

//     }
    
//     public function testSupprimerClient(): void
//     {

//     }
    
//     public function testRechercherTousLesClients(): void
//     {

//     }
    
    public function testRechercherClientParId(): void
    {
        $client = new Client();
        $client->setId(1);
        
        $this->clientService = new ClientService($this->entityManager);
        
        $this->entityManager->expects($this->any())
        ->method('getRepository')
        ->willReturn($this->repo);
        
        $this->repo->expects($this->any())
                   ->method('find')
                   ->with(1)
                   ->willReturn($client);
        
        $returnedClient = $this->clientService->rechercherClientParId(1);
        
        $this->assertSame($client, $returnedClient);
    }
    
//     public function testRechercherClientsParNomEtPrenom(): void
//     {

//     }
}
