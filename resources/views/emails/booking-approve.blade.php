Selamat {{ $first_name }} {{ $last_name}}!
<br>
<br>
Pesanan “Spot Foto” Anda masih tersedia,
<br>
Informasi Pesanan,<br>
Nama Partner :  {{$partner_name}}<br>
Nama Paket : {{$pkg_name_them}}<br>
Tanggal : {{ date('d F Y', strtotime($booking_start_date)) }}<br>
Jam : {{$booking_start_time}}:00 - {{$booking_end_time + $booking_overtime}}:00 WIB<br>
<br>
Silahkan melanjutkan pesanan Anda melalui tautan dibawah ini:
<br>
{{ url('booking/approved', $link)}}
<br>
atau Anda dapat melanjutkan pada PROFIL-KU pada situs KUPESAN.ID
<br><br>
Capture the time of your life with,<br>
KUPESAN.ID