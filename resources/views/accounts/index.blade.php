<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Lista de Contas</h2>
            <a href="/accounts/create" class="btn btn-primary">Nova Conta</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome da Conta</th>
                        <th>App Key</th>
                        <th>App Token</th>
                        <th>Informações</th>
                        <th>ID do Catálogo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="accountsTable">
                    <!-- Os dados serão inseridos aqui via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function loadAccounts() {
            try {
                const response = await fetch('/api/accounts');
                const accounts = await response.json();
                
                const tableBody = document.getElementById('accountsTable');
                tableBody.innerHTML = accounts.map(account => `
                    <tr>
                        <td>${account.id}</td>
                        <td>${account.account_name}</td>
                        <td>${account.app_key}</td>
                        <td>${account.app_token}</td>
                        <td>${account.info}</td>
                        <td>${account.product_catalog_id}</td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="viewAccount(${account.id})">Ver</button>
                            <button class="btn btn-sm btn-warning" onclick="editAccount(${account.id})">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteAccount(${account.id})">Excluir</button>
                        </td>
                    </tr>
                `).join('');
            } catch (error) {
                alert('Erro ao carregar contas: ' + error.message);
            }
        }

        async function deleteAccount(id) {
            if (confirm('Tem certeza que deseja excluir esta conta?')) {
                try {
                    const response = await fetch(`/api/accounts/${id}`, {
                        method: 'DELETE'
                    });
                    
                    if (response.ok) {
                        alert('Conta excluída com sucesso!');
                        loadAccounts();
                    } else {
                        alert('Erro ao excluir conta');
                    }
                } catch (error) {
                    alert('Erro ao excluir conta: ' + error.message);
                }
            }
        }

        function viewAccount(id) {
            window.location.href = `/accounts/${id}`;
        }

        function editAccount(id) {
            window.location.href = `/accounts/${id}/edit`;
        }

        // Carrega as contas quando a página é carregada
        document.addEventListener('DOMContentLoaded', loadAccounts);
    </script>
</body>
</html> 