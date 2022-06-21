@extends('layouts.app')


@section('content')

<h2> Section Show </h2>


<div>
    <p>
        {{$categorie->category_name}}
    </p>
    <p>
        {{$categorie->description}}
    </p>
    <p>
        @foreach($product as $produit)

        {{$produit->product_name}}

        @endforeach
    </p>
</div>

@endsection


