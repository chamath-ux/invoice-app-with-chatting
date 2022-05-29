@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-bold text-lg" >{{ __('Change Email Address') }}</div>

                <div class="card-body">
                    <form action='{{ route('create') }}' method='post'>
                        @csrf
                        @method('POST')
                            <label class='font-bold text-lg mb-2 pl-2'>Enter New Email Address</label>
                            <input type='email' name='change_email' class='border border-xl rounded-xl w-full py-2 px-3 text-base' id='change_email' value='{{auth()->user()->email}}'>
                            <button  type='submit' class='px-2 py-1 mt-2 border rounded-xl w-40 bg-blue-500 font-bold text-base text-white' >Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function email_reset(){

        var email = $('#change_email').val();
        $.ajax({
                url: "{{ url('/create') }}",
                type: "post",
                data: {
                         "_token": "{{ csrf_token() }}",
                        email:email
                    } ,
                success: function (data) {

               console.log(data);
                },
                // error: function(jqXHR, textStatus, errorThrown) {
                // console.log(textStatus, errorThrown);
                // }
        });
    }
    </script>
@endsection
