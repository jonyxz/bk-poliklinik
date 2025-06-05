<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Janji Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Form Edit Janji Periksa') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan perbarui informasi jadwal periksa di bawah ini.') }}
                            </p>
                        </header>

                        <form class="mt-6" action="{{ route('pasien.janji_periksa.update', $janjiPeriksa->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
        
                            {{-- Nomor Rekam Medis --}}
                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput">Nomor Rekam Medis</label>
                                <input type="text" class="rounded form-control" id="formGroupExampleInput"
                                    value="{{ $no_rm }}" readonly>
                            </div>
        
                            {{-- Pilih Dokter --}}
                            <div class="form-group mb-3">
                                <label for="dokterSelect">Dokter</label>
                                <select class="form-control" id="dokterSelect" name="id_jadwal_periksa" required>
                                    <option value=""  disabled selected>Pilih Dokter</option>
                                    @foreach ($jadwalPeriksas as $jadwal)
                                        <option value="{{ $jadwal->id }}" {{ $janjiPeriksa->id_jadwal_periksa == $jadwal->id ? 'selected' : '' }}>
                                            {{ $jadwal->dokter->nama }} | {{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_jadwal_periksa')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
        
                            {{-- Keluhan --}}
                            <div class="form-group mb-3">
                                <label for="keluhan">Keluhan</label>
                                <textarea class="form-control" id="keluhan" rows="3" name="keluhan" required>{{ $janjiPeriksa->keluhan }}</textarea>
                                @error('keluhan')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ route('pasien.janji_periksa.index') }}" class="btn btn-secondary">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>