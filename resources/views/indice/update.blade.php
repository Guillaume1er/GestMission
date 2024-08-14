@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body">
        <div class="header-title">
            <h4 class="card-title">Modifier l'indice</h4>
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

        <form method="POST" action="{{ route('update-indice', $indice->id) }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="code" class="form-label">Code</label>
                        <input type="text" required class="form-control" value="{{ $indice->code }}" name="code">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="montantNuite" class="form-label">Code</label>
                        <input type="number" required class="form-control" value="{{ $indice->montantNuite }}" name="montantNuite">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="montantRepas" class="form-label">Code</label>
                        <input type="number" required class="form-control" value="{{ $indice->montantRepas }}" name="montantRepas">
                    </div>
                </div>
              
               
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

    </div>


@endsection
