<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Create text index for full-text search on title, author, keywords
        DB::connection('mongodb')->getMongoDB()
            ->selectCollection('digital_items')
            ->createIndex(
                ['title' => 'text', 'author' => 'text', 'keywords' => 'text'],
                ['name' => 'title_author_keywords_text_index', 'weights' => ['title' => 10, 'author' => 5, 'keywords' => 2]]
            );
    }

    public function down(): void
    {
        DB::connection('mongodb')->getMongoDB()
            ->selectCollection('digital_items')
            ->dropIndex('title_author_keywords_text_index');
    }
};
