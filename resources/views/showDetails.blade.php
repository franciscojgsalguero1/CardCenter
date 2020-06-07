@extends('layouts.app')

@section('title', "Cardcenter - Account Details")
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Details</div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <span id="name">{{Auth::user()->name}}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>
                            <div class="col-md-6">
                                <span id="surname">{{Auth::user()->surname}}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>
                            <div class="col-md-6">
                                <span id="street">{{Auth::user()->street}}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street_num" class="col-md-4 col-form-label text-md-right">{{ __('Street Number') }}</label>
                            <div class="col-md-6">
                                <span id="street_num">{{Auth::user()->street_num}}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_code" class="col-md-4 col-form-label text-md-right">{{ __('Post Code') }}</label>
                            <div class="col-md-6">
                                <span id="post_code">{{Auth::user()->post_code}}</span>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <span id="city">{{Auth::user()->city}}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                            <div class="col-md-6">
                                <span id="country">{{Auth::user()->country}}</span>
                            </div>
                        </div>                     

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <span id="email">{{Auth::user()->email}}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <span id="phone_number">{{Auth::user()->phone_number}}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="iban" class="col-md-4 col-form-label text-md-right">{{ __('IBAN') }}</label>
                            <div class="col-md-6">
                                <span id="iban">{{Auth::user()->iban}}</span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="bicswift" class="col-md-4 col-form-label text-md-right">{{ __('BIC/Swift') }}</label>
                            <div class="col-md-6">
                                <span id="bicswift">{{Auth::user()->bicswift}}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>
                            <div class="col-md-6">
                                <span id="bank_name">{{Auth::user()->bank_name}}</span>
                            </div>
                        </div>

                        <button>
                            <a href="{{url('/user/updateAccountDetails/')}}"class="w3-bar-item w3-button">Update Account Details</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
