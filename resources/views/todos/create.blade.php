<form action="/todos" method="post">
    @csrf

    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="{{ old('name') }}">
    @error('name')
    <p>{{ $message }}</p>
    @enderror
    <button type="submit">Create</button>
</form>
