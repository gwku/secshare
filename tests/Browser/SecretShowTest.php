<?php

use App\Models\Secret;
use Laravel\Dusk\Browser;

test('secrets.show.invalid_signature', function () {
    $secret = Secret::factory()->create([
        'views' => 0,
        'max_views' => 5,
    ]);

    $this->browse(function (Browser $browser) use ($secret) {
        $browser->visit(route('secrets.show', ['secret' => $secret->token]))
            ->assertSee('403');
    });
});

test('secrets.show.valid_secret', function () {
    $secret = Secret::factory()->create([
        'content' => 'This is a test secret',
        'views' => 0,
        'max_views' => 5,
        'expires_at' => now()->addDays(1),
    ]);

    $url = URL::temporarySignedRoute('secrets.show', now()->addMinutes(5), ['secret' => $secret->token], false);

    $this->browse(function (Browser $browser) use ($secret, $url) {
        $browser->visit($url)
            ->assertSee($secret->expires_at->diffForHumans())
            ->assertSee(($secret->max_views - 1) . ' left');

        $this->assertDatabaseHas('secrets', [
            'token' => $secret->token,
            'views' => 1,
        ]);
    });
});

test('secrets.show.final_view', function () {
    $secret = Secret::factory()->create([
        'content' => 'This is a test secret',
        'views' => 4,
        'max_views' => 5,
    ]);

    $url = URL::temporarySignedRoute('secrets.show', now()->addMinutes(5), ['secret' => $secret->token], false);

    $this->browse(function (Browser $browser) use ($secret, $url) {
        $browser->visit($url)
            ->assertSee('0 left');

        $this->assertDatabaseMissing('secrets', ['id' => $secret->token]);
    });
});

test('secrets.show.max_views_exceeded', function () {
    $secret = Secret::factory()->create([
        'content' => 'This is a test secret',
        'views' => 5,
        'max_views' => 5,
    ]);

    $url = URL::temporarySignedRoute('secrets.show', now()->addMinutes(5), ['secret' => $secret->token], false);

    $this->browse(function (Browser $browser) use ($secret, $url) {
        $browser->visit($url);
        $browser->visit($url)->assertSee('404');
    });
});

