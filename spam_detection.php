<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $data = json_decode(file_get_contents('php://input'), true);
    $commentId = $data['commentId'] ?? null;

    if (!$commentId) {
        echo json_encode(['message' => 'Invalid input.']);
        exit();
    }

    // Simulate database operations
    $spamThreshold = 20; // Number of reports needed to mark as spam
    $currentReports = getSpamReports($commentId);

    if ($currentReports >= $spamThreshold) {
        echo json_encode(['message' => 'This comment is already marked as spam.']);
        exit();
    }

    // Increment the spam report count
    $newCount = incrementSpamReports($commentId);

    if ($newCount >= $spamThreshold) {
        markCommentAsSpam($commentId);
        echo json_encode(['message' => 'Comment marked as spam.', 'spamStatus' => true]);
    } else {
        echo json_encode(['message' => 'Spam report submitted.', 'spamStatus' => false]);
    }
    exit();
}

function getSpamReports($commentId) {
    // Simulate retrieving the current report count from the database
    return 15; // Example value
}

function incrementSpamReports($commentId) {
    // Simulate incrementing the report count in the database
    return getSpamReports($commentId) + 1;
}

function markCommentAsSpam($commentId) {
    // Simulate marking the comment as spam in the database
    // Example: Update the database to mark this comment as spam
}
?>
