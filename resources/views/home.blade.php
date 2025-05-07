<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pollution Monitor</title>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="fixed w-full z-50">
        <div class="flex h-16 items-center px-4 justify-center">
            <h1 class="text-white text-xl font-semibold">Zephyr's</h1>
        </div>
    </nav>
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 pt-16">
        <div>
            <div class="mt-4 {{$colorClass}} flex-row text-white mx-4 rounded-t-md p-4 shadow-md">
                <div class="flex justify-baseline font-bold">
                    <h1>Kualitas Udara</h1>
                </div>
                <div class="flex-row justify-items-center">
                    <h1 class="text-6xl lg:text-8xl font-semibold py-4">{{$air->air_quality}}</h1>
                    <h3 class="mt-4">Terakhir diperbarui: {{$air->created_at}}</h3>
                </div>
            </div>
            <div class="flex mx-4 mb-4 rounded-b-md justify-between p-4 shadow-md">
                <div class="flex-1">
                    <p class="gas-text">PM2.5</p>
                    <p class="justify-self-center">{{$air->pm25}} µg/m³</p>
                    <hr class="small-line">
                </div>
                <div class="flex-1">
                    <p class="gas-text">NO2</p>
                    <p class="justify-self-center">{{$air->no2}} ppb</p>
                    <hr class="small-line">
                </div>
                <div class="flex-1">
                    <p class="gas-text">CO</p>
                    <p class="justify-self-center">{{$air->co}} ppm</p>
                    <hr class="small-line">
                </div>
            </div>
        </div>

        <div>
            <div class="rounded-md shadow-md p-4 mx-4 text-green-900 mb-4 mt-4">
                <h1 class="font-semibold text-xl">Kondisi Lingkungan</h1>
                <div class="flex mt-4">
                    <div class="flex-1 bg-green-200 mr-2 rounded-md p-8">
                        <div>
                            <p class="justify-self-center">Suhu</p>
                            <h1 class="justify-self-center text-3xl font-semibold">{{$air->temp}}°C</h1>
                        </div>
                    </div>
                    <div class="flex-1 bg-green-200 ml-2 rounded-md p-8">
                        <div>
                            <p class="justify-self-center">Kelembaban</p>
                            <h1 class="justify-self-center text-3xl font-semibold">{{$air->humidity}}%</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-md shadow-md p-4 mx-4 mb-4">
                <h1 class="font-semibold text-green-900 text-xl">Status Air Purifier</h1>
                <h1 class="font-semibold text-xl mt-4">Tidak Aktif</h1>
                <p class="text-gray-500 text-sm">Kualitas Udara Baik</p>
            </div>
            <div class="mt-4 bg-green-500 flex-row text-white mx-4 rounded-t-md p-4 shadow-md">
                <div class="flex justify-baseline font-bold">
                    <h1>Tips dan Rekomendasi</h1>
                </div>
            </div>
            <div class=" mx-4 mb-4 rounded-b-md p-4 shadow-md">
                <p class="text-xs text-gray-500">- Kualias udara saat ini sangat baik. Debu pabrik semen minimal. ini
                    waktu
                    yang tepat untuk berkegiatan diluar ruangan</p>
                <p class="text-xs text-gray-500">- Periksa filter air purifier secara berkala untuk memastikan kinerja
                    optimal saat dibutuhkan</p>
            </div>
        </div>
    </div>
</body>

</html>
