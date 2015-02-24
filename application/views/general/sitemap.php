<?php
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/23/15
 * Time: 1:15 PM
 * Proj: prod-new
 */

echo "<?"; ?>xml version="1.0" encoding="UTF-8"<?php echo "?".">\n"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
         xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<!-- This page is build in {elapsed_time} seconds! -->
<?php foreach($urls as $url):?>
	<url>
<?php 
		foreach($url as $tag => $val):
			if($tag == 'loc') $val = base_url().$val;
?>
		<<?php echo $tag;?>><?php echo htmlentities($val,ENT_XML1, 'UTF-8') ;?></<?php echo $tag;?>>
<?php 
		endforeach;
?>
	</url>
<?php endforeach;?>
</urlset>
