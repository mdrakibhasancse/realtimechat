<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Time Chat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
<div class="container pt-5">
    <div class="row">
        <div class="col-6 offset-3">   
            <div class="card">
                <div class="card-header bg-info text-white">
                    <span>Live Chat with: {{ $user->name }}</span>
                </div>
                <div class="card-body" id="chatBody">
                      @foreach($messages as $message)
                        @if($message->sender_id == auth()->id() || $message->receiver_id == auth()->id())
                            <div class="message">
                                <div class="" style="{{ $message->sender_id == auth()->id() ? 'color: #17a2b8' : 'color: gray' }}">
                                    <p>{{ $message->sender_id == auth()->id() ? $message->message : '(' . $message->sender->name . ') : ' . $message->message }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="card-footer text-right">
                    <div class="input-group">
                        <input type="text" name="message" id="message" class="form-control" placeholder="Type your message">
                        <div class="input-group-append">
                            <button type="submit" id="send" class="btn btn-primary">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#send").click(function () {
        $.post("{{ route('sendMessage', $user->id) }}", {
            message: $("#message").val(),
        }, function (data) {
            let senderMessage = 
                '<div class="message">' +
                    '<div class="" style="color: #17a2b8"><p>' + $("#message").val() + '</p></div>' +
                '</div>';
            $("#chatBody").append(senderMessage);
            $("#message").val(''); 
            toastr.success('Message sent successfully!');
        });
    });

    var pusher = new Pusher('5235b87bb220bb6e6cc0', {
        cluster: 'eu',
        encrypted: true
    });

    var channel = pusher.subscribe('chat{{ auth()->id() }}');
    channel.bind('push-message', function(data) {
        let userName = "{{ $user->name }}"; 
        let receiverMessage = 
            '<div class="message">' +
                '<div class="" style="color: gray"><p>(' + userName + '): ' + data.message + '</p></div>' +
            '</div>';
        $("#chatBody").append(receiverMessage); 
    });
</script>
</body>
</html>