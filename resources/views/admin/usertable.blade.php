<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <a href="{{ auth()->user()->hasRole('admin') ? route('admin.dashboard') : route('editor.dashboard')}}"
                           class="text-xl font-semibold text-gray-900 text-white">
                           <- Kembali
                        </a>
            <h2 class="font-semibold text-xl text-white leading-tight">Kelola Users</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
                <table class="w-full text-sm">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($user as $user)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <form action="{{ route('admin.updateRoleSwitch', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="role" 
                                                class="px- py-2 border rounded-md focus:ring focus:ring-blue-300">
                                            <option value="" disabled selected>
                                                {{ $user->getRoleNames()->first() ?? 'Pilih Role' }}
                                            </option>

                                            <!-- Pilihan role lain -->
                                            <option value="admin">admin</option>
                                            <option value="editor">editor</option>
                                        </select>

                                        <button type="submit" 
                                                class="ml-2 px-3 py-1 text-xs font-semibold rounded-md bg-blue-600 text-white hover:bg-blue-700">
                                            Ubah
                                        </button>
                                    </form>

                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs font-semibold rounded-md bg-red-600 text-white hover:bg-red-700">Hapus User</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
