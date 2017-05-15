<!DOCTYPE html>
<html  ng-app="app" ng-controller="controller" lang="<?php echo $idLang ?>">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $meta_title; ?></title>
        <meta name="description" content="<?php echo $meta_description; ?>">
        <meta name="keywords" content="<?php echo $meta_kw; ?>">
        <link rel="icon" type="image/png" href="<?php echo $rooturl; ?>favicon.png" />
        <link href="<?php echo $ressurl; ?>css/design.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo $ressurl; ?>css/basic.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo $ressurl; ?>css/elements.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo $ressurl; ?>css/mobile.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo $ressurl; ?>css/tree.css" type="text/css" rel="stylesheet" />


        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <?php
        if ($nav == "error") {
            header("HTTP/1.0 404 Not Found");
        }
        ?>
        
        <script src="<?php echo $urlJs ?>jquery-3.1.1.min.js"></script>

        <link href="<?php echo $urlPlug; ?>qtip/jquery.qtip.min.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="<?php echo $urlJs ?>datepicker-fr.js"></script>
        <script src="<?php echo $urlJs ?>sorttable.js"></script>



        <script>
            $(document).ready(function(){


    $('a[title]').qtip(
    {
    position : {   my: 'bottom right',
            at: 'top left'},
            style: {
            classes: 'qtip-dark qtip-shadow ',
                    tip: {
                    corner: 'right bottom'
                    }
            }
    });
    }


    );
            $(window).on('load', function() {

    $(".se-pre-con").fadeOut("slow"); ;
    });
        </script>


    </head>
    <body>        
        
        <div class="se-pre-con"></div>
        <h1 style="vertical-align: top; margin-top: 30px" align="center"> <?php echo $txt[$idLang]['basic0001'] ?></h1>
        
       
