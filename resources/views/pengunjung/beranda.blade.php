@extends('layouts.pengunjung')

@section('title', 'Beranda - Blog Kami')

@section('content')
<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <h2 class="mb-4 text-navy-dark fw-bold">Artikel Terbaru</h2>
        
        @forelse($artikel as $item)
            <div class="card mb-4 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if($item->gambar)
                            <img src="{{ asset('storage/uploads_artikel/' . $item->gambar) }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $item->judul }}">
                        @else
                            <div class="bg-secondary text-white d-flex justify-content-center align-items-center h-100 rounded-start">
                                <span>No Image</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <span class="badge badge-kategori mb-2">{{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}</span>
                            <h4 class="card-title fw-bold text-navy-dark">
                                <a href="{{ route('artikel.detail', $item->id) }}" class="text-navy-dark text-decoration-none hover-green">
                                    {{ $item->judul }}
                                </a>
                            </h4>
                            <p class="card-text text-muted small mb-2">
                                <i class="bi bi-person me-1"></i> {{ $item->penulis->nama_depan ?? 'Admin' }} {{ $item->penulis->nama_belakang ?? '' }}
                                &bull; 
                                <i class="bi bi-calendar me-1"></i> {{ $item->hari_tanggal ?? $item->created_at->format('d M Y') }}
                            </p>
                            <p class="card-text">
                                {{ Str::limit(strip_tags($item->isi), 120, '...') }}
                            </p>
                            <a href="{{ route('artikel.detail', $item->id) }}" class="btn btn-green btn-sm mt-2">Baca Selengkapnya &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Belum ada artikel yang diterbitkan.</div>
        @endforelse

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $artikel->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4 mt-5 mt-lg-0">
        <div class="card">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h5 class="fw-bold text-navy-dark">Kategori Artikel</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href="{{ route('beranda') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ empty($kategoriId) ? 'active-kategori' : '' }}">
                        Semua Artikel
                        <span class="badge bg-secondary rounded-pill">{{ $kategoriList->sum('artikel_count') }}</span>
                    </a>
                    @foreach($kategoriList as $kat)
                        <a href="{{ route('beranda', ['kategori' => $kat->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $kategoriId == $kat->id ? 'active-kategori' : '' }}">
                            {{ $kat->nama_kategori }}
                            <span class="badge {{ $kategoriId == $kat->id ? 'bg-light text-success' : 'bg-secondary' }} rounded-pill">{{ $kat->artikel_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
