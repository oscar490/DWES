<?php

class Prueba
{
    public const PUBLICA_DEFAULT = 'publica';

    public $publica;

    public static $estatica = 30;

    private $_privada = 25;

    protected $protegida = 'protegida';

    public function __construct($valor=selft::PUBLICA_DEFAULT)
    {
        $this->publica = $valor;
    }

    public function getPrivada()
    {
        return $this->_privada;
    }

    public function setPrivada($privada): void
    {
        $this->_privada = $privada;
    }

    public function mostrar()
    {
        echo self::PUBLICA_DEFULT;
    }
}
