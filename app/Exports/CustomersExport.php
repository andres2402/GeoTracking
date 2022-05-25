<?php

namespace App\Exports;

use App\Customer;
use App\Http\Controllers\logic\CustomerLogic;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection,WithHeadings,WithMapping
{
    use CustomerLogic;
    
    CONST MODEL="App\Customer";

    protected $request;
    //protected $customers;

    function __construct($request) {
            $this->request = $request;
            //$this->customers = $customers;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $customers = $this->getCustomers();
        $customers = $customers['data'];
        if (!is_null($this->request->name)) {
            $name = $this->request->name;
            $customers->whereHas('user', function($query) use($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        }
        if (!is_null($this->request->last_name)) {
            $last_name = $this->request->last_name;
            $customers->whereHas('user', function($query) use($last_name) {
                $query->where('last_name', 'like', '%' . $last_name . '%');
            });
        }
        if (!is_null($this->request->email)) {
            $email = $this->request->email;
            $customers->whereHas('user', function($query) use($email) {
                $query->where('email', $email);
            });
        }
        if (!is_null($this->request->phone)) {
            $phone = $this->request->phone;
            $customers->whereHas('user', function($query) use($phone) {
                $query->where('phone', $phone);
            });
        }
        if (!is_null($this->request->state) && $this->request->state != -1) {
            $customers->where('state',$this->request->state);
        }

        $customers = $customers->get();
        return $customers;
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Apellido',
            'Telefono',
            'Email',
            'Estado',
            'Fecha de Registro',
        ];
    }

    public function map($customers): array
    {
        return [
            $customers['id'],
            $customers['user']['name'],
            $customers['user']['last_name'],
            $customers['user']['phone'],
            $customers['user']['email'],
            $customers['state']==1?'Activo':($customers['state']==0?'Inactivo':'Papelera'),
            $customers['created_at']
        ];
    }
}
