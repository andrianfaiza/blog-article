<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3">
            <div>
                <a href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('editor.dashboard')}}"
                   class="text-xl font-semibold text-white">
                   <- Back
                </a>
            </div>
            <div class="flex gap-3 justify-end mt-4">
                <a href="{{ route('articles.edit', $article->id) }}"
                   class="px-3 py-1 text-xs rounded-md bg-orange-600 text-white hover:bg-orange-700">
                   <i class="fas fa-pen-to-square text-lg"></i>
                </a>
                <form action="{{ route('articles.destroy', ['article' => $article->id, 'from' => 'show']) }}" method="POST" class="px-3 py-1 text-xs rounded-md bg-red-600 text-white hover:bg-pink-700">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fas fa-trash text-lg"></i></button>
                </form>
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
