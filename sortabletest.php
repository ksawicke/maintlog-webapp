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
        </style>

        <script src="assets/templates/komatsuna/js/jquery.min.js"></script>
    </head>

    <body>

        <div style="padding:50px;height:500px;width:500px;background-color:canary;">


            <div id="demo">

                <ul id="sortable1" class="whatMatters connectedSortable">
                    <li class="ui-state-default" id="1">Item 1</li>
                    <li class="ui-state-default" id="2">Item 2</li>
                    <li class="ui-state-default" id="3">Item 3</li>
                    <li class="ui-state-default" id="4">Item 4</li>
                    <li class="ui-state-default" id="5">Item 5</li>
                </ul>

                <ul id="sortable2" class="connectedSortable">
                    <li class="ui-state-highlight" id="asdf">Item 1</li>
                    <li class="ui-state-highlight" id="asdfasd">Item 2</li>
                    <li class="ui-state-highlight" id="x3125">Item 3</li>
                    <li class="ui-state-highlight" id="asdfsadf">Item 4</li>
                    <li class="ui-state-highlight" id="141412414">Item 5</li>
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

            });

        </script>

    </body>
</html>