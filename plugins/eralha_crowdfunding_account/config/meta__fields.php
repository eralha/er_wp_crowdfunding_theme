<?php

    $metaBoxes = array(
        "config_projeto" => array(
            "groupTitle" => "Configuração projecto",
            "fields" => array(
                array("Data Finalização", "proj_data_fecho", "text"),
                array("Total a Angariar", "proj_total_angariar", "text"),
                array("Total Angariado", "proj_total_angariado", "text"),
                array("Estado Projecto", "proj_estado", "select", 
                    "options" => array(
                        "Em análise",
                        "Em curso",
                        "Finalizado sem sucesso",
                        "Finalizado com exito",
                        "Financiado"
                    ))
            )
        ),
        "informacao_promotor" => array(
            "groupTitle" => "O Promotor",
            "fields" => array(
                array("Nome Promotor", "proj_nome_promotor", "text"),
                array("Telefone Promotor", "proj_telf_promotor", "text")
            )
        ),
        "informacao_projecto" => array(
            "groupTitle" => "Informação do Projecto",
            "fields" => array(
                array("Titulo", "proj_title", "text"),
                array("Facebook", "proj_facebook", "text"),
                array("Objectivo", "proj_objectivo", "text"),
                array("Video", "proj_video_url", "text"),
                array("Localização", "proj_localizacao", "text"),
                array("Resumo", "proj_resumo", "textarea"),
                array("Sobre o Projecto", "proj_sobre", "textarea"),
                array("Sobre o Promotor", "proj_sobre_promotor", "textarea"),
                array("Orçamento e prazos", "proj_orcamento", "textarea"),
                array("Plano Divulgação", "proj_plano_divulgacao", "textarea"),
                array("Níveis / Recompensas", "proj_recompensas", "group")
            )
        ),
    );

?>