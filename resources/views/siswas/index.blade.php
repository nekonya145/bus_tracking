<x-layout>
  <x-slot:namepage>{{ $namepage }}</x-slot:namepage>  

  @if(session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="text-white mb-0">{{ session('success') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  
  <div class="container-fluid py-4 mt-2" style="background-image: url('{{ asset('img/Nomads Map.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: center; min-height: 92vh;">
  <h4 class="text-end me-4">Manajemen Siswa</h4>
  <div class="rounded my-2 d-flex align-items-center" style="min-height: 80vh; background-color: rgba(184, 192, 224, 0.5);">
    <div class="container">
    {{-- BARIS PERTAMA --}}
    <div class="row align-items-center justify-content-center px-3 pb-3">
    <h4>List Data Siswa</h4>
    <div class="card">
        <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Nama</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Email</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">NISN</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Kelas</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">WhatsApp</th>
                <th class="text-secondary opacity-7"></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($siswas as $siswa)
            <tr>
                <td><h6 class="mb-0 text-sm">{{ $siswa->name }}</h6></td>
                <td><p class="text-sm mb-0">{{ $siswa->email }}</p></td>
                <td><p class="text-sm mb-0">{{ $siswa->nisn }}</p></td>
                <td><p class="text-sm mb-0">{{ $siswa->kelas }}</p></td>
                <td><p class="text-sm mb-0">{{ $siswa->nomor_whatsapp }}</p></td>
                <td>
                <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa {{ $siswa->name }}?')" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link text-danger font-weight-bold text-xs p-0 m-0">Hapus</button>
                </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-4">Belum ada data siswa.</td></tr>
            @endforelse
            </tbody>
        </table>
        </div>
    </div>
    </div>

    {{-- BARIS KEDUA --}}
    <div class="row align-items-center justify-content-center px-3">
    <div class="col-sm-6 d-flex justify-content-center">
        <button type="button" class="btn btn-primary m-0" data-bs-toggle="modal" data-bs-target="#tambahSiswa">Tambah Siswa</button>
    </div>
    </div>


    {{-- MODAL --}}
    <div class="modal fade" id="tambahSiswa" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title">Tambah Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">NISN</label>
                    <input type="text" name="nisn" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="kelas" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor WhatsApp</label>
                    <input type="text" name="nomor_whatsapp" class="form-control" required>
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    
  </div>
</div>
@include('partials/footer')

</x-layout>