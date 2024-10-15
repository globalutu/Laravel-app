@extends('tmplt.template')
@section('content')

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informations de l\'utilisateur</h6>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Nom: <span class="text-dark">{{ $accord->nom ?? 'Nom non disponible' }}</span></h5>
                    <p class="card-subtitle mb-2 text-muted">Rôle: <span class="text-dark">
                            @php
                                $role = $roles->firstWhere('Idrol', $accord->role);
                            @endphp

                            {{ $role ? $role->libelrol : 'Rôle non disponible' }}</span></p>

                    <form method="POST" action="{{ route('accord.post') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $accord->Iduse }}">

                        <div class="form-group">
                            <label for="menu">Sélectionner le menu</label>
                            <select name="menu" class="form-control" id="menu" required>
                                @forelse ($menus as $menu)
                                    <option value="{{ $menu->Idmen }}">{{ $menu->libelle }}</option>
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
            <!-- Boutons circulaires -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Menus assignés</h6>
                </div>
                <div class="card-body">
                    @if ($assignedMenus && $assignedMenus->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom du Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignedMenus as $index => $menu)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $menu->libelle }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <code>Aucun menu assigné à {{ $accord->nom ?? 'cet utilisateur' }}</code>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
@include('menus.back')
<!-- SweetAlert2 pour les messages de succès ou d'erreur -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Vérifier s'il y a un message de succès ou d'erreur dans la session
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
