<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 5/3/2018
 * Time: 1:18 PM
 */
class Mail_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function send_mail($to, $subject, $msg, $label = NULL, $from = NULL, $attatchments = NULL)
    {
        /*
        [NAME]

        [BUTTON]

        [TEXT]

        [ADDITIONAL_TEXT] Markups*/

        $from = ($from == NULL) ? $this->Util_model->get_option("site_email") : $from;
        $label = SITE_TITLE;
        $site_title = SITE_TITLE;
        $site_url = SITE_URL;
        $logo = base_url() . "assets/img/logo.png";
        if (is_array($msg)) {
            $msg = $this->template($msg);
        } else {
            $template_start = "<table role='presentation' width='100%' border='0' cellpadding='0' cellspacing='0'>";
            $template_start .= "<tr>";
            $template_start .= "<td align='center' style='background-color:#2c3e50; padding:15px 0px;'>";
            $template_start .= "<img src='$logo'>";
            $template_start .= "</td>";
            $template_start .= "</tr>";
            $template_start .= "<tr>";
            $template_start .= "<td>";

            $template_end = "</td>";
            $template_end .= "</tr>";
            $template_end .= "<tr>";
            $template_end .= "<td>";
            $template_end .= "<table role='presentation' border='0' cellpadding='0' cellspacing='0' width='100%'>";
            $template_end .= "<tr>";
            $template_end .= "<td class='content-block' align='center'>";
            $template_end .= "<span class='apple-link'>Thank you for choosing and believing in us</span>";
            $template_end .= "<br> $site_title Support Team";
            $template_end .= "</td>";
            $template_end .= "</tr>";
            $template_end .= "<tr>";
            $template_end .= "<td class='content-block powered-by' align='center'>";
            $template_end .= "Powered by <a href='$site_url'>$site_title</a>";
            $template_end .= "</td>";
            $template_end .= "</tr>";
            $template_end .= "</table>";
            $template_end .= "</td>";
            $template_end .= "</tr>";
            $template_end .= "</table>";
            $msg = $template_start . $msg . $template_end;
        }


        if (strstr($to, ',')) {
            $to = explode(",", $to);
            foreach ($to as $s_to) {
                if (is_connected()) {
                    $send = $this->Util_model->send_mail($from, $s_to, $subject, htmlspecialchars_decode($msg), $label);
                    return $send['return'];
                } else {
                    return true;
                }
            }
        } else {
            if (is_connected()) {
                $send = $this->Util_model->send_mail($from, $to, $subject, htmlspecialchars_decode($msg), $label);
                return $send['return'];
            } else {
                return true;
            }
        }
    }

    public function template($arr = [])
    {
        $site_title = SITE_TITLE;
        $site_url = $this->Util_model->get_option("site_url");
        $tagline = $this->Util_model->get_option("site_tagline");
        $logo = base_url() . "assets/img/logo.png";

        $button = $arr['[BUTTON]'];
        $name = $arr['[NAME]'];
        $text = $arr['[TEXT]'];
        $additional_text = $arr['[ADDITIONAL_TEXT]'];

        $template = <<<EOL
<!doctype html>
<html>

<head>
    <meta name='viewport' content='width=device-width' />
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>$site_title</title>
    <style>
        img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%;
        }

        body {
            background-color: #f6f6f6;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%;
        }

        table td {
            font-family: sans-serif;
            font-size: 14px;
            vertical-align: top;
        }

        .body {
            background-color: #f6f6f6;
            width: 100%;
        }

        .container {
            display: block;
            margin: 0 auto !important;
            max-width: 580px;
            padding: 10px;
            width: 580px;
        }

        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 580px;
            padding: 10px;
        }

        .main {
            background: #ffffff;
            border-radius: 3px;
            width: 100%;
        }

        .wrapper {
            box-sizing: border-box;
            padding: 20px;
        }

        .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
        }

        clear: both;
        margin-top: 10px;
        text-align: center;
        width: 100%;
        }

        .footer td,
        .footer p,
        .footer span,
        .footer a {
            color: #999999;
            font-size: 12px;
            text-align: center;
        }

        h1,
        h2,
        h3,
        h4 {
            color: #000000;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            text-transform: capitalize;
        }

        p,
        ul,
        ol {
            font-family: sans-serif;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 15px;
        }

        p li,
        ul li,
        ol li {
            list-style-position: inside;
            margin-left: 5px;
        }

        a {
            color: #3498db;
            text-decoration: underline;
        }

        .btn {
            box-sizing: border-box;
            width: 100%;
        }

        .btn>tbody>tr>td {
            padding-bottom: 15px;
        }

        .btn table {
            width: auto;
        }

        .btn table td {
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center;
        }

        .btn a {
            background-color: #ffffff;
            border: solid 1px #3498db;
            border-radius: 5px;
            box-sizing: border-box;
            color: #3498db;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            padding: 12px 25px;
            text-decoration: none;
            text-transform: capitalize;
        }

        .btn-primary table td {
            background-color: #3498db;
        }

        .btn-primary a {
            background-color: #3498db;
            border-color: #3498db;
            color: #ffffff;
        }

        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .align-center {
            text-align: center;
        }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .clear {
            clear: both;
        }

        .mt0 {
            margin-top: 0;
        }

        .mb0 {
            margin-bottom: 0;
        }

        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0;
        }

        .powered-by a {
            text-decoration: none;
        }

        hr {
            border: 0;
            border-bottom: 1px solid #f6f6f6;
            margin: 20px 0;
        }

        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }

            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 16px !important;
            }

            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important;
            }

            table[class=body] .content {
                padding: 0 !important;
            }

            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
            }

            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            table[class=body] .btn table {
                width: 100% !important;
            }

            table[class=body] .btn a {
                width: 100% !important;
            }

            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        @media all {
            .ExternalClass {
                width: 100%;
            }

            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }

            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }

            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }

            .btn-primary table td:hover {
                background-color: #34495e !important;
            }

            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }
    </style>
</head>

<body class=''>
    <span class='preheader'><b>$site_title</b>, $tagline
        <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>
            <tr>
                <td>&nbsp;</td>
                <td class='container'>
                    <div class='content'>
                        <table width='100%' role='presentation' border='0' cellpadding='0' cellspacing='0'>
                            <tr>
                                <td align='center' style='background-color:#5e76ac; padding:15px 0px;'>
                                    <img src='$logo'>
                                </td>
                            </tr>
                        </table>
                        <!-- START CENTERED WHITE CONTAINER -->
                        <table role='presentation' class='main'>
                            <!-- START MAIN CONTENT AREA -->
                            <tr>
                                <td class='wrapper'>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                                        <tr>
                                            <td>
                                                <p><b>Hi $name,</b></p>
                                                <p>$text</p>
                                                <table role='presentation' border='0' cellpadding='0' cellspacing='0'
                                                    class='btn btn-primary'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='left'>
                                                                <table role='presentation' border='0' cellpadding='0'
                                                                    cellspacing='0'>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td> $button </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p>$additional_text</p>
                                                <p>Support Team</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- END MAIN CONTENT AREA -->
                        </table>
                        <!-- END CENTERED WHITE CONTAINER -->
                        <!-- START FOOTER -->
                        <div class='footer'>
                            <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td class='content-block' align='center'>
                                        <span class='apple-link'>We really appreciate your patronage and we are open to
                                            serving you better.</span>
                                        <br> $site_title Support Team
                                    </td>
                                </tr>
                                <tr>
                                    <td class='content-block powered-by' align='center'>
                                        Powered by <a href='$site_url'>$site_title</a>.
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- END FOOTER -->
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
</body>

</html>
EOL;

        return $template;
    }

    public function send_notification($heading, $text, $btn, $additional, $first = "Ava Links")
    {
        $to = $this->Util_model->get_option("notification_email");

        $message = "<p>$text</p>";
        $message .= $btn . "<br>";
        $message .= $additional;

        return $this->Util_model->send_mail($this->Util_model->get_option('site_email'), $to, $heading, $message);
    }

}