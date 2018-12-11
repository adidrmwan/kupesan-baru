Mohon maaf {{ $first_name }} {{ $last_name}},
<br>
<br>
Pesanan Anda tidak tersedia.
<br>
Informasi Pesanan,<br>
Nama Partner :  {{$partner_name}}<br>
Nama Paket : {{$pkg_name_them}}<br>
Tanggal : {{ date('d F Y', strtotime($booking_start_date)) }}<br>
Jam : {{$booking_start_time}}:00 - {{$booking_end_time + $booking_overtime}}:00 WIB<br>
<br>
Silahkan melakukan pemesanan kembali di situs KUPESAN.ID atau menghubungi customer service untuk informasi lebih lanjut.
<br>
{{ url('home')}}
<br><br>
Capture the time of your life with,<br>
KUPESAN.ID