<?php
namespace App\Models;

use DateTime;
class Post extends Model
{
    protected $table = 'posts';


    public function getCreatedAt(): string
    {
       return (new DateTime($this->created_at))->format("d/m/y à H:m ");

    }

    public function getExcerpt(): string
    {
        return substr($this->content, 0, 200) . '...';
    }

    public function getButton(): string
    {
        return <<<HTML
        <a href="/posts/$this->id" class="btn btn-primary">Lire l'artcile</a>
HTML;

    }

    public function getTags()
    {
        return $this->query("
        SELECT t.* FROM tags t
        INNER JOIN post_tag pt ON pt.tag_id = t.id
        INNER JOIN posts p ON pt.post_id = p.id
        WHERE p.id = ?
        ", $this->id);
    }

}