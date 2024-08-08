@extends('layouts.dashboard_sans_sta')

@section('content')
    <div class="card-body">
        <div class="header-title">
            <h4 class="card-title">Modifier le type d'intervention</h4>
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

        <form method="POST" action="{{ route('update-type-intervention', $typeintervention->id) }}">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="typeIntervention" class="form-label">Type d'intervention</label>
                        <input type="text" required class="form-control" name="typeIntervention" value="{{$typeintervention->typeIntervention}}">
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="4" name="description" value="description" >{{$typeintervention->description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" id="livretBord" value="1" name="livretBord" {{ $typeintervention->livretBord ? 'checked' : ''}}>
                        <label class="form-check-label" for="livretBord">
                            Livret de bord
                        </label>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>

    </div>


@endsection
