@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')

<div class="detailcard">
  <div>
    <div class="titlebox">
      <button type="button" onClick="history.back()" class="backbtn"><</button>
      <p class="store">{{ $store->store }}</p>
    </div>
    <div class="">
      <img src="{{ asset($store->image) }}" alt="{{ $store->store }}" class="detailimg">
      <div class="storedetail">
        <p>#{{ $store->region->region }}</p>
        <p>#{{ $store->genre->genre }}</p>
    </div>
        <p class="explanacard">{{ $store->overview }}</p>  
    </div>
  </div>

  <div class="reservationcard">
    <p class="reservationcard_title">予約</p>
    <form action="{{ url('/store/' . $store->id) }}" method="post">
        @csrf
        <ul class="cardlist">
            <li>
                <input name="date" type="date" id="dateInput" class="cardlist_form cardlist_input" onchange="updateReservationDetails()" />
            </li>
            <li>
                <select name="time" id="carTimeInput" class="cardlist_form cardlist_select" onchange="updateReservationDetails()">
                    <option value="" selected="">未選択</option>
                    @for($i = 7; $i <= 20; $i++)
                    @for($j = 0; $j <= 5; $j++)
                    <option value="{{$i}}:{{$j}}0">{{$i}}:{{$j}}0</option>
                    @endfor
                    @endfor
                </select>
            </li>
            <li>
                <select name="number" id="peopleInput" class="cardlist_form cardlist_select" onchange="updateReservationDetails()">
                    <option value="" selected>未選択</option>
                    @for($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}">{{ $i }}人</option>
                    @endfor
                </select>
            </li>
        </ul>
        <!-- インプットをここに表示 -->
        <div id="reservationDetails" class="reservationdetail">
            <table>
                <tr>
                    <th class="detailtitle">Shop</th>
                    <td>{{ $store->store }}</td>
                </tr>
                <tr>
                    <th class="detailtitle">Date</th>
                    <td><span id="selectedDate"></span></td>
                </tr>
                <tr>
                    <th class="detailtitle">Time</th>
                    <td><span id="selectedTime"></span></td>
                </tr>
                <tr>
                    <th class="detailtitle">Number</th>
                    <td><span id="selectedPeople"></span></td>
                </tr>
            </table>
        </div>

        <button type="submit" class="reservationbtn">予約する</button>
    </form>
  </div>
</div>

<script>
function updateReservationDetails() {
    // 各入力要素から値を取得
    const dateInput = document.getElementById('dateInput').value;
    const carTimeInput = document.getElementById('carTimeInput').value;
    const peopleInput = document.getElementById('peopleInput').value;
    
    // 予約内容を表示する要素に値をセット
    document.getElementById('selectedDate').textContent = dateInput || '未選択';
    document.getElementById('selectedTime').textContent = carTimeInput || '未選択';
    document.getElementById('selectedPeople').textContent = peopleInput ? `${peopleInput}人` : '未選択';
}

// ページが読み込まれたときに初期状態を設定
window.onload = () => {
    updateReservationDetails();
    
    // 入力要素にイベントリスナーを追加
    document.getElementById('dateInput').addEventListener('input', updateReservationDetails);
    document.getElementById('carTimeInput').addEventListener('change', updateReservationDetails);
    document.getElementById('peopleInput').addEventListener('change', updateReservationDetails);
};
</script>

@endsection