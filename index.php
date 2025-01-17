<?php
ob_start("minifier");

function minifier($code) {
    $search = array(
        // Remove whitespaces after tags
        '/\>[^\S ]+/s',
         
        // Remove whitespaces before tags
        '/[^\S ]+\</s',
         
        // Remove multiple whitespace sequences
        '/(\s)+/s',
         
        // Removes comments
        '/<!--(.|\s)*?-->/',
        
        // Find URLs that end with .jpg, .png, or .webp and add ?v=1.0
        '/\.(jpg|png|webp)([\'"])/i',
        
        // Find <img> tags that don't already have loading="lazy" and add it
        '/<img(?![^>]+loading=)([^>]+)>/i'
    );
    
    $replace = array(
        '>', 
        '<', 
        '\\1', 
        '', 
        '.$1?v=1.0$2',  // Append ?v=1.0 to matching image URLs
        '<img loading="lazy" $1>'  // Add loading="lazy" to <img> tags
    );

    $code = preg_replace($search, $replace, $code);
    return $code;
}

$country_codes = [
    'AF' => '+93',
    'AL' => '+355',
    'DZ' => '+213',
    'AS' => '+1-684',
    'AD' => '+376',
    'AO' => '+244',
    'AI' => '+1-264',
    'AG' => '+1-268',
    'AR' => '+54',
    'AM' => '+374',
    'AW' => '+297',
    'AU' => '+61',
    'AT' => '+43',
    'AZ' => '+994',
    'BS' => '+1-242',
    'BH' => '+973',
    'BD' => '+880',
    'BB' => '+1-246',
    'BY' => '+375',
    'BE' => '+32',
    'BZ' => '+501',
    'BJ' => '+229',
    'BM' => '+1-441',
    'BT' => '+975',
    'BO' => '+591',
    'BA' => '+387',
    'BW' => '+267',
    'BR' => '+55',
    'BN' => '+673',
    'BG' => '+359',
    'BF' => '+226',
    'BI' => '+257',
    'KH' => '+855',
    'CM' => '+237',
    'CA' => '+1',
    'CV' => '+238',
    'KY' => '+1-345',
    'CF' => '+236',
    'TD' => '+235',
    'CL' => '+56',
    'CN' => '+86',
    'CO' => '+57',
    'KM' => '+269',
    'CG' => '+242',
    'CD' => '+243',
    'CR' => '+506',
    'HR' => '+385',
    'CU' => '+53',
    'CY' => '+357',
    'CZ' => '+420',
    'DK' => '+45',
    'DJ' => '+253',
    'DM' => '+1-767',
    'DO' => '+1-809',
    'EC' => '+593',
    'EG' => '+20',
    'SV' => '+503',
    'GQ' => '+240',
    'ER' => '+291',
    'EE' => '+372',
    'ET' => '+251',
    'FK' => '+500',
    'FO' => '+298',
    'FJ' => '+679',
    'FI' => '+358',
    'FR' => '+33',
    'GA' => '+241',
    'GM' => '+220',
    'GE' => '+995',
    'DE' => '+49',
    'GH' => '+233',
    'GI' => '+350',
    'GR' => '+30',
    'GL' => '+299',
    'GD' => '+1-473',
    'GP' => '+590',
    'GU' => '+1-671',
    'GT' => '+502',
    'GN' => '+224',
    'GW' => '+245',
    'GY' => '+592',
    'HT' => '+509',
    'HN' => '+504',
    'HK' => '+852',
    'HU' => '+36',
    'IS' => '+354',
    'IN' => '+91',
    'ID' => '+62',
    'IR' => '+98',
    'IQ' => '+964',
    'IE' => '+353',
    'IL' => '+972',
    'IT' => '+39',
    'CI' => '+225',
    'JM' => '+1-876',
    'JP' => '+81',
    'JO' => '+962',
    'KZ' => '+7',
    'KE' => '+254',
    'KI' => '+686',
    'KP' => '+850',
    'KR' => '+82',
    'KW' => '+965',
    'KG' => '+996',
    'LA' => '+856',
    'LV' => '+371',
    'LB' => '+961',
    'LS' => '+266',
    'LR' => '+231',
    'LY' => '+218',
    'LI' => '+423',
    'LT' => '+370',
    'LU' => '+352',
    'MO' => '+853',
    'MK' => '+389',
    'MG' => '+261',
    'MW' => '+265',
    'MY' => '+60',
    'MV' => '+960',
    'ML' => '+223',
    'MT' => '+356',
    'MH' => '+692',
    'MQ' => '+596',
    'MR' => '+222',
    'MU' => '+230',
    'YT' => '+262',
    'MX' => '+52',
    'FM' => '+691',
    'MD' => '+373',
    'MC' => '+377',
    'MN' => '+976',
    'ME' => '+382',
    'MS' => '+1-664',
    'MA' => '+212',
    'MZ' => '+258',
    'MM' => '+95',
    'NA' => '+264',
    'NR' => '+674',
    'NP' => '+977',
    'NL' => '+31',
    'NC' => '+687',
    'NZ' => '+64',
    'NI' => '+505',
    'NE' => '+227',
    'NG' => '+234',
    'NU' => '+683',
    'NP' => '+977',
    'NO' => '+47',
    'NP' => '+977',
    'OM' => '+968',
    'PK' => '+92',
    'PA' => '+507',
    'PE' => '+51',
    'PH' => '+63',
    'PL' => '+48',
    'PT' => '+351',
    'PR' => '+1-787',
    'QA' => '+974',
    'RO' => '+40',
    'RU' => '+7',
    'RW' => '+250',
    'RE' => '+262',
    'BL' => '+590',
    'SH' => '+290',
    'KN' => '+1-869',
    'LC' => '+1-758',
    'PM' => '+508',
    'VC' => '+1-784',
    'WS' => '+685',
    'SM' => '+378',
    'ST' => '+239',
    'SN' => '+221',
    'RS' => '+381',
    'SC' => '+248',
    'SL' => '+232',
    'SG' => '+65',
    'SK' => '+421',
    'SI' => '+386',
    'SB' => '+677',
    'SO' => '+252',
    'ZA' => '+27',
    'GS' => '+500',
    'ES' => '+34',
    'LK' => '+94',
    'SD' => '+249',
    'SR' => '+597',
    'SS' => '+211',
    'SE' => '+46',
    'CH' => '+41',
    'SY' => '+963',
    'TJ' => '+992',
    'TZ' => '+255',
    'TH' => '+66',
    'TL' => '+670',
    'TG' => '+228',
    'TK' => '+690',
    'TO' => '+676',
    'TT' => '+1-868',
    'TN' => '+216',
    'TR' => '+90',
    'TM' => '+993',
    'TC' => '+1-649',
    'TV' => '+688',
    'UG' => '+256',
    'UA' => '+380',
    'AE' => '+971',
    'GB' => '+44',
    'US' => '+1',
    'UY' => '+598',
    'UZ' => '+998',
    'VU' => '+678',
    'VA' => '+39',
    'VE' => '+58',
    'VN' => '+84',
    'WF' => '+681',
    'EH' => '+212',
    'YE' => '+967',
    'ZM' => '+260',
    'ZW' => '+263',
];

$user_ip = $_SERVER['REMOTE_ADDR'];
$country_code = 'NL';

if ($user_ip) {
    // $response = json_decode(file_get_contents("http://ip-api.com/json/{$user_ip}"));
    // $country_code = $response->countryCode;
}

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="WKIqY8Ui8URF4B-_EHLn7ZJpRmzXjLDn8OroIYX8Kew" />
    <meta name="author" content="Eelco Greidanus">
    <meta name="description" content="Create free QR codes online with our easy-to-use QR code generator. Generate personalized QR codes for your website, business, events, and more.">
    <meta name="keywords" content="QR code generator, free QR codes, create QR code, free QR code generator, QR code for website, QR code for businesses, online QR code maker, personalize QR code, QR code for products, QR code for contact information, QR code maker no registration, QR code for marketing, QR code for advertisements, QR code for events, gratis QR code generator, QR code maken, QR code voor bedrijven, QR code maken online, QR code personaliseren, QR code voor producten, QR code voor contactinformatie, QR code voor marketing, QR code voor advertenties, QR code voor evenementen">
    <meta name="robots" content="index, follow">
    <title>QRcode generator - qrcode.eelcogreidanus.nl</title>

    <link rel="manifest" href="/site.webmanifest" />
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1NPR3X27GR"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-1NPR3X27GR');
    </script>

    <script>
        $(document).ready(function() {
            var current_type = 'text';

            var qrcode_url = 'qrcode.php';
            var qrcode_size = 200;

            var country_code = "+31";
            var country = "NL";

            $('#type').on('change', function() {
                $(`#type_${current_type}`).addClass('hidden');
                $(`#type_${$(this).val()}`).removeClass('hidden');

                current_type = $(this).val();
            });

            $('#text').on('input', function() {
                var url =
                    `${qrcode_url}?type=${current_type}&value=${$(this).val()}&size=${qrcode_size}`;
                $('#qrcode').attr('src', url);
            });

            $('#url').on('input', function() {
                var url =
                    `${qrcode_url}?type=${current_type}&value=${$(this).val()}&size=${qrcode_size}`;
                $('#qrcode').attr('src', url);
            });

            $('#email').on('input', function() {
                var url =
                    `${qrcode_url}?type=${current_type}&value=mailto:${$(this).val()}&size=${qrcode_size}`;
                $('#qrcode').attr('src', url);
            });

            $('.country-code-button').on('click', function() {
                country_code = $(this).attr('data-country-code');
                country = $(this).attr('data-country');

                $("#dropdown-phone-button").html(` ${country} ${country_code}
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                `);
            });

            $('#phone-input').on('input', function() {
                phone_number = `${country_code} ${$(this).val()}`;
                var url =
                    `${qrcode_url}?type=${current_type}&value=tel:${phone_number}&size=${qrcode_size}`;
                $('#qrcode').attr('src', url);
            });

            $('.country-code-button-2').on('click', function() {
                country_code = $(this).attr('data-country-code');
                country = $(this).attr('data-country');

                $("#dropdown-phone-button-2").html(` ${country} ${country_code}
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                `);
            });

            $('#phone-input-2').on('input', function() {
                phone_number = `${country_code} ${$(this).val()}`;
                var url =
                    `${qrcode_url}?type=${current_type}&value=sms:${phone_number}?body=${$('#message').val()}&size=${qrcode_size}`;
                $('#qrcode').attr('src', url);
            });

            $('#message').on('input', function() {
                phone_number = `${country_code} ${$(this).val()}`;
                var url =
                    `${qrcode_url}?type=${current_type}&value=sms:${$('#phone-input-2').val()}?body=${$(this).val()}&size=${qrcode_size}`;
                $('#qrcode').attr('src', url);
            });
        });
    </script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 flex items-center justify-center h-screen">
    <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg p-4 max-w-3xl w-full">
        <div class="flex flex-col sm:flex-row items-center sm:items-start">
            <img src="qrcode.php?size=200" id="qrcode" alt="QR Code Image" class="rounded-lg mb-4 sm:mb-0 sm:mr-4">
            <div class="w-full sm:w-auto grow">
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type
                    QRcode:</label>
                <select id="type"
                    class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="text" selected>Text</option>
                    <option value="url">Url</option>
                    <option value="email">Email</option>
                    <option value="phone">Phone number</option>
                    <option value="sms">Sms</option>
                </select>

                <div id="type_text" class="mb-4">
                    <div>
                        <label for="text"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Text</label>
                        <input type="text" id="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                </div>
                <div id="type_url" class="mb-4 hidden">
                    <div>
                        <label for="text"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Url</label>
                        <input type="url" id="url"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                </div>
                <div id="type_email" class="mb-4 hidden">
                    <div>
                        <label for="text"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                </div>
                <div id="type_phone" class="mb-4 hidden">
                    <label for="phone-input" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                        number:</label>
                    <div class="flex items-center mt-2">
                        <button id="dropdown-phone-button" data-dropdown-toggle="dropdown-phone"
                            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                            type="button">
                            <?php
                            echo $country_code . ' ' . $country_codes[$country_code];
                            ?>
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div id="dropdown-phone"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-52 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdown-phone-button">

                                <?php
                                foreach($country_codes as $country => $code) {
                                ?>
                                <li>
                                    <button type="button"
                                        class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white country-code-button"
                                        role="menuitem" data-country-code="<?= $code ?>" data-country="<?= $country ?>">
                                        <span class="inline-flex items-center">
                                            <?= $country ?> (<?= $code ?>)
                                        </span>
                                    </button>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="relative w-full">
                            <input type="text" id="phone-input" aria-describedby="helper-text-explanation"
                                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" />
                        </div>
                    </div>
                </div>
                <div id="type_sms" class="mb-4 hidden">
                    <label for="phone-input-2" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                        number:</label>
                    <div class="flex items-center mt-2 mb-4">
                        <button id="dropdown-phone-button-2" data-dropdown-toggle="dropdown-phone-2"
                            class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                            type="button">
                            <?php
                            echo $country_code . ' ' . $country_codes[$country_code];
                            ?>
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div id="dropdown-phone-2"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-52 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdown-phone-button-2">

                                <?php
                                foreach($country_codes as $country => $code) {
                                ?>
                                <li>
                                    <button type="button"
                                        class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white country-code-button-2"
                                        role="menuitem" data-country-code="<?= $code ?>"
                                        data-country="<?= $country ?>">
                                        <span class="inline-flex items-center">
                                            <?= $country ?> (<?= $code ?>)
                                        </span>
                                    </button>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="relative w-full">
                            <input type="text" id="phone-input-2" aria-describedby="helper-text-explanation"
                                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" />
                        </div>
                    </div>

                    <label for="message"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                    <textarea id="message" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
ob_end_flush();
?>