@extends('tmplt.template')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ajout de Menu</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Formulaire pour Rôle -->
            <div class="card shadow mb-4 mx-auto">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulaire d'Ajout de Menu</h6>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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
    </script>
@endsection
@include('menus.back')
