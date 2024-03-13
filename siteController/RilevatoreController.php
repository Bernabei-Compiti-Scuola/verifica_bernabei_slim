<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RilevatoreController
{
    
    function impianto(Request $request, Response $response, $args) 
    {
        $imp = new Impianto();   
        $response->getBody()->write($imp->jsonSerialize());
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    //$tipo = % => umidità, $tipo = C => temperatura
    function getRilevatori(Request $request, Response $response, $args)
    {
        $imp = new Impianto();
        if($args['tipo']=='umidita')
        {
            $rilevatori = $imp->getRilevatoriDiUmidita();
            $response->getBody()->write($rilevatori->jsonSerialize());
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
        else if($args['tipo']=='temperatura')
        {
            $rilevatori = $imp->getRilevatoriDiTemperatura();
            $response->getBody()->write($rilevatori->jsonSerialize());
            return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
        }
        else
        {
            $response->getBody()->write("Tipo non valido");
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }

    function getDispositivo(Request $request, Response $response, $args)
    {
        $imp = new Impianto();
        if($args['tipo']=='umidita')
        {
            $rilevatore = $imp->getRilevatoriDiUmidita()->find($args['identificativo']);
            if ($rilevatore != null) 
            {
                $response->getBody()->write($rilevatore->jsonSerialize());
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            } 
            else 
            {
                $response->getBody()->write("rilevatore non presente");
                return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
            }
        }
        else if($args['tipo']=='temperatura')
        {
            $rilevatore = $imp->getRilevatoriDiTemperatura()->find($args['identificativo']);
            if ($rilevatore != null) 
            {
                $response->getBody()->write($rilevatore->jsonSerialize());
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            } 
            else 
            {
                $response->getBody()->write("rilevatore non presente");
                return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
            }
        }
        else
        {
            $response->getBody()->write("Tipo non valido");
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }


    function getMisurazioniDispositivo(Request $request, Response $response, $args)
    {
        $imp = new Impianto();
        if($args['tipo']=='umidita')
        {
            $rilevatore = $imp->getRilevatoriDiUmidita()->find($args['identificativo']);
            if ($rilevatore != null) 
            {
                $response->getBody()->write($rilevatore->getMisurazioni()->jsonSerialize());
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            } 
            else 
            {
                $response->getBody()->write("rilevatore non presente");
                return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
            }
        }
        else if($args['tipo']=='temperatura')
        {
            $rilevatore = $imp->getRilevatoriDiTemperatura()->find($args['identificativo']);
            if ($rilevatore != null) 
            {
                $response->getBody()->write($rilevatore->getMisurazioni()->jsonSerialize());
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            } 
            else 
            {
                $response->getBody()->write("rilevatore non presente");
                return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
            }
        }
        else
        {
            $response->getBody()->write("Tipo non valido");
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }
    
    function getMisurazioniDispositivo_MaggDi_valMin(Request $request, Response $response, $args)
    {
        $imp = new Impianto();
        if($args['tipo']=='umidita')
        {
            $rilevatore = $imp->getRilevatoriDiUmidita()->find($args['identificativo']);
            if ($rilevatore != null) 
            {
                $response->getBody()->write($rilevatore->getValore_maggDiValMin()->jsonSerialize());
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            } 
            else 
            {
                $response->getBody()->write("rilevatore non presente");
                return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
            }
        }
        
        else if($args['tipo']=='temperatura')
        {
            $rilevatore = $imp->getRilevatoriDiTemperatura()->find($args['identificativo']);
            if ($rilevatore != null) 
            {
                $response->getBody()->write($rilevatore->getValore_maggDiValMin()->jsonSerialize());
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
            } 
            else 
            {
                $response->getBody()->write("rilevatore non presente");
                return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
            }
        }
        else
        {
            $response->getBody()->write("Tipo non valido");
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }

    function createRilevatore(Request $request, Response $response, $args)
    {
        $imp = new Impianto();
        if($args['tipo']=='umidita')
        {
            $body = $request->getBody()->getContents();
            $parseBody = json_decode($body, true);

            $identificativo=$parseBody['identificativo'];
            $codiceSeriale=$parseBody['codiceSeriale'];
            $posizione=$parseBody['posizione'];

            $ril = new RilevatoreDiUmidita($identificativo, $codiceSeriale, $posizione);
            
            $response->getBody()->write($ril->jsonSerialize());

            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        }
        
        else if($args['tipo']=='temperatura')
        {
            $body = $request->getBody()->getContents();
            $parseBody = json_decode($body, true);

            $identificativo=$parseBody['identificativo'];
            $codiceSeriale=$parseBody['codiceSeriale'];
            $tipologia=$parseBody['tipologia'];

            $ril = new RilevatoreDiUmidita($identificativo, $codiceSeriale, $tipologia);
            
            $response->getBody()->write($ril->jsonSerialize());

            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        }
        else
        {
            $response->getBody()->write("Tipo non valido");
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }

    function updateRilevatore(Request $request, Response $response, $args)
    {
        $imp = new Impianto();
        if($args['tipo']=='umidita')
        {
            $rilevatore = $imp->getRilevatoriDiUmidita()->find($args['identificativo']);
            if ($rilevatore != null) 
            {
                $body = $request->getBody()->getContents();
                $parseBody = json_decode($body, true);

                $rilevatore->setIdentificativo($parseBody['identificativo']);
                $rilevatore->setCodiceSeriale($parseBody['codiceSeriale']);
                $rilevatore->setPosizione($parseBody['posizione']);
                $response->getBody()->write($alunno->jsonSerialize());
                return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
            } 
            else 
            {
                $response->getBody()->write("rilevatore non presente");
                return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
            }
        }
        
        else if($args['tipo']=='temperatura')
        {
            $rilevatore = $imp->getRilevatoriDiTemperatura()->find($args['identificativo']);
            if ($rilevatore != null) 
            {
                $body = $request->getBody()->getContents();
                $parseBody = json_decode($body, true);

                $rilevatore->setIdentificativo($parseBody['identificativo']);
                $rilevatore->setCodiceSeriale($parseBody['codiceSeriale']);
                $rilevatore->setTipologia($parseBody['tipologia']);
                $response->getBody()->write($alunno->jsonSerialize());
                return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
            } 
            else 
            {
                $response->getBody()->write("rilevatore non presente");
                return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
            }
        }
        else
        {
            $response->getBody()->write("Tipo non valido");
            return $response->withHeader('Content-Type', 'application/json')->withStatus(404);
        }
    }

    
}