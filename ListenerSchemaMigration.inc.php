<?php

/**
 * @file classes/migration/ListenerSchemaMigration.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ListenerSchemaMigration
 * @brief Describe database table structures.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ListenerSchemaMigration extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Create a table that is going to be updated if submission has the first publication being published
        Schema::create('listener_submissions_published', function (Blueprint $table) {
            $table->bigInteger('submission_id');
            $table->foreign('submission_id')->references('submission_id')->on('submission_files');
            $table->bigInteger('publication_id');
            $table->timestamp('first_published')->useCurrent();
        });
    }
}
