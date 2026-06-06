<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="flex justify-between items-center rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <div>

                        <div class="text-sm font-semibold uppercase tracking-[0.24em] text-orange-600">Articles You Wrote</div>
                        <div class="mt-4 text-4xl font-bold text-slate-900">{{ $articleCount }}
                            <span class="mt-2 text-sm text-slate-500">Articles</span>
                        </div>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('editor.dashboard') }}" 
                               class="inline-flex items-center rounded-md bg-orange-600 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-700">
                               All Articles
                            </a>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-newspaper text-orange-600 text-4xl"></i>
                    </div>
                </div>

                <div class="flex justify-between items-center rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <div>
                        <div class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-600">Quick Actions</div>
                        <div class="mt-4 text-lg font-semibold text-slate-900">Add and Write Articles.</div>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('articles.create') }}" 
                               class="inline-flex items-center rounded-md bg-orange-600 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-700">
                               Write New Article
                            </a>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-pen-nib text-orange-600 text-4xl"></i>
                    </div>
                </div>
            </div>
            

            <!-- list of user's articles -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-4">{{ __('My Articles') }}</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-4">
                
                @foreach ($articles as $article)
                    <div class="flex flex-col justify-between rounded-xl bg-white p-6 shadow border border-slate-200">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">
                                {{ $article->header }}
                            </h3>
                            <p class="text-sm text-slate-600 mb-4 line-clamp-3">
                                {{ Str::limit($article->content, 50) }}
                            </p>
                            <span class="text-xs text-slate-500">
                                Written by: <span class="font-medium">{{ optional($article->author)->name }}</span>
                            </span>
                        </div>
                        
                        <div class="mt-4 flex gap-2">
                            <a href="{{route('articles.show', $article->id)}}" 
                            class="px-3 py-1 text-xs rounded-md bg-orange-600 text-white hover:bg-orange-700">
                            <i class="fas fa-eye text-lg"></i>
                            </a>
                            <a href="{{route('articles.edit', $article->id)}}" 
                            class="px-3 py-1 text-xs rounded-md bg-blue-600 text-slate-700 text-white hover:bg-slate-300">
                            <i class="fas fa-pen-to-square text-lg"></i>
                            </a>
                            <form action="{{ route('articles.destroy', ['article' => $article->id, 'from' => 'myarticles']) }}" method="POST" class="px-3 py-1 text-xs rounded-md bg-red-600 text-white hover:bg-pink-700">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class="fas fa-trash text-lg"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </div>
</x-app-layout>
