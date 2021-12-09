<?php
echo "antes del if";
if(isset($_POST['id'])){
    echo "despues del if";
    $id=$_POST['id'];
    $xml = simplexml_load_file("../xml/Notes.xml");
    $result = $xml->xpath( "//NoteUser[@id='$id']");
    foreach ( $result as $node ) {
        $dom = dom_import_simplexml($node);
        $dom->parentNode->removeChild($dom);
    }
    $domxml = new DOMDocument('1.0');
    $domxml->preserveWhiteSpace = false;
    $domxml->formatOutput = true;
    $domxml->loadXML($xml->asXML());
    $domxml->save('../xml/Notes.xml');
}