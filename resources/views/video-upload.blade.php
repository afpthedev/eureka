<!-- resources/views/video-upload.blade.php -->
<form action="{{ route('video.upload', ['token' => $kurban->video_upload_token]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="video">Video Yükleyin:</label>
    <input type="file" name="video" id="video" required>
    <button type="submit">Yükle</button>
</form>
