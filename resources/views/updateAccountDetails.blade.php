@extends('layouts.app')

@section('title', "Cardcenter - Update Account Details")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Account Details') }}</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('updateAccountDetails') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>
                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" name="street" required placeholder="Street">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street_num" class="col-md-4 col-form-label text-md-right">{{ __('Street Number') }}</label>
                            <div class="col-md-6">
                                <input id="street_num" type="text" class="form-control" name="street_num" required placeholder="Street Number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_code" class="col-md-4 col-form-label text-md-right">{{ __('Post Code') }}</label>
                            <div class="col-md-6">
                                <input id="post_code" type="text" class="form-control" name="post_code" required placeholder="Post Code">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" required placeholder="City">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control" name="country" required placeholder="Country">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <input id="phone_number" type="string" class="form-control" name="phone_number" required placeholder="Your Phone Number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="iban" class="col-md-4 col-form-label text-md-right">{{ __('IBAN') }}</label>
                            <div class="col-md-6">
                                <input id="iban" type="text" class="form-control" name="iban" required placeholder="IBAN">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="bicswift" class="col-md-4 col-form-label text-md-right">{{ __('BIC/Swift') }}</label>
                            <div class="col-md-6">
                                <input id="bicswift" type="text" class="form-control" name="bicswift" required placeholder="BIC or Swift code">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_name" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>
                            <div class="col-md-6">
                                <input id="bank_name" type="text" class="form-control" name="bank_name" required placeholder="The name of your Bank">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
