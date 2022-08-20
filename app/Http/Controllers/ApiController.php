<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function companyInfo()
    {
        $customer = Http::withToken(ENV('token'))
        ->accept('application/json')
        ->contentType('application/json')
        ->withUserAgent('QBOV3-OAuth2-Postman-Collection')
        ->get('https://sandbox-quickbooks.api.intuit.com/v3/company/4620816365236030100/companyinfo/4620816365236030100?minorversion=40');

        return $customer['CompanyInfo']['CompanyName'];
    }

    public function createCustomer()
    {
        $values = '
        {
            "BillAddr": {
                "Line1": "123 Main Street",
                "City": "Mountain View",
                "Country": "USA",
                "CountrySubDivisionCode": "CA",
                "PostalCode": "94042"
            },
            "Notes": "Here are other details.",
            "DisplayName": "Kings Groceries1",
            "PrimaryPhone": {
                "FreeFormNumber": "(555) 555-5555"
            },
            "PrimaryEmailAddr": {
                "Address": "jdrew@myemail.com"
            }
        }
        
        ';
        $customer = Http::withToken(ENV('token'))
        ->accept('application/json')
        ->contentType('application/json')
        ->withUserAgent('QBOV3-OAuth2-Postman-Collection')
        ->post('https://sandbox-quickbooks.api.intuit.com/v3/company/4620816365236030100/customer?minorversion=40',json_decode($values));

        return $customer;
    }

    public function invoices()
    {
        $invoices = Http::withToken(ENV('token'))
        ->accept('application/json')
        ->contentType('application/text')
        ->withUserAgent('QBOV3-OAuth2-Postman-Collection')
        ->get('https://sandbox-quickbooks.api.intuit.com/v3/company/4620816365236030100/invoice/12?minorversion=40');

        return $invoices;  
    }

    public function customers()
    {
        $rawData = 'Select * from Customer startposition 1 maxresults 5';

        $customer = Http::withToken(ENV('token'))
        ->accept('application/json')
        ->contentType('application/json')
        ->withUserAgent('QBOV3-OAuth2-Postman-Collection')
        ->post('https://sandbox-quickbooks.api.intuit.com/v3/company/4620816365236030100/query?minorversion=40',$rawData);


        return view("welcome", ["customer" => $customer]);
    }

    public function showCustomer()
    {
        $customer = Http::withToken(ENV('token'))
        ->accept('application/json')
        ->contentType('application/json')
        ->withUserAgent('QBOV3-OAuth2-Postman-Collection')
        ->get('https://sandbox-quickbooks.api.intuit.com/v3/company/4620816365236030100/customer/2?minorversion=40');

        return json_decode($customer);
    }
}
