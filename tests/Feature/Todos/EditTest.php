<?

use App\Models\Todo;

it('updates a todo', function () {
    $todo = Todo::factory()->create();

    $response = $this->put("/todos/{$todo->id}", [
        'name' => 'Updated Todo',
    ]);

    $this->assertDatabaseHas('todos', [
        'name' => 'Updated Todo',
    ]);
});

it('requires valid name', function ($name) {
    $todo = Todo::factory()->create();

    $response = $this->put("/todos/{$todo->id}", [
        'name' => $name,
    ]);

    $response->assertSessionHasErrors('name');
})->with([
    ['name' => ''],
    ['name' => null],
    ['name' => str_repeat('a', 256)],
]);

it('redirects to the index page', function () {
    $todo = Todo::factory()->create();

    $response = $this->put("/todos/{$todo->id}", [
        'name' => 'Updated Todo',
    ]);

    $response->assertRedirect('/todos');
});
