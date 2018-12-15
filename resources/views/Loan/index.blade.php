@extends('layout')


@section('title', 'Loan')

@section('content')
    <div class="container">

        <h1>All Loans</h1>
        <div class="container">
            <table class="table table-striped">
                <thead class="font-weight-bold">
                <tr>
                    <td>ID</td>
                    <td>Loan Amount</td>
                    <td>Loan Term</td>
                    <td>Interest Rate</td>
                    <td>Created at</td>
                    <td>Edit</td>
                </tr>
                </thead>
                <tbody>
                <a href="{{url('loan/create')}}" class="btn btn-primary">Add New Loan</a>
                @foreach($loans as $loan)
                    <tr>
                        <td>{{number_format($loan->id, 0)}}</td>
                        <td>{{number_format($loan->amount, 2)}}฿</td>
                        <td>{{number_format($loan->term, 0)}} Years</td>
                        <td>{{number_format($loan->interest_rate, 2)}}%</td>
                        <td>{{$loan->created_at}}</td>
                        <td class="form-inline">
                            <a href="{{action('LoanController@show',$loan->id)}}" class="btn btn-primary">View</a>
                            <a href="{{action('LoanController@edit',$loan->id)}}" class="btn btn-success">Edit</a>
                            {{--<form action="{{action('LoanController@destroy', $loan->id)}}" method="post">--}}
                            <form method="post" action="{{route('loan.destroy', $loan->id)}}" >
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $loans->links() }}
            <div>
@endsection
