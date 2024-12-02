<!DOCTYPE html>
<html>
<head>
    <title>Dosya Yükleme</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1>Dosya Yükleme</h1>
<form action="{{ route('upload.file') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="data_file" accept=".csv,.xlsx" required>
    <button type="submit">Yükle</button>
</form>


@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

@if(session('error'))
    <p>{{ session('error') }}</p>
@endif
</body>
</html>
