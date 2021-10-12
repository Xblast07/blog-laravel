@extends('layout')

@section('title', 'Créer un nouvel article')

@section('content')
    <h1>Créer un nouvel article</h1>
    
    <form action="{{ route('posts.store') }}" method="post">
        @csrf
        
        @if($errors->any())
            <aside class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </aside>
        @endif
        
        <div class="form-group">
            <label for="title">Titre</label>
            <input value="{{ old('title') }}" type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Article</label>
            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" cols="30" rows="10">{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="categories">Catégories</label>
            <select multiple name="categories[]" id="categories" class="form-control @error('content') is-invalid @enderror">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('categories')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <button class="btn btn-primary">Ajouter</button>
        </div>
    </form>
@endsection