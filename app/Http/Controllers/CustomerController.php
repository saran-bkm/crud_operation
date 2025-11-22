<?php
namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('orders')->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function add(){
        return view('customers.add');
    }

    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }

}
