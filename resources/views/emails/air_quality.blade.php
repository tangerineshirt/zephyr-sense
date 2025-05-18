<!DOCTYPE html>
<html>
<head>
    <title>Notifikasi Kualitas Udara</title>
</head>
<body>
    <h1>Notifikasi Kualitas Udara</h1>
    <p>Kualitas udara saat ini: {{ $air->air_quality }}</p>
    <p>PM 2.5: {{ $air->pm25 }}</p>
    <p>CO: {{ $air->co }}</p>
    <p>NO2: {{ $air->no2 }}</p>
    <p>Temperatur: {{ $air->temp }}</p>
    <p>Humidity: {{ $air->humidity }}</p>
</body>
</html>
