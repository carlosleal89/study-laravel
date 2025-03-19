@extends('layouts.app')

@section('title', 'Editar Conta')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Editar Conta</h2>
                <a href="/accounts" class="btn btn-secondary">Voltar</a>
            </div>

            <div class="card">
                <div class="card-body">
                    <form id="editForm">
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
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Função para obter o ID da conta da URL
    function getAccountId() {
        const path = window.location.pathname;
        return path.split('/')[2]; // /accounts/{id}/edit
    }

    // Carregar dados da conta
    async function loadAccountData() {
        const accountId = getAccountId();
        try {
            const response = await fetch(`/api/accounts/${accountId}`);
            const account = await response.json();
            
            // Preencher o formulário com os dados
            document.getElementById('account_name').value = account.account_name;
            document.getElementById('app_key').value = account.app_key;
            document.getElementById('app_token').value = account.app_token;
            document.getElementById('info').value = account.info;
            document.getElementById('product_catalog_id').value = account.product_catalog_id;
        } catch (error) {
            alert('Erro ao carregar dados da conta: ' + error.message);
        }
    }

    // Enviar formulário
    document.getElementById('editForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const accountId = getAccountId();
        const formData = {
            account_name: document.getElementById('account_name').value,
            app_key: document.getElementById('app_key').value,
            app_token: document.getElementById('app_token').value,
            info: document.getElementById('info').value,
            product_catalog_id: parseInt(document.getElementById('product_catalog_id').value)
        };

        try {
            const response = await fetch(`/api/accounts/${accountId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            if (response.ok) {
                alert('Conta atualizada com sucesso!');
                window.location.href = '/accounts';
            } else {
                const error = await response.json();
                alert('Erro ao atualizar conta: ' + JSON.stringify(error));
            }
        } catch (error) {
            alert('Erro ao enviar dados: ' + error.message);
        }
    });

    // Carregar dados quando a página for carregada
    document.addEventListener('DOMContentLoaded', loadAccountData);
</script>
@endsection 