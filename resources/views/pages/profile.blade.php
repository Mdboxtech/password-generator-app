@extends('app.app')


@section('content')
    <div class="container ">
        <div class="card m-1">
            <div class="card-body">
                <h3 class="card-title text-center">
                    profile
                </h3>

                <div class="row">
                    <div class="col-md">

                        <img class="rounded-circle m-1" src="{{ asset('assets/images/default.png') }}" alt=""
                            srcset="">
                    </div>
                    <div class="col-md-6 text-left">
                        <h4>{{ auth()->user()->username }}</h4>
                        <h4>{{ auth()->user()->fullname }}</h4>
                        <h4>{{ auth()->user()->email }}</h4>


                    </div>
                </div>


            </div>
        </div>


    </div>
@endsection
