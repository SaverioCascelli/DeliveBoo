<h1>Nuovo Ordine</h1>

<p>{{ $lead->restaurantName }} hai ricevuto un nuovo ordine da:</p>
<div>
    <span>{{ $lead->name }} </span>
    <span>{{ $lead->surname }}</span>
</div>
<p>Indirizzo: {{ $lead->address }}</p>
<p>Numero di telefono: {{ $lead->phoneNumber }}</p>

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
<p>Totale ordine: {{ $lead->totalPrice }}</p>
