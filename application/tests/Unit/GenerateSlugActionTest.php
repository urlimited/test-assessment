<?php

namespace Tests\Unit;

use App\Actions\Urls\GenerateSlugAction;
use App\DTO\CreateUrlDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateSlugActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_generates_slug_from_given_dto(): void
    {
        // 1. Initialization and mocking
        $dto = new CreateUrlDTO(
            destination: 'https://example.com'
        );

        $action = new GenerateSlugAction();

        // 2.Scenarios run
        $slug = $action->handle($dto);

        // 3. Assertions

        // 3.1 Assert that action returned a value
        $this->assertNotNull($slug);

        // 3.2 Assert that the slug length is according to the config
        $this->assertEquals(config('url_shortening.url_length'), strlen($slug));

        // 3.3 Assert that slug used required charset
        $this->assertTrue(strspn($slug, config('url_shortening.url_charset')) == strlen($slug));
    }
}
