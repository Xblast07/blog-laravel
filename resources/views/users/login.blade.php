@extends('layout')

@section('title', 'Connexion')

@section('content')
    <h1>Connexion</h1>
    
    <form action="{{ route('users.authenticate') }}" method="post">
        @csrf
        
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input value="{{ old('username') }}" type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-2">
            <button class="btn btn-primary">Se connecter</button>
        </div>
    </form>
@endsection