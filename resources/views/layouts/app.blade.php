<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <linkpreconnect href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="font-sans antialiased bg-gray-100">
        
        <div class="flex h-screen overflow-hidden">
            
            @include('layouts.sidebar')

            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden ml-64">
                
                @include('layouts.navigation')

                <main class="p-6">
                    {{ $slot }}
                </main>
            </div>

        </div>
    </body>
</html>