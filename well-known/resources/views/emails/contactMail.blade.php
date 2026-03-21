<html>
@component('mail::message')
    # Hello My name is {{$data['name']}}

    Email: {{$data['email']}}
    Telephone: {{$data['phone']}}


    and I am interested in

        #{{$data['message']}}




    @component('mail::button', ['url' => 'mailto: '.$data['email']])
        Reply to {{$data['name']}}
    @endcomponent

    With Thanks, {{$data['name']}} <br>
    {{ config('app.name') }}
@endcomponent
</html>
