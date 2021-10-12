@extends('layout')

@section('title', 'Inscription')

@section('content')
    <h1>Inscription</h1>
    
    <form action="{{ route('users.store') }}" method="post">
        @csrf
        
        <div class="form-group">
            <label for="email">Email</label>
            <input value="{{ old('email') }}" type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
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
        <div class="form-group">
            <label for="password-confirmation">Confirmation du mot de passe</label>
            <input type="password" name="password_confirmation" id="password-confirmation" class="form-control">
        </div>
        <div class="mt-2">
            <button class="btn btn-primary">S'inscrire</button>
        </div>
    </form>
@endsection