<!DOCTYPE html>
<html>
<head>
    <title>Kurban Listesi</title>
</head>
<body>
<h1>Kurban Listesi</h1>
<table border="1" style="width: 100%; border-collapse: collapse;">
    <thead>
    <tr>
        <th>Bağışçı Adı</th>
        <th>Telefon Numarası</th>
        <th>Kurban Türü</th>
        <th>Fiyat</th>
        <th>Kurban Tarihi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{ $row['Bağışçı Adı'] }}</td>
            <td>{{ $row['Telefon Numarası'] }}</td>
            <td>{{ $row['Kurban Türü'] }}</td>
            <td>{{ $row['Fiyat'] }}</td>
            <td>{{ $row['sacrifice_date'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
