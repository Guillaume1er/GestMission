@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body">
        <div class="header-title">
            <h4 class="card-title">Ajouter un utilisateur</h4>
        </div> <br>

        <form method="POST" action="{{ route('create-user') }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" required class="form-control" name="name">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" required class="form-control" name="email">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" required class="form-control" name="password">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select class="form-select" required name="role" id="role">
                            <option value="USER" selected>UTILISATEUR</option>
                            <option value="ADMIN">ADMINISTRATEUR</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>

    </div>

    </div>
@endsection
