<?php declare(strict_types=1);

// dummy obstacle detector that always finds an obstacle at x 0
class WorstObstacleDetector implements ObstacleDetector
{
    public function at(int $x, int $y): bool
    {
        if ($x == 0) {
            return true;
        }
        
        return false;
    }
}