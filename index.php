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
        require_once './autoloader.php';
        addToSetIncludePath();
        spl_autoload_register();
        new ErrorHandler([]);
        $test = new InputObject("twesd", "tesfd");
        $c = new Collection(InputObject::class, 'getInputComponet', [new InputObject("fds", "dfs")]);
        $c->add(new InputObject("twes", "tesfd"));
        $c->add(new InputObject("dfs", "sdf"));

//        $c->rekeyCollection();
//        echo $c->getByKey("fds");
//        var_dump($c->getCollection());
//
//        $domDom = new DOMDocument();
//        $domDom->loadHTML('C:\xampp\htdocs\NewLogSystem\Panels\DetailsPanel.php');
//        $elm = $domDom->createElement("p", "This is a test");
//        $domDom->appendChild($elm);
//        echo $domDom->saveHTML();
        
        $testController = new TestController(file_get_contents('C:\xampp\htdocs\PhpBaicsFW\TestPanel.php'), new TestModel("David", "Mc Cartan"));
        $testController->updateView();
        echo $testController->getView();
        ?>
    </body>
</html>
