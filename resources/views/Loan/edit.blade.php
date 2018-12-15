@extends('layout')


@section('title', 'Create Loan')

@section('content')

    <div class="container">

        @if($mode == "create")
            <h1>Create Loan</h1>
                <form method="post" action="{{url('/loan')}}" >
        @else
            <h1>Edit Loan</h1>
                <form method="post" action="{{route('loan.update', $loan->id)}}">
                    {{method_field('PATCH')}}
        @endif

                <input type="hidden" value="{{csrf_token()}}" name="_token" />

                <div class="input-group row">
                    <label for="amount" class="col-sm-2 col-form-label font-weight-bold">Loan Amount:</label>

                    <div class="col-sm-3">
                        <div class="input-group row">
                            <input type="text" class="form-control" id="amount" name="amount" value="@if(old('amount')<>""){{old('amount')}}@elseif($mode=="edit"){{$loan->amount}}@endif"/>
                            <div class="input-group-append">
                                <span class="input-group-text">฿</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="input-group row">
                    <label for="amount" class="col-sm-2 col-form-label font-weight-bold">Term:</label>

                    <div class="col-sm-3">
                        <div class="input-group row">
                            <input type="text" class="form-control" id="term" name="term" value="@if(old('term')<>""){{old('term')}}@elseif($mode=="edit"){{$loan->term}}@endif"/>
                            <div class="input-group-append">
                                <span class="input-group-text">Years</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="input-group row">
                    <label for="amount" class="col-sm-2 col-form-label font-weight-bold">Interest Rate:</label>

                    <div class="col-sm-3">
                        <div class="input-group row">
                            <input type="text" class="form-control" id="interest_rate" name="interest_rate" value="@if(old('interest_rate')<>""){{old('interest_rate')}}@elseif($mode=="edit"){{$loan->interest_rate}}@endif"/>
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="input-group row">
                    <label for="amount" class="col-sm-2 col-form-label font-weight-bold">Start Date:</label>

                    <div class="col-sm-3">
                        <div class="input-group row">
                            <select style="width: 45%" class="custom-select" id="month" name="month">
                                <option value="12" hidden >Dec</option>
                                @foreach($months as $key=>$value)
                                    <option value="{{$value}}"
                                        @if($mode=="edit" && date('n', strtotime($loan->start_date)) == $value) selected @endif> {{$key}}
                                    </option>



                                @endforeach
                            </select>

                            <select style="width: 45%" class="custom-select" id="year" name="year">
                                <option value="2018" hidden >2018</option>
                                @foreach($years as $value)
                                    {{--<option value="{{$value}}">{{$value}}</option>--}}
                                    <option value="{{$value}}"
                                        @if($mode=="edit" && date('Y', strtotime($loan->start_date)) == $value) selected @endif> {{$value}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="input-group row">
                    <div class="col-sm-2"></div>
                    <button type="submit" class="btn btn-primary">@if($mode == "create") Create @else Update @endif</button>
                    <button type="button" class="btn btn-default" onclick="window.location='{{url('/')}}'">Back</button>
                </div>
            </form>
@endsection
