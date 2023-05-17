<?php

namespace App\Core;

class BaseLanguage
{
    private $language;
    private $language_dir;
    private $cookie_name = 'language';

    public function __construct($language_dir)
    {
        $this->language_dir = $language_dir;
        $this->language = $this->get_language();
    }

    private function get_language()
    {
        if (isset($_COOKIE[$this->cookie_name]) && file_exists($this->language_dir . $_COOKIE[$this->cookie_name] . '.json')) {
            return $_COOKIE[$this->cookie_name];
        }
        $files = glob($this->language_dir . '*.json');
        if (!empty($files)) {
            $language = basename($files[0], '.json');
            setcookie($this->cookie_name, $language, time() + 3600 * 24 * 30, '/');
            return $language;
        }
        return null;
    }

    public function set_language($language)
    {
        if (file_exists($this->language_dir . $language . '.json')) {
            $this->language = $language;
            setcookie($this->cookie_name, $language, time() + 3600 * 24 * 30, '/');
        }
    }

    public function get_available_languages()
    {
        $files = glob($this->language_dir . '*.json');
        $languages = [];
        foreach ($files as $file) {
            $languages[] = basename($file, '.json');
        }
        return $languages;
    }

    public function get_current_language()
    {
        return $this->language;
    }

    public function get($key)
    {
        $file = $this->language_dir . $this->language . '.json';
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $translations = json_decode($json, true);
            if (isset($translations[$key])) {
                return $translations[$key];
            }
        }
        return $key;
    }
}
