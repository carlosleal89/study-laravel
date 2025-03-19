<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Nova Conta</h2>
        <form id="accountForm" class="mt-4">
            <div class="mb-3">
                <label for="account_name" class="form-label">Nome da Conta</label>
                <input type="text" class="form-control" id="account_name" name="account_name" required>
            </div>
            <div class="mb-3">
                <label for="app_key" class="form-label">App Key</label>
                <input type="text" class="form-control" id="app_key" name="app_key" required>
            </div>
            <div class="mb-3">
                <label for="app_token" class="form-label">App Token</label>
                <input type="text" class="form-control" id="app_token" name="app_token" required>
            </div>
            <div class="mb-3">
                <label for="info" class="form-label">Informações</label>
                <textarea class="form-control" id="info" name="info" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="product_catalog_id" class="form-label">ID do Catálogo de Produtos</label>
                <input type="number" class="form-control" id="product_catalog_id" name="product_catalog_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>

    <script>
        document.getElementById('accountForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = {
                account_name: document.getElementById('account_name').value,
                app_key: document.getElementById('app_key').value,
                app_token: document.getElementById('app_token').value,
                info: document.getElementById('info').value,
                product_catalog_id: parseInt(document.getElementById('product_catalog_id').value)
            };

            try {
                const response = await fetch('/api/accounts', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    alert('Conta criada com sucesso!');
                    window.location.href = '/accounts';
                } else {
                    const error = await response.json();
                    alert('Erro ao criar conta: ' + JSON.stringify(error));
                }
            } catch (error) {
                alert('Erro ao enviar dados: ' + error.message);
            }
        });
    </script>
</body>
</html> 