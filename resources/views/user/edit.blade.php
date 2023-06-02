@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card ">
                <div class="card-body">
                    <h4 class="card-title">Modifier votre profil</h4>
                    <hr>
                    <div class="col">
                        <form class="form-group " action="{{ route('user.update') }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Nom Complet</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                                @error('email')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Ancien mot de pass </label>
                                <input type="password" class="form-control" name="oldPassword">
                                @error('oldPassword')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nouveau mot de pass </label>
                                <input type="password" class="form-control" name="password">
                                @error('password')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Confirmation </label>
                                <input type="password" class="form-control" name="confirmation">
                                @error('confirmation')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Done</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
