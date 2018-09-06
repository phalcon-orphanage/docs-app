<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="https://www.w3.org/2001/XMLSchema"
        xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    {% for element in elements %}
        <url>
            <loc>https://docs.phalconphp.com/{{ element }}</loc>
            <changefreq>daily</changefreq>
        </url>
    {% endfor %}
</urlset>
