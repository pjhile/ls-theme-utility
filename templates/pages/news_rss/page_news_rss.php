<?=
  Blog_Post::get_rss(
    $site_settings->company->title,
    $site_settings->company->title . " news and updates",
    site_url('rss'),
    site_url('news/post'),
    site_url('news/category'),
    site_url('news'),
    20);
?>