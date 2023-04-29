<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function abilities()
    {
        return $this->hasMany(RoleAbility::class);
    }
    public static function CreateWithAbility(Request $request)
    {
        DB::transaction();
        try {
            $role = Role::crete([
                'name' => $request->post('name'),

            ]);
            //post give me date form (form)

            foreach ($request->post('abilities') as $ability => $value) {
                RoleAbilities::create([
                    'role_id' => $role->id,
                    'ability' => $ability,
                    'type' => $value,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $role;
    }
    public function UpdateWithAbility(Request $request)
    {
        DB::transaction();
        try {
            $this->update([
                'name' => $request->post('name'),

            ]);
            //post give me date form (form)
            foreach ($request->post('abilitis') as  $ability => $value) {
                RoleAbilities::updateOrCreate([
                    'role_id' => $request->id,
                    'ability' => $ability,
                ], [
                    'type' => $value,

                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $this;
    }
}
