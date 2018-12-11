Hai, {{ $first_name }} {{ $last_name}}!
<br>
<br>
Selamat transaksi Anda telah berhasil.<br>
Berikut adalah detail pesanan “Spot Foto” Anda,
<br>
<br>
Kode Booking : <b>{{$kode_booking}}</b> <br>
Nama Partner : {{$partner_name}}<br>
Nama Paket : <span style="text-transform: uppercase;">{{$pkg_name_them}}</span><br>
Tanggal Sewa : {{ date('d F Y', strtotime($booking_start_date)) }} - {{ date('d F Y', strtotime($booking_end_date)) }}<br>
Jam : {{$booking_start_time}}:00 - {{$booking_end_time + $booking_overtime}}:00 WIB <br>
Harga Paket : Rp {{number_format($booking_normal_price,0,',','.')}}<br>
Harga Overtime : Rp {{number_format($booking_overtime_price,0,',','.')}}<br>
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