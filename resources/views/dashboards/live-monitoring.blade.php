<x-layout>
  <x-slot:namepage>{{ $namepage }}</x-slot:namepage>  
  
  <div class="container-fluid py-4 mt-2" style="background-image: url('{{ asset('img/Nomads Map.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: center; min-height: 92vh;">
  <h4 class="text-end me-4">Monitoring Live</h4>
  <div class="rounded my-2 d-flex align-items-center" style="min-height: 80vh; background-color: rgba(184, 192, 224, 0.5);">
    <div class="container h-100">
    {{-- BARIS PERTAMA --}}
    <div class="row h-100 align-items-center px-3 py-5">
      
        <div class="col-md-8">
            <h4 class="fw-bold">Live Monitoring</h4>
            <div id="map" class="rounded shadow-lg" style="min-height: 50vh;"></div>
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
                fetch('/api/buses')
                  .then(res => res.json())
                  .then(response => {

                    const busData = response.data.buses;
                    const bounds = [];

                    busData.forEach(bus => {
                    const lat = parseFloat(bus.latitude);
                    const lng = parseFloat(bus.longitude);
                    bounds.push([lat, lng]);


                    if (busMarkers[bus.id]) {
                        busMarkers[bus.id].setLatLng([lat, lng]);
                      } else {
                        const marker = L.marker([lat, lng], { icon: busIcon }).addTo(map);
                        busMarkers[bus.id] = marker;

                        marker.on('click', function () {
                          document.getElementById('platNomor').textContent = bus.plat ?? '-';
                          document.getElementById('ruteAktif').textContent = bus.nama_route ?? 'Rute tidak ditemukan';
                          document.getElementById('kodeBus').textContent = bus.nama_bus ?? '-';
                        });
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

              loadBusPositions();

              setInterval(loadBusPositions, 3000);
            </script>
        </div>

        <div class="col-md-4">
          {{-- Element Pertama --}}
          <div class="row rounded my-2" style="background: #f5eedc">
              <div class="col-3 d-flex align-items-center justify-content-center">
                <i class="ni ni-bus-front-12 text-dark fs-3 opacity-10"></i>
              </div>
              <div class="col-9">
                <div class="row">
                  <p class="mb-0 mt-2 px-0">Bus</p>
                </div>
                <div class="row">
                  <p class="mb-2 bg-secondary w-auto rounded text-white fw-bold fs-5" id="kodeBus">-</p>
                </div>
              </div>
          </div>
          {{-- Element Kedua --}}
          <div class="row rounded my-2" style="background: #f5eedc">
              <div class="col-3 d-flex align-items-center justify-content-center">
                <i class="ni ni-tag text-dark fs-3 opacity-10"></i>
              </div>
              <div class="col-9">
                <div class="row">
                  <p class="mb-0 mt-2 px-0">Plat Nomor</p>
                </div>
                <div class="row">
                  <p class="mb-2 w-auto px-0 rounded fw-bold fs-5" id="platNomor">-</p>
                </div>
              </div>
          </div>
          {{-- Element Ketiga --}}
          <div class="row rounded my-2" style="background: #f5eedc">
              <div class="col-3 d-flex align-items-center justify-content-center">
                <i class="ni ni-compass-04 text-dark fs-3 opacity-10"></i>
              </div>
              <div class="col-9">
                <div class="row">
                  <p class="mb-0 mt-2 px-0">Rute Aktif</p>
                </div>
                <div class="row">
                  <p class="mb-2 w-auto px-0 rounded fw-bold fs-5" id="ruteAktif">-</p>
                </div>
              </div>
          </div>
        </div>
    </div>
    </div>

  </div>
  @include('partials/footer')
  </div>

</x-layout>