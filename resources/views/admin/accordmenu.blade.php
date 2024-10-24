@extends('tmplt.template')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informations de l'utilisateur</h6>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Nom: <span class="text-dark">{{ $accord->libelrol ?? 'Nom non disponible' }}</span>
                    </h5>

                    <form method="POST" action="{{ route('accord.post') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $accord->Idrol }}">

                        <div class="form-group">
                            <label for="menu">Sélectionner le menu</label>
                            <select name="menu" class="form-control" id="menu" required>
                                @forelse ($menus as $menu)
                                    <option value="{{ $menu->Idmen }}"
                                        {{ isset($assignedMenus) && in_array($menu->Idmen, $assignedMenus->pluck('Idmen')->toArray()) ? 'selected' : '' }}>
                                        {{ $menu->libelle }}
                                    </option>
                                @empty
                                    <option value="">Aucun menu disponible</option>
                                @endforelse
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Valider</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Colonne 2: Boutons circulaires (Options) -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Menus assignés</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom du Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($assignedMenus as $index => $menu)
                                <tr>
                                    <th scope="row">{{ $index + 1 }}</th>
                                    <td>{{ $menu->libelle }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Aucun menu assigné à {{ $accord->nom ?? 'cet utilisateur' }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('menus.back')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    });
</script>
