@extends('tmplt.template')
@section('content')
    <div class="container-fluid">
        <!-- Titre de la page -->
        <h1 class="h3 mb-4 text-gray-800">Liste des Menus</h1>

        <!-- Bouton pour ouvrir le modal d'ajout de menu -->
        <button class="btn btn-primary mb-3" data-target="#addMenuBtn" data-toggle="modal">Ajouter Menu
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
                                        <button data-target="#addmodifyBtn" data-toggle="modal"
                                            onclick="updatemenu('{{ $menu->Idmen }}','{{ $menu->libelle }}','{{ $menu->route }}','{{ $menu->icon }}')"
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



    <div class="modal fade" id="addmodifyBtn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content card shadow mb-4 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-secondary">Modification du Menu </h6>
                </div>
                <div class="card-body">
                    <input type="hidden" id="idupdatemenu" name="idupdatemenu" />
                    <label id="infoupdate"></label>
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />

                    <div class="form-group">
                        <label for="libelrol">Libellé du Menu</label>
                        <input type="text" name="libelle" class="form-control" id="libelle"
                            placeholder="Entrez le libellé du menu" required>
                    </div>
                    <div class="form-group">
                        <label for="codrol">Route du Menu</label>
                        <input type="text" name="route" class="form-control" id="route"
                            placeholder="Entrez le route du menu" required>
                    </div>
                    <div class="form-group">
                        <label for="codrol">Icon du Menu</label>
                        <input type="text" id="icon" name="icon" class="form-control"
                            placeholder="Entrez l'icon du menu" required>
                    </div>
                    <button type="submit" onclick="valideupdatemenu()" class="btn btn-primary">Ajouter le Menu</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal d'ajout de menus --}}
    <div class="modal fade" id="addMenuBtn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">

            <div class="modal-content card shadow mb-4 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulaire d'Ajout de Menu </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('menu.post') }}" method="POST">
                        @csrf <!-- Token CSRF -->
                        <div class="form-group">
                            <label for="libelrol">Libellé du Menu</label>
                            <input type="text" name="libelle" class="form-control" id="libelrol"
                                placeholder="Entrez le libellé du menu" required>
                        </div>
                        <div class="form-group">
                            <label for="codrol">Route du Menu</label>
                            <input type="text" name="route" class="form-control" id="codrol"
                                placeholder="Entrez le route du menu" required>
                        </div>
                        <div class="form-group">
                            <label for="codrol">Icon du Menu</label>
                            <input type="text" name="icon" class="form-control" id="codrol"
                                placeholder="Entrez l'icon du menu" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter le Menu</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal de message d'ajout --}}

    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <!-- Icône pour succès ou échec -->
                    <i id="modalIcon" class="" style="font-size: 40px;"></i>
                    <p id="modalMessageContent" class="mt-3"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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
            @if (session('success'))
                document.getElementById('modalMessageContent').innerText = "{{ session('success') }}";
                document.getElementById('modalIcon').className = "fas fa-check-circle text-success";
                $('#messageModal').modal('show');
            @elseif (session('error'))
                document.getElementById('modalMessageContent').innerText = "{{ session('error') }}";
                document.getElementById('modalIcon').className = "fas fa-times-circle text-danger";
                $('#messageModal').modal('show');
            @endif
        });

        async function updatemenu(Idmen, libelle, route, icon) {
            document.getElementById('idupdatemenu').value = Idmen;
            document.getElementById('libelle').value = libelle;
            document.getElementById('route').value = route;
            document.getElementById('icon').value = icon;
        };

        async function valideupdatemenu() {

            // récupération des données du formulaire
            token = document.getElementById("_token").value;
            Idmen = document.getElementById("idupdatemenu").value;
            libelle = document.getElementById('libelle').value;
            route = document.getElementById('route').value;
            icon = document.getElementById('icon').value;

            dat = {
                _token: token,
                id: Idmen,
                libelle: libelle,
                route: route,
                icon: icon,

            };
            console.log(dat);

            document.getElementById("infoupdate").innerHTML =
                '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';

            // En cours d'envoie
            try {
                let response = await fetch("{{ route('valideupdatemenu') }}", {
                    method: 'POST',
                    headers: {
                        'Access-Control-Allow-Credentials': true,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(dat)
                });

                if (response.status == 200) {
                    data = await response.text();
                    document.getElementById("infoupdate").innerHTML =
                        '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>' +
                        data + '</strong></div>';
                    setTimeout(function() {
                        //window.location.href = "{{ route('liste.user') }}";
                    }, 3000);
                } else {
                    document.getElementById("infoupdate").innerHTML =
                        '<div class="alert alert-danger alert-block"> <button type="button" class="close" data-dismiss="alert">×</button><strong>Une erreur s\'est produite </strong></div>';
                }
            } catch (error) {
                document.getElementById("infoupdate").innerHTML = error;
            }
        };
        document.addEventListener('DOMContentLoaded', function() {
            // Sélectionner tous les boutons de suppression
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const Idmen = this.getAttribute(
                        'data-user-id'); // Récupérer l'ID de l'utilisateur
                    const userName = this.getAttribute(
                        'data-user-name'); // Récupérer le libelle de l'utilisateur

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
@include('menus.back')
