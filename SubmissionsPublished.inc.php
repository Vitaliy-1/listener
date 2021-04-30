<?php

/**
 * @file plugins/generic/listener/SubmissionsPublished.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SubmissionsPublished
 * @ingroup plugins_generic_listener
 *
 * @brief custom model to interact with submissions_published table
 */

use Illuminate\Database\Eloquent\Model;

class SubmissionsPublished extends Model
{
    protected $table = 'listener_submissions_published';
    protected $primaryKey = 'submission_id';
    public $incrementing = false;
    public $timestamps = false;
    const UPDATED_AT = null;
    const CREATED_AT = 'first_published';
}
