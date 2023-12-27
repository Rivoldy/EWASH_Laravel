@extends('layout.master')
@section('content')
    <?php
    date_default_timezone_set('Asia/Jakarta'); // Mengatur zona waktu ke Indonesia Bagian Barat
    $current_time = date('H:i'); // Mendapatkan waktu saat ini (HH:ii)
    $greeting = 'Selamat ';

    if ($current_time >= '05:00' && $current_time <= '10:30') {
        $greeting .= 'Pagi';
    } elseif ($current_time <= '15:30') {
        $greeting .= 'Siang';
    } elseif ($current_time <= '18:30') {
        $greeting .= 'Sore';
    } else {
        $greeting .= 'Malam';
    }
    ?>

    <h3 style="text-align: center; color: #3498db; font-size: 36px;">{{ $greeting }}, {{ session('name') }}</h3>
@endsection
