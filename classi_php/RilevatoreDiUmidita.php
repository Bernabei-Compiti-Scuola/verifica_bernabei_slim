<?php
    require_once 'Rilevatore.php';
    class RilevatoreDiUmidita extends Rilevatore implements JsonSerializable
    {
        protected $posizione;
        public function __construct($identificativo, $codiceSeriale,$unita='%')
        {
            parent::__construct($identificativo,$codiceSeriale, $unita);
            $this->posizione = $posizione;
        }
    


    public function jsonSerialize()
    {
        $a = [
            "identificativo"=>$this->identificativo,
            "misurazioni"=>$this->misurazioni,
            "unitaDiMisura"=>$this->unita,
            "codiceSeriale"=>$this->codiceSeriale,
            "posizione"=>$this->posizione
        ];
        return $a;
    }

    function getPosizione()
    {
        return $this->posizione;
    }
     function setPosizione($posizione)
    {
        $this->posizione = $posizione;
    }
}
?>