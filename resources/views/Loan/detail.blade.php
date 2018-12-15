@extends('layout')


@section('title', 'Create Loan')

@section('content')
    <div class="container">

        <div class="container">
            <table class="border-0">
                <thead>
                <h1>Loan Details</h1>
                </thead>
                <tbody>
                <tr>
                    <td width="200">ID:</td>
                    <td>{{number_format($loan->id, 0)}}</td>
                <tr>
                    <td>Loan Amount:</td>
                    <td>{{number_format($loan->amount, 2)}}฿</td>
                </tr>
                <tr>
                    <td>Loan Term:</td>
                    <td>{{number_format($loan->term, 0)}} Years</td>
                </tr>
                <tr>
                    <td>Interest Rate:</td>
                    <td>{{number_format($loan->interest_rate, 2)}}%</td>
                </tr>
                <tr>
                    <td>Created at:</td>
                    <td>{{$loan->created_at}}</td>
                </tr>
                </tbody>
            </table>
            <div>
                <br>
                <button type="button" onclick="window.location='{{url('/')}}'">Back</button>

                <br><br>
                {{--Repayment Schedules--}}
                <h1>Repayment Schedules</h1>
                <div class="container">
                    <table class="table table-striped">
                        <thead class="font-weight-bold">
                        <tr>
                            <td>Payment No</td>
                            <td>Date</td>
                            <td>Payment Amount</td>
                            <td>Principal</td>
                            <td>Interest</td>
                            <td>Balance</td>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($payments as $payment)
                            <tr>
                                <td>{{$payment->payment_no}}</td>
                                <td>{{\Carbon\Carbon::parse($payment->payment_date)->format('Y-m')}}</td>
                                <td>{{number_format($payment->payment_amount, 2)}}</td>
                                <td>{{number_format($payment->principal, 2)}}</td>
                                <td>{{number_format($payment->interest, 2)}}</td>
                                <td>{{number_format($payment->balance, 2)}}</td>
                                {{--{{$payment['interest_rate']}}--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div>
                        <button type="button" onclick="window.location='{{url('/')}}'">Back</button>
                    </div>
@endsection
