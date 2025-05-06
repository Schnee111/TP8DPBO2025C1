<?php
class TemplateProcessor {
    private static function processTemplate($templatePath, $replacements) {
        if (!file_exists($templatePath)) {
            return "Template {$templatePath} not found!";
        }
        
        $content = file_get_contents($templatePath);
        
        foreach ($replacements as $key => $value) {
            $content = str_replace('{' . $key . '}', $value, $content);
        }
        
        return $content;
    }
    
    public static function render($contentTemplatePath, $contentReplacements, $title) {
        // Process content template
        $contentTemplate = self::processTemplate($contentTemplatePath, $contentReplacements);
        
        // Extract content between {CONTENT_START} and {CONTENT_END} tags
        preg_match('/{CONTENT_START}(.*){CONTENT_END}/s', $contentTemplate, $matches);
        $content = isset($matches[1]) ? $matches[1] : $contentTemplate;
        
        // Process layout template
        $layoutReplacements = [
            'TITLE' => $title,
            'CONTENT' => $content
        ];
        
        $layoutTemplate = self::processTemplate('templates/layout.html', $layoutReplacements);
        
        echo $layoutTemplate;
    }
}
?>