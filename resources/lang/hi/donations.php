<?php

return [
    'paypal' => [
        'title' => 'पेपैल के साथ भुगतान करें',
        'disabled' => 'यह विधि वर्तमान में अक्षम है।',
        'empty' => 'वर्तमान में कोई भी मूल्य पैकेज नहीं जोड़े गए हैं, कृपया समर्थन से संपर्क करें।',
        'pay-text' => ':amount के :silk_name के लिए :price :currency',
        'submit' => 'अभी खरीदें!',
        'pending' => 'आपके पास भुगतान लंबित है!',
    ],
    'notification' => [
        'buy' => [
            'success-title' => 'हॊ गया',
            'success-message' => 'आपके दान को सफलतापूर्वक संसाधित किया गया है, धन्यवाद!',
            'success-help' => 'आपके खाते में अभी :amount ' . config('siteSettings.sro_silk_name', 'Silk') . ' जमा किए गए हैं। इसके साथ मजे करो!',
            'success-back' => 'अपने डैशबोर्ड पर वापस जाएं',
            'invoice-closed-title' => 'संसाधित',
            'invoice-closed-message' => 'यह दान पहले से ही संसाधित था, धन्यवाद!',
            'invoice-help' => 'ऐसा लगता है कि पेपैल को हमें जवाब भेजने के लिए थोड़ी देर की आवश्यकता है, कृपया थोड़ा इंतजार करें, लेनदेन अभी किया जा रहा है।',
            'invoice-ahref' => 'वापस जाओ',
            'error-title' => 'अरे!',
            'error' => 'कुछ गलत हो गया है, कृपया इसे फिर से आज़माएँ या टिकट लिखें।',
            'error-helper' => 'आप इसे फिर से आज़मा सकते हैं, हम आपके द्वारा किए जा रहे प्रत्येक चरण को लॉग कर रहे हैं।',
            'error-ahref' => 'वापस जाओ',
            'notification' => 'सफलतापूर्वक :amount ' . config('siteSettings.sro_silk_name', 'Silk') . ' खरीदे',
        ],
    ],
];
