<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    {{-- content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="flex justify-between items-center rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <div>
                        <div class="text-sm font-semibold uppercase tracking-[0.24em] text-orange-600">Statistics</div>
                        <div class="mt-4 text-4xl font-bold text-slate-900">{{$articleTotal}}</div>
                        <div class="mt-2 text-sm text-slate-500">Total registered articles</div>
                    </div>
                    <div>
                        <i class="fas fa-newspaper text-orange-600 text-4xl"></i>
                    </div>
                </div>
                <div class="flex justify-between items-center rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <div>
                        <div class="text-sm font-semibold uppercase tracking-[0.24em] text-orange-600">Want to Be an Editor?</div>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <form action="{{route('users.updateRole', Auth::user()->id)}}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="role" value="editor"
                                    class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-700">
                                    Change to Editor
                                </button>
                            </form>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-pen-nib text-orange-600 text-4xl"></i>
                    </div>
                </div>
            </div>

            <!-- list of articles -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-4">All Articles</h2>
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
                            <a href="{{route('articles.showuser', $article->id)}}" 
                            class="px-3 py-1 text-xs rounded-md bg-orange-600 text-white hover:bg-orange-700">
                            <i class="fas fa-eye text-lg"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>