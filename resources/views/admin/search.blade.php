@extends('tmplt.template')
@section('content')

    <div class="container">

        {{-- Affichage des résultats --}}
        @if (isset($results))
            <h2>Résultats de la recherche pour "{{ request()->input('search') }}"</h2>
            @if ($results->isEmpty())
                <p>Aucun résultat trouvé.</p>
            @else
                <div class="row mt-3">
                    @foreach ($results as $result)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body text-center"> {{-- Centrer le contenu de la carte --}}
                                    <div class="profile-icon mb-3">
                                        <i class="fas fa-user-circle fa-5x"></i>
                                    </div>
                                    <h5 class="card-title">{{ $result->nom }} {{ $result->prenom }}</h5>
                                    <p class="card-text"> <!-- Ajoutez d'autres informations ici si nécessaire -->
                                        <strong>Email:</strong> {{ $result->email }} <br>
                                        <strong>Role:</strong> {{ $result->role }} <br>
                                    </p>
                                    <button data-target="#addmodifyBtn" data-toggle="modal"
                                        class="btn btn-info btn-circle btn-sm" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button class="btn btn-danger btn-circle btn-sm delete-button" title="Supprimer"
                                        data-user-id="{{ $result->id }}" data-user-name="{{ $result->nom }}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
@endsection
@include('menus.back')
