@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body container">
        <div class="header-title">
            <h4 class="card-title">Modifier la banque</h4>
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

        <form method="POST" action="{{ route('update-banque', $banque->id) }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code </label>
                        <input type="text" required class="form-control" name="code" value="{{ $banque->code }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="sigle" class="form-label">Sigle</label>
                        <input class="form-control" rows="4" name="sigle" value="{{ $banque->sigle }}" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input class="form-control" rows="4" name="nom" value="{{ $banque->nom }}"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="agence" class="form-label">Agence/Adresse</label>
                        <textarea class="form-control" rows="4" name="agence">{{ $banque->agence }}</textarea>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

    </div>


@endsection
