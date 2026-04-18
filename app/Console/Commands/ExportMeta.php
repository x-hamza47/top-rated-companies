<?php

namespace App\Console\Commands;

use App\Services\MetaExportService;
use Illuminate\Console\Command;

class ExportMeta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:meta';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export service and company meta data to XLSX';

    /**
     * Execute the console command.
     */
    public function handle(MetaExportService $exportService)
    {
        $this->info('Starting meta export...');

        try {
            $filePath = $exportService->export();
            $this->info("Meta data exported successfully to: {$filePath}");
        } catch (\Exception $e) {
            $this->error('Meta export failed: ' . $e->getMessage());
        }
    }
}
