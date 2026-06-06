<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3">
            <div>
                <a href="{{ url()->previous() }}"
                   class="text-xl font-semibold text-white">
                   <- Back
                </a>
            </div>
        </div>
    </x-slot>

    <main class="max-w-5xl mx-auto px-4 py-10">
        <article class="rounded-3xl bg-white p-8 shadow-sm border border-slate-200">
            <div class="mb-2 text-sm uppercase tracking-[0.18em] text-slate-500">{{ $article->created_at->translatedFormat('d F Y') }}</div>
            <h1 class="text-4xl font-bold text-slate-900">{{ $article->header }}</h1>
            <div class="mt-4 text-sm text-slate-600">Author: {{ $article->author?->name ?? 'Guest' }}</div>
            <p class="text-slate-700 leading-relaxed break-all whitespace-pre-line">
                {{ $article->content }}
            </p>
        </article>
    </main>
</x-app-layout>
