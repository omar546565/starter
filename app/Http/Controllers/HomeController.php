<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\User;
use PDF;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');

    }
    public function get_customer($id){
        $customer = User::where('id',$id)->get();
        return $customer;


    }

    public function generate_pdf()
    {
        $data = [
            'foo' => 'bar'
        ];
        $pdf = PDF::loadView('invoice', $data);
        return $pdf->stream('document.pdf');
    }


    public function invoice()
    {
        return view('invoice');



    }
    public function index22($id)
    {
     //   return view('invoice');
        $pdf = App::make('dompdf.wrapper');
       $pdf->loadHTML($this->convert($id));
      return $pdf->stream();


    }
    public function convert($id){
        $customer = $this->get_customer($id);


        foreach ($customer as $cust){
            $output = '
                <!DOCTYPE HTML>
                <html  style="direction: rtl;">
                <body>
                <head>
                 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                 <title>Untitled</title>
                    </head>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSi6oQsWAmA16Ifbvvg5lFkR6HuCw1rUKW7Zg&usqp=CAU">
                     <h1 >Test3443</h1>
                    <div>
                    <h1 >'.$cust->id.'</h1>
                    <h1 style="font-family:XBRiyaz,sans-serif " >'.$cust->name.'</h1>
                    <h1 >'.$cust->email.'</h1>
                    </div>`
                 </body>
                 </html>
            ';

        }
        return $output;
    }

}
