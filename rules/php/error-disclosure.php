<?php
// Test cases for rules/php/error-disclosure.yaml
// A "ruleid" comment means the next line MUST be flagged; an "ok" comment
// means it must NOT be.

// ---------- db-error-shown-to-visitor ----------

// The most copied line in PHP tutorials.
// ruleid: db-error-shown-to-visitor
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// ruleid: db-error-shown-to-visitor
die("Error: " . mysqli_error($conn));

// W3Schools-style insert error.
// ruleid: db-error-shown-to-visitor
echo "Error: " . $sql . "<br>" . mysqli_error($conn);

// W3Schools-style connection check.
if (!$conn) {
    // ruleid: db-error-shown-to-visitor
    die("Connection failed: " . mysqli_connect_error());
}

// Object style.
// ruleid: db-error-shown-to-visitor
echo "Query failed: " . $conn->error;

// ruleid: db-error-shown-to-visitor
exit($stmt->error);

// Error put into a JSON reply is still shown to the visitor.
// ruleid: db-error-shown-to-visitor
echo json_encode(['success' => false, 'message' => $mysqli->error]);

// Safe: details to the server log, plain message to the visitor.
// ok: db-error-shown-to-visitor
error_log(mysqli_error($conn));
die("Something went wrong. Please try again.");

// Safe: stored in a variable and logged, never printed.
// ok: db-error-shown-to-visitor
$err = mysqli_error($conn);
error_log($err);

// Not a database object: a form validator's error is fine to show.
// ok: db-error-shown-to-visitor
echo $validator->error;

// Two steps: stored in a variable, printed later. Still a leak.
$msg = "Insert failed: " . mysqli_error($conn);
// ruleid: db-error-shown-to-visitor
echo $msg;

// ---------- exception-message-shown-to-visitor ----------

// W3Schools-style PDO connection.
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    // ruleid: exception-message-shown-to-visitor
    echo "Connection failed: " . $e->getMessage();
}

// The exact shape EduAdapt had (finding F-108).
try {
    $stmt = $conn->prepare("DELETE FROM sessions WHERE id = ?");
} catch (Throwable $e) {
    // ruleid: exception-message-shown-to-visitor
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

// The two-step shape most EduAdapt endpoints had (F-108).
try {
    $stmt = $conn->prepare("SELECT * FROM sessions");
} catch (Throwable $e) {
    $msg = 'Database error: ' . $e->getMessage();
    if (stripos($e->getMessage(), "doesn't exist") !== false) {
        $msg .= ' - run the migration';
    }
    // ruleid: exception-message-shown-to-visitor
    echo json_encode(['success' => false, 'message' => $msg]);
}

// Safe: logged, plain message shown.
try {
    $stmt = $conn->prepare("SELECT 1");
} catch (mysqli_sql_exception $e) {
    // ok: exception-message-shown-to-visitor
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Something went wrong.']);
}

// ---------- display-errors-enabled ----------

// ruleid: display-errors-enabled
ini_set('display_errors', 1);

// ruleid: display-errors-enabled
ini_set("display_errors", "On");

// ok: display-errors-enabled
ini_set('display_errors', '0');

// Safe: only on the developer's own machine (decided at run time).
// ok: display-errors-enabled
ini_set('display_errors', $is_local ? '1' : '0');

// ---------- phpinfo-left-in-code ----------

// ruleid: phpinfo-left-in-code
phpinfo();
