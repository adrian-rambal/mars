<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class RoverITTest extends TestCase
{   
    private function build() : Rover
    {
        $physicalMover = new Mover(new Vehicle(0));
    
        return new Rover(1,1,$physicalMover, new WorstObstacleDetector());
    
    }
  
    public function setUp(): void
    {
        error_reporting(E_ALL);
    }

    public function testShouldReportObstacle(): void
    {
        $this->expectException(ObstacleFoundException::class);
        $this->expectExceptionMessage("x:0 y:1");

        $rover = $this->build();
        $rover->move("F");
    }


    public function testShouldReportSameObstacleMoreThanOnce() {
        $rover = $this->build();
        
        try {
            $rover->move("F");
        } catch (ObstacleFoundException $e) {
           $this->assertSame("x:0 y:1", $e->getMessage());
        }
 
        try {
            $rover->move("F");
        } catch (ObstacleFoundException $e) {
           $this->assertSame("x:0 y:1", $e->getMessage());
        }
    }

    public function testShouldMoveAfterObstacleReport() {
        $rover = $this->build();
        
        try {
            $rover->move("F");
        } catch (ObstacleFoundException $e) {
           $this->assertSame("x:0 y:1", $e->getMessage());
        }
 
        $rover->move("R");

        try {
            $rover->move("F");
        } catch (ObstacleFoundException $e) {
           $this->assertSame("x:0 y:2", $e->getMessage());
        }
    
    }
}