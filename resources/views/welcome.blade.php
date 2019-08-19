<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css')}}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
        [chat-box] {
            width: 5000px;
            display: inline-block;
        }
        @media screen and (min-width: 480px) {
            [chat-box] {
            width: 400px;
            display: inline-block;
            }
        }
        </style>
    </head>
    <body style="background-color:lavender;">
    <section class="container" style="background-color:white;margin-top: 20px;">
            <div class="row" >
                    <div class="col-sm-12" style="height: 300px;">
                        <h4 style="border-bottom: 1px solid black">Chats</h4>
                        <p chat-content></p>
                    </div>
                    <div class="col-sm-12 bg-secondary" >
                        
                        <form role="form" class="form-group" style="margin-top: 20px">
                            {{csrf_field()}}
                            <div class="input-group">
                              <input type="text" name="message" chat-box class="form-control" placeholder="Type...">
                              <div class="input-group-prepend">
                                <button type="submit" class="input-group-text">Send</button>
                              </div>
                            </div> 
                          </form>
                    </div>
                </div>
    </section>
    

    <script>
        const chats = [];
        const chatField = document.querySelector('[chat-box]');
        chatField.addEventListener("keydown", (e) => {
            // console.log(e.key);
            if(e.key == 'Enter') {
            const {value} = chatField;
            const currentDate = new Date();
            chats.push({name: value, date: currentDate});
            console.log(value);
            console.log(chats);
            }
                
        })
        console.log(chatField);
       
    </script>
</html>
