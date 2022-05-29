@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-bold text-lg" >{{ __('Be With Friends') }}</div>

                <div class="card-body">
                    <div class='grid grid-rows-1'>
                        <div class='grid grid-cols-2 gap-4'>
                            <div class='w-100'>
                                <ul>
                                 @foreach($users as $key=>$user)

                                    <li class='bg-blue-500 py-1 px-2 border rounded-xl text-uppercase font-bold text-white w-40'   onclick='open_chat({{$key}})'>
                                        <input type='hidden' name='user_id_{{$key}}' id='user_id_{{$key}}' value='{{$user->id}}'>
                                        {{$user->name}}

                                        @if($user->online == '1')
                                            <img src="{{ asset('images/dot1.ico') }}" alt="description of myimage" class='text-green-500 px-5' style='display:inline-block'>
                                        @else
                                            <img src="{{ asset('images/dot3.ico') }}" alt="description of myimage" class='text-green-500 px-5' style='display:inline-block'>
                                        @endif
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            <div class='w-full' id='chat_window'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   function open_chat(key){

    var user_id = $('#user_id_'+key).val();


    $('#chat_window').html('');
    $.ajax({
                url: "{{ url('/chat_window') }}",
                type: "post",
                data: {
                         "_token": "{{ csrf_token() }}",
                        user_id:user_id
                    } ,
                success: function (html) {


                        $('#chat_window').html(html);

                        console.log(html);
                },
        });
   }
    </script>
@endsection
