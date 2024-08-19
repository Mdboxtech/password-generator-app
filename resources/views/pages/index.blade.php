@extends('app.app')

@section('content')
    <meta name="csrf-token" content="{{ Session::token() }}">
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card mb-5">
                        <div class="card-body p-sm-5">
                            <h2 class="text-center mb-4">Generator password</h2>
                            <label class="p-2 bg-dark text-light rounded">Password Length</label>
                           <input class="form-control m-1" min='1' max="50"  value="20" style="width:100px !important" id="lengthnum" type="number" name=""> 
                            <form method="post">
                                <div><button id="generatePassword" class="btn btn-dark d-block w-100" type="submit">
                                        generate </button></div>
                            </form>

                            <div id="display" class="card m-2 d-none">
                                <div class="card-body">
                                    <p id="passwordDisplay" class="text-primary"> </p>

                                </div>
                                <div class="bg-secondary">


                                    <div class="row m-2">
                                        <button data-clipboard-action="copy" data-clipboard-target="#passwordDisplay"
                                            type="button" id="copyP" class="btn btn-sm btn-dark col m-1"
                                            name="button">copy</button>
                                        @auth

                                            <button type="button" id="Gpassword" class="btn btn-sm btn-dark col m-1"
                                                name="button">save
                                                password</button>
                                        @endauth

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @auth
                    <div class="col-md-4 ">

                            
                        <div class="card mb-5">
                            <h6 class="card-title text-center m-1">generated password</h6>
                            <button id="showpass" class="btn-primary btn btn-sm m-1">show password</button>
                            <button id="hidepass" class="btn-primary btn btn-sm m-1 d-none">hide password</button>
                            <div id="DisGpassword" class="card-body p-sm-5">

                                @foreach ($userGpass as $userGpas)
                                    <input type="password" class='form-control m-2 ginput'
                                        value="{{ $userGpas->generated_password }}">
                                    <small> {{ $userGpas->created_at }}</small>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            // getGpassword();



            var clipboard = new ClipboardJS('.btn');

            clipboard.on('success', function(e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);
                alert('copy successful');
            });

            clipboard.on('error', function(e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);
            });

            $('#generatePassword').click(function(e) {
                e.preventDefault();
           
                $(this).html(`<div class="spinner-grow text-primary"></div>`);
                setTimeout(() => {
                    $(this).html(` <span class="spinner-grow spinner-grow-sm"></span>
                                        generating...`);
                    $('#display').removeClass('d-none');
                    var randomPassword = generateRandomPassword($('#lengthnum').val());
                    $('#passwordDisplay').text(randomPassword).attr('data-clipboard-text',
                        randomPassword);

                    $(this).html(`generate`);
                }, 3000);
            });



            function generateRandomPassword(length) {
                var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                var password = "";
                for (var i = 0; i < length; i++) {
                    var randomIndex = Math.floor(Math.random() * charset.length);
                    password += charset.charAt(randomIndex);
                }
                return password;
            }


            $('#Gpassword').click(function() {
                // user_id = $(this).data('id');
                gpass = $('#passwordDisplay').html();
                // alert(user_id);
                $.post('/saveGpassword', {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    // user_id: user_id,
                    generated_password: gpass

                }, function(data) {
                    alert(data);
                    location.replace('/');
                });
            });


            // function getGpassword() {
            //     $.post('/getGpassword', {
            //         _token: $("meta[name=csrf-token]").attr("content")
            //     }, function(data) {
            //         // console.log(data);
            //         data.forEach((item, data) => {
            //             // console.log(item.generated_password);

            //             $('#DisGpassword').append(
            //                 `<input type="password"  class='form-control m-2 ginput' value="${item.generated_password}">
        //                <small> ${item.created_at}</small>

        //                 `
            //             )

            //         });
            //     });
            // }

            // $(document).on('click', '#showpass', function() {


            $('#showpass').click(function() {




                // var dd = $('ginput');
                $('.ginput').each((item) => {

                    var inputElement = $('.ginput');
                    inputElement.attr('type', 'text');
                    $('#showpass').addClass('d-none');
                    $('#hidepass').removeClass('d-none');



                });

                // console.log(dd);
            });
            $('#hidepass').click(function() {




                // var dd = $('ginput');
                $('.ginput').each((item) => {

                    var inputElement = $('.ginput');
                    inputElement.attr('type', 'password');
                    $('#hidepass').addClass('d-none');
                    $('#showpass').removeClass('d-none');




                });

                // console.log(dd);
            });

        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            Var clipboard = new ClipboardJS(‘#passwordDisplay’);

            Clipboard.on(‘success’, function€ {
                Alert(‘Password copied to clipboard: ‘ + e.text);
                e.clearSelection();
            });

            $(“#generatePassword”).click(function() {
                Var randomPassword = generateRandomPassword(20);
                $(“#passwordDisplay”).text(randomPassword).attr(‘data-clipboard-text’, randomPassword);
            });

            Function generateRandomPassword(length) {
                Var charset = “abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789”;
                Var password = “”;
                For (var I = 0; I < length; i++) {
                    Var randomIndex = Math.floor(Math.random() * charset.length);
                    Password += charset.charAt(randomIndex);
                }
                Return password;
            }
        });
    </script> --}}
@endsection
