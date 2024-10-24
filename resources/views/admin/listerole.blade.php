@extends('tmplt.template')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <button type="button" style="margin-right: 30px; float: right; padding-right: 30px; padding-left: 30px;"
            class="btn btn-secondary bg-deep-orange waves-effect" data-color="deep-orange" data-toggle="modal"
            data-target="#add">Ajout de Rôle</button>
    </div>
    <div class="container-fluid">
        <!-- Table des menus -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-gray-800">Liste des Roles</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Code du role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $menu)
                                <tr>

                                    <td>{{ $menu->libelrol }}</td>
                                    <td>{{ $menu->codrol }}</td>
                                    <td>
                                        <!-- Bouton pour ouvrir le modal de modification -->
                                        <!-- Bouton pour ouvrir le modal de modification -->
                                        <button data-target="#addmodifyrole" data-toggle="modal"
                                            onclick="updatemenu('{{ $menu->Idrol }}','{{ $menu->libelrol }}','{{ $menu->codrol }}')"
                                            class="btn btn-info btn-circle btn-sm" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <a href="{{ route('users.accordMenu', ['id' => $menu->Idrol]) }}"
                                            class="btn btn-success btn-circle btn-sm" title="Accorder des menus">
                                            <i class="fas fa-tasks"></i>
                                        </a>
                                        <!-- Bouton pour ouvrir le modal de suppression -->
                                        <button class="btn btn-danger btn-circle btn-sm delete-button" title="Supprimer"
                                            data-user-id="{{ $menu->Idrol }}" data-user-name="{{ $menu->libelrol }}">
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

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="modal fade" id="addmodifyrole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">

                    <div class="modal-content card shadow mb-4 mx-auto">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-secondary">Modification du Role </h6>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="idupdaterole" name="idupdaterole" />
                            <label id="infoupdate"></label>
                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />

                            <div class="form-group">
                                <label for="libelrol">Libellé du Role</label>
                                <input type="text" name="libelrol" class="form-control" id="libelrol"
                                    placeholder="Entrez le libellé du menu" required>
                            </div>
                            <div class="form-group">
                                <label for="codrol">Code du Role</label>
                                <input type="text" name="codrol" class="form-control" id="codrol"
                                    placeholder="Entrez le codrol du menu" required>
                            </div>

                            <button type="submit" onclick="valideupdaterole()" class="btn btn-primary">Ajouter le
                                Menu</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal du Formulaire pour Rôle -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">

                    <div class="modal-content card shadow mb-4 mx-auto">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Formulaire d'Ajout de Rôle</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('roles.post') }}" method="POST">
                                @csrf <!-- Token CSRF -->
                                <div class="form-group">
                                    <label for="libelle">Libellé du Rôle</label>
                                    <input type="text" name="libelrol" class="form-control" id="libelrol"
                                        placeholder="Entrez le libellé du rôle" required>
                                </div>
                                <div class="form-group">
                                    <label for="code">Code du Rôle</label>
                                    <input type="text" name="codrol" class="form-control" id="codrol"
                                        placeholder="Entrez le code du rôle" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Ajouter le rôle</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            {{-- liste des roles --}}
        </div>
    </div>

    <!-- Modal pour afficher les messages -->
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
                    <i id="modalcodrol" class="" style="font-size: 40px;"></i>
                    <p id="modalMessageContent" class="mt-3"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>

    </div>

    <!-- Script pour afficher le message modal -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                document.getElementById('modalMessageContent').innerText = "{{ session('success') }}";
                document.getElementById('modalcodrol').className =
                    "fas fa-check-circle text-success"; // Icône succès
                $('#messageModal').modal('show');
            @elseif (session('error'))
                document.getElementById('modalMessageContent').innerText = "{{ session('error') }}";
                document.getElementById('modalcodrol').className = "fas fa-times-circle text-danger"; // Icône échec
                $('#messageModal').modal('show');
            @endif
        });

        async function updatemenu(Idrol, libelrol, codrol) {
            document.getElementById('idupdaterole').value = Idrol;
            document.getElementById('libelrol').value = libelrol;
            document.getElementById('codrol').value = codrol;
        };

        async function valideupdaterole() {

            // Récupération des données du formulaire
            token = document.getElementById("_token").value;
            Idrol = document.getElementById("idupdaterole").value;
            libelrol = document.getElementById('libelrol').value;
            codrol = document.getElementById('codrol').value;

            let dat = new FormData(); // Utilisez FormData pour l'envoi de formulaire
            dat.append('_token', token);
            dat.append('id', Idrol);
            dat.append('libelrol', libelrol);
            dat.append('codrol', codrol);

            document.getElementById("infoupdate").innerHTML =
                '<div class="alert alert-warning alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>En cours de traitement.. <br> Veuillez patienter! </strong></div>';

            // Envoi des données
            try {
                let response = await fetch("{{ route('valideupdaterole') }}", {
                    method: 'POST',
                    body: dat
                });

                if (response.ok) {
                    let data = await response.text();
                    document.getElementById("infoupdate").innerHTML =
                        '<div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>' +
                        data + '</strong></div>';
                    setTimeout(function() {
                        window.location.reload(); // Recharge la page pour refléter les changements
                    }, 3000);
                } else {
                    document.getElementById("infoupdate").innerHTML =
                        '<div class="alert alert-danger alert-block"> <button type="button" class="close" data-dismiss="alert">×</button><strong>Une erreur s\'est produite </strong></div>';
                }
            } catch (error) {
                document.getElementById("infoupdate").innerHTML =
                    '<div class="alert alert-danger alert-block"><button type="button" class="close" data-dismiss="alert">×</button><strong>' +
                    error + '</strong></div>';
            }
        };
    </script>
@endsection
@include('menus.back')
