<x-mail::message>
# Request Status

<br>
<div>
    Your request <b>{{$data->document_name}}</b> has been <span class="status">{{$data->status}}</span>.<br>
    <?php
        if($data->status == "completed"){
            echo "<p>Please get your $data->document_name at the office, thanks.</p><br>";
        }
        echo "<p>Document Fee: P$data->fee</p>";
        if($data->status != "approved" && $data->comment){
            echo "<p>Comment: $data->comment</p>";
        }
        $status = ucfirst($data->status);
        echo "<p> $status by: $data->admin_name</p>"
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
    p{
        margin-block-start: 0em;
        margin-block-end: 0em;
    }

</style>
