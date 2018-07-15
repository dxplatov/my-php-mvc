<?php
/**
 * Created by PhpStorm.
 * User: doston
 * Date: 6/23/18
 * Time: 01:09
 */

class Pages extends Controller
{
    public function __construct(){


    }
    public function index(){

        $data = [
            'title'=>'Welcome',
        ];
        $this->views('pages/index' ,$data);

    }
    public function about(){
        $data = ['title'=>'About us'];
        $this->views('pages/about',$data);
    }
}