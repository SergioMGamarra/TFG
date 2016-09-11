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
$pre_link = "https://journalofbigdata.springeropen.com/";
$pre_link = substr($pre_link, 0, -1);
header('Content-Type: text/html; charset=utf-8');
// Include the library
include('../include/simple_html_dom.php');
include('../include/functions.php');
for ($j = 1; $j <= 2; $j++) {
    // Retrieve the DOM from a given URL
    //$html = file_get_html('https://www.sciencedaily.com/search/?keyword=bigdata#gsc.tab=0&gsc.q=bigdata&gsc.page='.$j);
    $html = file_get_html('https://journalofbigdata.springeropen.com/articles?searchType=journalSearch&sort=PubDate&page='.$j);
    foreach ($html->find('li.ResultsList_item ') as $art) {
        foreach ($art->find('a.fulltexttitle') as $title) {
            $enlace = $pre_link."".$title->href;
            $titulo = strip_tags($title->innertext);
            echo "Título: ".$titulo.". Con enlace en: ".$enlace;
            echo "<br>";
        }

        foreach ($art->find('div.article_abstract') as $abstract) {
            foreach ($abstract->find('p') as $abs) {
                $abs = $abs->innertext;
            }
            echo "Abstract: ".$abs;
            echo "<br>";
        }

        foreach ($art->find('p.ResultsList_authors') as $autor) {
            $aut = $autor->innertext;
            echo "Autor: ".$aut;
            echo "<br>";

        }

        foreach ($art->find('span.ResultsList_journalTitle') as $revista) {
            $revista = $revista->innertext;
            echo "Revista: ".$revista;
            echo "<br>";
        }

        foreach ($art->find('p.ResultsList_published') as $publicado_en) {
            $publicado_en=substr($publicado_en->innertext,14);
            echo "Publicado en: ".$publicado_en;
            echo "<br>";
        }


        $html_content = file_get_html($enlace);
        foreach ($html_content->find('div.main__content') as $conten) {
            $conten = $conten->plaintext;
            echo "<br><br><br><br><br><br><br><br>";
            echo $conten->plaintext;
            echo "<br><br><br><br><br><br><br><br>";
        }


        echo "<br><br>";
        insertArt_complete($connection, $titulo, $aut, $abs, $conten, $publicado_en, $enlace, $fecha, $revista);

    }

/*
    echo "Tengo la página ".$j."<br>";

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
            echo "hola";
            //echo "Título: ".$e1->innertext . "<br>";
            //$titulo .= strip_tags($e1->innertext);
            /*foreach ($e1->find('a.gs-title') as $e2) {
                $enlace = $e2->href;
                //echo "Enlace: ".utf8_decode($e2->href) . "<br>";
            }
        }*/


        /*foreach ($e->find('div.gs_a') as $e1) {
            $autor .= strip_tags($e1->innertext);
            //echo "Autores: ". utf8_decode($e1->innertext) . "<br>";
        }*/
/*
        foreach ($e->find('div.gs-bidi-start-align gs-snippet') as $e1) {
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
        //insertArt($connection, $titulo, $autor, $abstract, '', $fecha, $enlace);
    }*/


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
