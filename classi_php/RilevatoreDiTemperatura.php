<?php
    require_once 'Rilevatore.php';
    class RilevatoreDiTemperatura extends Rilevatore implements JsonSerializable
    {
        protected $tipologia;
        public function __construct($identificativo, $codiceSeriale, $unita="°C")
        {
            parent::__construct($identificativo,$codiceSeriale,$unita);
            $this->tipologia = $tipologia;
        }
    


    function jsonSerialize()
    {
        $a = [
            "identificativo"=>$this->identificativo,
            "misurazioni"=>$this->misurazioni,
            "unitaDiMisura"=>$this->unita,
            "codiceSeriale"=>$this->codiceSeriale,
            "tipologia"=>$this->tipologia
        ];
    }

    function getTipologia()
    {
        return $this->tipologia;
    }
    function setTipologia($tipologia)
    {
        $this->tipologia = $tipologia;
    }
}
?>