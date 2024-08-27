@extends('layouts.dashboard_sans_sta')

@section('content')
<div class="card-body container">
    <div class="header-title">
        <h4 class="card-title">Ajouter un lieu mission</h4>
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

    <form method="POST" action="{{ route('create-lieu-mission') }}">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="departement" class="form-label">Département</label>
                    <select class="form-select" required name="departement_id" id="departement_id">
                        <option selected>Sélectionnez un département</option>
                        @foreach ($departements as $departement)
                            <option value="{{ $departement->id }}">{{ $departement->nomDepartement }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="ville" class="form-label">Commune</label>
                    <select name="commune" id="ville_id" class="form-control select2bs4 select2-hidden-accessible"
                        required>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="distance" class="form-label">Distance</label>
                    <input class="form-control" type="number" name="distance" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <input class="form-check-input" type="checkbox" id="nuite" value="1" name="nuite">
                    <label class="form-check-label" for="nuite">
                        Nuité
                    </label>
                </div>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $('#departement_id').change(function() {
            var departementId  = $(this).find(":selected").val();

                $.get("/lieu-mission/villes/" + departementId, function(response) {
                    console.log(response);
                    $('#ville_id').empty();
                    $('#ville_id').append("<option>Sélectionnez la ville</option>");
                    $.each(response, function(key, value) {
                        $('#ville_id').append("<option value=\""+value+"\">"+value+"</option>");
                    });
                });
            })
</script>
@endsection
