<x-layout>
  <x-slot:namepage>{{ $namepage }}</x-slot:namepage>  
  
  @if(session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="text-white mb-0">{{ session('success') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if(session()->has('loggedin'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="text-white mb-0">{{ session('loggedin') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="container-fluid py-4 mt-2" style="background-image: url('{{ asset('img/Nomads Map.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: center; min-height: 92vh;">
    {{-- BARIS PERTAMA --}}
    <div class="row mb-4 d-flex justify-content-center">
        <div class="col-12 col-sm-8 col-lg-6">
        <div class="row p-3 rounded shadow-lg d-flex mx-2" style="background: #f5eedc">
          <div class="col-6 col-sm-4 d-flex justify-content-center my-2">
            <div class="text-center text-black">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 6rem; width: 6rem; background: #172b4d;">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 5rem; width: 5rem; background: #ffffff;">
                <p class="m-0 fw-bolder fs-5" style="color: black" id="jumlahBus">{{ $jumlah_bus }}</p>
              </div>
              </div>
              <p class="m-0">Jumlah Bus</p>
            </div>
          </div>
          <div class="col-6 col-sm-4 d-flex justify-content-center my-2">
            <div class="text-center text-black">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 6rem; width: 6rem; background: #172b4d;">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 5rem; width: 5rem; background: #ffffff;">
                <p class="m-0 fw-bolder fs-5" style="color: black" id="jumlahRoute">{{ $jumlah_route }}</p>
              </div>
              </div>
              <p class="m-0">Jumlah Rute</p>
            </div>
          </div>
          <div class="col-6 col-sm-4 d-flex justify-content-center my-2 mx-auto">
            <div class="text-center text-black">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 6rem; width: 6rem; background: #172b4d;">
              <div class="d-flex align-items-center justify-content-center" style="border-radius: 50%; height: 5rem; width: 5rem; background: #ffffff;">
                <p class="m-0 fw-bolder fs-5" style="color: black" id="jumlahSiswa">{{ $jumlah_siswa }}</p>
              </div>
              </div>
              <p class="m-0">Jumlah Siswa</p>
            </div>
          </div>

        </div>
        </div>
    </div>

    {{-- BARIS Kedua --}}
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-sm-8 col-lg-6">
        <div class="rounded p-3 mx-2 shadow-lg" style="background: #f5eedc">
          <h4>Live Map</h4>
            <div id="map" class="rounded" style="min-height: 50vh;"></div>
            <script>
              const map = L.map('map');
              const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
              }).addTo(map);

              const busIcon = L.icon({
                iconUrl: '{{ asset('img/marker.png') }}',
                iconSize: [38, 38],
                iconAnchor: [20, 20],
                popupAnchor: [0, -20],
              });

              const statusColor = {
                'TERSEDIA': 'green',
                'FULL': 'red',
                'MAINTENANCE': 'orange',
              };

              const busMarkers = {}; // Menyimpan marker per bus.id
              let mapInitialized = false;

              function loadBusPositions() {
                fetch('/api/koordinat-bus')
                  .then(res => res.json())
                  .then(busses => {
                    const bounds = [];

                    busses.forEach(bus => {
                      const lat = parseFloat(bus.latitude);
                      const lng = parseFloat(bus.longitude);
                      bounds.push([lat, lng]);

                      if (busMarkers[bus.id]) {
                        // Update posisi marker jika sudah ada
                        busMarkers[bus.id].setLatLng([lat, lng]);
                      } else {
                        // Buat marker baru
                        const marker = L.marker([lat, lng], { icon: busIcon })
                          .addTo(map)
                          .bindPopup(`
                            <b>${bus.nama_bus}</b><br>
                            Rute: ${bus.route?.rute ?? '-'}<br>
                            Status: <span style="color:${statusColor[bus.status] ?? 'black'}">${bus.status}</span>
                          `);
                        busMarkers[bus.id] = marker;
                      }
                    });

                    if (!mapInitialized) {
                      if (bounds.length > 0) {
                        map.fitBounds(bounds, {
                          padding: [50, 50],
                          maxZoom: 16
                        });
                      } else {
                        map.setView([-5.135399, 119.423790], 15);
                      }
                      mapInitialized = true;
                    }
                  });
              }

              // Load pertama kali
              loadBusPositions();

              // Polling tiap 3 detik
              setInterval(loadBusPositions, 3000);
            </script>
        </div>
        </div>
    </div>
  @include('partials/footer')

</x-layout>