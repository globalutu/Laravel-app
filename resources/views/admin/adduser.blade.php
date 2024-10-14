@extends('tmplt.template')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ajout d'Utilisateur</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Formulaire pour Utilisateur -->
                <div class="card shadow mb-4 mx-auto">
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
                                    @forelse ($role as $user)
                                        <option value="{{ $user->Idrol }}">{{ $user->libelrol }}</option>
                                    @empty
                                        <option value="">Aucun rôle disponible</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mtp">Mot de Passe</label>
                                <input type="password" name="mtp" class="form-control" id="mtp"
                                    placeholder="Entrez le mot de passe" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter l'utilisateur</button>
                        </form>
                    </div>
                </div>
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
                        <i class="fas fa-check-circle text-success" style="font-size: 40px;"></i>
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
                    $('#messageModal').modal('show');
                @elseif (session('error'))
                    document.getElementById('modalMessageContent').innerText = "{{ session('error') }}";
                    $('#messageModal').modal('show');
                @endif
            });
        </script>
    @endsection
