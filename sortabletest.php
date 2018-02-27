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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="assets/jstree/themes/default/komatsu_custom.css" />

        <style>
            table {
                font-size: 1em;
            }

            .ui-draggable, .ui-droppable {
                background-position: top;
            }

            #sortable1, #sortable2 {
                border: 1px solid #eee;
                width: 142px;
                min-height: 20px;
                list-style-type: none;
                margin: 0;
                padding: 5px 0 0 0;
                float: left;
                margin-right: 10px;
            }
            #sortable1 li, #sortable2 li {
                margin: 0 5px 5px 5px;
                padding: 5px;
                font-size: 1.2em;
                width: 120px;
            }
            
            .whatMatters .ui-state-highlight, .whatMatters .ui-widget-content .ui-state-highlight, .whatMatters .ui-widget-header .ui-state-highlight {
                border: 1px solid #dad55e;
                background: orange !important;
                color: #777620;
            }
        </style>

        <script src="assets/templates/komatsuna/js/jquery.min.js"></script>
    </head>

    <body>

        <div style="padding:50px;height:500px;width:500px;background-color:canary;">


            <div id="demo">

                <ul id="sortable1" class="whatMatters connectedSortable">
                </ul>

                <ul id="sortable2" class="connectedSortable">
                </ul>

            </div>


        </div>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script>

            $(function () {

                $("#sortable1, #sortable2").sortable({
                    connectWith: ".connectedSortable",
                    change: function( event, ui ) {
                        console.log("Something changed...");
                        console.log(event);
                        console.log(ui);
                        
                        var sorted = $( ".whatMatters" ).sortable( "serialize", { key: "sort" } );
                        var sortedIds = $( ".whatMatters" ).sortable( "toArray" );
                        
                        console.log(sorted);
                        console.log(sortedIds);
                    }
                }).disableSelection();
                
                function loadEmUp() {
                    for(i=1; i <= 10; i++) {
                        $("#sortable2").append('<li class="ui-state-highlight" id="' + i + '">Item ' + i + '</li>');
                    }
                }
                
                loadEmUp();

            });

        </script>

    </body>
</html>