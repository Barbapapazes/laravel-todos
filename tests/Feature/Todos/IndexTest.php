<?

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Pagination\LengthAwarePaginator;

it('should return the correct view', function () {
    $response = $this->get('/todos');

    $response->assertViewIs('todos.index');
});

it('should return paginated per 10 todos', function () {
    $todos = Todo::factory(3)->create();

    $response = $this->get('/todos');

    $response->assertViewHas('todos', function (LengthAwarePaginator $paginatedData) use ($todos) {
        return collect($paginatedData->items())->pluck('name')->diff($todos->pluck('name'))->isEmpty() && $paginatedData->perPage() === 10;
    });
});

it('renders the list of todos', function () {
    $todos = Todo::factory(3)->create();

    $response = $this->get('/todos');

    $response->assertSeeInOrder($todos->pluck('name')->toArray());
});

it('orders the todos by the latest', function () {
    $todos = Todo::factory(3)
        ->state(new Sequence(
            ['created_at' => now()->subDay()],
            ['created_at' => now()],
        ))
        ->create();


    $response = $this->get('/todos');

    $response->assertSeeInOrder($todos->sortByDesc('created_at')->pluck('name')->toArray());
});

it('has the correct title', function () {
    $response = $this->get('/todos');

    $response->assertSee('Todos');
});
