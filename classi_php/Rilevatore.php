<?php
    class Rilevatore implements JsonSerializable
    {
        protected $identificativo;
        protected $misurazioni;
        protected $unitaDiMisura;
        protected $codiceSeriale;

        public function __construct($identificativo,$codiceSeriale,$unita)
        {
            $this->identificativo = $identificativo;
            $this->misurazioni = array();
            $this->unitaDiMisura = $unita;
            $this->codiceSeriale = $codiceSeriale;
        }

        public function jsonSerialize()
        {
            $a = [
                "identificativo"=>$this->identificativo,
                "misurazioni"=>$this->misurazioni,
                "unitaDiMisura"=>$this->unitaDiMisura,
                "codiceSeriale"=>$this->codiceSeriale
            ];
            return $a;
        }
        
        public function getValore_maggDiValMin()
        {
            $a = array();
            $valore_minimo=min($a);
            foreach($this->misurazioni as $m)
            {
                if($m['valore']>$valore_minimo)
                {
                    $a[] = $m;
                }
            }
            return $a;
        }

        public function getIdentificativo()
        {
            return $this->identificativo;
        }

        public function getMisurazioni()
        {
            return $this->misurazioni;
        }

        public function getUnitaDiMisura()
        {
            return $this->unitaDiMisura;
        }

        public function getCodiceSeriale()
        {
            return $this->codiceSeriale;
        }

        public function setIdentificativo($identificativo)
        {
            $this->identificativo = $identificativo;
        }

        public function setMisurazioni($misurazioni)
        {
            $this->misurazioni = $misurazioni;
        }

        public function setUnitaDiMisura($unitaDiMisura)
        {
            $this->unitaDiMisura = $unitaDiMisura;
        }

        public function setCodiceSeriale($codiceSeriale)
        {
            $this->codiceSeriale = $codiceSeriale;
        }
    }
?>