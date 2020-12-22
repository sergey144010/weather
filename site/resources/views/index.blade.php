<!DOCTYPE html>
<html>
<h1>VIEW</h1>

<form action="/" method="POST">
    @csrf
    <input name="date" type="text"/>
    <input type="submit" value="Send">
</form>
@if ($history)
    <h4>{{ $history->date }} : {{ $history->temp }}</h4>
@endif

@if ($error)
    <h4>Error: {{ $error }}</h4>
@endif

@foreach ($collection as $history)
    <li>{{ $history->date }} : {{ $history->temp }}</li>
@endforeach
</html>
