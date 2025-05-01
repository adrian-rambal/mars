<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class MoverITTest extends TestCase
{   
    public function setUp(): void
    {
        error_reporting(E_ALL);
    }

    public function testShouldMove(): void
    {
        $vehicle = new Vehicle(0);
        $mover = new Mover($vehicle);
        $position = $mover->right(1,1);

        $this->assertSame(1, $position->x);
        $this->assertSame(2, $position->y);
    }
}