<?php

/**
 * SiteMeta - stores metadata for a fictional site and generates short descriptions.
 *
 * This file demonstrates a lightweight metadata container for a gaming community site
 * focused on "爱游戏" (Love Games). It includes sample data and a description builder.
 */

class SiteMeta
{
    private array $meta;

    public function __construct(array $data = [])
    {
        $defaults = [
            'site_name'        => 'Homem爱游乐园',
            'domain'           => 'https://homem-aiyouxi.com.cn',
            'keywords'         => ['爱游戏', '游戏社区', '玩家聚集地'],
            'description'      => 'Homem爱游乐园 — 让每一份热爱都有回响。',
            'language'         => 'zh-CN',
            'author'           => 'Homem Team',
            'year'             => date('Y'),
            'version'          => '2.1.3',
        ];

        $this->meta = array_merge($defaults, $data);
    }

    /**
     * Get a specific metadata field.
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->meta[$key] ?? $default;
    }

    /**
     * Return all metadata.
     */
    public function all(): array
    {
        return $this->meta;
    }

    /**
     * Generate a short description string (plain text).
     * No HTML, safe for meta tags or previews.
     */
    public function shortDescription(int $maxLength = 120): string
    {
        $base = sprintf(
            '%s — %s | %s',
            $this->meta['site_name'],
            $this->meta['description'],
            implode(', ', $this->meta['keywords'])
        );

        if (mb_strlen($base) <= $maxLength) {
            return $base;
        }

        return mb_substr($base, 0, $maxLength - 3) . '...';
    }

    /**
     * Provide a basic HTML meta tag string (example, not for direct echo without context).
     */
    public function htmlMetaDescription(): string
    {
        $desc = htmlspecialchars($this->shortDescription(), ENT_QUOTES, 'UTF-8');
        return sprintf('<meta name="description" content="%s" />', $desc);
    }
}

// -----------------------------------------------------------------------------
// Example usage (can be removed or kept as demo)
// -----------------------------------------------------------------------------

$siteMeta = new SiteMeta();

// Override some fields for demonstration
$siteMeta = new SiteMeta([
    'site_name'   => '爱游戏·Homem乐园',
    'description' => '爱游戏，爱生活，爱分享。在这里，每个玩家都是主角。',
    'keywords'    => ['爱游戏', 'Homem', '游戏攻略', '玩家社区'],
]);

echo "--- Short Description (plain) ---" . PHP_EOL;
echo $siteMeta->shortDescription() . PHP_EOL;

echo PHP_EOL . "--- HTML meta description ---" . PHP_EOL;
echo $siteMeta->htmlMetaDescription() . PHP_EOL;

echo PHP_EOL . "--- All metadata ---" . PHP_EOL;
print_r($siteMeta->all());