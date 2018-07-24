<?php

namespace Statamic\Addons\StructuredData;

use Statamic\Extend\Tags;
use Statamic\API\Str;
use Statamic\API\URL;
use Statamic\API\Content;

class StructuredDataTags extends Tags
{
    /**
     * The {{ structured_data:breadcrumb }} tag
     *
     * @return string
     */
    public function breadcrumb()
    {
      $crumbs = [];

      $url = $this->get(['url' , 'from'], URL::getCurrent());
      $locale = site_locale();
      $segments = explode('/', $url);
      $segment_count = count($segments);

      $segment_urls = [];

      for ($i = 2; $i <= $segment_count; $i++) {
          $segment_urls[] = URL::tidy(join($segments, '/'));

          array_pop($segments);
      }

      foreach ($segment_urls as $segment_url) {
          $default_segment_uri = URL::getDefaultUri($locale, $segment_url);

          if ($default_segment_uri) {
            $content = Content::whereUri($default_segment_uri)->in($locale)->toArray();
          }

          $crumbs[] = [
            'url' => $content['permalink'],
            'name' => $content['title'],
          ];
      }

      return \JsonLd\Context::create('breadcrumb_list', [
          'itemListElement' => array_reverse($crumbs),
      ]);;
    }
}
