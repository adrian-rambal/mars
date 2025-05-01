<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class MoverTest extends TestCase
{   
    public function setUp(): void
    {
        error_reporting(E_ALL);
    }

    public function testShouldMoveRight(): void
    {
        $vehicle = $this->createMock(Vehicle::class);
        $vehicle->expects($this->once())
                ->method('turnRight');
        $vehicle->method('getDegrees')
                ->willReturn(90);

        $mover = new Mover($vehicle);
        $position = $mover->right(1,1);

        $this->assertSame(1, $position->x);
        $this->assertSame(2, $position->y);
    }

    public function testShouldMoveLeft(): void 
    {
        $vehicle = $this->createMock(Vehicle::class);
        $vehicle->expects($this->once())
                ->method('turnLeft');
        $vehicle->method('getDegrees')
                ->willReturn(-90);

        $mover = new Mover($vehicle);
        $position = $mover->left(1,1);

        $this->assertSame(1, $position->x);
        $this->assertSame(0, $position->y);
    }

    public static function moveForwardProvider(): array
    {
        return [
            'facing 0 deg'      => [0, 0, 1],
            'facing 90 deg'     => [90, 1, 2],
            'facing 180 deg'    => [180, 2, 1],
            'facing 270 deg'    => [270, 1, 0],
        ];
    }

    #[DataProvider('moveForwardProvider')]
    public function testShouldMoveForward(int $facingDegrees, int $x, int $y): void 
    {
        $vehicle = $this->createMock(Vehicle::class);
        $vehicle->method('getDegrees')
                ->willReturn($facingDegrees);

        $mover = new Mover($vehicle);
        $position = $mover->forward(1,1);

        $this->assertSame($x, $position->x);
        $this->assertSame($y, $position->y);
    }
}