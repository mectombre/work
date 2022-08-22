@extends('/layout/simpleLayout')

@section('main')

    <h1 class="text-center">bienvenu</h1>

    <form id="choose" action="acceuil" method="post">
        {{ csrf_field() }}
        <select name="cat" id="cat">

            <?php

            use App\Models\Categorie;
            $result =Categorie::get('name');

            //dump($result);
            //dump($result[0]->name);
            //print_r($sth);

            $i=0;
            foreach($result as $data) {
                echo '<option>'.$result[$i]->name.'</option>';
                $i+=1;}
            ?>

        </select>
        <input type="submit" value="choose"/>
    </form>

    <main>
        <div id="carousel">
            @foreach($var as $var)
                <span><p>{{$var->name}}:</p></span>

                <?php
                $image= $var->thumbnail;
                //dump($image);
                $encodeimg= base64_encode($image);
                echo "<span><img height='300px' src='data:image/jpeg;base64,{$encodeimg}'></span>";
                ?>
            @endforeach
            <span>1</span>
            <span>2</span>

        </div>
    </main>

@endsection

