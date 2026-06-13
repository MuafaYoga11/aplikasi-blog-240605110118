@extends('layouts.pengunjung')

@section('title', $artikel->judul . ' - Blog Kami')

@section('content')
<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white p-3 rounded shadow-sm">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}" class="text-green text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('beranda', ['kategori' => $artikel->id_kategori]) }}" class="text-green text-decoration-none">
                        {{ $artikel->kategori->nama_kategori ?? 'Kategori' }}
                    </a>
                </li>
                <li class="breadcrumb-item active text-truncate" aria-current="page" style="max-width: 200px;">{{ $artikel->judul }}</li>
            </ol>
        </nav>

        <div class="card mb-4">
            @if($artikel->gambar)
                <img src="{{ asset('storage/uploads_artikel/' . $artikel->gambar) }}" class="card-img-top object-fit-cover" alt="{{ $artikel->judul }}" style="max-height: 400px;">
            @endif
            <div class="card-body p-4 p-lg-5">
                <span class="badge badge-kategori mb-3 px-3 py-2 fs-6">{{ $artikel->kategori->nama_kategori ?? 'Tanpa Kategori' }}</span>
                
                <h1 class="card-title fw-bold text-navy-dark mb-3">{{ $artikel->judul }}</h1>
                
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom text-muted">
                    <div class="me-3">
                        @if(isset($artikel->penulis->foto) && $artikel->penulis->foto)
                            <img src="{{ asset('storage/uploads_penulis/' . $artikel->penulis->foto) }}" alt="Author" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center" style="width: 40px; height: 40px;">
                                <i class="bi bi-person"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="fw-bold text-dark">{{ $artikel->penulis->nama_depan ?? 'Admin' }} {{ $artikel->penulis->nama_belakang ?? '' }}</div>
                        <div class="small"><i class="bi bi-calendar me-1"></i> {{ $artikel->hari_tanggal ?? $artikel->created_at->format('d M Y') }}</div>
                    </div>
                </div>

                <div class="card-text lh-lg" style="font-size: 1.1rem; color: #475569;">
                    {!! $artikel->isi !!}
                </div>

                <div class="mt-5 pt-4 border-top">
                    <a href="{{ route('beranda') }}" class="btn btn-outline-secondary">
                        &larr; Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar: Artikel Terkait -->
    <div class="col-lg-4 mt-5 mt-lg-0">
        <div class="card sticky-top" style="top: 20px;">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h5 class="fw-bold text-navy-dark">Artikel Terkait</h5>
            </div>
            <div class="card-body">
                @forelse($artikelTerkait as $terkait)
                    <div class="d-flex mb-3 align-items-center">
                        <div class="flex-shrink-0 me-3">
                            @if($terkait->gambar)
                                <img src="{{ asset('storage/uploads_artikel/' . $terkait->gambar) }}" class="rounded object-fit-cover" alt="{{ $terkait->judul }}" width="70" height="70">
                            @else
                                <div class="bg-secondary text-white rounded d-flex justify-content-center align-items-center" style="width: 70px; height: 70px;">
                                    <span style="font-size: 0.7rem;">No Img</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h6 class="mb-1">
                                <a href="{{ route('artikel.detail', $terkait->id) }}" class="text-navy-dark text-decoration-none fw-bold" style="font-size: 0.95rem;">
                                    {{ Str::limit($terkait->judul, 40) }}
                                </a>
                            </h6>
                            <small class="text-muted">{{ $terkait->hari_tanggal ?? $terkait->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                @empty
                    <p class="text-muted small">Belum ada artikel terkait di kategori ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
