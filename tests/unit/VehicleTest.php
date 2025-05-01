<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class VehicleTest extends TestCase
{   
    public function setUp(): void
    {
        error_reporting(E_ALL);
    }

    public function testShouldDecrease90DegreesWhenLeft(): void
    {
        $vehicle = new Vehicle(0);
        
        $vehicle->turnLeft();
        
        $this->assertSame(-90, $vehicle->getDegrees());
    }

    public function testShouldResetDegreesTo0WhenLeftTurnYields360(): void
    {
        $vehicle = new Vehicle(-270);
        
        $vehicle->turnLeft();
        
        $this->assertSame(0, $vehicle->getDegrees());
    }

    public function testShouldIncrease90DegreesWhenRight(): void
    {
        $vehicle = new Vehicle(0);
        
        $vehicle->turnRight();
        
        $this->assertSame(90, $vehicle->getDegrees());
    }

    public function testShouldResetDegreesTo0WhenRightTurnYields360(): void
    {
        $vehicle = new Vehicle(270);
        
        $vehicle->turnRight();
        
        $this->assertSame(0, $vehicle->getDegrees());
    }
}