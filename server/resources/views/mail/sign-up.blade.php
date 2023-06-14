<x-mail::message>
# Sign Up

Verify your account with the code below.

<div>
    {{$code}}
</div>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

<style>
    div{
        background-color:#941616;
        width:fit-content;
        margin:auto;
        color:white;
        font-size:30px;
        font-weight:600;
        padding:4px 12px 4px 12px;

    }

</style>