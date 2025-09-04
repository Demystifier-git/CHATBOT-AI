<?php
require "lib/utilities.php";

// get ip
$ip = $_GET['ip'];

// fetch users
require "lib/connect_to_db.php";
$sql = "SELECT id, prompt, response, timestamp FROM chats WHERE ip = ?";
$chats = queryDB($mysqli, $sql, "s", $ip);
$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Roq AI</title>
	<style>
		* {
			font-family: system-ui;
			margin: 0;
		}

		body {
			background-color: #f5f5f5;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		td,
		th {
			border: 1px solid #aaa;
			padding: 8px;
		}

		a {
			text-decoration: none;
			color: grey;
		}

		a:active,
		a:hover {
			color: #42b72a;
		}

		section {
			padding: 10px;
		}

		.container {
			max-width: fit-content;
			margin: 0 auto;
			background-color: #fff;
			padding: 18px;
		}

		h2 {
			margin-bottom: 18px;
		}
	</style>
</head>

<body>
	<section>
		<div class="container">
			<?php if (count($chats)): ?>
				<h2>Prompts from user: <?php echo $ip ?></h2>
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Prompt</th>
							<th>Response</th>
							<th>Timestamp (UTC)</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($chats as $chat): ?>
							<tr>
								<td><?php echo $chat['id'] ?></td>
								<td><?php echo $chat['prompt'] ?></td>
								<td><?php echo $chat['response'] ?></td>
								<td><?php echo $chat['timestamp'] ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p>No prompts from user: <b><?php echo $ip ?></b></p>
			<?php endif; ?>
		</div>
	</section>
</body>

</html>