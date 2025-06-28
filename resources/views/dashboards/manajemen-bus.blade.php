<x-layout>
  <x-slot:namepage>{{ $namepage }}</x-slot:namepage>  
  
  <div class="container-fluid py-4 mt-2" style="background-image: url('{{ asset('img/Nomads Map.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: center; min-height: 92vh;">
  <h4 class="text-end me-4">Manajemen Bus</h4>
  <div class="rounded my-2 d-flex align-items-center" style="min-height: 80vh; background-color: rgba(184, 192, 224, 0.5);">
    <div class="container">
    {{-- BARIS PERTAMA --}}
    <div class="row align-items-center justify-content-center px-3 pb-3">
      <h4>List Data Bus</h4>
      <div class="card">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
              <thead>
                  <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plat</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Bus</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rute</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Driver</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
                      <th class="text-secondary opacity-7"></th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($buses as $bus)
                  <tr>
                      <td>
                          <h6 class="mb-0 text-sm">{{ $bus->plat }}</h6>
                      </td>
                      <td>
                          <h6 class="mb-0 text-sm">{{ $bus->nama_bus }}</h6>
                      </td>
                      <td>
                          <p class="text-sm font-weight-bold mb-0">{{ $bus->route?->nama_rute ?? 'Tanpa Rute' }}</p>
                          <p class="text-xs text-secondary mb-0">({{ $bus->route?->time_start }} - {{ $bus->route->time_end }})</p>
                      </td>
                      <td>
                          <h6 class="mb-0 text-sm">{{ $bus->driver?->name ?? '-' }}</h6>
                      </td>
                      <td class="align-middle text-center text-sm">
                          @if($bus->status == 'TERSEDIA')
                              <span class="badge badge-sm bg-gradient-info">TERSEDIA</span>
                          @elseif($bus->status == 'FULL')
                              <span class="badge badge-sm bg-gradient-warning">FULL</span>
                          @elseif($bus->status == 'MAINTENANCE')
                              <span class="badge badge-sm bg-gradient-secondary">MAINTENANCE</span>
                          @endif
                      </td>
                      <td class="align-middle">
                          {{-- <a href="#"
                            class="text-primary font-weight-bold text-xs me-2 edit-bus-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#editBusModal"
                            data-id="{{ $bus->id }}"
                            data-nama_bus="{{ $bus->nama_bus }}"
                            data-plat="{{ $bus->plat }}"
                            data-action="{{ route('bus.update', $bus->id) }}">
                              Edit
                          </a> --}}
                          <a href="{{-- route('bus.destroy', $bus->id) --}}" class="text-danger font-weight-bold text-xs" onclick="return confirm('Yakin ingin menghapus bus plat {{ $bus->plat }}?')">Hapus</a>
                      </td>
                  </tr>
                  @empty
                  {{-- Ini akan ditampilkan jika tidak ada data bus sama sekali --}}
                  <tr>
                      <td colspan="5" class="text-center py-4">
                          <p class="text-secondary mb-0">Belum ada data bus yang ditambahkan.</p>
                      </td>
                  </tr>
                  @endforelse
              </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- BARIS KEDUA --}}
    <div class="row align-items-center justify-content-center px-3">
      <div class="col-sm-6 d-flex justify-content-center">
      <button type="button" class="btn btn-primary m-0" data-bs-toggle="modal" data-bs-target="#tambahBus">Tambah Bus</button>
      </div>
    </div>
    </div>


    {{-- MODAL --}}
    <div class="modal fade" id="tambahBus" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="/tambah-bus" method="POST">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalTambahBusLabel">Tambah Bus</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="text" name="nama_bus" class="form-control" placeholder="Nama Bus">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editBusModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editBusForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBusModalLabel">Edit Bus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_nama_bus" class="form-label">Nama Bus</label>
                            <input type="text" id="edit_nama_bus" name="nama_bus" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_plat" class="form-label">Plat Nomor</label>
                            <input type="text" id="edit_plat" name="plat" class="form-control" required>
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
      // Tangkap event saat modal akan ditampilkan
      const editBusModal = document.getElementById('editBusModal');
      editBusModal.addEventListener('show.bs.modal', function (event) {
          // Tombol yang memicu modal
          const button = event.relatedTarget;

          // Ambil data dari atribut data-*
          const namaBus = button.getAttribute('data-nama_bus');
          const plat = button.getAttribute('data-plat');
          const action = button.getAttribute('data-action');

          // Dapatkan elemen form dan input di dalam modal
          const modalForm = editBusModal.querySelector('#editBusForm');
          const modalInputNamaBus = editBusModal.querySelector('#edit_nama_bus');
          const modalInputPlat = editBusModal.querySelector('#edit_plat');
          const modalTitle = editBusModal.querySelector('.modal-title');

          // Update action form dan value dari input
          modalForm.action = action;
          modalInputNamaBus.value = namaBus;
          modalInputPlat.value = plat;
          modalTitle.textContent = 'Edit Bus: ' + plat;
      });
  });
  </script>

</x-layout>