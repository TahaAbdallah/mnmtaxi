<br>

<strong>Carpool Request Details </strong><br><br><br>
<strong>Name: </strong>{{ $data->name }} <br>
<strong>Phone: </strong>{{ $data->phone }} <br>
<strong>From Address: </strong>{{ $data->address }} <br>
<strong>University: </strong>{{ $data->university }} <br>
<strong>date(s): </strong>{{ $data->date }} <br>
<strong>Departure time: </strong>{{ $data->departureTime }} <br>
<strong>Comeback time: </strong>{{ $data->comeBackTime }} <br>

<a href={{ 'https://wa.me/961' .$data->phone }}>Press here to reply on whatsapp</a>