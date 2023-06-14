<x-mail::message>
# Request Status

<div>
Your request <b>{{$data->document_name}}</b> has been <span class="status">{{$data->status}}</span>.
</div>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

<style>
    div{
        width:fit-content;
        margin:auto;
        font-size:30px;
        padding:4px 12px 4px 12px;

    }
    .status{
        font-weight:bold;
    }

</style>
