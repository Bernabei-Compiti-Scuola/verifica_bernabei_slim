<?php
require_once './classi_php/Rilevatore.php';
require_once './classi_php/RilevatoreDiUmidita.php';
require_once './classi_php/RilevatoreDiTemperatura.php';
class Impianto implements JsonSerializable
{
    protected $nome;
    protected $latitudine;
    protected $longitudine;
    protected $rilevatori;

    public function __construct()
    {
        $this->nome = "impianto-1";
        $this->latitudine = 0;
        $this->longitudine = 0;
        $this->rilevatori = array();

        $r = new RilevatoreDiTemperatura("rilevatore-1",'codice-1');
        $r->setTipologia("Terra");
        $r->setMisurazioni(array(['data'=>'2021-01-01','valore'=>20],['data'=>'2021-01-02','valore'=>25]));
        $this->rilevatori[]= $r;

        $r = new RilevatoreDiUmidita("rilevatore-2",'codice-2');
        $r->setPosizione("Interno");
        $r->setMisurazioni(array(['data'=>'2021-01-01','valore'=>20],['data'=>'2021-01-02','valore'=>25]));
        $this->rilevatori[]= $r;

        $r = new RilevatoreDiTemperatura("rilevatore-3",'codice-3');
        $r->setTipologia("Aria");
        $r->setMisurazioni(array(['data'=>'2021-01-01','valore'=>20],['data'=>'2021-01-02','valore'=>25]));
        $this->rilevatori[]= $r;

        $r = new RilevatoreDiUmidita("rilevatore-4",'codice-4');
        $r->setPosizione("Esterno");
        $r->setMisurazioni(array(['data'=>'2021-01-01','valore'=>20],['data'=>'2021-01-02','valore'=>25]));
        $this->rilevatori[]= $r;

    }

    
    public function jsonSerialize()
    {
        
        $a = [
            "nome"=>$this->nome,
            "latitudine"=>$this->latitudine,
            "longitudine"=>$this->longitudine,
            "rilevatori"=>$this->rilevatori
        ];
        return $a;
        
    }

    
    public function find($identificativo)
    {
        foreach($this->rilevatori as $rilevatore)
        {
            if($rilevatore->getIdentificativo()==$identificativo)
            {
                return $rilevatore;
            }
        }
        return null;
    }

    public function getRilevatoriDiTemperatura()
    {
        $rilevatoriDiTemperatura = array();
        foreach($this->rilevatori as $rilevatore)
        {
            if($rilevatore->getTipologia()=="temperatura")
            {
                $rilevatoriDiTemperatura[] = $rilevatore;
            }
        }
        return $rilevatoriDiTemperatura;
    }

    public function getRilevatoriDiUmidita()
    {
        $rilevatoriDiUmidita = array();
        foreach($this->rilevatori as $rilevatore)
        {
            if($rilevatore->getPosizione()=="umidita")
            {
                $rilevatoriDiUmidita[] = $rilevatore;
            }
        }
        return $rilevatoriDiUmidita;
    }  

    public function getNome()
    {
        return $this->nome;
    }
    public function getLatitudine()
    {
        return $this->latitudine;
    }
    public function getLongitudine()
    {
        return $this->longitudine;
    }
    public function getRilevatori()
    {
        return $this->rilevatori;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setLatitudine($latitudine)
    {
        $this->latitudine = $latitudine;
    }
    public function setLongitudine($longitudine)
    {
        $this->longitudine = $longitudine;
    }
    public function setRilevatori($rilevatori)
    {
        $this->rilevatori = $rilevatori;
    }


}