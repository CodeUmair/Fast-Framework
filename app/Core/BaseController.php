<?php

namespace App\Core;

use App\Core\BaseLanguage;

class BaseController
{
    public function __construct()
    {
        $language = new BaseLanguage(BASE_PATH . 'app/Languages/');
        $languages = $language->get_available_languages();
        $current_language = $language->get_current_language();
    }
}
