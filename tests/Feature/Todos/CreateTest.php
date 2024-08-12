<?php

use App\Models\Todo;

it('should return the correct view', function () {
    $response = $this->get('/todos/create');

    $response->assertViewIs('todos.create');
});

it('should return an empty todo', function () {
    $response = $this->get('/todos/create');

    $response->assertViewHas('todo', function (Todo $todo) {
        return $todo->name === null;
    });
});
