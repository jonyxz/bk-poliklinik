<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Form Tambah Jadwal Periksa') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Silakan isi form di bawah ini untuk menambahkan jadwal periksa baru.') }}
                        </p>
                    </header>

                    <form class="mt-6" action="{{ route('dokter.jadwal_periksa.store') }}" method="POST">
                        @csrf

                        {{-- Hari --}}
                        <div class="mb-3 form-group">
                            <label for="hari">Hari</label>
                            <select
                                class="rounded form-control"
                                id="hari"
                                name="hari"
                                required
                            >
                                <option value="" disabled selected>Pilih Hari</option>
                                @foreach (['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'] as $hari)
                                    <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>
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
                                value="{{ old('jam_mulai') }}"
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
                                value="{{ old('jam_selesai') }}"
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
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
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
</x-app-layout>