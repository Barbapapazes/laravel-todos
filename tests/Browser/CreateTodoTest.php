<?php

use Laravel\Dusk\Browser;

test('Create a Todo', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/todos/create')
            ->type('name', 'My first todo')
            ->press('Create')
            ->assertPathIs('/todos')
            ->assertSee('My first todo');
    });
});
