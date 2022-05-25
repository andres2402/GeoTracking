<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Exports\CustomersExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\logic\CustomerLogic;
use App\Http\Controllers\RestActions;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    use  CustomerLogic;
    const MODEL = "App\Customer";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer)
    {
        $customers = $this->getCustomers();
        $customers = $customers['data'];

        if (!is_null(request()->name)) {
            $name = request()->name;
            $customers->whereHas('user', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        }
        if (!is_null(request()->last_name)) {
            $last_name = request()->last_name;
            $customers->whereHas('user', function ($query) use ($last_name) {
                $query->where('last_name', 'like', '%' . $last_name . '%');
            });
        }
        if (!is_null(request()->email)) {
            $email = request()->email;
            $customers->whereHas('user', function ($query) use ($email) {
                $query->where('email', $email);
            });
        }
        if (!is_null(request()->phone)) {
            $phone = request()->phone;
            $customers->whereHas('user', function ($query) use ($phone) {
                $query->where('phone', $phone);
            });
        }
        if (!is_null(request()->state) && request()->state != -1) {
            $customers->where('state', request()->state);
        }

        $customers = $customers->latest();
        $customers = $customers->paginate(15);

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $response = $this->save($request);
        if ($response['status'] == 201) {
            return redirect()->route('clientes.index')->withStatus(__('Cliente registrado exitosamente.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = $this->showCustomer($id);
        $customer = $customer['data'];
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = $this->showCustomer($id);
        $customer = $customer['data'];
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $model = Customer::find($id);
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required','email',
                Rule::unique('users','email')->ignore($model->user->id)
                ->where('deleted_at',NULL)->where('role_id', 2)],
            'phone' => ['required', 'digits:10',
                Rule::unique('users','phone')->ignore($model->user->id)
                ->where('deleted_at',NULL)->where('role_id', 2)],
            'state' => 'required|numeric',
        ]);
        $response = $this->updateCustomer($request, $id);
        if ($response['status'] == 200) {
            return back()->withStatus(__('Cliente actualizado exitosamente.'));
        } else {
            return back()->withStatus(__('Hubo un error, intentelo nuevamente.'));
        }
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed|different:old_password',
            'password_confirmation' => 'required|min:6',
        ]);
        $response = $this->changePassword($request, $id);
        if ($response['status'] == 200) {
            return back()->withPasswordStatus(__('Contraseña actualizada correctamente.'));
        } else {
            return back()->withStatus(__('Hubo un error, intentelo nuevamente. ' . $response['error']));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = $this->deleteCustomer($id);
        return response()->json(['data' => null], $response['status']);
    }

    public function export(Request $request)
    {
        activity()
            ->inLog('Exportar')
            ->causedBy(Auth::user())
            ->log('El usuario ha exportado el listado de clientes');
        return Excel::download(new CustomersExport($request), 'Clientes.xlsx');
    }
}
