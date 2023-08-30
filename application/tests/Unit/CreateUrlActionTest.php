<?php

namespace Tests\Unit;

use App\Actions\Urls\CreateUrlAction;
use App\Actions\Urls\GenerateSlugAction;
use App\DTO\CreateUrlDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @desription Creates URL with random generated slug \
 *    Covered scenarios: \
 *      1.  Successfully creates a url
 * @covers \App\Actions\Urls\CreateUrlAction::handle
 */
class CreateUrlActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_create_a_url(): void
    {
        // 1. Initialization and mocking
        $mockedSlugValue = 'mockedSlug';

        $mockedSlugGenerator = $this->mock(GenerateSlugAction::class);

        $mockedSlugGenerator->shouldReceive('handle')
            ->once()
            ->andReturn($mockedSlugValue);

        $dtoData = [
            'destination' => 'https://google.com'
        ];

        $dto = new CreateUrlDTO(
            destination: $dtoData['destination']
        );

        // 2.Scenarios run

        /** @var CreateUrlAction $action */
        $action = app(CreateUrlAction::class);

        $action->handle($dto);

        // 3. Assertions

        // 3.1 Assert that action is stored in DB
        $this->assertDatabaseHas(
            'urls',
            [
                'destination' => $dtoData['destination'],
                'slug' => $mockedSlugValue
            ]
        );
    }
}
