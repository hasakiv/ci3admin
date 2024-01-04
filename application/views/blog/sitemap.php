<?php header('Content-type: text/xml'); ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo base_url();?></loc>
        <priority>1.0</priority>
        <changefreq>daily</changefreq>
    </url>



    <?php foreach($items as $item) { ?>
    <url>
        <loc><?php echo site_url()."post/".$item->url ?></loc>
        <priority>0.8</priority>
        <changefreq>daily</changefreq>
    </url>
    <?php } ?>


</urlset>