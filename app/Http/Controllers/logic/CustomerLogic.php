<?php
namespace App\Http\Controllers\logic;
use App\User as User;
use App\Customer as Customer;
use App\Http\Controllers\RestActions;
use App\Notifications\PasswordNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
trait CustomerLogic
{
    use RestActions;

    public function allCustomers(){
        try {
            $m = self::MODEL;
			return $this->respond('done', $m::all()->load('user'));
		} catch (\Throwable $e) {
			return $this->respond('server error', [], $e->getMessage());
		}
    }

    public function getCustomers(){
        try {
            $m = self::MODEL;
			return $this->respond('done', $m::whereIn('state',[1,0])->with('user'));
		} catch (\Throwable $e) {
			return $this->respond('server error', [], $e->getMessage());
		}
    }

    public function showCustomer($id){
        try {
            $model = Customer::where('id', $id)->with('user')->first();
			return $this->respond('done', $model);
		} catch (\Throwable $e) {
			return $this->respond('server error', [], $e->getMessage());
		}
    }

    public function updateCustomer($request, $id){
        try {
            $model = Customer::find($id);
            $model->update($request->all());
            $model->user->update($request->all());
			return $this->respond('done', $model);
		} catch (\Throwable $e) {
			return $this->respond('server error', [], $e->getMessage());
		}
    }

    public function save($request){
        try {
            $pass = $request->password;
            $request->merge(
                [
                    'password' => bcrypt($request->password),
                    'code_confirmed' => 1,
                    'role_id' => 2
                ]);
            $user=User::create($request->all());
            $customer=Customer::create(['user_id'=>$user->id]);

            send_sms($user->phone,'Estimado cliente, su contraseña es: '.$pass);
            $user->notify(new PasswordNotification($pass));
            return $this->respond('created',$customer->load('user'));
        } catch (\Throwable $e) {
            return $this->respond('server error', [], $e->getMessage());
        }

    }

    public function CustomerShow($model)
	{
		try {
			if (is_null($model)) {
				return $this->respond('not_found');
			}
			return $this->respond('done', $model->load('user'));
		} catch (\Throwable $e) {
			return $this->respond('server error', [], $e->getMessage());
		}
	}

    public function changePassword($request, $id){
        try{
            $customer = Customer::find($id);
            $customer->user->update(['password' => Hash::make($request->password)]);
            send_sms($customer->user->phone,'Estimado usuario, su nueva contraseña es: '.$request->password);
            $customer->user->notify(new PasswordNotification($request->password));
            return $this->respond('done', []);
        }catch (\Throwable $e) {
            return $this->respond('server error', [], $e->getMessage());
        }
    }

    public function register($request)
    {

        $result = DB::transaction(function () use ($request) {
            try
            {
                $randomCode = rand(0, 999999);
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->password = bcrypt($request->password);
                $user->code = $randomCode;
                $user->save();

                $customer = new Customer();
                $customer->user_id = $user->id;
                $customer->save();

                send_sms($user->phone, 'Su código de verificación es:' . $randomCode);

                return $this->respond('created',$customer->load('user'));
            }catch(\Exception $e){
                return $this->respond('server error', null, $e->getMessage());
            }
        });

        return $result;

    }

    public function login($request)
    {
        try {
            $credentials = request(['phone', 'password']);
            if (!Auth::attempt($credentials)) {
                return $this->respond('server error', null, 'Telefono o contraseña incorrecta');
            }

            $user = User::where('phone', $request->phone)->first();
            if ($user->code_confirmed == 0) {
                return $this->respond('not_valid', null, 'Cuenta sin confirmar, por favor confirme su cuenta');
            }
            if ( ! Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error en login');
            }

            $token=$user->createToken('authToken')->plainTextToken;

            return $this->respond('done', $token);
        } catch (Exception $error) {
            return $this->respond('server error', null, $error);
        }
    }

    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->respond('done',null,'Session cerrada con exito');
    }

    public function forgotPassword($request)
    {
        try {
            $randomCode = rand(0, 999999);
            $user = User::where('phone', $request->phone)->first();
            $user->code = $randomCode;
            $user->code_confirmed = 0;
            $user->update();

            send_sms($user->phone, 'Su código de verificación es:' . $randomCode);
            return $this->respond('done', $randomCode);
        } catch (\Throwable $th) {
            return $this->respond('server error', null, 'Ha ocurrido un problema');
        }
    }

    public function confirmCode($request)
    {
        $user = User::where('phone', $request->phone)->first();
        $user->code = '';
        $user->code_confirmed = 1;
        $user->update();
        return $this->respond('done', null, 'Codigo confirmado con exito');
    }

    public function restorePassword($request)
    {
        try {
            $request->validate([
                'phone' => 'required|exists:users,phone',
                'password' => 'required|min:6'
            ]);

            $user = User::where('phone', $request->phone)->first();
            $user->password = bcrypt($request->password);
            $user->update();

            return $this->respond('done', $user);
        } catch (\Throwable $th) {
            return $this->respond('server error', null, 'Ha ocurrido un error al cambiar de contraseña');
        }
    }

    public function deleteCustomer($id)
    {
        try{
            $customer = Customer::find($id);
            $customer->delete();
            $customer->user()->delete();
            return $this->respond('done', null);
        }catch (\Throwable $e) {
            return $this->respond('server error', [], $e->getMessage());
        }
    }

}
