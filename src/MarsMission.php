<?php declare(strict_types=1);

class MarsMission
{   
    private int $x;
    private int $y;
    private int $degrees;
    private Commander $commander;

    public function __construct(int $x, int $y, string $direction)
    {
        $this->x=$x;
        $this->y=$y;
        $this->degrees=$this->toDegrees($direction);
    }

    public function getCommander() : Commander {
        if (!isset($this->commander)) {
            $this->commander = new Commander($this->buildRover());
        }
        return $this->commander;
    }

    private function buildRover() : Rover 
    {
        $physicalMover = new Mover(new Vehicle($this->degrees));

        return new Rover($this->x, $this->y, $physicalMover, new WorstObstacleDetector());
    }

    private function toDegrees(string $direction) : int {
        return match ($direction) {
            'N' => 0,
            'S' => 180,
            'E' => 90,
            'W' => 270,
            default => throw new InvalidArgumentException("Invalid direction"),
        };
    }
}
