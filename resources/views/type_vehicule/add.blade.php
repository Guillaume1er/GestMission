@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body">
        <div class="header-title">
            <h4 class="card-title">Ajouter une type de véhicule</h4>
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

        <form method="POST" action="{{ route('create-type-vehicule') }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="typeVehicule" class="form-label">Type de véhicule</label>
                        <input type="text" required class="form-control" name="typeVehicule">
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
