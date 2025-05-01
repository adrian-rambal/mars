<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class RoverTest extends TestCase
{   
    public function setUp(): void
    {
        error_reporting(E_ALL);
    }

    public static function commandProvider(): array
    {
        return [
            'R' => ["R", "right"],
            'L' => ["L", "left"],
            'F' => ["F", "forward"]
        ];
    }

    #[DataProvider('commandProvider')]
    public function testCommandShouldMoveTheRover(string $command, string $method): void
    {
        $mover = $this->createMock(Mover::class);
        $mover->expects($this->once())
        ->method($method)
        ->willReturn(new ImmutableTuple(1,2));

        $obstacleDetector = $this->createMock(ObstacleDetector::class);
        $obstacleDetector->expects($this->once())
        ->method("at")
        ->with($this->identicalTo(1,2))
        ->willReturn(false);

        $rover = new Rover(1,1,$mover, $obstacleDetector);

        $rover->move($command);
    }

    public function testCommandShouldNotMoveTheRoverIfObstacleAhead(): void
    {   
        $this->expectException(ObstacleFoundException::class);
        $this->expectExceptionMessage("x:1 y:2");
        
        $mover = $this->createMock(Mover::class);
        $mover->expects($this->once())
        ->method("forward")
        ->willReturn(new ImmutableTuple(1,2));

        $obstacleDetector = $this->createMock(ObstacleDetector::class);
        $obstacleDetector->expects($this->once())
        ->method("at")
        ->willReturn(true);

        $rover = new Rover(1,1,$mover, $obstacleDetector);

        $rover->move("F");
    }
}