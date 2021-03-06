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
 * Defines CytoscapeController class for pathbuilder visualisation.
  */
  class CytoscapeController extends ControllerBase {
 
           
  /**
   Define Container and Style for Cytoscape library
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
                           <style>#viewer {
                                   width: 100%;
                                   height: 100%;
                                   position: absolute;
                                   top: 0px;
                                   left: 0px;
                                   display: block;
                                   }
                           </style>
                         
                           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                      <script src="/libraries/cytoscape/dist/cytoscape.min.js"></script>
                     </head>
                     <body>
                        <div id="viewer"></div>
                        <script>
                           $.getJSON("https://testrakete.gnm.de/sites/default/files/2019-06/path_example.json", function (data) {
                            //console.log(data);
                             var cy = cytoscape({
                                      container: document.getElementById("viewer"),
                                       elements: data,
                                       style: [
                                       {
                                        selector: "node",
                                        style:{
                                              "label": "data(label)",
                                               "width": "30px",
                                               "height": "30px",
                                               "color": "black",
                                               "background-fit": "contain",
                                               "background-clip": "none",
                                               "text-background-color": "orange",
                                               "text-background-opacity": 0.4
                                        
                                              }
                                        },
                                        
                                            {
                                        selector: "edge",
                                        style: {
                                               "width": "5px",
                                               "curve-style": "bezier",
                                               
                                               
                                               "line-color": "#777777",
                                               "target-arrow-color": "#777777",
                                               "target-arrow-shape": "triangle",
                                               "label": "data(label)",
                                               "text-rotation": "autorotate"
                                            }
                                        }                                                                                                                                                                                                                                                                                                  
                                       ],
                                       layout: {
                                           name: "circle",
                                           minNodeSpacing: 10,
                                           nodeDimensionsIncludeLabels: false,
                                           padding: 30,
                                           avoidOverlap: true,
                                           startAngle: 3 / 2 * Math.PI,
                                           clockwise: true,
                                           fit: true,
                                           radius: undefined
                                           }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
                                       }); 
                                     cy.userZoomingEnabled( true );
                                     });
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                          </script>
                      </body>
                  </html>'
                  );
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
           return $response;
        }                                                                                                                                                                                                                                                                   
   }