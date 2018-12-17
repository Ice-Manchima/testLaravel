<?php

use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recordNo = 20;

        //Not used factory
//        for($i=0; $i<$recordNo; $i++){
//            App\Loan::create([
//                'amount' => random_int(10000,100000),
//                'term' => 1,
//                'interest_rate' => 15,
//                'start_date' => '2018-05-01',
////            ]);
//        }


        //Used factory
        factory(App\Loan::class, $recordNo)->create();
    }
}
