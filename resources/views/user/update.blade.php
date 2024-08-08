@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body">
        <div class="header-title">
            <h4 class="card-title">Modifier l'utilisateur</h4>
        </div> <br>

        @if ($errors->any())
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="flex-shrink-0 bi me-2 icon-24" width="24" height="24">
                    <use xlink:href="#exclamation-triangle-fill"></use>
                </svg>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="flex-shrink-0 bi me-2 icon-24" width="24" height="24">
                    <use xlink:href="#check-circle-fill"></use>
                </svg>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('update-user', $user->id) }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" required class="form-control" value="{{ $user->name }}" name="name">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" required class="form-control" value="{{ $user->email }}" name="email">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" value="" name="password">
                    </div>
                </div>

                {{-- <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe de confirmation</label>
                        <input type="password" class="form-control" value="" name="confirmpassword">
                    </div>
                </div> --}}

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select class="form-select" name="role" id="role">
                            <option value="USER" {{ $user->role === 'USER' ? 'selected' : '' }}>UTILISATEUR</option>
                            <option value="ADMIN" {{ $user->role === 'ADMIN' ? 'selected' : '' }}>ADMINISTRATEUR</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

    </div>


@endsection
