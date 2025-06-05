<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Janji Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Janji Periksa') }}
                        </h2>
                        <div class="flex-col items-center justify-center text-center">
                            <a href="{{ route('pasien.janji_periksa.create') }}" class="btn btn-primary">Tambah Janji Periksa</a>

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
                                    <th scope="col">No Rekam Medis</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($janjiPeriksas as $janji)
                                    <tr>
                                        <th scope="row" class="align-middle text-start">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="align-middle text-start">
                                            {{ ucfirst($janji->no_rm) }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $janji->jadwalPeriksa->dokter->nama ?? 'Tidak tersedia' }}
                                        </td>
                                        <td class="align-middle text-start">
                                            {{ $janji->keluhan }}
                                        </td>
                                        <td class="flex items-center gap-2">
                                            {{-- Button Edit --}}
                                            <a href="{{ route('pasien.janji_periksa.edit', $janji->id) }}" class="btn btn-secondary btn-sm">
                                                Edit
                                            </a>
                                        
                                            {{-- Button Delete --}}
                                            <form action="{{ route('pasien.janji_periksa.destroy', $janji->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus janji ini?')">
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