@extends('layouts.app')


@section('content')

<h2> Section Edit </h2>

@forelse($categories as $categorie)
    
    
    <form action="{{ route('admin.categories.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="row mb-3">
            <label for="category_name" class="col-md-4 col-form-label text-md-end">{{ __('Category Name') }}</label>
                <div class="col-md-6">
                    <input id="category_name" type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ old('category_name') }}" required autocomplete="category_name" autofocus>
                </div>
        </div>

        @error('category_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span> 
        @enderror

        <div class="row mb-3">
            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                <div class="col-md-6">
                    <input id="description" type="text" class="form-control @error('username') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>
                </div>
        </div>

        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span> 
        @enderror

        <div class="row mb-3">
            <label for="image-upload" class="col-md-4 col-form-label text-md-end">{{ __('Category Image') }}</label>
            <input type="file" id="category_image" class="category_image" name="category_image" >
        </div>

        @error('category_image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span> 
        @enderror

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('CREATE') }}
                </button>
            </div>
        </div>

    </form>

@endforelse

@endsection
