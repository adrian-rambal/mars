<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class CommanderTest extends TestCase
{
    public function setUp(): void
    {
        # Turn on error reporting
        error_reporting(E_ALL);
    }


    public function testShouldYieldTypeErrorWhenCommandIsNull(): void
    {
        $rover = $this->createMock(Rover::class);
        $commander = new Commander($rover);

        $rover->expects($this->never())
        ->method('move');

        $this->expectException(TypeError::class);

        $commander->send(null);
    }

    public static function invalidCommandProvider(): array
    {
        return [
            'empty'  => [''],
            'invalid' => ['INVALID'],
            'not capital letters' => ['frl'],
            'with whitespace in between the command'  => ['FRL FRL'],
            'with whitespace in before the command'  => [' FRL'],
            'with whitespace in after the command'  => ['FRL ']
        ];
    }

    #[DataProvider('invalidCommandProvider')]
    public function testShouldYieldInvalidWhenInvalidCommand(string $command): void
    {
        $rover = $this->createMock(Rover::class);
        $commander = new Commander($rover);

        $rover->expects($this->never())
        ->method('move');

        $this->expectException(InvalidCommandException::class);

        $commander->send($command);
    }

    public function testShouldSendInstructionsToRoverWhenValid() {
        $rover = $this->createMock(Rover::class);
        $commander = new Commander($rover);

        $rover->expects($this->once())
            ->method('move')
            ->with($this->identicalTo('FRL'));

        $commander->send('FRL');
    }
}