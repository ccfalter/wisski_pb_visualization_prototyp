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
 * Defines SigmaController class for pathbuilder visualisation.
  */
  class SigmaController extends ControllerBase {
 
           
  /**
   Define Container and Style for Sigma library
   and Visualize Graph
   Needed for .json: https://stackoverflow.com/questions/21795125/json-is-not-read-by-sigma-js
   sigma.parsers.json('data/arctic.json', {
     container: 'graph-container'
     });
     
     or:
     var jnet, s;
     $.getJSON("assets/data/user_networkA
     .json", function(response){
       jnet = response;
       s = new sigma({
            graph: jnet,
            container: 'network-graph'
            });
            buildNetwork();
     })
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
                           <style>#viewer { width: 100%;
                               height: 100%;
                                   
                                   
                                   position: absolute;
                                   top: 0px;
                                   left: 0px;
                                   display: block;
                                   }
                           </style>
                           <script src="libraries/sigma.js/build/sigma.min.js"></script>
                           <script src="libraries/sigma.js/build/plugins/sigma.parsers.json.min.js"></script>
                           <script src="libraries/sigma.js/build/plugins/sigma.layout.forceAtlas2.min.js"></script>
                           <script src="libraries/sigma.js/build/plugins/sigma.pathfinding.astar.min.js"></script>
                                           
                           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                     </head>
                     <body>
                        <div id="viewer"></div>
                        <script>
                        //Add a method to the graph that returns all neighbors of a node
                        sigma.classes.graph.addMethod("neighbors", function(nodeId) {
                         var k,
                           neighbors = {},
                             index = this.allNeighborsIndex[nodeId] || {};
                              for (k in index)
                                neighbors[k] = this.nodesIndex[k];
                                 return neighbors;
                                 });
                           //Import JSON      
                           var jnet, s;
                           $.getJSON("https://testrakete.gnm.de/libraries/sigma.js/examples/data/arctic.json", function (data) {
                            //console.log(data);
                             jnet = data;                                                                                                            
                                s = new sigma({
                                               graph: jnet,
                                           container: "viewer",
                                           type: "canvas",
                                           settings: {
                                                   minArrowSize: 10,
                                                   defaultEdgeType: "arrow"    
                                                
                                                       }
                                               }
                                           );
                                                                                                                                                                                                                                                                                                             
                              });                                                                                                                                                                                                                               
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                          </script>
                      </body>
                  </html>'
                  );
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
           return $response;
        }                                                                                                                                                                                                                                                                   
   }