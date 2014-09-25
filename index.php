<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        new ErrorHandler([]);
        $test = new InputObject("twesd", "tesfd");
        $c = new Collection(InputObject::class, 'getInputComponet', [new InputObject("fds", "dfs")]);
        $c->add(new InputObject("twes", "tesfd"));
        $c->add(new InputObject("dfs", "sdf"));

        $c->rekeyCollection();
        echo $c->getByKey("fds");
        var_dump($c->getCollection());

        $domDoc = new HTMLPanel('C:\xampp\htdocs\NewLogSystem\Panels\DetailsPanel.php');
        echo $domDoc->getAsDOMDocument()->saveHTML();
        $domDom = new DOMDocument();
        $domDom = &$domDoc->getAsDOMDocument();
        $elm = $domDom->createElement("p", "This is a test");
        $domDom->appendChild($elm);
        echo $domDoc->getAsDOMDocument()->saveHTML();
        ?>



    </body>
</html>
