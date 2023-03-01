<h1>Conferma ordine</h1>

<div>
    <span>{{ $lead->name }} </span>
    <span>{{ $lead->surname }}</span>
    <span>il tuo ordine da {{ $lead->restaurantName }} è in arrivo!</span>
</div>
<p>Totale ordine: {{ $lead->totalPrice }}</p>
<p>Indirizzo: {{ $lead->address }}</p>

<h3>Riepilogo ordine </h3>
<table>
    <tr>
        <th>Piatto</th>
        <th>Quantità</th>
        <th>Costo unitario</th>
        <th>Totale Piatti</th>
    </tr>
    @foreach ($lead->order->foods as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->pivot->quantity }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ number_format($item->price * $item->pivot->quantity, 2, ',', '.') }}</td>
        </tr>
    @endforeach
</table>
