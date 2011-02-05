<?=
  Blog_Post::get_rss(
    $site_settings->company->title,
    $site_settings->company->title . " news and updates",
    site_url('rss'),
    site_url($site_settings->news->path . '/post'),
    site_url($site_settings->news->path . '/category'),
    site_url($site_settings->news->path),
    $site_settings->news->rss->per_page);
?>