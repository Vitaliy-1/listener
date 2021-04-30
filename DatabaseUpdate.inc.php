<?php

/**
 * @file plugins/generic/listener/DatabaseUpdate.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class DatabaseUpdate
 * @ingroup plugins_generic_listener
 *
 * @brief Listener to the Event
 */

import('plugins.generic.listener.SubmissionsPublished');

use PKP\observers\events\PublishedEvent;

class DatabaseUpdate

{
    public function handle(PublishedEvent $event)
    {
        $submissionId = $event->submission->getId();

        $publishedSubmission = SubmissionsPublished::find($submissionId);
        if ($publishedSubmission) return;

        $submissionPublished = new SubmissionsPublished;
        $submissionPublished->submission_id = $submissionId;
        $submissionPublished->publication_id = $event->publication->getId();
        $submissionPublished->save();
    }
}
