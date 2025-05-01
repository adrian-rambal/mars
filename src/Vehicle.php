<?php declare(strict_types=1);

// turns the rover
class Vehicle
{   
    const int TURN = 90;

    private int $degrees; // vehicle orientation

    public function __construct(int $degrees)
    {
        $this->degrees = $degrees;
    }

    public function turnLeft() : void {
        $this->degrees -= self::TURN;
        $this->resetDegrees();
    }

    public function getDegrees() : int {
        return $this->degrees;
    }

    public function turnRight() : void {
        $this->degrees += self::TURN;
        $this->resetDegrees();
    }

    private function resetDegrees() : void {
        if (abs($this->degrees) >= 360) {
            $this->degrees %= 360;
        }
    }
}