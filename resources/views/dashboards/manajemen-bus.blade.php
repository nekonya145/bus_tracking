<x-layout>
  <x-slot:namepage>{{ $namepage }}</x-slot:namepage>  

  @if(session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="text-white mb-0">{{ session('success') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  
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
                          <p class="text-xs text-secondary mb-0">({{ $bus->route?->time_start ?? '-' }} - {{ $bus->route->time_end ?? '-' }})</p>
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
                          <a href="#"
                            class="text-primary font-weight-bold text-xs me-2 edit-bus-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#editBusModal"
                            data-id="{{ $bus->id }}"
                            data-nama_bus="{{ $bus->nama_bus }}"
                            data-plat="{{ $bus->plat }}"
                            data-status="{{ $bus->status }}"
                            data-driver_id="{{ $bus->driver_id }}"
                            data-route_id="{{ $bus->route_id }}"
                            data-action="{{ route('bus.update', $bus->id) }}">
                            Edit
                          </a>
                          <form action="{{ route('bus.destroy', $bus->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus bus {{ $bus->nama_bus }}?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger font-weight-bold text-xs p-0 m-0" style="border: none; background: none;">
                                Hapus
                            </button>
                          </form>
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
    {{-- <div class="modal fade" id="tambahBus" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('bus.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Bus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tambah_nama_bus" class="form-label">Nama Bus</label>
                            <input type="text" id="tambah_nama_bus" name="nama_bus" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tambah_plat" class="form-label">Plat Nomor</label>
                            <input type="text" id="tambah_plat" name="plat" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tambah_status" class="form-label">Status</label>
                            <select id="tambah_status" name="status" class="form-control" required>
                                <option value="TERSEDIA">TERSEDIA</option>
                                <option value="FULL">FULL</option>
                                <option value="MAINTENANCE">MAINTENANCE</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tambah_driver_id" class="form-label">Driver</label>
                            <select id="tambah_driver_id" name="driver_id" class="form-control" required>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tambah_route_id" class="form-label">Rute</label>
                            <select id="tambah_route_id" name="route_id" class="form-control" required>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}">{{ $route->nama_rute }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

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
                        {{-- Nama Bus --}}
                        <div class="mb-3">
                            <label for="edit_nama_bus" class="form-label">Nama Bus</label>
                            <input type="text" id="edit_nama_bus" name="nama_bus" class="form-control" required>
                        </div>

                        {{-- Plat Nomor --}}
                        <div class="mb-3">
                            <label for="edit_plat" class="form-label">Plat Nomor</label>
                            <input type="text" id="edit_plat" name="plat" class="form-control" required>
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label for="edit_status" class="form-label">Status</label>
                            <select id="edit_status" name="status" class="form-control">
                                <option value="TERSEDIA">TERSEDIA</option>
                                <option value="FULL">FULL</option>
                                <option value="MAINTENANCE">MAINTENANCE</option>
                            </select>
                        </div>

                        {{-- Driver --}}
                        <div class="mb-3">
                            <label for="edit_driver_id" class="form-label">Driver</label>
                            <select id="edit_driver_id" name="driver_id" class="form-control">
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                                    <option value="">-</option>
                            </select>
                        </div>

                        {{-- Rute --}}
                        <div class="mb-3">
                            <label for="edit_route_id" class="form-label">Rute</label>
                            <select id="edit_route_id" name="route_id" class="form-control">
                                @foreach ($routes as $route)
                                    <option value="{{ $route->id }}">{{ $route->nama_rute }}</option>
                                @endforeach
                                    <option value="">-</option>
                            </select>
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
        const editButtons = document.querySelectorAll('.edit-bus-btn');

        const modal = new bootstrap.Modal(document.getElementById('editBusModal'));
        const form = document.getElementById('editBusForm');

        const inputNama = document.getElementById('edit_nama_bus');
        const inputPlat = document.getElementById('edit_plat');
        const selectStatus = document.getElementById('edit_status');
        const selectDriver = document.getElementById('edit_driver_id');
        const selectRoute = document.getElementById('edit_route_id');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const namaBus = button.getAttribute('data-nama_bus');
                const plat = button.getAttribute('data-plat');
                const status = button.getAttribute('data-status');
                const driverId = button.getAttribute('data-driver_id');
                const routeId = button.getAttribute('data-route_id');
                const action = button.getAttribute('data-action');

                form.action = action;
                inputNama.value = namaBus;
                inputPlat.value = plat;
                selectStatus.value = status;
                selectDriver.value = driverId;
                selectRoute.value = routeId;
            });
        });
    });
  </script>

</x-layout>