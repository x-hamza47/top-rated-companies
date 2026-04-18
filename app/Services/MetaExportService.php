<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Service;
use App\Models\Company;
use App\Models\Insight;

class MetaExportService
{
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Headers
        $sheet->setCellValue('A1', 'URL');
        $sheet->setCellValue('B1', 'Title');
        $sheet->setCellValue('C1', 'Meta Description');
        $sheet->setCellValue('D1', 'Title Length');

        $row = 2;

        // Static pages
        $staticPages = [
            [
                'url' => url('/'),
                'title' => 'Top Firms Reviewer - Compare the Best Agencies & Consultants',
                'meta' => 'Find the best software development, marketing, and consulting firms. Compare top-rated agencies and read expert reviews at Top Firms Reviewer.'
            ],
            [
                'url' => url('/contact'),
                'title' => 'Contact Us | Top Firms Reviewer',
                'meta' => 'Get in touch with Top Firms Reviewer. Send your inquiries or feedback using our contact form.'
            ],
            [
                'url' => url('/claim-profile'),
                'title' => 'Claim Your Company Profile | Top Firms Reviewer',
                'meta' => 'Claim your company profile on Top Firms Reviewer to manage services, pricing, and reviews. Increase your visibility to potential clients.'
            ],
            [
                'url' => url('/blogs'),
                'title' => 'Blogs — Top Firms Reviewer',
                'meta' => 'Read the latest blogs on software development, marketing, design, and consulting. Discover insights, trends, and expert tips from industry leaders.'
            ],
        ];

        foreach ($staticPages as $page) {
            $sheet->setCellValue("A{$row}", $page['url']);
            $sheet->setCellValue("B{$row}", $page['title']);
            $sheet->setCellValue("C{$row}", $page['meta']);
            $sheet->setCellValue("D{$row}", mb_strlen($page['title']));
            $row++;
        }

        // Insights / Blog pages
        $blogs = Insight::all();
        foreach ($blogs as $blog) {
            $url = url("/blogs/{$blog->slug}");
            $title = "{$blog->title} — Top Firms Reviewer";
            $meta = $blog->description ?? \Illuminate\Support\Str::limit(strip_tags($blog->article), 150);

            $sheet->setCellValue("A{$row}", $url);
            $sheet->setCellValue("B{$row}", $title);
            $sheet->setCellValue("C{$row}", $meta);
            $sheet->setCellValue("D{$row}", mb_strlen($title, 'UTF-8'));
            $row++;
        }

        // Service pages
        $services = Service::all();
        foreach ($services as $service) {
            $url = url("/companies/{$service->slug}");
            $title = "Top {$service->name} Companies | Top Firms Reviewer";
            $meta = "Compare top {$service->name} companies. Read verified reviews, pricing, and services to find the best {$service->name} partner for your business.";

            $sheet->setCellValue("A{$row}", $url);
            $sheet->setCellValue("B{$row}", $title);
            $sheet->setCellValue("C{$row}", $meta);
            $sheet->setCellValue("D{$row}", mb_strlen($title, 'UTF-8'));
            $row++;
        }

        // Company pages
        $companies = Company::withCount('reviews')->get();
        foreach ($companies as $company) {
            $url = url("/profile/{$company->slug}");
            $title = "{$company->name} Reviews ({$company->reviews_count}), Pricing, Services & Ratings | Top Firms Reviewer";
            $meta = "Read {$company->reviews_count} verified reviews of {$company->name}. Explore ratings, pricing, services, and company details on Top Firms Reviewer.";

            $sheet->setCellValue("A{$row}", $url);
            $sheet->setCellValue("B{$row}", $title);
            $sheet->setCellValue("C{$row}", $meta);
            $sheet->setCellValue("D{$row}", mb_strlen($title, 'UTF-8'));
            $row++;
        }

  
        // Save to XLSX and return path
        $writer = new Xlsx($spreadsheet);
        $fileName = 'meta_data.xlsx';
        $writer->save(storage_path($fileName));

        return storage_path($fileName);
    }
}