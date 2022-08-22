@extends('/layout/simpleLayout')

@section('main')
    <form method="POST">
        {{ csrf_field() }}
        <p><input name="username" placeholder="username" value="@if($a = !"e"){$a[0]->name}@endif"></p>

        @if($errors->has('username'))
            <h4 class="h5">{{$errors->first('username')}}</h4>
        @endif

        <p><input  type="email"  name="email" placeholder="mail" value="@if($a = !"e"){$a[0]->email}@endif"></p>

        @if($errors->has('email'))
            <h4 class="h5">{{$errors->first('email')}}</h4>
        @endif

        <p><input  type="text"  name="text" placeholder="ecrivez votre demande"></p>

        @if($errors->has('email'))
            <h4 class="h5">{{$errors->first('email')}}</h4>
        @endif
        <p> <input id="bt" type="submit" value="envoyé"></p>
    </form>
    <a href="/deco" class="badge">deco</a>
@endsection
