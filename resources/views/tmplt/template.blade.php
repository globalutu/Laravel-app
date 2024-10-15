<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Hilaire Sevn Ainadou">
    <title>{{ config('app.name') }} - Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        /* Style pour le bouton de retour */
        #backButton {
            position: fixed;
            /* Fixe le bouton dans un coin */
            bottom: 50px;
            /* Ajustez selon vos besoins */
            left: 20px;
            /* Ajustez selon vos besoins */
            z-index: 1000;
            /* Assurez-vous qu'il soit au-dessus des autres éléments */
            border-radius: 50%;
            /* Pour le style circulaire */
            width: 40px;
            /* Largeur */
            height: 40px;
            /* Hauteur */
            display: flex;
            /* Flex pour centrer l'icône */
            justify-content: center;
            /* Centre horizontalement */
            align-items: center;
            /* Centre verticalement */
            background-color: #4e73df;
            /* Couleur d'arrière-plan */
            color: white;
            /* Couleur de l'icône */
            border: none;
            /* Pas de bordure */
            transition: background-color 0.3s;
            /* Transition douce pour l'effet hover */
        }

        #backButton:hover {
            background-color: #2e59d9;
            /* Couleur d'arrière-plan au survol */
        }

        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            /* Positionnement en bas à droite */
            right: 20px;
            /* Positionnement à droite */
            z-index: 1000;
            /* Assurez-vous qu'il soit au-dessus des autres éléments */
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('menus.menu')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @yield('alert')
                {{-- barre de menu lateral --}}
                @include('menus.wrapper')

                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- Ajoutez ce code juste avant le footer -->

            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>


    <script>
        document.getElementById('backButton').addEventListener('click', function() {
            const currentUrl = window.location.pathname; // Récupérer l'URL actuelle

            if (currentUrl.includes('/admin/dashboard')) {
                swal({
                    title: "Êtes-vous sûr ?",
                    text: "Vous allez être déconnecté.",
                    icon: "warning",
                    buttons: {
                        cancel: "Annuler",
                        confirm: {
                            text: "Déconnecter",
                            value: true,
                            closeModal: true,
                        },
                    },
                }).then((willLogout) => {
                    if (willLogout) {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');

                        fetch('/Deconnexion', {
                                method: 'GET', // Utilisez GET pour la déconnexion
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken, // Ajoutez le token CSRF ici
                                    'Content-Type': 'application/json',
                                },
                            })
                            .then(response => {
                                if (response.ok) {
                                    window.location.href =
                                        '/login'; // Rediriger vers la page de connexion
                                } else {
                                    alert('Une erreur s\'est produite lors de la déconnexion.');
                                }
                            })
                            .catch(error => console.error('Erreur:', error));
                    }
                });
            } else {
                window.history.back();
            }
        });
    </script>



</body>

</html>
