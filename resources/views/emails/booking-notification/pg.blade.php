Selamat {{$partner_name}}!
<br>
<br>
Anda memiliki pesanan baru!!
<br>
<br>
Berikut adalah informasi pesanan dari pelanggan KUPESAN.ID,<br>
Name Pelanggan : {{$user_name}}<br>
Tanggal Pemesanan: {{ date('d F Y', strtotime($start_date)) }} <br>
waktu Pemesanan: {{ date('H i', strtotime($start_date)) }} <br>
Name Paket : <span style="text-transform: uppercase;">{{$pg_name}}</span><br>
Total : Rp {{number_format($booking_total,0,',','.')}}
<br><br>
Anda dapat melihat detail pesanan dan menyetujui pesanan melalui tautan dibawah ini :
<br>
{{ url('partner/dashboard/pg', $link)}}
<br><br>
Have a nice day!<br>
KUPESAN.ID