@extends('tmplt.template')
@section('content')
    <div class="container">
        <h2>Modifier Utilisateur</h2>

        <form action="{{ route('users.update', $user->Iduse) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $user->nom }}" required>
            </div>

            <div class="form-group">
                <label for="prenoms">Prénoms</label>
                <input type="text" class="form-control" id="prenoms" name="prenoms" value="{{ $user->prenoms }}"
                    required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                    required>
            </div>

            <div class="form-group">
                <label for="role">Rôle</label>
                <select class="form-control" id="role" name="role" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->Idrol }}" {{ $role->Idrol == $user->role ? 'selected' : '' }}>
                            {{ $role->libelrol }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="{{ route('liste.user') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
@include('menus.back')
