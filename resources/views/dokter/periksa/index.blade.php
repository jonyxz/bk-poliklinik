<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Janji Periksa') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            Daftar Periksa
                        </h2>
                    </header>
                    <div class="overflow-x-auto">
                        <table
                            class="min-w-full table-auto table-striped table-hover border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        No</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        No Antrian</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Pasien</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Jadwal</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Keluhan</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($janjiPeriksas as $janji)
                                    @php
                                        $sudahDiperiksa = $janji->periksa !== null;
                                        $noAntrianUtama = $janjiPeriksas->filter(function($item) {
                                            return $item->periksa === null;
                                        })->min(function($item) {
                                            return (int) $item->no_antrian;
                                        });
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-2 align-middle">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 align-middle">
                                            <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded text-xs">
                                                Antrian: {{ $janji->no_antrian }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 align-middle">
                                            {{ optional($janji->pasien)->nama ?? '-' }}
                                            <div class="text-xs text-gray-500">
                                                {{ optional($janji->pasien)->no_rm ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 align-middle">
                                            {{ $janji->jadwalPeriksa->hari }} |
                                            {{ \Carbon\Carbon::parse($janji->jadwalPeriksa->jam_mulai)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($janji->jadwalPeriksa->jam_selesai)->format('H:i') }}
                                        </td>
                                        <td class="px-4 py-2 align-middle">{{ $janji->keluhan }}</td>
                                        <td class="px-4 py-2 align-middle">
                                            @if($sudahDiperiksa)
                                                <span class="px-3 py-1 bg-gray-300 text-gray-600 rounded text-sm cursor-not-allowed">Sudah Diperiksa</span>
                                            @else
                                                <a href="{{ route('dokter.periksa.create', $janji->id) }}"
                                                    class="px-3 py-1 @if((int)$janji->no_antrian === (int)$noAntrianUtama) bg-success @else bg-danger @endif text-white rounded transition text-sm font-semibold">
                                                    Periksa
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada janji periksa
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