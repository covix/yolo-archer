<?php    
    
    
$urlDetail = "http://webapps.unitn.it/Orari/it/Web/DettaglioImpegno/482748?_=1417359655844";
$urlSchedule = "http://webapps.unitn.it/Orari/it/Web/AjaxEventi/c/10114-/agendaWeek";

$data = [ '_' => '1417344954081', 'start' => '1416783600', 'end' => '1417388400'];
          
$data = http_build_query($data);

$context = [
  'http' => [
    'method' => 'GET',
    'content' => $data
  ]
];
$context = stream_context_create($context);
$result = file_get_contents($urlSchedule, false, $context);

echo $result;
?>          