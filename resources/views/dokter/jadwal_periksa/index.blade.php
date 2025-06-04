<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Jadwal Periksa') }}
                        </h2>
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.jadwal_periksa.create') }}" class="btn btn-primary">Tambah Jadwal Periksa</a>

                            @if (session('success'))
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600"
                                >
                                    {{ session('success') }}
                                </p>
                            @endif
                        </div>
                    </header>
                    <div class="table-responsive">
                        <table class="table mt-6 overflow-hidden rounded table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Jam Mulai</th>
                                    <th scope="col">Jam Selesai</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwalPeriksas as $jadwal)
                                    <tr>
                                        <th scope="row" class="align-middle text-start">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="align-middle text-start">
                                            {{ ucfirst($jadwal->hari) }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $jadwal->jam_mulai }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $jadwal->jam_selesai }}
                                        </td>
                                        <td class="align-middle text-start">
                                            <span class="{{ $jadwal->status ? 'badge badge-pill bg-success px-4 py-2 rounded-full text-white' : 'badge badge-pill bg-danger px-4 py-2 rounded-full text-white' }}">
                                                {{ $jadwal->status ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-start">
                                                <div class="flex items-center gap-2">
                                                    <form action="{{ route('dokter.jadwal_periksa.toggleStatus', $jadwal->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn-sm" {{ $jadwal->status ? 'disabled' : '' }}>
                                                            Aktifkan
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('dokter.jadwal_periksa.toggleStatus', $jadwal->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-danger btn-sm" {{ !$jadwal->status ? 'disabled' : '' }}>
                                                            Nonaktifkan
                                                        </button>
                                                    </form>
                                                </div>
                                        </td>
                                        <td class="flex items-center gap-2">
                                            {{-- Button Edit --}}
                                            <a href="{{ route('dokter.jadwal_periksa.edit', $jadwal->id) }}" class="btn btn-secondary btn-sm">
                                                Edit
                                            </a>
                                        
                                            {{-- Button Delete --}}
                                            <form action="{{ route('dokter.jadwal_periksa.destroy', $jadwal->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </section>
            </div>
        </div>
    </div>
</x-app-layout>