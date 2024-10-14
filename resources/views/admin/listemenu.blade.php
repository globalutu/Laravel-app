@extends('tmplt.template')
@section('content')
    <div class="container-fluid">
        <!-- Titre de la page -->
        <h1 class="h3 mb-4 text-gray-800">Liste des Menus</h1>

        <!-- Bouton pour ouvrir le modal d'ajout de menu -->
        <button class="btn btn-primary mb-3" id="addMenuBtn" href="{{ route('menu.get') }}">Ajouter Menu
        </button>
        <!-- Table des menus -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table des Menus</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Libellé</th>
                                <th>Route</th>
                                <th>Icône</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menus as $menu)
                                <tr>

                                    <td>{{ $menu->libelle }}</td>
                                    <td>{{ $menu->route }}</td>
                                    <td><i class="{{ $menu->icon }}"></i></td>
                                    <td>
                                        <!-- Bouton pour ouvrir le modal de modification -->
                                        <a href="{{ route('menuEdit', ['id' => $menu->Idmen]) }}"
                                            class="btn btn-info btn-circle btn-sm" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Bouton pour ouvrir le modal de suppression -->
                                        <button class="btn btn-danger btn-circle btn-sm delete-button" title="Supprimer"
                                            data-user-id="{{ $menu->Idmen }}" data-user-name="{{ $menu->libelle }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucun menu trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <!-- Inclure SweetAlert2 CSS et JS, jQuery et Bootstrap JS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Utilisez la version complète de jQuery pour les requêtes AJAX -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sélectionner tous les boutons de suppression
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const Idmen = this.getAttribute(
                        'data-user-id'); // Récupérer l'ID de l'utilisateur
                    const userName = this.getAttribute(
                        'data-user-name'); // Récupérer le nom de l'utilisateur

                    // Afficher la pop-up de confirmation SweetAlert2
                    Swal.fire({
                        title: 'Êtes-vous sûr?',
                        text: `Cette action supprimera définitivement le menu "${userName}".`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oui, supprimer!',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Utiliser AJAX pour supprimer l'utilisateur
                            fetch(`/deltMenu${Idmen}`, {
                                    method: 'GET',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                    },
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire(
                                            'Supprimé!',
                                            data.message,
                                            'success'
                                        ).then(() => {
                                            location
                                                .reload(); // Recharger la page pour mettre à jour la liste
                                        });
                                    } else {
                                        Swal.fire(
                                            'Erreur!',
                                            data.error,
                                            'error'
                                        );
                                    }
                                })
                                .catch((error) => {
                                    Swal.fire(
                                        'Erreur!',
                                        'Une erreur est survenue lors de la suppression.',
                                        'error'
                                    );
                                });
                        }
                    });
                });
            });
        });
    </script>
@endsection
