<?php

namespace App\Modules\VehiculoModule;

// use App\Http\Controllers\Traits\RestActions;
use Illuminate\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Http\Controllers\RestActions;
use App\Modules\ConductorModule\Conductor;

class Vehiculo extends Model
{
    use HasApiTokens, LogsActivity, RestActions;

    protected $table = 'vehiculos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'Veh_Con_id',
        'Veh_documento',
        'Veh_modelo',
        'Veh_año',
        'Veh_estado',
        'Veh_placa',
        'Veh_matricula',
        'Veh_soat',
        'Veh_tecnomecanica',
        'Veh_c_soat',
        'Veh_c_t_mecanica',
        'Veh_c_t_propiedad',
    ];

    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'Veh_Con_id');
    }


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


    public function validateVehiculo($request)
    {
        return Validator::make(
            $request->all(),
            [
                'Veh_Con_id' => 'required',
                'Veh_documento' => 'required',
                'Veh_modelo' => 'required',
                'Veh_año' => 'required',
                'Veh_estado' => 'required',
                'Veh_placa' => 'required',
                'Veh_matricula' => 'required',
                'Veh_soat' => 'required',
                'Veh_tecnomecanica' => 'required',
                'Veh_c_soat' => '',
                'Veh_c_t_mecanica' => '',
                'Veh_c_t_propiedad' => '',
            ]
        );
    }


    /* Scopes Config */
    public function scopeVeh_Con_id($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Veh_Con_id', 'like', '%' . $value . '%');
        }
    }
    public function scopeVeh_modelo($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Veh_modelo', 'like', '%' . $value . '%');
        }
    }
    public function scopeVeh_año($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Veh_año', 'like', '%' . $value . '%');
        }
    }
    public function scopeVeh_matricula($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Veh_matricula', 'like', '%' . $value . '%');
        }
    }
    public function scopeVeh_placa($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Veh_placa', 'like', '%' . $value . '%');
        }
    }
    public function scopeVeh_tecnomecanica($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Veh_tecnomecanica', 'like', '%' . $value . '%');
        }
    }
    public function scopeVeh_soat($query, $value)
    {
        if (!is_null($value)) {
            $query->where('Veh_soat', 'like', '%' . $value . '%');
        }
    }


    public function saveVehiculo($request)
    {
        $validator = $this->validateVehiculo($request, 'create');

        if ($validator->fails()) {
            return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
        }

        try {
            $vehiculo = $this::create([
                'Veh_Con_id' => $request->Veh_Con_id,
                'Veh_documento' => $request->Veh_documento,
                'Veh_modelo' => $request->Veh_modelo,
                'Veh_año' => $request->Veh_año,
                'Veh_estado' => $request->Veh_estado,
                'Veh_placa' => $request->Veh_placa,
                'Veh_matricula' => $request->Veh_matricula,
                'Veh_soat' => $request->Veh_soat,
                'Veh_tecnomecanica' => $request->Veh_tecnomecanica,
                'Veh_c_soat' => $request->Veh_c_soat,
                'Veh_c_t_mecanica' => $request->Veh_c_t_mecanica,
                'Veh_c_t_propiedad' => $request->Veh_c_t_propiedad,
            ]);

            //return view($this->path . 'create');
            return $this->respond(200, $vehiculo, null, 'Vehiculo creado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear vehiculo');
        }
    }

    public function updateVehiculo($request, $id)
    {
        try {
            $validator = $this->validateVehiculo($request);

            if ($validator->fails()) {
                return $this->respond(500,  $validator->errors(), 'validation error', $validator->errors()->first());
            }

            $vehiculo = $this::find($id);
            if (is_null($vehiculo)) {
                return $this->respond(500, [], 'user not found', 'No se encontró el vehiculo');
            }

            $vehiculo->update([
                'Veh_Con_id' => $request->Veh_Con_id ?? $vehiculo->Veh_Con_id,
                'Veh_documento' => $request->Veh_documento ?? $vehiculo->Veh_documento,
                'Veh_modelo' => $request->Veh_modelo ?? $vehiculo->Veh_modelo,
                'Veh_año' => $request->Veh_año ?? $vehiculo->Veh_año,
                'Veh_estado' => $request->Veh_estado ?? $vehiculo->Veh_estado,
                'Veh_placa' => $request->Veh_placa ?? $vehiculo->Veh_placa,
                'Veh_matricula' => $request->Veh_matricula ?? $vehiculo->Veh_matricula,
                'Veh_soat' => $request->Veh_soat ?? $vehiculo->Veh_soat,
                'Veh_tecnomecanica' => $request->Veh_tecnomecanica ?? $vehiculo->Veh_tecnomecanica,
                'Veh_c_soat' => $request->Veh_c_soat ?? $vehiculo->Veh_c_soat,
                'Veh_c_t_mecanica' => $request->Veh_c_t_mecanica ?? $vehiculo->Veh_c_t_mecanica,
                'Veh_c_t_propiedad' => $request->Veh_c_t_propiedad ?? $vehiculo->Veh_c_t_propiedad,
            ]);

            return $this->respond(200, $vehiculo, null, 'Vehiculo creado exitosamente');
        } catch (\Exception $e) {
            return $this->respond(500, [], $e->getMessage(), 'Error al crear vehiculo');
        }
    }



    // public function deleteVehiculo($id)
    // {
    //     try {
    //         $vehiculo = $this::find($id);
    //         if (is_null($vehiculo)) {
    //             return $this->respond(500, [], 'No se encontró el vehiculo');
    //         }
    //         $vehiculo->delete();
    //         return $this->respond(200, $vehiculo, null, 'Vehiculo eliminado exitosamente');
    //     } catch (\Exception $e) {
    //         return $this->respond(500, [], $e->getMessage(), 'Error al eliminar vehiculo');
    //     }
    // }
}
