<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach($urls as $url): ?>
        <url>
            <loc><?= $host . $url ?></loc>
            <changefreq>daily</changefreq>
            <priority>1</priority>
        </url>
    <?php endforeach; ?>
</urlset>

