<?php

use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('vacancies');
        });


        Unit::insert([
            [
                'name' => 'CBA - ALUMÍNIO',
                'vacancies' => 268
            ],
            [
                'name' => 'CBA - CORPORATIVO ALUMÍNIO',
                'vacancies' => 40
            ],
            [
                'name' => 'CBA - MIRAÍ',
                'vacancies' => 10
            ],
            [
                'name' => 'CBA - NIQUELÂNDIA',
                'vacancies' => 20
            ],
            [
                'name' => 'CBA - FAZENDA ENGENHO',
                'vacancies' => 10
            ],
            [
                'name' => 'CBA - POÇOS DE CALDAS',
                'vacancies' => 10
            ],
            [
                'name' => 'CBA - BARRO ALTO',
                'vacancies' => 7
            ],
            [
                'name' => 'CBA - ITAPISSUMA',
                'vacancies' => 40
            ],
            [
                'name' => 'CBMX - METALATEX',
                'vacancies' => 25
            ],
            [
                'name' => 'CD - SOROCABA',
                'vacancies' => 40
            ],
            [
                'name' => 'CD - USINAS',
                'vacancies' => 10
            ],
            [
                'name' => 'CBA - ALUX',
                'vacancies' => 10
            ]
        ]);

        // Schema::table('users', function (Blueprint $table) {
        //     $table->integer('unit_id');
        // });

        $users = User::all();

        foreach($users as $user) {
            $unit = Unit::where('name', $user->unit)->first();
            $user->unit_id = $unit->id;
            $user->save();
        }

        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('unit_id');
            $table->string('user_name');
            $table->string('tshirt');
            $table->string('phone');
            $table->string('unit');
            $table->timestamps();
        });

        Schema::create('runs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
};
