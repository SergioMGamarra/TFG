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
//for ($j = 1; $j <= 2; $j++) {
    // Retrieve the DOM from a given URL
    //$html = file_get_html('https://www.sciencedaily.com/search/?keyword=bigdata#gsc.tab=0&gsc.q=bigdata&gsc.page='.$j);
    $html = file_get_html('https://journalofbigdata.springeropen.com/articles?searchType=journalSearch&sort=PubDate&page=2');
    //$html = file_get_html('https://journalofbigdata.springeropen.com/articles?query=all&volume=&searchType=&tab=keyword&page='.$i);
    $post = array();
    foreach ($html->find('li.ResultsList_item ') as $art) {
        foreach ($art->find('a.fulltexttitle') as $title) {
            $enlace = $pre_link."".$title->href;
            $titulo = strip_tags($title->innertext);
            echo "Título: ".$titulo.". Con enlace en: ".$enlace;
            $post['titulo'] = $titulo;
            echo "<br>";
        }

        foreach ($art->find('div.article_abstract') as $abstract) {
            foreach ($abstract->find('p') as $abs) {
                $abs = $abs->innertext;
            }
            echo "Abstract: ".$abs;
            $post['abstract'] = $abs;
            echo "<br>";
        }

        foreach ($art->find('p.ResultsList_authors') as $autor) {
            $aut = $autor->innertext;
            echo "Autor: ".$aut;
            $post['nombre_autor'] = $aut;
            echo "<br>";

        }

        foreach ($art->find('span.ResultsList_journalTitle') as $revista) {
            $revista = $revista->innertext;
            echo "Revista: ".$revista;
            $post['revista'] = $revista;
            echo "<br>";
        }

        foreach ($art->find('p.ResultsList_published') as $publicado_en) {
            $publicado_en=substr($publicado_en->innertext,14);
            echo "Publicado en: ".$publicado_en;
            $post['fecha'] = $publicado_en;
            echo "<br>";
        }

        foreach ($art->find('a.fulltextpdf') as $fichero) {
            $enlace_fichero = $fichero->href;
            echo "Fichero: ".$fichero->href;
            
        }

        file_put_contents("/Applications/MAMP/htdocs/science/solr/files/0/".str_replace(' ', '_',$titulo.".pdf"), fopen("https://journalofbigdata.springeropen.com".$enlace_fichero, 'r'));

        $html_content = file_get_html($enlace);
        foreach ($html_content->find('div.main__content') as $conten) {
            $conten = $conten->plaintext;
            echo "<br><br><br><br><br><br><br><br>";
            echo $conten->plaintext;
            echo "<br><br><br><br><br><br><br><br>";
        }


        echo "<br><br>";
        InsertNewArticle_parsing ($connection, $post, $enlace_fichero);

    //}
}
?>
</body></html>
