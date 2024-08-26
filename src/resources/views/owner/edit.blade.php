<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/ownerindex.css') }}">
</head>
<body>
    <h1>店舗 編集 画面です</h1>

    <form action="{{ route('owner.update', $store->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <th>店舗名</th>
                <td>
                    <input type="text" name="store" value="{{ $store->store }}">
                </td>
            </tr>
            <tr>
                <th>地域</th>
                <td>
                    <select name="region_id" id="region_id" required>
                @foreach($regions as $region)
                    <option value="{{$region->id}}" 
                        @if($store->region_id == $region->id) selected @endif>
                        {{$region->region}}
                    </option>
                @endforeach
            </select>
                </td>
            </tr>
            <tr>
                <th>ジャンル</th>
                <td>
                    <select name="genre_id" id="genre_id" required>
                    @foreach($genres as $genre)
                    <option value="{{$genre->id}}"
                        @if($store->genre_id == $genre->id) selected @endif>
                        {{$genre->genre}}
                    </option>
                    @endforeach
                </select>
                </td>
            </tr>
            <tr>
                <th>店舗説明</th>
                <td>
                    <input type="text" name="overview" value="{{ $store->overview }}">
                </td>
            </tr>
            <tr>
                <th>画像</th>
                <td>
                    <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)">
            <!-- 現在の画像を表示 -->
                 @if (strpos($store->image, 'images/') !== false)
               <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->store }}" class="cardimg">
               @else
               <img src="{{ asset($store->image) }}" alt="{{ $store->store }}" class="cardimg">
                @endif
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button type="submit">更新</button>
                </td>
            </tr>
        </table>
    </form>
</body>

<script>
    function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('image-preview');
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</html>
