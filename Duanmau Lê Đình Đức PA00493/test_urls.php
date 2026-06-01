<?php
$urls = [
    'tra_hoa_cuc_old' => 'https://images.unsplash.com/photo-1594631252845-29fc4586d5bc?q=80&w=500',
    'tra_hoa_cuc_new' => 'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?q=80&w=500',
    'tra_atiso_do_old' => 'https://images.unsplash.com/photo-1555529731-118a820c4098?q=80&w=500',
    'tra_atiso_do_new1' => 'https://images.unsplash.com/photo-1506368249639-73a05d6f6488?q=80&w=500',
    'tra_atiso_do_new2' => 'https://images.unsplash.com/photo-1597481499750-3e6b22637e12?q=80&w=500',
    'tra_atiso_do_new3' => 'https://images.unsplash.com/photo-1627435601357-374b1e0455a6?q=80&w=500',
    'chamomile_tea_cup' => 'https://images.unsplash.com/photo-1563822249548-9a72b6353cd1?q=80&w=500',
    'hibiscus_tea' => 'https://images.unsplash.com/photo-1515694346937-94d85e41e6f0?q=80&w=500'
];

foreach ($urls as $key => $url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    echo "$key ($url) -> Status: $http_code\n";
}
