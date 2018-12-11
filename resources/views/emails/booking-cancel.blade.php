Mohon maaf {{ $first_name }} {{ $last_name}},
<br>
<br>
Pesanan Anda tidak tersedia.
<br>
Informasi Pesanan,<br>
Nama Partner :  {{$partner_name}}<br>
Nama Paket : {{$name}}<br>
Tanggal Sewa : {{ date('d F Y', strtotime($start_date)) }} - {{ date('d F Y', strtotime($end_date)) }}<br>
<br>
Silahkan melakukan pemesanan kembali di situs KUPESAN.ID atau menghubungi customer service untuk informasi lebih lanjut.
<br>
{{ url('home')}}
<br><br>
Capture the time of your life with,<br>
KUPESAN.ID