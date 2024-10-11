@extends('layouts.dashboard_sans_sta')

@section('content')
<div class="mb-4 mt-4 ms-4">
    <a href="{{ url()->previous() }}" class="btn btn-primary d-inline-flex align-items-center">
        <svg class="icon-32 me-2" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        Retour
    </a>
</div>

    <div class="card-body container">
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
                        <label for="montantNuite" class="form-label">Montant nuité (F CFA)</label>
                        <input type="number" required class="form-control" value = "{{ number_format($indice->montantNuite, 0, ',', '') }}" name="montantNuite">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="montantRepas" class="form-label">Montant Repas (F CFA)</label>
                        <input type="number" required class="form-control" value="{{ number_format($indice->montantRepas, 0, ',', '') }}" name="montantRepas">
                    </div>
                </div>
              
               
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

    </div>


@endsection
