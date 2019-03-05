Selamat {{ $first_name }} {{ $last_name}}!
<br>
<br>
Pesanan “Busana” Anda masih tersedia.
<br>
Informasi Pesanan,<br>
Nama Partner :  {{$partner_name}}<br>
Nama Paket : {{$name}}<br>
Tanggal Sewa : {{ date('d F Y', strtotime($start_date)) }} - {{ date('d F Y', strtotime($end_date)) }}<br>
<br>
Silahkan melanjutkan pesanan Anda melalui tautan dibawah ini:
<br>

{{ url('booking/approved/busana', $link)}}
<br>
atau Anda dapat melanjutkan pada PROFIL-KU pada situs KUPESAN.ID
<br><br>
Capture the time of your life with,<br>
KUPESAN.ID