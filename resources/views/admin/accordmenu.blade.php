@extends('tmplt.template')
@section('content') 

    <div class="row">
        {{--  <!-- Colonne 1: Informations de la personne et sélection d\'options -->  --}}
        <div class="col-lg-6">
            {{--  <!-- Carte d\'informations -->  --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informations de l\'utilisateur</h6>
                </div>
                <div class="card-body">
                    <!-- Affichage des informations personnelles -->
                    <h5 class="card-title">Nom: <span class="text-dark">{{ $accord->nom ?? 'Nom non disponible' }}</span></h5>
                    <p class="card-subtitle mb-2 text-muted">Rôle: <span class="text-dark">{{ $accord->role ?? 'Rôle non disponible' }}</span></p>

                    <!-- Formulaire de sélection -->
                    <form method="POST" action="{{ route('accord.post') }}">
                        @csrf
                        <!-- Champ caché pour l'ID de l'utilisateur -->
                        <input type="hidden" name="user_id" value="{{ $accord->Iduse }}">

                        <!-- Sélection du menu -->
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
