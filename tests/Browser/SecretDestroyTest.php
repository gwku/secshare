<?php

use App\Models\Secret;
use Facebook\WebDriver\Exception\TimeoutException;
use Laravel\Dusk\Browser;


test('secrets.destroy.invalid_revoke_token', function () {
    $secret = Secret::factory()->create([
        'revoke_token' => Hash::make('correct-token'),
    ]);

    $this->browse(function (Browser $browser) use ($secret) {
        $browser->visit(route('secrets.edit', ['secret' => $secret->token]))
            ->type('revoke_token', 'incorrect-token')
            ->press(__('secrets.edit.revoke_btn'))
            ->assertRouteIs('secrets.edit', ['secret' => $secret->token])
            ->assertSee(__('secrets.edit.invalid_revoke_token'));
    });
});

test('secrets.destroy.valid_revoke_token', function () {
    $secret = Secret::factory()->create([
        'revoke_token' => Hash::make('correct-token'),
    ]);

    $this->browse(function (Browser $browser) use ($secret) {
        $browser->visit(route('secrets.edit', ['secret' => $secret->token]))
            ->type('revoke_token', 'correct-token')
            ->press(__('secrets.edit.revoke_btn'))
            ->assertRouteIs('secrets.create')
            ->assertSee(__('secrets.edit.revoke_success'));

        $this->assertDatabaseMissing('secrets', ['id' => $secret->id]);
    });
});
