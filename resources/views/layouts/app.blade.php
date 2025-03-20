<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Genius')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div id="app">
        <div class="container-fluid">
            <div class="row vh-100">
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 bg-dark d-flex flex-column p-0">
                    <div class="flex-grow-1 p-3">
                        <a href="/" class="p-2 nav-link text-white rounded">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                        <a href="/accounts" class="p-2 nav-link text-white rounded">
                            <i class="bi bi-person"></i> Contas
                        </a>
                        <!-- Adicionar mais links -->
                    </div>
                    
                    <!-- Logout -->
                    <div class="p-3 mt-auto">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-box-arrow-right"></i> Sair
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Conteúdo Principal -->
                <div class="col-md-9 col-lg-10 p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 