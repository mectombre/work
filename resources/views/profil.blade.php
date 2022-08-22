@extends('/layout/simpleLayout')

@section('main')

    <p>bonjour: {{$util[0]->name}}</p>
    <p> vous etes connecté avec le mail: {{$util[0]->email}}</p>
@endsection
