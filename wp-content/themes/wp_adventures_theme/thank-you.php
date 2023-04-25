<?php

/* Template Name: Thank You */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">

    <meta name="facebook-domain-verification" content="c567h1m2gmth28o6voum9yxvfki5ye" />

    <style>
        <?php
        $css_string = "";
        echo $css_string;

        /*
         *	@since 1.1.16
         * If the Google Custom Font textarea is NOT empty, print just the custom Google Font family link.
         */

        if(!empty(get_theme_mod('adventures_titlecustomfam_header', ''))) {
            echo get_theme_mod('adventures_titlecustomfam_header');
        }
        ?>

    </style>
    <?php wp_head(); ?>

    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1850691028657322');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=1850691028657322&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LN742KSRH6">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-LN742KSRH6');
    </script>

    <?php get_header(); ?>

</head>
<body class="vikwp-body">

<!-- Start Main box -->
<div id="main-container">
    <div id="container">

        <?php

        if ( get_query_var('hash_order') ) {

            $decrypted_order = json_decode(base64_decode(get_query_var('hash_order')), true);

            global $wpdb;
            $results = $wpdb->get_results( "SELECT * FROM `wptp_vikrentcar_orders` WHERE `id` = " . $decrypted_order['order_id'] . " AND `sid` = " . $decrypted_order['sid'] );
            foreach ( $results as $result ) {

                function get_string_between($string, $start, $end){
                    $string = ' ' . $string;
                    $ini = strpos($string, $start);
                    if ($ini == 0) return '';
                    $ini += strlen($start);
                    $len = strpos($string, $end, $ini) - $ini;
                    return substr($string, $ini, $len);
                }

                $fullstring = $result->custdata;
                $nume = get_string_between($fullstring, 'Nume: ', 'Prenume:');
                $prenume = get_string_between($fullstring, 'Prenume: ', 'e-mail:');


                ?>

                <style type="text/css">

                    .card {
                        position: relative;
                        display: block;
                        background-color: #fff;
                        border-radius: 0;
                        border: 1px solid rgba(0,0,0,.125);
                        max-width: 1200px;
                        margin: 100px auto;
                    }

                    .card-block {
                        padding: 1.25rem;
                    }

                    .card-title {
                        margin-bottom: 0.75rem;
                    }

                    .definition-list dl {
                        display: -webkit-box;
                        display: -ms-flexbox;
                        display: flex;
                        -ms-flex-wrap: wrap;
                        flex-wrap: wrap;
                    }

                    .definition-list dl dd,
                    .definition-list dl dt {
                        -webkit-box-flex: 0;
                        -ms-flex: 0 0 45%;
                        flex: 0 0 45%;
                        background: #eee;
                        padding: 0.625rem;
                        margin: 0.125rem;
                    }

                    .definition-list dl dd:nth-of-type(2n), .definition-list dl dt:nth-of-type(2n) {
                        background: #f6f6f6;
                    }

                </style>

                <section id="content-hook_order_confirmation" class="card">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="definition-list">
                                    <h3 class="h1 card-title">
                                        Vă mulțumim pentru comanda. Detaliile comenzii dvs.:
                                    </h3>
                                    <dl>
                                        <dt style="font-weight: bold;">Comandă:</dt>
                                        <dd><?php echo $result->sid; ?></dd>
                                        <dt style="font-weight: bold;">Nume</dt>
                                        <dd><?php echo $nume . $prenume; ?></dd>
                                        <dt style="font-weight: bold;">Telefon</dt>
                                        <dd><?php echo $result->phone; ?></dd>
                                        <dt style="font-weight: bold;">Email</dt>
                                        <dd style="word-break: break-all;"><?php echo $result->custmail; ?></dd>
                                        <dt style="font-weight: bold;">Costul comenzii</dt>
                                        <dd><?php echo $result->car_cost; ?>&nbsp;EUR + TVA</dd>
                                    </dl>
                                    <p style="margin-bottom: 0px;">Comanda dvs. va fi procesată și veți primi detalii în curând.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php

            }

        }

        ?>
    </div>
</div>
<div id="nav-menu-devices" class="nav-devices-content">
    <?php get_template_part('template-parts/navigation/navigation', 'responsive'); ?>
</div>

<?php get_footer(); ?>

<!-- End Main box -->
<?php wp_footer(); ?>

</body>

</html>
