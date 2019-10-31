@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
                @include('sidebar',['user_messages'=>$user_messages])
        </div> 
        <div class="col-md-8"> 
            <div class="card">
                <div class="card-header">Chat </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                           @if (count($conversations) > 0)
                        <div style="max-height:300px;height:300px;overflow-y: scroll;">
                          <div chat-content id="ko">
                                
                            </div>
                            
                        </div>
                        @else 
                            <p>No conversation so far. Start a conversation</p>
                        @endif
                                 </div>
                        <!-- method="POST" action="{{action('MessagesController@store')}}" -->
                         <form id="myForm" class="form-group"  style="margin-top: 20px">
                            <!-- {{csrf_field()}} -->
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" >
                            <input type="hidden" name="message_id" value="{{$id}}" >
                            <div class="input-group">
                              <input type="text" name="message" autocomplete="off" chat-box class="form-control" placeholder="Type...">
                              <div class="input-group-prepend">
                                <button class="input-group-text" id="ajaxSubmit">Send</button>
                              </div>
                            </div> 
                          </form>
                  
                </div>
            </div>
        </div>
    </div>
    
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#ajaxSubmit').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
             headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            })
            $.ajax({
                url: "{{ url('storeConversations') }}",
                method: 'post',
                data: {
                    message_id: $('[name="message_id"]').val(),
                    message: $('[name="message"]').val()
                },
                success: function(result) {
                    // what should happen when success
                    $('[name="message"]').val('');
                    // console.log(result);
                }
            })
        })



        setInterval(function() {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        var value = $('[name="message_id"]').val();
        var user = $('[name="user_id"]').val();
        $.ajax({
            url: "{{ url('getConversations') }}",
            method: "get",
            data: {
                id: value
            },
            success: function(data){
                $('[chat-content]').html('');
                $.each(data, function(i, v) {

                    $('[chat-content]').append(`
                        <div class="card">
                        <div class="card-body ${(v.user_id == user) ? 'text-right' : '' }" >
                            <b>${v.user.name}</b> <br>
                            ${v.message} <br>
                            <i>${v.created_at}</i>
                       </div>
                       </div><br>
                        `);
                })
            }
        })
        }, 100);
      

        



    })

</script>
@endsection
