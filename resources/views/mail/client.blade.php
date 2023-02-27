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
    @foreach ($lead->order as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->price * $item->quantity }}</td>
        </tr>
    @endforeach
</table>
