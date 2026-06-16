@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif (session('success'))
        <div class="alert alert-success alert-auto-close show" role="alert">
            <strong>Sukses!</strong> {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Input Data Operasional Kapal</h5>

            <form action="{{ url('/operasional/store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Jenis Kapal</label>
                    <input type="text" name="jenis_kapal"
                        value="{{ old('jenis_kapal') }}"class="form-control @error('jenis_kapal') is-invalid @enderror"
                        placeholder="(Cth: Ferry, Cargo, Tanker, dll)" required>
                    @error('jenis_kapal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Kapal</label>
                    <input type="number" name="tahun_kapal" id="tahun_kapal"
                        value="{{ old('tahun_kapal') }}"class="form-control @error('tahun_kapal') is-invalid @enderror"
                        required>
                    @error('tahun_kapal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kapasitas Kapal (GT/DWT)</label>
                    <input type="number" name="kapasitas_kapal"
                        value="{{ old('kapasitas_kapal') }}"class="form-control @error('kapasitas_kapal') is-invalid @enderror"
                        placeholder="(GT untuk kapal penumpang atau ro-ro)" required>
                    @error('kapasitas_kapal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Area Pelayaran</label>
                    <select name="area" id="area" class="form-control">
                        <option value="non_eca">Non-ECA</option>
                        <option value="eca">ECA</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tier IMO</label>
                    <input type="text" id="tier" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">RPM Kapal (RPM)</label>
                    <input type="number" id="rpm2" name="rpm2"
                        value="{{ old('rpm2') }}"class="form-control @error('rpm2') is-invalid @enderror" required>
                    @error('rpm2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kecepatan Kapal (Knot)</label>
                    <input type="number" id="rpm" name="rpm" step="0.001" min="0"
                        value="{{ old('rpm') }}" class="form-control @error('rpm') is-invalid @enderror" required>
                    @error('rpm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Daya Mesin (kW)</label>
                    <input type="number" id="daya_mesin" step="0.01" name="daya_mesin"
                        value="{{ old('daya_mesin') }}"class="form-control @error('daya_mesin') is-invalid @enderror"
                        required>
                    @error('daya_mesin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Jarak Tempuh (NM)</label>
                    <input type="number"id="jarak_tempuh" name="jarak_tempuh"
                        value="{{ old('jarak_tempuh') }}"class="form-control @error('jarak_tempuh') is-invalid @enderror"
                        required>
                    @error('jarak_tempuh')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Lama Operasi (Jam)</label>
                    <input type="number" id="lama_operasi" class="form-control" readonly>

                </div>

                <div class="mb-3">
                    <label class="form-label">Konsumsi BBM (Liter)</label>
                    <input type="number" id="konsumsi_bbm" name="konsumsi_bbm" class="form-control" readonly>

                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis BBM</label>
                    <select name="jenis_bbm_id" class="form-control" required>
                        <option value="">-- Pilih BBM --</option>
                        @foreach ($bbm as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->jenis_bbm }} | CO₂: {{ $item->faktor_emisi }} | S: {{ $item->sulfur }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">

                    <button class="btn btn-primary">Simpan & Hitung</button>
                    {{-- <a href="{{ route('operasional.') }}" class="btn btn-danger">Batal</a> --}}
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('tahun_kapal').addEventListener('input', hitungTier);
        document.getElementById('area').addEventListener('change', hitungTier);

        document.getElementById('jarak_tempuh').addEventListener('input', hitungSemua);
        document.getElementById('rpm').addEventListener('input', hitungSemua);
        document.getElementById('daya_mesin').addEventListener('input', hitungSemua);

        function hitungSemua() {
            hitungLamaOperasi();
            hitungKonsumsiBBM();
        }


        function hitungLamaOperasi() {
            let jarak = parseFloat(document.getElementById('jarak_tempuh').value);
            let kecepatan = parseFloat(document.getElementById('rpm').value);

            if (!isNaN(jarak) && !isNaN(kecepatan) && kecepatan > 0) {
                let hasil = jarak / kecepatan;
                document.getElementById('lama_operasi').value = hasil.toFixed(2);
            } else {
                document.getElementById('lama_operasi').value = '';
            }
        }

        function hitungKonsumsiBBM() {
            let daya = parseFloat(document.getElementById('daya_mesin').value);
            let lama = parseFloat(document.getElementById('lama_operasi').value);

            if (!isNaN(daya) && !isNaN(lama)) {
                let bbm = daya * lama * 0.232;
                document.getElementById('konsumsi_bbm').value = bbm.toFixed(2);
            } else {
                document.getElementById('konsumsi_bbm').value = '';
            }
        }

        function hitungTier() {
            let tahun = parseInt(document.getElementById('tahun_kapal').value);
            let area = document.getElementById('area').value;
            let tier = '';

            if (tahun < 2000) {
                tier = 'Tier I';
            } else if (tahun >= 2000 && tahun < 2016) {
                tier = 'Tier II';
            } else {
                tier = (area === 'eca') ? 'Tier III' : 'Tier II';
            }

            document.getElementById('tier').value = tier;
        }
    </script>

@endsection
