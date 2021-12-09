<?php
if (isset($_POST['title']) && isset($_POST['categoria']) && isset($_POST['text'])) {
    $title = $_POST['title'];
    $categoria = $_POST['categoria'];
    $text = $_POST['text'];
    $correo = "user@gmail.com";
    $id = $_POST['id'];
    echo "$title , $categoria, $text, $id ";
    $new = true;
    $xml = simplexml_load_file("../xml/Notes.xml");
    foreach ($xml->NoteUser as $noteUser) {
        
        if($noteUser->attributes()[0]==$id){
            $new=false;
            $xmlText= $noteUser->Text;
            $xmlText->attributes()['categoria']=$categoria;
            $xmlText->attributes()['title']=$title;
            $xmlText[0]=$text;
            $domxml = new DOMDocument('1.0');
            $domxml->preserveWhiteSpace = false;
            $domxml->formatOutput = true;
            $domxml->loadXML($xml->asXML());
            $domxml->save('../xml/Notes.xml');
        }
    }
    echo "fjsalfkdsj";
    if ($new) {
        
        try{
            $nota = $xml->addChild('NoteUser');
            $nota->addAttribute('id', uniqid());
            $nota->addAttribute('id', $correo);
            $xmltext=$nota->addChild('Text',$text);
            $xmltext->addAttribute('categoria', $categoria);
            $xmltext->addAttribute('title', $title);
            $domxml = new DOMDocument('1.0');
            $domxml->preserveWhiteSpace = false;
            $domxml->formatOutput = true;
            $domxml->loadXML($xml->asXML());
            $domxml->save('../xml/Notes.xml');
            
        }catch(Exception $e){
            echo "no se ha podido guardar la nota";
        }
    }
}
