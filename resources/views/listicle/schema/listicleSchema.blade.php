<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@graph" : [
    {
      "@type": "WebPage",
      "@id": "https://topfirmsreviewer.com/companies/{{ $service->slug }}",
      "url": "https://topfirmsreviewer.com/companies/{{ $service->slug }}",
      "name": "Top {{ $service->name }} Companies in {{ now()->format('F Y') }}",
      "description": "Compare top {{ $service->name }} companies. Read verified reviews, pricing, and services to find the best {{ $service->name }} partner for your business.",
      "inLanguage": "en-US",
      "isPartOf": {
        "@type": "WebSite",
        "name": "Top Firms Reviewer",
        "url": "https://topfirmsreviewer.com/"
      },
      "about": {
        "@type": "Thing",
        "name": "{{ $service->name }}"
      },
     "datePublished": "{{ $service->created_at->utc()->format('Y-m-d\TH:i:s+00:00') }}",
     "dateModified": "{{ optional($companies->max('updated_at'))->utc()?->format('Y-m-d\TH:i:s+00:00') ?? now()->utc()->format('Y-m-d\TH:i:s+00:00') }}"
    },

    {
        "@type": "ItemList",
        "@id": "https://topfirmsreviewer.com/companies/{{ $service->slug }}#itemlist"
        "name": "Top {{ $service->name }} Companies",
        "numberOfItems": {{ $companies->count() }},
        "itemListElement": [
            @foreach ($companies as $index => $company)
            {
            "@type": "ListItem",
            "position": {{ $index + 1 }},
            "item": {
                "@type": "LocalBusiness",
                "name": "{{ $company->name }}",
                "url": "https://topfirmsreviewer.com/profile/{{ $company->slug }}",
                "image": "{{ $company->logo }}",
                "priceRange": "{{ $company->details->hourly_rate ?? '' }}",
                "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "{{ $company->reviews_avg_rating ?? 0 }}",
                "reviewCount": "{{ $company->reviews_count ?? 0 }}",
                "bestRating": 5,
                "worstRating": 1
                }
            }
            }@if(!$loop->last),@endif
            @endforeach
        ]
    },
     {
      "@type": "FAQPage",
      "@id": "https://topfirmsreviewer.com/companies/{{ $service->slug }}#faq",
      "mainEntity": [
        @foreach ($serviceFaqs as $faq)
        {
          "@type": "Question",
          "name": "{{ $faq->question }}",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ strip_tags($faq->answer) }}"
          }
        }@if(!$loop->last),@endif
        @endforeach
      ]
    }

  ]
}
</script>
