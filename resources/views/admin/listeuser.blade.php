@extends('tmplt.template')
@section('content')
    <div class="container-fluid">
        <div class="modal-header">
            <button type="button" style="margin-right: 30px; float: right; padding-right: 30px; padding-left: 30px;"
                class="btn btn-secondary bg-deep-orange waves-effect" data-color="deep-orange" data-toggle="modal"
                data-target="#add">Ajouter</button>
        </div>
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
                                        <button
                                            onclick="update('{{ $lister->Iduse }}','{{ $lister->nom }}','{{ $lister->prenoms }}',
                                            '{{ $lister->email }}','{{ $lister->role }} ')"
                                            data-toggle="modal" data-target="#modify" class="btn btn-info btn-circle btn-sm"
                                            title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Bouton Accorder des Menus -->


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
        <!-- Modification des informetions d'utilisateur-->

        <div class="modal fade" id="modify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">

                <div class="modal-content card shadow mb-4 mx-auto">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Modifier Utilisateur</h6>
                    </div>
                    <div class="card-body">

                        <input type="hidden" id="idupdate" name="idupdate" />
                        <label id="infoupdate"></label>

                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>

                        <div class="form-group">
                            <label for="prenoms">Prénoms</label>
                            <input type="text" class="form-control" id="prenoms" name="prenoms" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Rôle</label>
                            <select class="form-control" id="role" name="role" required>
                                @forelse ($roles as $user)
                                    <option value="{{ $user->Idrol }}">{{ $user->libelrol }}</option>
                                @empty
                                    <option value="0">Aucun rôle disponible</option>
                                @endforelse
                            </select>
                        </div>

                        <button type="submit" onclick="valideupdate()" class="btn btn-primary">Modifier</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ajout d'utilisateur-->

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">

                <div class="modal-content card shadow mb-4 mx-auto">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Formulaire d'Ajout d'Utilisateur</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.post') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" class="form-control" id="nom"
                                    placeholder="Entrez le nom de l'utilisateur" required>
                            </div>
                            <div class="form-group">
                                <label for="prenoms">Prénoms</label>
                                <input type="text" name="prenoms" class="form-control" id="prenoms"
                                    placeholder="Entrez les prénoms de l'utilisateur" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Entrez l'email de l'utilisateur" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Rôle</label>
                                <select name="role" class="form-control" id="role" required>
                                    @forelse ($roles as $user)
                                        <option value="{{ $user->Idrol }}">{{ $user->libelrol }}</option>
                                    @empty
                                        <option value="0">Aucun rôle disponible</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mtp">Mot de Passe</label>
                                <input type="password" name="mtp" class="form-control" id="mtp"
                                    placeholder="Entrez le mot de passe" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter l'utilisateur</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </form>
                    </div>
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

            document.addEventListener('DOMContentLoaded', function() {
                @if (session('success'))
                    document.getElementById('modalMessageContent').innerText = "{{ session('success') }}";
                    $('#messageModal').modal('show');
                @elseif (session('error'))
                    document.getElementById('modalMessageContent').innerText = "{{ session('error') }}";
                    $('#messageModal').modal('show');
                @endif
            });

            async function update(Iduse, nom, prenoms, email, role) {
                document.getElementById('idupdate').value = Iduse;
                document.getElementById('nom').value = nom;
                document.getElementById('prenoms').value = prenoms;
                document.getElementById('email').value = email;
                document.getElementById('role').value = role;
            };

            async function valideupdate() {

                // récupération des données du formulaire
                token = document.getElementById("_token").value;
                Iduse = document.getElementById("idupdate").value;
                nom = document.getElementById('nom').value;
                prenoms = document.getElementById('prenoms').value;
                email = document.getElementById('email').value;
                role = document.getElementById('role').value;

                dat = {
                    _token: token,
                    nom: nom,
                    prenoms: prenoms,
                    email: email,
                    role: role,
                    id: Iduse,
                };
                console.log(dat);

                document.getElementById("infoupdate").innerHTML =
                    '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';

                // En cours d'envoie
                try {
                    let response = await fetch("{{ route('valideupdate') }}", {
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
        </script>
    @endsection

    @include('menus.back')
