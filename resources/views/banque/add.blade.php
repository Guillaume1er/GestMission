@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body">
        <div class="header-title">
            <h4 class="card-title">Ajouter une banque</h4>
        </div> <br>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('create-banque') }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code </label>
                        <input type="text" required class="form-control" name="code">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="sigle" class="form-label">Sigle</label>
                        <input class="form-control" rows="4" name="sigle" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input class="form-control" rows="4" name="nom" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="agence" class="form-label">Agence/Adresse</label>
                        <textarea class="form-control" rows="4" name="agence"></textarea>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>

    </div>


@endsection
