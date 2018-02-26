<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <!--link rel="icon" href="../../favicon.ico"-->

        <title>Komatsu NA Maintenance Log</title>

        <link href='https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700' rel='stylesheet' type='text/css'>        
        <link rel="stylesheet" href="assets/jstree/themes/default/style.css" />
        <link rel="stylesheet" href="assets/jstree/themes/default/komatsu_custom.css" />

        <script src="assets/templates/komatsuna/js/jquery.min.js"></script>
        <script src="assets/jstree/jstree.min.js"></script>
    </head>

    <body>

        <div style="padding:50px;height:500px;width:500px;background-color:canary;">


            <div id="jstree_demo_div"></div>


        </div>

        <script>

            $(function () {

                console.log("YEEEEEE HAWWWW");

                /** AJAX **/
//                $('#tree').jstree({
//                    'core' : {
//                        'data' : {
//                        'url' : '/get/children/',
//                                'data' : function (node) {
//                                return { 'id' : node.id };
//                                }
//                    }
//                });

                /** DIRECT DATA **/
                $('#jstree_demo_div').jstree({'core': {
                        "animation" : 0,
                        "check_callback" : true,
                        'themes': [
                            {
                                'dots': false,
                                'icons': false,
                                'responsive': true
                            }
                        ],
                        'data': [
                            {
                                'text': 'Pre-Start',
                                'state': {
                                    'opened': true,
                                    'selected': false
                                },
                                'children': [
                                    {
                                        'text': 'Suspension'
                                    },
                                    {
                                        'text': 'Tires'
                                    },
                                    {
                                        'text': 'Horn/Alarm/Lights'
                                    },
                                    {
                                        'text': 'Leak Evidence'
                                    },
                                    {
                                        'text': 'Seat Belt'
                                    },
                                    {
                                        'text': 'Mirrors'
                                    },
                                    {
                                        'text': 'Fire Extinguishers'
                                    },
                                    {
                                        'text': 'Windows/Wipers'
                                    },
                                    {
                                        'text': 'Test Instruments'
                                    },
                                    {
                                        'text': 'Doors & Latches'
                                    },
                                    {
                                        'text': 'First Aid Kit'
                                    },
                                    {
                                        'text': 'Visibility Flag Whip'
                                    }

                                ]
                            },
                            {
                                'text': 'Post-Start',
                                'state': {
                                    'opened': true,
                                    'selected': false
                                },
                                'children': [
                                    {
                                        'text': 'Steering'
                                    },
                                    {
                                        'text': 'Brakes'
                                    },
                                    {
                                        'text': 'Seat Controls'
                                    },
                                    {
                                        'text': 'Air Conditioner'
                                    },
                                    {
                                        'text': 'Dash Controls'
                                    },
                                    {
                                        'text': 'Displays/Gauges'
                                    }

                                ]
                            }
                        ]
                    },
                    "plugins" : [
                      "contextmenu", "dnd", "search",
                      "state", "types", "wholerow"
                    ]
                });
                
                /** FUNCTION **/
                // function
//                $('#tree').jstree({
//                    'core' : {
//                        'data' : function (obj, callback) {
//                            callback.call(this, ['Root 1', 'Root 2']);
//                        }
//                    });

                $('#jstree_demo_div').on("changed.jstree", function (e, data) {
                    console.log(data.selected);
                });

                /**
                 * The three examples below do exactly the same thing
                 */
//                $('button').on('click', function () {
//                    $('#jstree').jstree(true).select_node('child_node_1');
//                    $('#jstree').jstree('select_node', 'child_node_1');
//                    $.jstree.reference('#jstree').select_node('child_node_1');
//                });

                /**
                 * Get JSON from tree
                 * 
                 *  var v = $('#data').jstree(true).get_json('#', {flat:true})
                 var mytext = JSON.stringify(v);
                 alert(mytext);
                 * 
                 */

            });

        </script>

    </body>
</html>