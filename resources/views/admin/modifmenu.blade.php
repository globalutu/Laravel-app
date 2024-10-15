@extends('tmplt.template')
@section('content')
    <div class="container">
        <h2>Modifier Menu</h2>

        <form action="{{ route('menus.update', $menu->Idmen) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="libelle">libelle du menu </label>
                <input type="text" class="form-control" id="libelle" name="libelle" value="{{ $menu->libelle }}" required>
            </div>

            <div class="form-group">
                <label for="route">Route du menu</label>
                <input type="text" class="form-control" id="route" name="route" value="{{ $menu->route }}"
                    required>
            </div>

            <div class="form-group">
                <label for="icon">Icon </label>
                <input type="icon" class="form-control" id="icon" name="icon" value="{{ $menu->icon }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="{{ route('liste.menus') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
@include('menus.back')
