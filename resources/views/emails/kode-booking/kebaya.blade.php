Hai, {{ $first_name }} {{ $last_name}}!
<br>
<br>
Selamat transaksi Anda telah berhasil.<br>
Berikut adalah detail pesanan “{{$category_name}}” Anda,
<br>
Kode Booking : <b>{{$kode_booking}}</b><br>
Name Partner : {{$partner_name}}<br>
Tanggal Sewa  : {{ date('d F Y', strtotime($start_date)) }} - {{ date('d F Y', strtotime($end_date)) }}<br>
Name Paket : <span style="text-transform: uppercase;">{{$name}}</span><br>
Tipe / Set Paket : <span style="text-transform: uppercase;">{{$category_name}} / {{$set}}</span><br>
Ukuran : <span style="text-transform: uppercase;">{{$size}}</span><br>
Kuantitas Paket : <span style="text-transform: uppercase;">{{$kuantitas_pesanan}}</span><br>
Harga Paket : Rp {{number_format($booking_price,0,',','.')}}<br>
Deposit : Rp {{number_format($deposit,0,',','.')}}<br>
@if($biaya_dry_clean != '0')
    Dry Clean Cost : Rp {{number_format($biaya_dry_clean,0,',','.')}}<br>
@endif
@if($biaya_kirim != '0')
    Biaya Kirim : Rp {{number_format($biaya_kirim,0,',','.')}}<br>
@endif
Total : Rp {{number_format($booking_total,0,',','.')}}
<br>
<br>
Terima kasih melakukan transaksi dan menggunakan layanan KUPESAN.ID,<br>
Mohon tunjukkan Booking Code kepada PARTNER-KU sebelum menggunakan layanan dan menikmati pesanan Anda.<br>
<br>
Capture the time of your life with,<br>
KUPESAN.ID <br>
{{ url('home')}}
<br>
<br>
Have a nice day!