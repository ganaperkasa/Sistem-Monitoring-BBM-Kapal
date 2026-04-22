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
    @endif
    <div class="card">

        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Input Data Jenis BBM Kapal</h5>

            <form action="{{ route('jenisbbm.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Jenis BBM</label>
                    <input type="text" name="jenis_bbm" value="{{ old('jenis_bbm') }}"
                        class="form-control @error('jenis_bmm') is-invalid @enderror" required>
                    @error('jenis_bbm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Faktor Emisi CO2</label>
                    <input type="text" name="faktor_emisi" value="{{ old('faktor_emisi') }}"
                        class="form-control @error('faktor_emisi') is-invalid @enderror"
                        placeholder="Contoh: 3.114 atau 3,114">
                    @error('faktor_emisi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">sulfur</label>
                    <input type="text" name="sulfur" class="form-control" placeholder="Contoh: 0.005 atau 0,005">
                </div>

                <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('jenisbbm.') }}" class="btn btn-danger">Batal</a>
                </div>
            </form>
            <script id="m1y4qk">
                document.querySelector('input[name="faktor_emisi"]').addEventListener('input', function(e) {
                    this.value = this.value.replace(',', '.');
                });

                document.querySelector('input[name="sulfur"]').addEventListener('input', function(e) {
                    this.value = this.value.replace(',', '.');
                });
            </script>

        </div>
    </div>
@endsection
