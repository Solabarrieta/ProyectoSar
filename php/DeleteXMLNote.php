<?php
if(isset($_POST['id'])){
    $xml = simplexml_load_file("../xml/Notes.xml");
    foreach ($xml->NoteUser as $noteUser) {
        
        if($noteUser->attributes()[0]==$id){
            $noteUser->parentNode->removeChild($noteUser);
            $domxml = new DOMDocument('1.0');
            $domxml->preserveWhiteSpace = false;
            $domxml->formatOutput = true;
            $domxml->loadXML($xml->asXML());
            $domxml->save('../xml/Notes.xml');
        }
    }
}