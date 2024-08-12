<h1>Todos</h1>

<ul>
    @foreach($todos as $todo)
    <li>{{ $todo->name }}</li>
    @endforeach
</ul>

{{ $todos->links() }}
