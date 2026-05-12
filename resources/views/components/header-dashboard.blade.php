<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') </title>

    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- 1. BASE (Variáveis, Reset e Estrutura de Grid) -->
    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/layouts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <!-- 2. ELEMENTOS COMUNS (Presentes em quase todas as páginas) -->
    <link rel="stylesheet" href="{{ asset('assets/css/navbar-footer.css') }}">

    <!-- 3. PÁGINAS PÚBLICAS (Landing Page) -->
    <link rel="stylesheet" href="{{ asset('assets/css/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing-elements.css') }}">

    <!-- 4. DASHBOARD E ÁREAS ESPECÍFICAS (Importar na área administrativa) -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard-base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tabelas.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/propostas.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/clientes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cuidadores.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/avaliacoes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/perfil-edit.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard-cuidador.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/add-specialty.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/hire-form.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/perfil-cuidador.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/perfil-cuidador-edit.css') }}">


    {{-- link font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
