<li>Harga Paket : <span class="pull-right">Rp {{number_format($listpesanan->booking_price, 0, ',', '.')}}</span></li>
<li>Deposit : <span class="pull-right">Rp {{number_format($listpesanan->deposit, 0, ',', '.')}}</span></li>
@if($listpesanan->price_dryclean != '0')
<li>Dryclean Cost : <span class="pull-right">Rp {{number_format($listpesanan->biaya_dry_clean, 0, ',', '.')}}</span></li>
@endif
@if($listpesanan->flag == 'userku')
<li>Biaya Pengiriman : <span class="pull-right">Rp {{number_format($listpesanan->biaya_kirim, 0, ',', '.')}}</span></li>
@endif
<li>Total :<span class="pull-right"> Rp {{number_format($listpesanan->booking_total, 0, ',','.')}}</span></li>