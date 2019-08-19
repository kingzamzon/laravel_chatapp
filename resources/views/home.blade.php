@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        You are logged in!
                    </div>
                    
                    <div>
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
            </div>
        </div>
    </div>
</div>
@endsection
