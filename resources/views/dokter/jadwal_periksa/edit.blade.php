<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Form Edit Jadwal Periksa') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan perbarui informasi jadwal periksa di bawah ini.') }}
                            </p>
                        </header>

                        <form class="mt-6" action="{{ route('dokter.jadwal_periksa.update', $jadwalPeriksa->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            {{-- Hari --}}
                            <div class="mb-3 form-group">
                                <label for="hari">Hari</label>
                                <select
                                    class="rounded form-control"
                                    id="hari"
                                    name="hari"
                                    required
                                >
                                    @foreach (['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'] as $hari)
                                        <option value="{{ $hari }}" {{ $jadwalPeriksa->hari == $hari ? 'selected' : '' }}>
                                            {{ ucfirst($hari) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('hari')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Jam Mulai --}}
                            <div class="mb-3 form-group">
                                <label for="jamMulai">Jam Mulai</label>
                                <input
                                    type="time"
                                    class="rounded form-control"
                                    id="jamMulai"
                                    name="jam_mulai"
                                    value="{{ $jadwalPeriksa->jam_mulai }}"
                                    required
                                >
                                @error('jam_mulai')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Jam Selesai --}}
                            <div class="mb-3 form-group">
                                <label for="jamSelesai">Jam Selesai</label>
                                <input
                                    type="time"
                                    class="rounded form-control"
                                    id="jamSelesai"
                                    name="jam_selesai"
                                    value="{{ $jadwalPeriksa->jam_selesai }}"
                                    required
                                >
                                @error('jam_selesai')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="mb-3 form-group">
                                <label for="status">Status</label>
                                <select
                                    class="rounded form-control"
                                    id="status"
                                    name="status"
                                    required
                                >
                                    <option value="1" {{ $jadwalPeriksa->status == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ $jadwalPeriksa->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div class="flex items-center gap-4 mt-4">
                                <a href="{{ route('dokter.jadwal_periksa.index') }}" class="btn btn-secondary">
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