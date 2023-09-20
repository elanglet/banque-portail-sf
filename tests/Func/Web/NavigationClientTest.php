<?php

namespace App\Tests\Func\Web;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class NavigationClientTest extends TestCase
{
    
    private $webDriver;
    private $baseUrl;
    
    public function setUp(): void
    {
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444', DesiredCapabilities::firefox());
        $this->baseUrl = "http://www.thatsiteundertest.com";
    }
    
    public function tearDown(): void
    {
        $this->webDriver->quit();
    }
    
    public function testStatsPage(): void
    {
        $this->webDriver->get($this->baseUrl . "/stats");
        
        $this->webDriver->findElement(WebDriverBy::id('loadajax'))->click();
        
        assertEquals(
            "This text should be present on the page",
            $this->webDriver->findElement(WebDriverBy::cssSelector('#ajaxdiv > p'))->getText()
        );
    }
}
