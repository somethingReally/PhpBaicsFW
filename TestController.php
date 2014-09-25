<?php

/*
 * Copyright 2014 David.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Description of TestController
 *
 * @author David
 */
class TestController extends ViewController {

    public function __construct($view, $model = "") {
        parent::__construct($view);
        $this->model = $model;
    }

    public function updateView() {
        $this->transeversAllNodes();
        $this->view = $this->domView->saveHTML();
    }

//put your code here
}
