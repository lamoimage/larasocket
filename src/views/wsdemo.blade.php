<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>larasocket demo</title>
  <link rel="stylesheet" href="https://bootswatch.com/cerulean/bootstrap.min.css">
  <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
      span.label{margin-right:10px;}
      .msg{padding:0 10px;}
  </style>

</head>
<body  style="padding-top:50px;">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Larasocket realtime demo</div>
                <div class="panel-body">
                </div>
                <div class="panel-footer">
                    <form class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" placeholder="Say something">
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="form-control btn btn-primary" value="send">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
    </div>
</div>

<script>
    var wsServer = "ws://192.168.10.10:9501";
    ws = new WebSocket(wsServer);    

    ws.onopen = function (evt) {
        console.log('WebSocket Connect Success!');
    };

    ws.onclose = function (evt) {
        console.log('WebSocket Closed');
    };

    ws.onmessage = function (evt) {
        var data = JSON.parse(evt.data);
        console.log(data);
        if (data.status == 'success'){
            switch (data.type){
                case 'msg':
                    if (data.from == $('.panel-body').data('from')){                        
                        var html ="";
                            html +=  '<div class="row">';
                            html +=     '<div class="text-left msg pull-right">';
                            html +=         '<span class="label label-warning pull-left">' + data.from + ':</span>';
                            html +=         '<p class="text-warning pull-left">' + data.data + '</p>';
                            html +=    '</div>';                       
                            html += '</div>';
                    }else{                        
                        var html ="";
                            html +=  '<div class="row">';
                            html +=     '<div class="text-left msg">';
                            html +=         '<span class="label label-info pull-left">' + data.from + ':</span>';
                            html +=         '<p class="text-info pull-left">' + data.data + '</p>';
                            html +=    '</div>';                       
                            html += '</div>';
                    }
                    $('.panel-body').append(html);
                    break;
                case 'wellcome':
                    var html ="";
                        html +=  '<div class="row">';
                        html +=     '<div class="text-left msg">';
                        html +=         '<span class="label label-success pull-left">SYSTEM:</span>';
                        html +=         '<p class="text-success pull-left">' + data.data + '</p>';
                        html +=    '</div>';                       
                        html += '</div>';
                    $('.panel-body').append(html);
                    break;
                case 'login': 
                    console.log(data.from);
                    $('.panel-body').attr('data-from', data.from);
                    break;
            }
        }
    };

    ws.onerror = function (evt) {
        console.log('WebSocket Error');
    };

    $("form").submit(function(){
        if (ws){
            var msg = $.trim($('form input[type=text]').val());
            if (msg){                
                ws.send(JSON.stringify({                    
                    "action": "sendmsg",
                    "from": $('.panel-body').data('from'),
                    "msg": msg
                }));
                $('form input[type=text]').val('');
            }
        }
        return false;
    });
</script>
</body>
</html>