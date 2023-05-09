<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h3 class="text-2xl text-gray-600 dark:text-gray-100 text-left p-5">{{__('Machines')}}</h3>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="map" style="height: 60vh"></div>
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
                    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
                    <script>
                        var map = L.map('map').setView([40.4378698, -3.8196207], 8);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        var startmarkers = @json($markers);
                        console.table(startmarkers);
                        mapLink =
                            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
                        L.tileLayer(
                            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; ' + mapLink + ' Contributors',
                                maxZoom: 18,
                            }).addTo(map);

                        let arrayOfMarkers = [];
                        for (let i = 0; i < startmarkers.length; i++) {
                            marker = new L.marker([startmarkers[i].lat, startmarkers[i].lng])
                                .bindPopup('<a href="' + startmarkers[i].editlink + '">'
                                    + startmarkers[i].name + '</a><br>'
                                    + startmarkers[i].address + '<br>'
                                    + startmarkers[i].city + '<br>'
                                    + startmarkers[i].zip + ' - ' + startmarkers[i].state + '<br>'
                                    + startmarkers[i].country + '<br>'
                                )
                                .addTo(map);

                            arrayOfMarkers.push([startmarkers[i].lat, startmarkers[i].lng])
                        }
                        var bounds = new L.LatLngBounds(arrayOfMarkers);
                        map.fitBounds(bounds);
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
