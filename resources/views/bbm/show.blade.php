@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Data Operasional</h5>

                <a href="" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i> PDF
                </a>
            </div>

            <div class="card-body">

                {{-- ================= INFO KAPAL ================= --}}
                <h6 class="mb-3">Informasi Kapal</h6>
                <div class="row mb-4">
                    <div class="col-md-4 col-6 mb-2">
                        <strong>Jenis Kapal</strong><br>
                        {{ $data->jenis_kapal }}
                    </div>
                    <div class="col-md-4 col-6 mb-2">
                        <strong>Tahun</strong><br>
                        {{ $data->tahun_kapal }}
                    </div>
                    <div class="col-md-4 col-6 mb-2">
                        <strong>Kapasitas</strong><br>
                        {{ $data->kapasitas_kapal }}
                    </div>
                </div>

                {{-- ================= OPERASIONAL ================= --}}
                <h6 class="mb-3">Data Operasional</h6>
                <div class="row mb-4">
                    <div class="col-md-3 col-6 mb-2">
                        <strong>RPM</strong><br>
                        {{ $data->rpm }}
                    </div>
                    <div class="col-md-3 col-6 mb-2">
                        <strong>Daya Mesin</strong><br>
                        {{ $data->daya_mesin }}
                    </div>
                    <div class="col-md-3 col-6 mb-2">
                        <strong>Lama Operasi</strong><br>
                        {{ $data->lama_operasi }}
                    </div>
                    <div class="col-md-3 col-6 mb-2">
                        <strong>Jarak</strong><br>
                        {{ $data->jarak_tempuh }}
                    </div>
                    <div class="col-md-3 col-6 mb-2">
                        <strong>Konsumsi BBM</strong><br>
                        {{ $data->konsumsi_bbm }}
                    </div>
                    <div class="col-md-3 col-6 mb-2">
                        <strong>Jenis BBM</strong><br>
                        {{ $data->bbm->jenis_bbm ?? '-' }}
                    </div>
                </div>

                {{-- ================= HASIL EMISI (CARD) ================= --}}
                <h6 class="mb-3">Hasil Emisi</h6>
                <div class="row text-center mb-4">

                    <div class="col-md-3 col-6 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6>CO₂</h6>
                                <h5>{{ $data->co2 }}</h5>
                                <span class="badge bg-{{ $co2_color }}">{{ $co2_status }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-6 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6>NOx</h6>
                                <h5>{{ $data->nox }}</h5>
                                <span class="badge bg-{{ $nox_color }}">{{ $nox_status }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-6 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6>SOx</h6>
                                <h5>{{ $data->sox }}</h5>
                                <span class="badge bg-{{ $sox_color }}">{{ $sox_status }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-6 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6>CII</h6>
                                <h5>{{ $data->cii }}</h5>
                                <span class="badge bg-{{ $cii_color }}">{{ $cii_status }}</span>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ================= REKOMENDASI ================= --}}
                <h6 class="mb-3">Rekomendasi</h6>
                <div class="card bg-light border-0 mb-4">
                    <div class="card-body">
                        <ul>
                            <li>
                                <strong>CO₂ (Emisi Karbon):</strong><br>
                                @if ($co2_color == 'success')
                                    Emisi CO₂ tergolong rendah. Kondisi ini menunjukkan efisiensi konsumsi bahan bakar sudah
                                    baik. Disarankan untuk mempertahankan pola operasional saat ini.
                                @elseif($co2_color == 'warning')
                                    Emisi CO₂ berada pada tingkat sedang. Perlu dilakukan optimalisasi konsumsi bahan bakar
                                    dan efisiensi perjalanan kapal.
                                @else
                                    Emisi CO₂ tinggi. Disarankan melakukan evaluasi operasional, seperti pengurangan
                                    konsumsi bahan bakar, optimasi rute, atau penggunaan bahan bakar yang lebih ramah
                                    lingkungan.
                                @endif
                            </li>

                            <li>
                                <strong>NOx (Emisi Nitrogen Oksida):</strong><br>
                                @if ($nox_color == 'success')
                                    Emisi NOx sangat baik dan telah memenuhi standar IMO Tier III. Mesin dalam kondisi
                                    optimal.
                                @elseif($nox_color == 'warning')
                                    Emisi NOx masih dalam batas normal (IMO Tier II), namun perlu pemantauan berkala
                                    terhadap performa mesin.
                                @else
                                    Emisi NOx tinggi dan melebihi standar IMO. Disarankan melakukan perawatan mesin atau
                                    penggunaan teknologi pengendalian emisi seperti SCR (Selective Catalytic Reduction).
                                @endif
                            </li>

                            <li>
                                <strong>SOx (Emisi Sulfur):</strong><br>
                                @if ($sox_color == 'success')
                                    Kandungan sulfur sangat rendah dan telah memenuhi regulasi MARPOL Annex VI. Kondisi
                                    bahan bakar sangat baik.
                                @elseif($sox_color == 'warning')
                                    Kandungan sulfur masih sesuai batas global IMO (≤ 0.50%), namun perlu diperhatikan jika
                                    beroperasi di area ECA.
                                @else
                                    Kandungan sulfur melebihi batas yang ditetapkan. Disarankan menggunakan bahan bakar
                                    rendah sulfur atau memasang scrubber.
                                @endif
                            </li>

                            <li>
                                <strong>CII (Efisiensi Karbon):</strong><br>
                                @if ($cii_color == 'success')
                                    Kapal memiliki efisiensi operasional sangat baik (Rating A). Tidak diperlukan perbaikan
                                    signifikan.
                                @elseif($cii_color == 'info')
                                    Kapal tergolong efisien (Rating B). Disarankan mempertahankan performa operasional.
                                @elseif($cii_color == 'warning')
                                    Efisiensi cukup (Rating C). Perlu peningkatan efisiensi untuk menghindari penurunan
                                    rating.
                                @else
                                    Efisiensi rendah (Rating D/E). Disarankan evaluasi menyeluruh terhadap operasional kapal
                                    dan konsumsi bahan bakar.
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- ================= KESIMPULAN ================= --}}
                <div class="alert alert-info">
                    <strong>Kesimpulan Akhir:</strong><br>
                    Sistem menunjukkan bahwa kondisi emisi kapal saat ini
                    <strong>{{ $overall }}</strong>.
                </div>

            </div>
        </div>

    </div>
@endsection
