<?php declare(strict_types=1);

// validates and sends commands to rover
class Commander
{
    const string MOVE_REGEX = '/^(F|L|R)+$/';

    private Rover $rover;

    public function __construct(Rover $rover)
    {
        $this->rover = $rover;
    }

    public function send(string $command): void
    {
        if (!preg_match(self::MOVE_REGEX, $command)) {
            throw new InvalidCommandException('Invalid move command');
        }

        $this->rover->move($command);
    }
}