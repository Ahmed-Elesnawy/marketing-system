
{{ $client_phone1 }} <br> {{ $client_phone2 }} <br>
<hr>
@lang("software.address") : {{ $client_address }}
<hr>


@if ( $markter_note )
@lang('software.markter_notice') <br>
{{ $markter_note }}

@endif




