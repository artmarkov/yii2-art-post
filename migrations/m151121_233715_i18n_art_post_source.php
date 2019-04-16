<?php

use artsoft\db\SourceMessagesMigration;

class m151121_233715_i18n_art_post_source extends SourceMessagesMigration
{

    public function getCategory()
    {
        return 'art/post';
    }

    public function getMessages()
    {
        return [
            'Categories' => 1,
            'Create Category' => 1,
            'Update Category' => 1,
            'Create Tag' => 1,
            'Update Tag' => 1,
            'No posts found.' => 1,
            'Post' => 1,
            'Posted in' => 1,
            'Posts Activity' => 1,
            'Posts' => 1,
            'Tag' => 1,
            'Tags' => 1,
        ];
    }
}