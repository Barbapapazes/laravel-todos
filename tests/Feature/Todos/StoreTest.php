<?

it('stores a todo', function () {
    $todoName = 'New Todo';

    $this->post('/todos', [
        'name' => $todoName,
    ]);

    $this->assertDatabaseHas('todos', [
        'name' => $todoName,
    ]);
});

it('requires valid name', function ($name) {
    $response = $this->post('/todos', [
        'name' => $name,
    ]);

    $response->assertSessionHasErrors('name');
})->with([
    ['name' => ''],
    ['name' => null],
    ['name' => str_repeat('a', 256)],
]);

it('redirects to the index page', function () {
    $response = $this->post('/todos', [
        'name' => 'New Todo',
    ]);

    $response->assertRedirect('/todos');
});
