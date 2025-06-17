<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Janji Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Buat Janji Periksa') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Atur jadwal pertemuan dengan dokter untuk mendapatkan layanan konsultasi dan pemeriksaan kesehatan sesuai kebutuhan Anda.') }}
                        </p>
                    </header>

                    <form class="mt-6" action="{{ route('pasien.janji_periksa.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="formGroupExampleInput">Nomor Rekam Medis</label>
                            <input type="text" class="rounded form-control" id="formGroupExampleInput"
                                placeholder="Example input" value="{{ $no_rm }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="dokterSelect">Dokter</label>
                            <select class="form-control" id="dokterSelect" name="id_jadwal_periksa" required>
                                <option value=""  disabled selected>Pilih Dokter</option>
                                @foreach ($jadwalPeriksas as $jadwal)
                                    @if ($jadwal->dokter) 
                                        <option value="{{ $jadwal->id }}">
                                            {{ $jadwal->dokter->nama }} - spesialis {{ $jadwal->dokter->polis->nama ?? "NA" }} | {{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keluhan">Keluhan</label>
                            <textarea class="form-control" id="keluhan" rows="3" name="keluhan" required></textarea>
                        </div>
                        <div class="flex items-center gap-4 mt-4">
                            {{-- <a href="{{ route('pasien.janji_periksa.index') }}" class="btn btn-secondary">
                                Batal
                            </a> --}}
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <div class="flex items-center gap-4 mt-4">
                        @if (session('status'))
                            <div class="mb-4 px-4 py-2 rounded bg-green-100 text-green-800">
                                {{ session('status') }}
                            </div>
                        @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>