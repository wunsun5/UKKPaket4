<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

    <style>
        .bi {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4em;
            color: white;
        }

        .nav-items {
            opacity: .8;
            transition: .5s;
        }

        .nav-items:hover,
        .nav-items.active {
            opacity: 1;
        }

        tr,
        td,
        thead,
        tbody,
        th {
            text-wrap: nowrap;
            padding: 8px 15px !important;
        }

        @media print {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

            body {
                padding: 3.5rem;
                color: black !important;
            }

            td,
            th {
                color: black !important;
            }

            .tools {
                display: none;
            }
        }
    </style>
</head>

<body>
    @include('components.navbar')

    <div class="d-flex align-items-center justify-content-center position-absolute position-relative w-100">
        @if (session()->has('success'))
            <div
                class="alert alert-success col-md-5 position-absolute top-0 d-flex align-items-center justify-content-between mt-3 gap-3">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @elseif(session()->has('fail'))
            <div
                class="alert alert-danger col-md-5 position-absolute top-0 d-flex align-items-center justify-content-between mt-3 gap-3">
                {{ session('fail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>
