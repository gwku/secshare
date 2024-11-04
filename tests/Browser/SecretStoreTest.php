<?php

use Facebook\WebDriver\Exception\TimeoutException;
use Laravel\Dusk\Browser;


test('secrets.store.correct_data', function () {
    $this->browse(/**
     * @throws TimeoutException
     */ function (Browser $browser) {

        $content = 'This is a test secret';
        $expiresIn = 12;
        $maxViews = 5;

        $browser
            ->visit(route('secrets.create'))
            ->type('content', $content)
            ->select('expires_in', $expiresIn)
            ->type('max_views', $maxViews)
            ->press(__('secrets.create.create'))
            ->waitForText(__('secrets.link.share'))
            ->assertPathIs('/secrets')
            ->assertSee(__('secrets.link.expires_in'))
            ->assertSee(__('secrets.link.max_views'))
            ->assertSee(__('secrets.link.revoke_token'));

        // Verify that the created secret data is stored correctly in the database.
        $this->assertDatabaseHas('secrets', [
            'expires_at' => now('UTC')->addHours($expiresIn),
            'max_views' => $maxViews,
        ]);
    });
});

test('secrets.store.invalid_data', function () {
    $this->browse(function (Browser $browser) {

        // Case 1: Empty content
        $browser
            ->visit(route('secrets.create'))
            ->type('content', '')
            ->select('expires_in', 12)
            ->type('max_views', 5)
            ->press(__('secrets.create.create'))
            ->waitForText(__('validation.required', ['attribute' => 'content']))
            ->assertSee(__('validation.required', ['attribute' => 'content']));

        // Case 2: Max views above the allowed limit
        $browser
            ->visit(route('secrets.create'))
            ->type('content', 'This is a test secret')
            ->select('expires_in', 12)
            ->type('max_views', 16)
            ->press(__('secrets.create.create'))
            ->waitForText(str_replace('_',' ',__('validation.max.numeric', ['attribute' => 'max_views', 'max' => 15])))
            ->assertSee(str_replace('_',' ',__('validation.max.numeric', ['attribute' => 'max_views', 'max' => 15])));
    });
});
