<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SitemapService;


class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all sitemap files (profiles, directories/services) and index';

    /**
     * Execute the console command.
     */
    public function handle(SitemapService $sitemap)
    {
        $this->info('Starting sitemap generation...');

        try {
            $sitemap->generate();
            $this->info('Sitemaps generated successfully!');
        } catch (\Exception $e) {
            $this->error('Sitemap generation failed: ' . $e->getMessage());
        }
    }
}
