<x-mail::message>
# Request Status

<br>
<div>
    Your request <b>{{$data->document_name}}</b> has been <span class="status">{{$data->status}}</span>.<br><br>
    <?php
        if($data->status == "completed"){
            echo "<p class='fee'>Please prepare an exact amount of P$data->fee upon recieving the document</p>";
        }
        if($data->comment){
            echo "<p>Comment: $data->comment</p>";
        }
    ?>
</div><br><br>



Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

<style>
    div{
        width:fit-content;
        margin:auto;
        font-size:20px;
        padding:4px 12px 4px 12px;
        text-align:center;

    }
    .status{
        font-weight:bold;
    }

</style>
