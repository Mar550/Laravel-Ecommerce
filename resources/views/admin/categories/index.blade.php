@extends('layouts.app')


@section('content')

<h2> Section index </h2>

@if(Session::has('message'))
<div class="message">
    <p> {{ Session::get('message') }} </p>
</div>
@endif

<div class="table-resposive">
    <table class="table table-hover table-condensed">
        <theadc class="thead-primary"> </thead>
        <tr>
            <th> ID </th>
            <th> Category name</th>
            <th> Description</th>
            <th> Image </th>
            <th> Number of attached products </th>
            <th> Actions </th>
        </tr>
        <tbody>
            

            @forelse($categories as $categorie)
    
            <tr>
                <th scope="row" class="scope"> {{ $categorie->id }} </th>
                <td> {{ $categorie->category_name }} </td>
                <td> {{ $categorie->description }} </td>
                <td> <img width="100" height="100" src="{{ Storage::url($categorie->category_image) }}" alt=""/> </td>
                <td> {{ $categorie->products_count }}</td>
                <td> 
                    <a class="btn btn-primary" href="{{ route('admin.categories.show', $categorie->id)}}"> Show category </a>
                    <a class="btn btn-primary" href="{{ route(('admin.categories.edit'))}}"> Edit </a>
                    <form method="POST" action="{{ route('admin.categories.delete', $categorie->id) }}">
                        @method('DELETE')
                        @csrf
                        
                        <input type="submit" class="btn btn-danger" value="DELETE"/>
                    </form>
                </td>
            </tr>
            @empty

            <tr>
                No Category Yet
            </tr>

            @endforelse
        </tbody>
    </table>

</div>
@endsection


