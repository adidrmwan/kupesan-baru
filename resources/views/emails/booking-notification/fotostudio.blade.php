Selamat {{$partner_name}}!
<br>
<br>
Anda memiliki pesanan baru!!
<br>
<br>
Berikut adalah informasi pesanan dari pelanggan KUPESAN.ID:<br>
Nama Pelanggan : {{$booking_user_name}}<br>
Nama Paket : <span style="text-transform: uppercase;">[ Paket - {{$pkg_name_them}} ]</span><br>
Jadwal Pesanan : {{ date('d F Y', strtotime($booking_start_date)) }}, {{$booking_start_time}}:00 - {{$booking_end_time + $booking_overtime}}:00 WIB<br>
Total : Rp {{number_format($booking_total,0,',','.')}}<br>
<br>
Anda dapat melihat detail pesanan dan menyetujui pesanan melalui tautan dibawah ini :
<br>
{{ url('partner/dashboard', $link)}}
<br><br>
Have a nice day!<br>
KUPESAN.ID