<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL as FacadesURL;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Sitemap as SitemapTag;
use Spatie\Sitemap\Tags\Url;

class SitemapService
{

    private $limit = 45000;

    public function generate()
    {
        $this->generateProfiles();
        $this->generateServices();
        $this->generateIndex();
    }

    private function generateProfiles()
    {
        $page = 1;
        Company::select('id', 'slug', 'updated_at')
            ->chunk($this->limit, function ($companies) use ($page) {
                $sitemap = Sitemap::create();

                foreach ($companies as $company) {
                    $sitemap->add(
                        Url::create(FacadesURL::to("/profile/{$company->slug}"))
                            ->setLastModificationDate($company->updated_at)
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                            ->setPriority(0.7)
                    );
                }
                $sitemap->writeToFile(public_path("sitemap-profile-{$page}.xml"));
                $page++;
            });
    }

    private function generateServices()
    {
        $page = 1;
        Service::where('status', 1)
            ->select('slug', 'updated_at')
            ->chunk($this->limit, function ($services) use ($page) {
                $sitemap = Sitemap::create();

                foreach ($services as $service) {
                    $sitemap->add(
                        Url::create(FacadesURL::to("/companies/{$service->slug}"))
                            ->setLastModificationDate($service->updated_at ?? now())
                            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                            ->setPriority(0.8)
                    );
                }
                $sitemap->writeToFile(public_path("sitemap-directory-{$page}.xml"));

                $page++;
            });
    }

    private function generateIndex() {
        $index = SitemapIndex::create();

        $files = glob(public_path('sitemap-*.xml'));

        foreach ($files as $filePath) {
            $filename = basename($filePath);

            if ($filename === 'sitemap.xml') {
                continue;
            }

            $url = FacadesURL::to($filename);

            $sitemapTag = SitemapTag::create($url);

            if (file_exists($filePath) && ($mtime = filemtime($filePath)) !== false) {
                $sitemapTag->setLastModificationDate(Carbon::createFromTimestamp($mtime));
            } 

            $index->add($sitemapTag);
        }
        $index->writeToFile(public_path("sitemap.xml"));
    }
}
