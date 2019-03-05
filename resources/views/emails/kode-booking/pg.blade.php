Hai, {{ $first_name }} {{ $last_name}}!
<br>
<br>
Selamat transaksi Anda telah berhasil.<br>
Berikut adalah detail pesanan “Fotografer” Anda,
<br>
<br>
Kode Booking : <b>{{$kode_booking}}</b> <br>
Nama Partner : {{$partner_name}}<br>
Nama Paket : <span style="text-transform: uppercase;">{{$pg_name}}</span><br>
Tanggal : {{ date('d F Y', strtotime($start_date)) }}<br>
Jam : {{ date('H:i', strtotime($start_date)) }} WIB<br>
Harga Paket : Rp {{number_format($booking_price,0,',','.')}}<br>
Total : Rp {{number_format($booking_total,0,',','.')}}
<br>
<br>
Terima kasih melakukan transaksi dan menggunakan layanan KUPESAN.ID,<br>
Mohon tunjukkan Booking Code kepada PARTNER-KU sebelum menggunakan layanan dan menikmati pesanan Anda.<br>
<br>
Capture the time of your life with,<br>
KUPESAN.ID <br>
{{ url('home')}}
<br><br>
Have a nice day!