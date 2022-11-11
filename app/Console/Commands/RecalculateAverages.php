<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;

class RecalculateAverages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recalculate:average';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate all averages on results';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Student::create([
        //     'name' => 'Test Test',
        //     'regnum' => '1234hello',
        //     'email' => 'inno@gmail.com',
        //     'gender' => 'male',
        //     'school_class_id' => 1,
        //     'status' => 'active',

        // ]);

    }
}
