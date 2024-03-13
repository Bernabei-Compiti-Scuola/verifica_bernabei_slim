<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require_once './siteController/RilevatoreController.php';
require_once './siteController/SiteController.php';
require_once './classi_php/Impianto.php';

$app = AppFactory::create();

$app->get('/', 'SiteController:index');

$app->get('/impianto', 'RilevatoreController:impianto');
//{tipo} = % => umidità, {tipo} = C => temperatura
$app->get('/rilevatori/{tipo}', 'RilevatoreController:getRilevatori');

$app->get('/rilevatori/{tipo}/{identificativo}', 'RilevatoreController:getDispositivo');

$app->get('/rilevatori/{tipo}/{identificativo}/misurazioni', 'RilevatoreController:getMisurazioniDispositivo');

$app->get('/rilevatori/{tipo}/{identificativo}/misurazioni/maggiore_di/{valore_minimo}', 'RilevatoreController:getMisurazioniDispositivo_MaggDi_valMin');

$app->post('/rilevatori/{tipo}', 'RilevatoreController:createRilevatore');

$app->put('/rilevatori/{tipo}/{identificativo}', 'RilevatoreController:updateRilevatore');

$app->run();