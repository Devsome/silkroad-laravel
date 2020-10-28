@component('mail::message')
    Hello {{ $data->recieverName }},

    Your Ticket with the name: "{{ $data->ticketTitle }}" got updated right now!

    You can visit your ticket with this link:
    {{ $data->url }}

    Regards,
    {{ config('app.name') }}
@endcomponent
