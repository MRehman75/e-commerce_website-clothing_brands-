@php
$breadcrumbItems = $seoData['breadcrumb'] ?? $breadcrumbs ?? null;

if (!$breadcrumbItems || count($breadcrumbItems) < 2) {
    return;
    }

    $itemListElement=[];
    $position=1;

    foreach ($breadcrumbItems as $item) {
    $itemListElement[]=[ '@type'=> 'ListItem',
    'position' => $position,
    'name' => $item['name'] ?? '',
    'item' => $item['url'] ?? '',
    ];
    $position++;
    }

    $breadcrumbSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => $itemListElement,
    ];
    @endphp

    @if(count($breadcrumbItems) > 1)
    <script type="application/ld+json">
        {
            !!json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!
        }
    </script>
    @endif