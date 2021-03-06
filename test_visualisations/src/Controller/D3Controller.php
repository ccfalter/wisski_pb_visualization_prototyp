<?php

namespace Drupal\test_visualisations\Controller;


use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;   
use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Form\FormStateInterface; 
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\wisski_core;
use Drupal\wisski_salz\AdapterHelper;
use Drupal\wisski_salz\Plugin\wisski_salz\Engine\Sparql11Engine;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url; 
use Drupal\Core\Link;
use Drupal\wisski_core\WisskiCacheHelper;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenDialogCommand;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Form\FormBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;



/**
 * Defines D3Controller class for pathbuilder visualisation.
  */
  class D3Controller extends ControllerBase {
 
           
  /**
   Define Container and Style for D3 library with Extensions
   and Visualize Graph
  
  **/
     public function start() {           
           $form = array();               
           $form['#markup'] = '<div id="viewer"></div>';
           $form['#allowed_tags'] = array('div', 'select', 'option','a', 'script');
           $form['#attached']['library'][] = "test_visualisations/test_vis";
           $response = new Response();
               $response->setContent('<!DOCTYPE html>
                   <html lang="en">
                     <head>
                           <title>Simple Viewer</title>
                           <meta charset="UTF-8">
                           <meta name="viewport" content="width=device-width, initial-scale=1.0">
                         
                           <script src="libraries/d3/d3.min.js"></script>
                           <script src="libraries/d3-selection-multi/d3-selection-multi.v1.min.js"></script>
                           <script src="libraries/d3/d3-fetch.v1.min.js"></script>
                           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                     </head>
                     <body>
                        <canvas width="960" height="500"></canvas>
                        
                        
                        <script>
                  
                           //Import JSON      
                          
                           //$.getJSON("https://testrakete.gnm.de/libraries/d3/example.json", function (datas) {
                            //console.log(data);
                              var json_url = "https://testrakete.gnm.de/libraries/d3/example.json";   
                         //      var xml_url = d3.xml("http://objekte-im-netz.fau.de/iser/sites/objekte-im-netz.fau.de.iser/files/wisski_pathbuilder/export/alte_masken_20190626T065147");
                          //     console.log(xml_url);
                               var canvas = document.querySelector("canvas"),
                                   context = canvas.getContext("2d"),
                                       width = canvas.width,
                                           height = canvas.height;
                                           
                                           var simulation = d3.forceSimulation()
                                               .force("link", d3.forceLink().id(function(d) { return d.id; }))
                                                   .force("charge", d3.forceManyBody())
                                                       .force("center", d3.forceCenter());
                                                       
                                                       d3.json(json_url, function(error, graph) {
                                                         if (error) throw error;
                                                         
                                                           simulation
                                                                 .nodes(graph.nodes)
                                                                       .on("tick", ticked);
                                                                       
                                                                         simulation.force("link")
                                                                               .links(graph.links);
                                                                               
                                                                                 function ticked() {
                                                                                     context.clearRect(0, 0, width, height);
                                                                                         context.save();
                                                                                             context.translate(width / 2, height / 2 + 40);
                                                                                             
                                                                                                 context.beginPath();
                                                                                                     graph.links.forEach(drawLink);
                                                                                                         context.strokeStyle = "#aaa";
                                                                                                             context.stroke();
                                                                                                             
                                                                                                                 context.beginPath();
                                                                                                                     graph.nodes.forEach(drawNode);
                                                                                                                         context.fill();
                                                                                                                             context.strokeStyle = "#fff";
                                                                                                                                 context.stroke();
                                                                                                                                 
                                                                                                                                     context.restore();
                                                                                                                                       }
                                                                                                                                       });
                                                                                                                                       
                                                                                                                                       function drawLink(d) {
                                                                                                                                         context.moveTo(d.source.x, d.source.y);
                                                                                                                                           context.lineTo(d.target.x, d.target.y);
                                                                                                                                           }
                                                                                                                                           
                                                                                                                                           function drawNode(d) {
                                                                                                                                             context.moveTo(d.x + 3, d.y);
                                                                                                                                               context.arc(d.x, d.y, 3, 0, 2 * Math.PI);
                                                                                                                                               }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                             // });                                                                                                                                                                                                                               
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                          </script>
                      </body>
                  </html>'
                  );
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
           return $response;
        }                                                                                                                                                                                                                                                                   
   }