<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Periksa Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow-md sm:rounded-lg">
                <section>
                    <header class="mb-6 border-b pb-3">
                        <h2 class="text-lg font-semibold text-gray-900">Form Periksa Pasien</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Silakan isi form di bawah ini untuk hasil periksa pasien.') }}
                        </p>
                    </header>

                    <div class="mb-6 p-4 bg-gray-100 rounded-md border border-gray-300 text-sm">
                        <div class="mb-2 flex flex-wrap items-center">
                            <span class="font-semibold text-gray-800 w-24 inline-block">Pasien</span>
                            <span class="text-gray-700 mr-2">: {{ $janji->pasien->nama }}</span>
                            <span class="text-xs text-gray-500">({{ $janji->pasien->no_rm }})</span>
                        </div>
                        <div class="mb-2 flex flex-wrap items-center">
                            <span class="font-semibold text-gray-800 w-24 inline-block">Jadwal</span>
                            <span class="text-gray-700">:
                                {{ $janji->jadwalPeriksa->hari }} |
                                {{ \Carbon\Carbon::parse($janji->jadwalPeriksa->jam_mulai)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($janji->jadwalPeriksa->jam_selesai)->format('H:i') }}
                            </span>
                        </div>
                        <div class="flex flex-wrap items-center">
                            <span class="font-semibold text-gray-800 w-24 inline-block">Keluhan</span>
                            <span class="text-gray-700">: {{ $janji->keluhan }}</span>
                        </div>
                    </div>

                    <form action="{{ route('dokter.periksa.store', $janji->id) }}" method="POST"
                        class="space-y-5">
                        @csrf

                        <div>
                            <label for="hasil" class="block text-gray-800 font-medium mb-1">Hasil Periksa</label>
                            <textarea id="hasil" name="hasil" rows="4"
                                class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 btn-blue transition"
                                required></textarea>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="obat">Pilih Obat</label>
                            <select
                                class="rounded form-control"
                                id="obat-dropdown"
                                name="obat[]"
                                multiple
                                required
                                size="5"
                            >
                                @foreach($obats as $obat)
                                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                        {{ $obat->nama_obat }} (Rp{{ number_format($obat->harga,0,',','.') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 form-group">
                            <label for="biaya_periksa">Biaya Periksa</label>
                            <input
                                type="text"
                                class="rounded form-control"
                                id="biaya_periksa"
                                name="biaya"
                                value="150000"
                                readonly
                                required
                            >
                            <small class="text-gray-500">Biaya dasar Rp150.000 + total harga obat.</small>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit"
                                class="px-3 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200">
                                Simpan
                            </button>
                            <a href="{{ route('dokter.periksa.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
document.getElementById('obat-dropdown').addEventListener('change', function() {
    let dasar = 150000;
    let totalObat = 0;
    Array.from(this.selectedOptions).forEach(option => {
        totalObat += parseInt(option.getAttribute('data-harga')) || 0;
    });
    document.getElementById('biaya_periksa').value = dasar + totalObat;
});
</script>