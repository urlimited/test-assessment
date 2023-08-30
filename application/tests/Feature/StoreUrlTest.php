<?php

namespace Tests\Feature;

use App\Actions\Urls\CreateUrlAction;
use App\Models\Url;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @desription Store the Url with specific data \
 *    Covered scenarios: \
 *      1.  Successfully store url
 * @covers \App\Http\Controllers\UrlController::store
 */
class StoreUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_url_successfully_created(): void
    {
        // 1. Initialization and mocking
        $user = User::factory()->createOne();

        $mockedAction = $this->createMock(CreateUrlAction::class);

        $mockedSlug = 'mockedSlug';
        $mockedDestination = 'https://google.com';

        $mockedAction->method('handle')
            ->willReturn(Url::factory()->createOne([
                'destination' => $mockedDestination,
                'slug' => $mockedSlug,
                'views' => 0
            ]));

        $this->app->instance(CreateUrlAction::class, $mockedAction);

        $requestData = [
            'destination' => $mockedDestination
        ];

        // 2.Scenarios run
        $response = $this
            ->actingAs($user)
            ->postJson(route('urls.store'), $requestData);

        // 3. Assertions

        // 3.1 Assert that response should be successful and should contain the expected data.
        $response->assertStatus(201)
            ->assertJson([
                'destination' => $mockedDestination,
                'slug' => $mockedSlug,
                'shortened_url' => config('url_shortening.base_url') . '/' . $mockedSlug
            ]);
    }
}
