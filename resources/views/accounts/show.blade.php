@extends('layouts.app')

@section('title', 'Detalhes da Conta')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Detalhes da Conta</h2>
                <div>
                    <a href="/accounts" class="btn btn-secondary me-2">Voltar</a>
                    <a href="#" id="editButton" class="btn btn-primary">Editar</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Nome da Conta:</div>
                        <div class="col-md-9" id="account_name"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">App Key:</div>
                        <div class="col-md-9" id="app_key"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">App Token:</div>
                        <div class="col-md-9" id="app_token"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Informações:</div>
                        <div class="col-md-9" id="info"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">ID do Catálogo:</div>
                        <div class="col-md-9" id="product_catalog_id"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Função para obter o ID da conta da URL
    function getAccountId() {
        const path = window.location.pathname;
        return path.split('/')[2]; // /accounts/{id}
    }

    // Carregar dados da conta
    async function loadAccountData() {
        const accountId = getAccountId();
        try {
            const response = await fetch(`/api/accounts/${accountId}`);
            const account = await response.json();
            
            // Preencher os dados
            document.getElementById('account_name').textContent = account.account_name;
            document.getElementById('app_key').textContent = account.app_key;
            document.getElementById('app_token').textContent = account.app_token;
            document.getElementById('info').textContent = account.info;
            document.getElementById('product_catalog_id').textContent = account.product_catalog_id;

            // Configurar o botão de editar
            document.getElementById('editButton').href = `/accounts/${accountId}/edit`;
        } catch (error) {
            alert('Erro ao carregar dados da conta: ' + error.message);
        }
    }

    // Carregar dados quando a página for carregada
    document.addEventListener('DOMContentLoaded', loadAccountData);
</script>
@endsection 