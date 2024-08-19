@extends('app.app')

<style>
    #inp {
        outline: 0;
    }
</style>
@section('content')
    <div class="container mt-1">
        <button id="showpass" class="btn-primary btn btn-sm m-1">show password</button>
        <button id="hidepass" class="btn-primary btn btn-sm m-1 d-none">hide password</button>
        @foreach ($userGpassword as $userGpass)
            <div class="card p-0 m-1">
                <div class="card-body ">
                    <div class="card-head">
                        <form action="/deleteGpass" method="post">
                            @csrf
                            <input type="hidden" name="id"  value="{{ $userGpass->id }}">
                            <button class="btn btn-danger btn-sm float-right">delete</button>
                        </form>
                    </div>
                    {{-- <div class="d-flex justify-content-around"> --}}
                    <p class="m-1">
                        <input type="password" class="border-0 outline-0 w-100 ginput" name="" id="inp"
                            value=" {{ $userGpass->generated_password }}">

                    </p>
                    <div class="card-footer m-0 float-right">
                        <small class=" d-block">
                            <p> {{ $userGpass->created_at }}</p>
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
        @if($userGpassword->count()<=0)
             <div class="card p-0 m-1">
                <div class="card-body ">
                    <div class="card-head text-center text-danger">
                    no password found!!
                    </div>
                    </div>
                    </div>

        @endif
        {{ $userGpassword->links('pagination::bootstrap-5') }}
    </div>

    <script>
        $(document).on('click', '#showpass', function() {


            $('.ginput').each((item) => {
                var inputElement = $('.ginput');
                inputElement.attr('type', 'text');

                $('#showpass').addClass('d-none');
                $('#hidepass').removeClass('d-none');


            });

            // console.log(dd);
        });
        $(document).on('click', '#hidepass', function() {


            $('.ginput').each((item) => {
                var inputElement = $('.ginput');
                inputElement.attr('type', 'password');

                $('#hidepass').addClass('d-none');
                $('#showpass').removeClass('d-none');


            });

            // console.log(dd);
        });
    </script>
@endsection
