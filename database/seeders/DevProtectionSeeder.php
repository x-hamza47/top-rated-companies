<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevProtectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_dev_delete');
        DB::unprepared('DROP TRIGGER IF EXISTS prevent_dev_update');

        DB::unprepared('
            CREATE TRIGGER prevent_dev_delete
            BEFORE DELETE ON users
            FOR EACH ROW
            BEGIN
                IF OLD.role = "dev" THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Cannot delete dev account.";
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER prevent_dev_update
            BEFORE UPDATE ON users
            FOR EACH ROW
            BEGIN
                IF OLD.role = "dev" THEN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Cannot modify dev account.";
                END IF;
            END
        ');
    }
}
