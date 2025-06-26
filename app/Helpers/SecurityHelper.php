<?php

namespace App\Helpers;

class SecurityHelper
{
    /**
     * Escape HTML output to prevent XSS
     */
    public static function escape($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Clean input data
     */
    public static function cleanInput($input)
    {
        if (is_array($input)) {
            return array_map([self::class, 'cleanInput'], $input);
        }
        
        return trim(strip_tags($input));
    }

    /**
     * Validate and sanitize file upload
     */
    public static function validateImage($file, $maxSize = 2048)
    {
        if (!$file || !$file->isValid()) {
            return false;
        }

        // Check file size (in KB)
        if ($file->getSize() > $maxSize * 1024) {
            return false;
        }

        // Check MIME type
        $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            return false;
        }

        // Check file extension
        $allowedExtensions = ['jpeg', 'jpg', 'png', 'gif', 'webp'];
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $allowedExtensions)) {
            return false;
        }

        return true;
    }

    /**
     * Generate secure filename
     */
    public static function generateSecureFilename($originalName)
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        return uniqid() . '_' . time() . '.' . $extension;
    }

    /**
     * Validate price input
     */
    public static function validatePrice($price)
    {
        return is_numeric($price) && $price >= 0 && $price <= 999999999;
    }

    /**
     * Sanitize product name
     */
    public static function sanitizeProductName($name)
    {
        // Remove HTML tags
        $name = strip_tags($name);

        // Remove special characters except allowed ones (support Unicode/Vietnamese)
        $name = preg_replace('/[^\p{L}\p{N}\s\-\.\,\(\)]/u', '', $name);

        // Trim and limit length
        return substr(trim($name), 0, 255);
    }
}
