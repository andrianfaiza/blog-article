<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $artikel->header}}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <x-app-layout>
    <body class="min-h-screen bg-gray-100 text-gray-900">
        <x-slot name="header">

            <header class="bfont-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3">
                <div>
                    <a href="{{ url()->previous() }}"
                       class="text-xl font-semibold text-gray-900 text-white">
                       <- Kembali
                    </a>
                </div>
            </div>
        </header>
        </x-slot>

        <main class="max-w-5xl mx-auto px-4 py-10">
            <article class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
                <div class="mb-2 text-sm uppercase tracking-[0.18em] text-slate-500">{{ $artikel->created_at->translatedFormat('d F Y') }}</div>
                <h1 class="text-4xl font-bold text-slate-900">{{ $artikel->header }}</h1>
                <div class="mt-4 text-sm text-slate-600">Penulis: {{ $artikel->author?->name ?? 'Guest' }}</div>
                <p class="text-slate-700 leading-relaxed break-all whitespace-pre-line">
    {{ $artikel->content }}
</p>
            </article>
        </main>
    </x-app-layout>
    </body>
</html>
