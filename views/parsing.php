    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
<?php
/**
 * Created by PhpStorm.
 * User: sergiomunozgamarra
 * Date: 28/6/16
 * Time: 20:06
 */

header('Content-Type: text/html; charset=utf-8');
// Include the library
include('../include/simple_html_dom.php');
include('../include/functions.php');
for ($j = 0; $j < 100; $j += 10) {
// Retrieve the DOM from a given URL
    $html = file_get_html('https://scholar.google.es/scholar?start=' . $j . '&q=big+data&hl=es&as_sdt=0,5');


// Por cada contenedor de información
    foreach ($html->find('div.gs_ri') as $e) {
        $links = array();
        $titulo = "";
        $autor = "";
        $abstract = "";
        $contenido = "";
        $fecha = "";
        $enlace = "";

        foreach ($e->find('h3.gs_rt') as $e1) {
            //echo "Título: ".$e1->innertext . "<br>";
            $titulo .= strip_tags($e1->innertext);
            foreach ($e1->find('a') as $e2) {
                $enlace = $e2->href;
                //echo "Enlace: ".utf8_decode($e2->href) . "<br>";
            }
        }


        foreach ($e->find('div.gs_a') as $e1) {
            $autor .= strip_tags($e1->innertext);
            //echo "Autores: ". utf8_decode($e1->innertext) . "<br>";
        }

        foreach ($e->find('div.gs_rs') as $e1) {
            //echo "Abstract: ".utf8_decode($e1->innertext) . "<br>";
            $abstract .= strip_tags($e1->innertext);
        }

        echo "ARTÍCULO: <BR>";
        echo "\t - <strong>Titulo</strong>: " . $titulo . "<br>";
        echo "\t - <strong>Enlace:</strong> " . $enlace . "<br>";
        echo "\t - <strong>Autores:</strong> " . $autor . "<br>";
        echo "\t - <strong>Abstract:</strong> " . $abstract . "<br>";
        echo "\t - <strong>Fecha:</strong> " . date('Y-m-d H:i:s') . "<br>";
        echo "<br>";
        echo $enlace;
        insertArt($connection, $titulo, $autor, $abstract, '', $fecha, $enlace);
    }


    /*
    foreach($html->find('div.gs_ri') as $e) {
        $link = $e->find('a');
    }*/

    /*
    foreach($html->find('a') as $e)
        echo $e." ->".$e->href . '<br>';
    */
    /*
    // Find all "A" tags and print their HREFs


    // Retrieve all images and print their SRCs
    foreach($html->find('img') as $e)
        echo $e->src . '<br>';

    // Find all images, print their text with the "<>" included
    foreach($html->find('img') as $e)
        echo $e->outertext . '<br>';

    // Find the DIV tag with an id of "myId"
    foreach($html->find('div#myId') as $e)
        echo $e->innertext . '<br>';

    // Find all SPAN tags that have a class of "myClass"
    foreach($html->find('div.gs_a') as $e)
        echo $e->outertext . '<br>';

    // Find all TD tags with "align=center"
    foreach($html->find('td[align=center]') as $e)
        echo $e->innertext . '<br>';

    // Extract all text from a given cell
    echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';*/
}
?>
    </body></html>
