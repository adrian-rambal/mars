<?php declare(strict_types=1);

class Rover
{
    private Mover $mover;

    private ObstacleDetector $obstacle;
    private int $x;
    private int $y;

    public function __construct(int $x, int $y, Mover $mover, ObstacleDetector $obstacle)
    {
        $this->mover = $mover;
        $this->x = $x;
        $this->y = $y;
        $this->obstacle = $obstacle;
    }

    public function move(string $command): void {
        foreach (str_split($command) as $instruction) {
            $nextPosition = $this->moveWith($instruction);
            
            $x = $nextPosition->x;
            $y = $nextPosition->y;
            if ($this->obstacle->at($x, $y)) {
                throw new ObstacleFoundException("x:{$x} y:{$y}");
            }

            $this->setPosition($nextPosition);
        }
    }



    private function setPosition($tuple) : void{
        $this->x = $tuple->x;
        $this->y = $tuple->y;
    }

    private function moveWith($instruction) : ImmutableTuple {
        return match ($instruction) {
            "F" => $this->mover->forward($this->x, $this->y),
            "L" => $this->mover->left($this->x, $this->y),
            "R" => $this->mover->right($this->x, $this->y)
        };
    }
}