<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'alumnos',
            'carreras',
            'catalogo_cuestionarios',
            'competencias',
            'estatus',
            'materias',
            'roles',
            'tipo_reactivos',
            'profesores',
            'grupos',
            'puntos_gramaticales',
            'evaluaciones',
            'reactivos',
            'respuestas',
            'opcion_reactivos',
            'comentarios',
            'evaluacion_has_reactivo',
            'grupo_has_alumno',
        ]);

        
        $this->call(AlumnoTableSeeder::class);
        $this->call(CarreraTableSeeder::class);
        $this->call(CatalogoCuestionarioTableSeeder::class);
        $this->call(CompetenciaTableSeeder::class);
        $this->call(EstatusTableSeeder::class);
        $this->call(MateriaTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TipoReactivoTableSeeder::class);
        $this->call(ProfesorTableSeeder::class);
        $this->call(GrupoTableSeeder::class);
        $this->call(PuntoGramaticalTableSeeder::class);
        $this->call(EvaluacionTableSeeder::class);
        $this->call(ReactivoTableSeeder::class);          
        $this->call(RespuestaTableSeeder::class);
        $this->call(OpcionReactivoTableSeeder::class);     
        $this->call(ComentarioTableSeeder::class);
        $this->call(EvaluacionHasReactivoTableSeeder::class);
        $this->call(GrupoHasAlumnoTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }

    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
 
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
 
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
