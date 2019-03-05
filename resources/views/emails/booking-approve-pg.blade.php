Selamat {{ $first_name }} {{ $last_name}}!
<br>
<br>
Pesanan “Fotografer” Anda masih tersedia,
<br>
Informasi Pesanan,<br>
Nama Partner :  {{$partner_name}}<br>
Nama Paket : {{$pg_name}}<br>
Tanggal : {{ date('l, d F Y', strtotime($start_date)) }}<br>
Jam : {{ date('H:i A', strtotime($start_date)) }} WIB<br>
<br>
Silahkan melanjutkan pesanan Anda melalui tautan dibawah ini:
<br>
{{ url('booking/approved/pg', $link)}}
<br>
atau Anda dapat melanjutkan pada PROFIL-KU pada situs KUPESAN.ID
<br><br>
Capture the time of your life with,<br>
KUPESAN.ID