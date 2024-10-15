@extends('tmplt.template')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Liste des Utilisateurs</h1>

        <!-- Table des utilisateurs -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Table des utilisateurs</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>

                                <th>Nom</th>
                                <th>Prénoms</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user as $lister)
                                <tr>

                                    <td>{{ $lister->nom }}</td>
                                    <td>{{ $lister->prenoms }}</td>
                                    <td>{{ $lister->email }}</td>
                                    <td> @php
                                        $role = $roles->firstWhere('Idrol', $lister->role);
                                    @endphp

                                        {{ $role ? $role->libelrol : 'Rôle non défini' }}
                                    </td>
                                    </td>
                                    <td>
                                        <!-- Bouton Modifier -->
                                        <a href="{{ route('userEdit', ['id' => $lister->Iduse]) }}"
                                            class="btn btn-info btn-circle btn-sm" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Bouton Accorder des Menus -->
                                        <a href="{{ route('users.accordMenu', ['id' => $lister->Iduse]) }}"
                                            class="btn btn-success btn-circle btn-sm" title="Accorder des menus">
                                            <i class="fas fa-tasks"></i>
                                        </a>

                                        <!-- Bouton Supprimer -->
                                        <button class="btn btn-danger btn-circle btn-sm delete-button" title="Supprimer"
                                            data-user-id="{{ $lister->Iduse }}" data-user-name="{{ $lister->nom }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucun utilisateur trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Inclure SweetAlert2 CSS et JS -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Sélectionner tous les boutons de suppression
                const deleteButtons = document.querySelectorAll('.delete-button');

                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        const userId = this.getAttribute(
                            'data-user-id'); // Récupérer l'ID de l'utilisateur
                        const userName = this.getAttribute(
                            'data-user-name'); // Récupérer le nom de l'utilisateur

                        // Afficher la pop-up de confirmation SweetAlert2
                        Swal.fire({
                            title: 'Êtes-vous sûr?',
                            text: `Cette action supprimera définitivement l'utilisateur "${userName}".`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Oui, supprimer!',
                            cancelButtonText: 'Annuler'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Utiliser AJAX pour supprimer l'utilisateur
                                fetch(`/destroyuser${userId}`, {
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
    @include('menus.back')
