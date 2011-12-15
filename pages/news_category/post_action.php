<?
if ($category)
{
  $this->page->title = $category->name;
  $this->data['pagination'] = $posts->paginate($this->request_param(1, 1)-1, 100);
  $this->data['posts'] = $posts->find_all();
}
?>