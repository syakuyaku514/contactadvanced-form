@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<div class="detailcard">
    <!-- 店舗詳細 -->
    <div class="detailcard_box">
        <div class="titlebox">
            <button type="button" onClick="history.back()" class="backbtn"><</button>
            <p class="store">{{ $store->store }}</p>
        </div>
        <div class="imagebox">
            @if (strpos($store->image, 'images/') !== false)
                <img src="{{ asset('storage/' . $store->image) }}" alt="{{ $store->store }}" class="detailimg">
            @else
                <img src="{{ asset($store->image) }}" alt="{{ $store->store }}" class="detailimg">
            @endif
            <div class="explanation">
                <div class="storedetail">
                    <p>#{{ $store->region->region }}</p>
                    <p class="genre">#{{ $store->genre->genre }}</p>
                </div>
                <p class="explanacard">{{ $store->overview }}</p> 
            </div> 
        </div>
    </div>

    <!-- 予約カード -->
    <div class="reservationcard">
        <p class="reservationcard_title">予約</p>
        <form action="{{ url('/store/' . $store->id) }}" method="post" class="reservationcard_form">
            @csrf
            <ul class="cardlist">
                <li class="cardlistli">
                    <input name="date" type="date" id="date" min="{{ date('Y-m-d') }}" value="" class="cardlist_form cardlist_input" onchange="updateReservationDetails()" />
                </li>
                <li class="cardlistli">
                    <select name="time" id="time" class="cardlist_form cardlist_select" onchange="updateReservationDetails()">
                        <option value="" selected="">未選択</option>
                        @for($i = 7; $i <= 20; $i++)
                        @for($j = 0; $j <= 5; $j++)
                        <option value="{{$i}}:{{$j}}0">{{$i}}:{{$j}}0</option>
                        @endfor
                        @endfor
                    </select>
                </li>
                <li class="cardlistli">
                    <select name="number" id="peopleInput" class="cardlist_form cardlist_select" onchange="updateReservationDetails()">
                        <option value="" selected>未選択</option>
                        @for($i = 1; $i <= 20; $i++)
                            <option value="{{ $i }}">{{ $i }}人</option>
                        @endfor
                    </select>
                </li>
            </ul>
            <!-- インプットの表示 -->
            <div id="reservationDetails" class="reservationdetail">
                <table class="reservationtable">
                    <tr>
                        <th class="detailtitle">Shop</th>
                        <td class="detailitem">{{ $store->store }}</td>
                    </tr>
                    <tr>
                        <th class="detailtitle">Date</th>
                        <td class="detailitem"><span id="selectedDate" class="detailitem"></span></td>
                    </tr>
                    <tr>
                        <th class="detailtitle">Time</th>
                        <td class="detailitem"><span id="selectedTime" class="detailitem"></span></td>
                    </tr>
                    <tr>
                        <th class="detailtitle">Number</th>
                        <td class="detailitem"><span id="selectedPeople" class="detailitem"></span></td>
                    </tr>
                </table>
            </div>

            <div class="error">
                @if (count($errors) > 0)
                    <p>入力に問題があります</p>  
                @endif

                <div class="error_content">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="reservationbtn">予約する</button>
        </form>
    </div>
</div>

<h2 class="reviewtitle">店舗のレビュー</h2>

<!-- レビューカード -->
  <div class="reviewcard">
    <p class="reviewwrite">レビューを書く</p>
    <form action="{{ route('store.review', $store->id) }}" method="post" class="reviewcardform">
    @csrf
    <ul class="cardlist">
        <div class="commentbox">
            <li>
                <div class="comment">
                    <label class="comment_text reviewwrite" for="body">コメント</label>
                </div>
            </li>
            <li>
                <div class="comment">
                    <textarea class="reviewcomment" name="comment" class="form-control" id="body" cols="30" rows="10"></textarea>
                </div>
            </li>
        </div>
    </ul>

    <div class="reviewerror">
        <div class="">
            @error('stars')
                {{ $message }}
            @enderror
        </div>
        <div class="">
            @error('comment')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="reviewbtnbox">
        <select class="cardlist_star" name="stars" id="star_rating">
                <option value="">評価を選択</option>
                <option value="1">★☆☆☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="3">★★★☆☆</option>
                <option value="4">★★★★☆</option>
                <option value="5">★★★★★</option>
        </select>
        <button type="submit" class="cardlist_star sendbtn">送信する</button>
    </div>
    
</form>
  </div>
</div>


<!-- レビュー一覧 -->
<div>
@foreach($Reviews as $Review)
<div class="review">
  <div class="reviewname">
    <div class="reviewname_text">
        <p>ユーザー名 :</p>
        <p>{{ $Review->user->name }}</p>
    </div>
    <div class="reviewstar">
        @for ($i = 0; $i < $Review->stars; $i++)
          <img src="{{ asset('img/star-yellow.png')}}" alt="黄色い星">
        @endfor
        @for ($i = $Review->stars; $i < 5; $i++)
          <img src="{{ asset('img/star-gray.png')}}" alt="灰色の星">
        @endfor
    </div>
  </div>
  <div class="reviewtext">
      <p class="reviewcontent">{{ $Review->comment }}</p>
  </div>

  <div class="userreview">
  @if(auth()->id() == $Review->user_id)
    <form action="{{ route('review.update', $Review->id) }}" method="post">
      @csrf
      @method('PATCH')
      <div class="userreview">
        <input type="text" class="userreview_inp" name="comment" value="{{ $Review->comment }}" required>
        <select name="stars" id="stars" required>
          <option value="">評価を選択</option>
          <option value="1" {{ $Review->stars == 1 ? 'selected' : '' }}>★☆☆☆☆</option>
          <option value="2" {{ $Review->stars == 2 ? 'selected' : '' }}>★★☆☆☆</option>
          <option value="3" {{ $Review->stars == 3 ? 'selected' : '' }}>★★★☆☆</option>
          <option value="4" {{ $Review->stars == 4 ? 'selected' : '' }}>★★★★☆</option>
          <option value="5" {{ $Review->stars == 5 ? 'selected' : '' }}>★★★★★</option>
        </select>
      </div>
        <button type="submit" class="userreview_btn updatebtn">更新</button>
    </form>
    <form action="{{ route('review.destroy', $Review->id) }}" method="post">
      @csrf
      @method('DELETE')
        <button type="submit" class="userreview_btn deletebtn">削除</button>
    </form>
  @endif
  </div>
</div>
@endforeach
</div>


<script>
    // 現在の日付を取得し、最小日付を設定
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('date').setAttribute('min', today);

    // 予約詳細を更新する関数
    function updateReservationDetails() {
        // 各入力要素から値を取得
        const dateInput = document.getElementById('date').value;
        const timeInput = document.getElementById('time').value;
        const peopleInput = document.getElementById('peopleInput').value;

        // 予約内容を表示する要素に値をセット
        document.getElementById('selectedDate').textContent = dateInput || '未選択';
        document.getElementById('selectedTime').textContent = timeInput || '未選択';
        document.getElementById('selectedPeople').textContent = peopleInput ? `${peopleInput}人` : '未選択';
        
        // 時間オプションを更新
        updateTimeOptions(dateInput);
    }

    // 現在以前の時間を選択できないようオプションを更新する関数
    function updateTimeOptions(selectedDate) {
        const timeSelect = document.getElementById('time');
        const now = new Date();
        const currentHour = now.getHours();
        const currentMinute = now.getMinutes();

        // 時間オプションを全て有効化
        for (let i = 0; i < timeSelect.options.length; i++) {
            timeSelect.options[i].disabled = false;
        }

        // 現在の日付が選択された場合、現在時刻より前の時間オプションを無効化
        if (selectedDate === today) {
            for (let i = 0; i < timeSelect.options.length; i++) {
                const optionValue = timeSelect.options[i].value;
                const [hour, minute] = optionValue.split(':').map(Number);

                if (hour < currentHour || (hour === currentHour && minute < currentMinute)) {
                    timeSelect.options[i].disabled = true;
                }
            }
        }
    }

    // ページが読み込まれたときに初期状態を設定
    window.onload = () => {
        updateReservationDetails();
        
        // 入力要素にイベントリスナーを追加
        document.getElementById('date').addEventListener('input', updateReservationDetails);
        document.getElementById('time').addEventListener('input', updateReservationDetails);
        document.getElementById('peopleInput').addEventListener('input', updateReservationDetails);
    };
</script>
@endsection