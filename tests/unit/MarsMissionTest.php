<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class MarsMissionTest extends TestCase
{   
    public function setUp(): void
    {
        error_reporting(E_ALL);
    }

    public static function invalidDirection(): array
    {
        return [
            'empty'  => [''],
            'invalid' => ['INVALID'],
        ];
    }

    #[DataProvider('invalidDirection')]
    public function testShouldYieldErrorOnInvalidDirection($direction): void
    {
        $this->expectException(InvalidArgumentException::class);
        $mission = new MarsMission(0,0,$direction);
    }

    public static function validDirection(): array
    {
        return [
            'N'  => ['N'],
            'S' => ['S'],
            'E' => ['E'],
            'W' => ['W'],
        ];
    }
    
    #[DataProvider('validDirection')]
    public function testShouldGetCommander($direction): void
    {
        $mission = new MarsMission(0,0,$direction);
        $this->assertNotNull($mission->getCommander());
    }

    public function testShouldSendCommandsToRover() {
        $this->expectException(ObstacleFoundException::class);
        $this->expectExceptionMessage("x:0 y:1");

        $mission = new MarsMission(1,1,"N");
        $commander = $mission->getCommander();
        $commander->execute("F");
    }
}