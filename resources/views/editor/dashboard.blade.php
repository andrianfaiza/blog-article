<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <div class="text-sm font-semibold uppercase tracking-[0.24em] text-orange-600">Artikel yang Anda Tulis</div>
                    <div class="mt-4 text-4xl font-bold text-slate-900">{{ $artikelCount }}
                        <span class="mt-2 text-sm text-slate-500">Artikel</span>
                    </div>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('editor.myartikel') }}" 
                           class="inline-flex items-center rounded-md bg-orange-600 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-700">
                           Artikel Saya
                        </a>
                    </div>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
                    <div class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-600">Aksi Cepat</div>
                    <div class="mt-4 text-lg font-semibold text-slate-900">Tambah dan Tulis Artikel.</div>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('artikel.create') }}" 
                           class="inline-flex items-center rounded-md bg-orange-600 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-700">
                           Tulis Artikel Baru
                        </a>
                    </div>
                </div>
            </div>
            

            <!-- daftar artikel user -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mt-4">{{ __('Semua Artikel') }}</h2>
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
                            <a href="{{route('editor.showuser', $artikel->id)}}" 
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
