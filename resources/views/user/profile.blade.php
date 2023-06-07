@extends('layout')

@section('content')
    <style>
        .card {
            max-width: 300px;
            margin: 0 auto;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card-header {
            text-align: center;
        }

        .card-body {
            text-align: center;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: #051139 3px solid;
            margin-bottom: 10px;
        }

        .name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .email {
            color: #888;
            margin-bottom: 20px;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <img id="profile-picture" class="profile-picture" width="100px" height="100px"
                            src="{{ asset('storage/images/' . Auth::user()->url) }}" alt="Profile Picture">
                        <div id="name" class="name">{{ Auth::user()->name }}</div>
                        <div id="email" class="email">{{ Auth::user()->email }}</div>
                        <div id="email" class="email">{{ Auth::user()->role->libelle }}</div>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary" href="{{ route('user.edit') }}">Modifier votre profil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
