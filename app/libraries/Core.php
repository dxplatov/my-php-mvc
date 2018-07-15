<?php
//App Core class
//Creates URL & loads controller
//URL format /controller/method/params
//

class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
//        print_r($this->getURL());
            $url = $this->getURL();
            //Look in controllers for the first value
            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php'))
            {
                //If exists set as controller
                $this->currentController = ucwords($url[0]);
                //Unset 0 index
                unset($url[0]);

            }
            //Require the controller
            require_once '../app/controllers/'.$this->currentController.'.php';
            //Init Controller
            $this->currentController = new $this->currentController;
            if(isset($url[1])){
                //Check if method exist
                if(method_exists($this->currentController,$url[1])){
                    $this->currentMethod = $url[1];
                    //Unset 1 index
                    unset($url[1]);
                }
            }
            //Get params
        $this->params = $url ? array_values($url) : [];
            //call a callback
            call_user_func_array([$this->currentController,$this->currentMethod], $this->params);
    }

    public function getURL(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            return $url;
        }

    }

}
