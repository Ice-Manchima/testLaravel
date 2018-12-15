<?php

namespace App\Http\Controllers;

use App\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    private $months;
    private $yearStart;
    private $yearEnd;
    private $years;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct()
    {
        $this->months = array('Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04', 'May' => '05', 'Jun' => '06'
                            , 'Jul' => '07', 'Aug' => '08', 'Sep' => '09', 'Oct' => '10', 'Nov' => '11', 'Dec' => '12');
        $this->yearStart = 2017;
        $this->yearEnd = 2050;
        $this->years = range($this->yearStart, $this->yearEnd);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loans = Loan::orderBy('id', 'desc')->paginate(15);
        return view('Loan.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $months = $this->months;
        $years = $this->years;
        $mode = "create";
        return view('Loan.edit', compact('months', 'years', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);

        $loan = new Loan();
        $loan->amount = request('amount');
        $loan->term = request('term');
        $loan->interest_rate = request('interest_rate');
        $loan->start_date = request('year').'-'.request('month').'-01';
        $loan->save();

        return redirect('/loan/'.$loan->id)->with('successfully','The loan has been created successfully.');
    }

    public function validateInput(Request $request){
        $this->validate($request,[
            'amount'=>'required|numeric|min:1000|max:100000000',
            'term'=> 'required|numeric|min:1|max:50',
            'interest_rate'=> 'required|numeric|min:1|max:36|regex:/^-?[0-9]{1,2}+(?:\.[0-9]{0,2})?$/'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\loan  $loans
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loan = Loan::find($id);
        $payments = $this->calulatePayment($loan);
        return view('Loan.detail', compact('loan', 'payments'));
    }

    public function calulatePayment(Loan $loan){
        $paymentSchedule = [];
        $termMonth = $loan->term*12;
        $interestRate = $loan->interest_rate/100;
        $balance = $loan->amount;
        $payment_amount = ($balance*($interestRate/12))/(1-pow(1+($interestRate/12), (-1*$termMonth)));
        $startDate = $loan->start_date;

        for($i=1; $i<=$termMonth; $i++){
            $interest = ($balance * $interestRate)/12;
            $principal = $payment_amount - $interest;
            if ($i == $termMonth){
                $principal = $balance;
                $balance = 0;
            }else{
                $balance = $balance - $principal;
            }
            $date = date("Y-m-d", strtotime("+".($i-1)."months", strtotime($startDate)));

            //Array
//            $paymentRec = [
//                '$paymentRec' => $i,
//                'payment_date' => $date,
//                'payment_amount' => $payment_amount,
//                'principal' => $principal,
//                'interest' => $interest,
//                'balance' => $balance
//            ];

            //Object
            $paymentRec = new \stdClass();
            $paymentRec->payment_no = $i;
            $paymentRec->payment_date = $date;
            $paymentRec->payment_amount = $payment_amount;
            $paymentRec->principal = $principal;
            $paymentRec->interest = $interest;
            $paymentRec->balance = $balance;

            array_push($paymentSchedule, $paymentRec);
        }

        return $paymentSchedule;
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\loan  $loans
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $months = $this->months;
        $years = $this->years;
        $mode = "edit";
        $loan = Loan::find($id);
        return view('Loan.edit', compact('months', 'years', 'mode', 'loan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\loan  $loans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validateInput($request);

        $loan = Loan::findorfail($id);
        $loan->amount = request('amount');
        $loan->term = request('term');
        $loan->interest_rate = request('interest_rate');
        $loan->start_date = request('year').'-'.request('month').'-01';
        $loan->update();

        return redirect('/loan/'.$loan->id)->with('successfully', 'The loan has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\loan  $loans
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Loan::find($id)->delete();

        return redirect('/loan')->with('successfully', 'Loan ID #'.$id.' has been deleted!!');
    }
}
