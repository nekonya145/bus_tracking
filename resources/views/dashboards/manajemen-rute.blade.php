<x-layout>
  <x-slot:namepage>{{ $namepage }}</x-slot:namepage>  

  @if(session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="text-white mb-0">{{ session('success') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if(session()->has('error'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <p class="text-white mb-0">{{ session('error') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  
  <div class="container-fluid py-4 mt-2" style="background-image: url('{{ asset('img/Nomads Map.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: center; min-height: 92vh;">
  <h4 class="text-end me-4">Manajemen Jadwal</h4>
  <div class="rounded my-2 d-flex align-items-center" style="min-height: 80vh; background-color: rgba(184, 192, 224, 0.5);">
    <div class="container">
    {{-- BARIS PERTAMA --}}
    <div class="row align-items-center justify-content-center px-3 pb-3">
      <h4>List Data Rute</h4>
      <div class="card">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rute Bus</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Waktu Start</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Waktu Finish</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
              @foreach ($routes as $route)
              <tr>
                <td>
                  <span class="text-xs font-weight-bold">{{ $route->nama_rute }}</span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">{{ $route->time_start }}</span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">{{ $route->time_end }}</span>
                </td>
                <td class="align-middle">
                  <a href="#"
                    class="text-primary font-weight-bold text-xs me-2 edit-rute-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#editJadwalBus"
                    data-id="{{ $route->id }}"
                    data-nama_rute="{{ $route->nama_rute }}"
                    data-jam_keberangkatan="{{ $route->time_start }}"
                    data-jam_kepulangan="{{ $route->time_end }}"
                    data-action="{{ route('rute.update', $route->id) }}">
                    Edit
                  </a>
                  <form action="{{ route('rute.destroy', $route->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-link text-danger font-weight-bold text-xs p-0 m-0">Hapus</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- BARIS KEDUA --}}
    <div class="row align-items-center justify-content-center px-3">
      <div class="col-sm-6 d-flex justify-content-center">
      <button type="button" class="btn btn-primary m-0" data-bs-toggle="modal" data-bs-target="#tambahJadwalBus">Tambah Jadwal</button>
      </div>
    </div>
    </div>


    {{-- MODAL --}}
    <div class="modal fade" id="editJadwalBus" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editRuteForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Jadwal Rute</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Nama Rute --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Rute</label>
                            <input type="text" id="edit_nama_rute" name="nama_rute" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Waktu Berangkat</label>
                                <input type="time" id="edit_jam_keberangkatan" name="jam_keberangkatan" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Waktu Pulang</label>
                                <input type="time" id="edit_jam_kepulangan" name="jam_kepulangan" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
  </div>
  @include('partials/footer')
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
      const editButtons = document.querySelectorAll('.edit-rute-btn');
      const form = document.getElementById('editRuteForm');

      editButtons.forEach(button => {
          button.addEventListener('click', () => {
              form.action = button.getAttribute('data-action');
              document.getElementById('edit_nama_rute').value = button.getAttribute('data-nama_rute');
              document.getElementById('edit_jam_keberangkatan').value = button.getAttribute('data-jam_keberangkatan');
              document.getElementById('edit_jam_kepulangan').value = button.getAttribute('data-jam_kepulangan');
          });
      });
  });
  </script>

</x-layout>