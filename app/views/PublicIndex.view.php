<?php
/*
 * The view class for public index page
 */
 require_once('viewXhtml.php');
 require_once('tcpdf/tcpdf.php');
 
 
$t_oView = new viewXhtml('PublicIndex.phtml');

$t_sSearchResult = '<br/> here';
$stringResult = file_get_contents('http://www.autotrader.co.uk/search/used/cars/postcode/en36ap/radius/10/onesearchad/used%2Cnearlynew%2Cnew/price-from/500/price-to/2000/quicksearch/true');
if (preg_match_all('/<div id="advert[0-9]+" class="[a-zA-Z ]+">.{2,3585}/s', trim($stringResult), $matches))
{
	// echo 'matches!';
	// foreach($matches[0] as $result)
	// {
	// 	$t_sSearchResult .= $result;
	// }
}
else
	echo 'no match';


$t_oView->setVar('PdfLink', $t_sSearchResult);


$t_oView->render();
 
?>