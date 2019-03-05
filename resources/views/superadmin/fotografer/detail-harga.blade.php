<td>{{number_format($data->booking_price,0,',','.')}}</td>
<td>{{number_format($data->deposit,0,',','.')}}</td>
@if($data->biaya_dry_clean == '0')
<td>-</td>
@else
<td>{{number_format($data->biaya_dry_clean,0,',','.')}}</td>
@endif
@if($data->flag == 'userku')
<td>{{number_format($data->biaya_kirim,0,',','.')}}</td>
<td>{{number_format($data->booking_total,0,',','.')}}</td>
@else
<td>-</td>
<td>{{number_format($data->booking_total,0,',','.')}}</td>
@endif