<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <form action="{{route('users.updateRole', Auth::user()->id)}}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" name="role" value="editor"
                                class="px-5 py-2 text-xs rounded-md bg-blue-600 text-white">
                                Ubah ke Editor
                            </button>
                        </form>

        </div>
    </x-slot>

    {{-- content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- daftar artikel user -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Semua Artikel') }}</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-4">
                
                @foreach ($artikel as $artikel)
                    <div class="flex flex-col justify-between rounded-xl bg-white p-6 shadow border border-slate-200">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">
                                {{ $artikel->header }}
                            </h3>
                            <p class="text-sm text-slate-600 mb-4 line-clamp-3">
                                {{ Str::limit($artikel->content, 50) }}
                            </p>
                            <span class="text-xs text-slate-500">
                                Ditulis oleh: <span class="font-medium">{{ optional($artikel->author)->name }}</span>
                            </span>
                        </div>
                        
                        <div class="mt-4 flex gap-2">
                            <a href="{{route('artikel.showuser', $artikel->id)}}" 
                            class="px-3 py-1 text-xs rounded-md bg-orange-600 text-white hover:bg-orange-700">
                            Baca
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>