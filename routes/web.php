<?php

use App\Models\Todo;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/todos');
});

Route::get('/todos', function () {
    return view('todos.index', [
        'todos' => Todo::latest()->paginate(10),
    ]);
});

Route::get('/todos/create', function () {
    return view('todos.create', [
        'todo' => new Todo(),
    ]);
});

Route::post('/todos', function () {
    Todo::create(request()->validate([
        'name' => ['required', 'max:255'],
    ]));

    return redirect('/todos');
});

Route::put('/todos/{todo}', function (Todo $todo) {
    $todo->update(request()->validate([
        'name' => ['required', 'max:255'],
    ]));

    return redirect('/todos');
});
