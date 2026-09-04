<?php

add_action( 'admin_head', 'testingtheme_admin_select2_custom_styles' );
/**
 * Ajustes de ancho para Select2 en los metaboxes de CMB2.
 */
function testingtheme_admin_select2_custom_styles() {
    ?>
    <style>
        /* Hace que el select se ajuste al ancho de su contenido */
        .cmb2-options-type-select .select2-container--default {
            display: inline-block !important;
            width: auto !important;
            min-width: 220px !important; /* Un ancho mínimo recomendado para comodidad visual */
        }

        /* Ajuste de alineación del texto e icono dentro del Select2 */
        .select2-container .select2-selection--single {
            height: 36px !important;
            display: flex !important;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: normal !important;
            padding-left: 10px;
            padding-right: 25px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 34px !important;
        }
    </style>
    <?php
}