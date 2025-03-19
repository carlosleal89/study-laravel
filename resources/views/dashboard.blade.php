@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Dashboard</h2>
                <a href="/accounts/create" class="btn btn-primary">Nova Conta</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contas</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="w-5">ID</th>
                                    <th class="w-15">Nome da Conta</th>
                                    <th class="w-20 text-truncate">App Key</th>
                                    <th class="w-20 text-truncate">App Token</th>
                                    <th class="w-15">Informações</th>
                                    <th class="w-10">ID do Catálogo</th>
                                    <th class="w-15">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="accountsTable">
                                <!-- Os dados serão inseridos aqui via JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                    <td class="text-truncate" style="max-width: 200px;">${account.app_key}</td>
                    <td class="text-truncate" style="max-width: 200px;">${account.app_token}</td>
                    <td>${account.info}</td>
                    <td>${account.product_catalog_id}</td>
                    <td>
                        <div class="d-flex flex-column flex-md-row gap-2">
                            <a href="/accounts/${account.id}" class="btn btn-sm btn-info">Ver</a>
                            <a href="/accounts/${account.id}/edit" class="btn btn-sm btn-warning">Editar</a>
                            <button class="btn btn-sm btn-danger" onclick="deleteAccount(${account.id})">Excluir</button>
                        </div>
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

    // Carrega as contas quando a página for carregada
    document.addEventListener('DOMContentLoaded', loadAccounts);
</script>
@endsection 