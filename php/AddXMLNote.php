<?php
if(isset($_POST['title'])&& isset($_POST['categoria']) && isset($_POST['text'])&& isset($_POST['id'])){
    $title=$_POST['title'];
    $categoria=$_POST['categoria'];
    $text=$_POST['text'];
    $correo="user@gmail.com";
    $id=$_POST['id'];
    echo "$text $categoria $title $correo $id ";

    $xml = simplexml_load_file("../xml/Notes.xml");
    foreach ($xml->children() as $child) {
        print_r($child);
        # code...
    }
    $Nota= $xml->addChild('NoteUser');
}