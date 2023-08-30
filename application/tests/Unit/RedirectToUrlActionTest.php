<?php

namespace Tests\Unit;

use App\Actions\Urls\RedirectToUrlAction;
use App\DTO\TransferToUrlDTO;
use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectToUrlActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_generates_slug_from_given_dto(): void
    {
        // 1. Initialization and mocking
        $url = Url::factory()->create();

        $initialViews = $url->getAttribute('views');

        // Create a DTO with the created URL model.
        $dto = new TransferToUrlDTO(
            url: $url
        );

        // 2.Scenarios run
        $action = new RedirectToUrlAction();
        $returnedDestination = $action->handle($dto);

        // 3. Assertions

        // 3.1 Assert that the views count was incremented.
        $this->assertEquals(
            $initialViews + 1,
            $url->fresh()->views
        );

        // 3.2 Assert that the returned destination is correct.
        $this->assertEquals($url->getAttribute('destination'), $returnedDestination);
    }
}
