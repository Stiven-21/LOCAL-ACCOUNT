<?php
    class Failed extends Controller{
        function __construct(){
            parent::__construct();
            $this -> view -> mensaje = "Error al cargar el recurso :v";
            $this -> view -> render('templates/failed/prueba');
        }
    }