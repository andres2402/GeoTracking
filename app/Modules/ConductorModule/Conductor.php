<?php

namespace App\Modules\ConductorModule;

// use App\Http\Controllers\Traits\RestActions;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Http\Controllers\RestActions;

//se crea una clase Conductor la cual está heredando de la clase model todas las funcionalidades del dao. 
class Conductor extends Model 
{
    use HasApiTokens, LogsActivity, RestActions;
    // use HasFactory;

    protected $table = 'conductors';

    protected $primaryKey = 'id';

    // En esta parte se utiliza el fillable para realizar las asignaciones masivas.
    protected $fillable = [
        'Con_nombre',
        'Con_apellido',
        'Con_telefono',
        'Con_direccion',
        'Con_estado',
        'Con_n_pase',
        'Con_c_pase',
        'Con_n_documento',
        'Con_c_documento',
        'Con_c_hoja_vida',
    ];


    // Relationships Config
    // public function getType()
    // {
    //     return $this->belongsTo(ParameterValue::class, 'type');
    // }

    // public function getFaculty()
    // {
    //     return $this->belongsTo(ParameterValue::class, 'faculty');
    // }

    // public function getProgram()
    // {
    //     return $this->belongsTo(ParameterValue::class, 'program');
    // }
    // End Relationships config


    // función utilizada para validar Conductor con sus respectivos campos.
    public function validateConductor($request)
    {
        return Validator::make(
            $request->all(),
            [
                'Con_nombre' => 'required',
                'Con_apellido' => 'required',
                'Con_telefono' => 'required',
                'Con_direccion' => 'required',
                'Con_estado' => 'required',
                'Con_n_pase' => 'required',
                'Con_c_pase' => '',
                'Con_n_documento' => 'required',
                'Con_c_documento' => '',
                'Con_c_hoja_vida' => '',
            ]
        );
    }


    /* Scopes Config */
    public function scopeCon_nombre($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Con_nombre', 'like', '%' . $value . '%');
        }
    }
    public function scopeCon_apellido($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Con_apellido', 'like', '%' . $value . '%');
        }
    }
    public function scopeCon_telefono($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Con_telefono', 'like', '%' . $value . '%');
        }
    }
    public function scopeCon_direccion($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Con_direccion', 'like', '%' . $value . '%');
        }
    }
    public function scopeCon_n_pase($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Con_n_pase', 'like', '%' . $value . '%');
        }
    }


    // se crea una función para guardar los datos del conductor en la bd, y por medio de el método (validateConductor)
    // se valida la información que esta entrando como parametro ($request).
    public function saveConductor( $request)
    {
        $validator = $this->validateConductor($request, 'create');

        if ($validator->fails()) {
            return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
        }

        try {
            $conductor = $this::create([
                'Con_nombre' => $request->Con_nombre,
                'Con_apellido' => $request->Con_apellido,
                'Con_telefono' => $request->Con_telefono,
                'Con_direccion' => $request->Con_direccion,
                'Con_estado' => $request->Con_estado,
                'Con_n_pase' => $request->Con_n_pase,
                'Con_c_pase' => $request->Con_c_pase,
                'Con_n_documento' => $request->Con_n_documento,
                'Con_c_documento' => $request->Con_c_documento,
                'Con_c_hoja_vida' => $request->Con_c_hoja_vida,
            ]);

            //return view($this->path . 'create');
            return $this->respond(200, $conductor, null, 'Conductor creado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear conductor');
        }
    }

    // se crea una función para actualizar los datos del conductor en la bd, por medio del parametro request recibimos los datos y por medio del id consultamos el conductor a actualizar.
    public function updateConductor($request, $id)
    {
    //en esta parte con la ayuda de un try catch controlamos los errores que se puedan genrar al momento de actualizar.
        try {
            $validator = $this->validateConductor($request);       //con la Ayuda del método validateConductor validamos que los datos actualizado sean correctos
            if ($validator->fails()) {
                return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
            }

            $conductor = $this::find($id); // por medio del id busca si el conductor existe, de lo contrario muestra el mensaje de error.
            if (is_null($conductor)) {
                return $this->respond(500, [], 'user not found', 'No se encontró el conductor');
            }

            $conductor->update([  //Para realizar la actualizacion utilizamos el método update la cual viene por defecto.
                'Con_nombre' => $request->Con_nombre ?? $conductor->Con_nombre,
                'Con_apellido' => $request->Con_apellido ?? $conductor->Con_apellido,
                'Con_telefono' => $request->Con_telefono ?? $conductor->Con_telefono,
                'Con_direccion' => $request->Con_direccion ?? $conductor->Con_direccion,
                'Con_estado' => $request->Con_estado ?? $conductor->Con_estado,
                'Con_n_pase' => $request->Con_n_pase ?? $conductor->Con_n_pase,
                'Con_c_pase' => $request->Con_c_pase ?? $conductor->Con_c_pase,
                'Con_n_documento' => $request->Con_n_documento ?? $conductor->Con_n_documento,
                'Con_c_documento' => $request->Con_c_documento ?? $conductor->Con_c_documento,
                'Con_c_hoja_vida' => $request->Con_c_hoja_vida ?? $conductor->Con_c_hoja_vida,
            ]);

            return $this->respond(200, $conductor, null, 'Conductor creado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear conductor');
        }
    }

    

    // public function deleteConductor($id)
    // {
    //     try {
    //         $conductor = $this::find($id);
    //         if (is_null($conductor)) {
    //             return $this->respond(500, [], 'No se encontró el conductor');
    //         }
    //         $conductor->delete();
    //         return $this->respond(200, $conductor, null, 'Conductor eliminado exitosamente');
    //     } catch (\Exception $e) {
    //         return $this->respond(500, [], $e->getMessage(), 'Error al eliminar conductor');
    //     }
    // }
}
