<div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    
                    <div class="space-y-6">
                        <div>
                            <label for="header" class="block text-sm font-medium text-gray-700">Judul Artikel</label>
                            <input type="text" id="header" name="header" value="{{ old('header', $artikel->header ?? '')}}" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">Isi Artikel</label>
                            <textarea name="content" id="content" cols="30" rows="20" class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">{{ old('content', $artikel->content ?? '')}}</textarea>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="submit" class="inline-flex items-center justify-center rounded-md bg-orange-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-700">Kirim</button>
                            <a href="{{url()->previous()}}" class="text-sm text-gray-500 hover:text-gray-700">Kembali</a>
                            {{-- <a href="{{auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('editor.dashboard')}}" class="text-sm text-gray-500 hover:text-gray-700">Kembali</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>