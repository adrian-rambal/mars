<?php declare(strict_types=1);

// moves the rover
class Mover
{   
    private Vehicle $vehicle;

    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    private function getDegrees() : int
    {
        return $this->vehicle->getDegrees();
    }

    public function right($x, $y) : ImmutableTuple 
    {
        $this->vehicle->turnRight();
        return $this->forward($x, $y);
    }

    public function left($x, $y) : ImmutableTuple 
    {
        $this->vehicle->turnLeft();
        return $this->forward($x, $y);
    }

    public function forward($x, $y) : ImmutableTuple
    {
        $rad = deg2rad($this->getDegrees());
        $deltaX = intval(cos($rad));
        $deltaY = intval(sin($rad));

        return new ImmutableTuple($x - $deltaX, $y + $deltaY);
    }
}