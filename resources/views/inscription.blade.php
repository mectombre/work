@extends('/layout/simpleLayout')

@section('main')
    <form method="POST">
        {{ csrf_field() }}
        <p><input name="username" placeholder="username"></p>

        @if($errors->has('username'))
            <h4 class="h5">{{$errors->first('username')}}</h4>
        @endif

        <p><input  type="email"  name="email" placeholder="mail"></p>

        @if($errors->has('email'))
            <h4 class="h5">{{$errors->first('email')}}</h4>
        @endif


        <p><input type="password" name="password" placeholder="mdp" ></p>

        @if($errors->has('password'))
            <h5> {{ $errors->first('password')}}</h5>
        @endif

        <p> <input type="submit" value="inscription"></p>
    </form>
@endsection
