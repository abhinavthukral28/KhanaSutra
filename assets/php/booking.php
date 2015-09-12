<?php

	// Mail settings
	$to = "web-master72@yandex.ru";
	$subject = "Book a table";

	// AutoResponder settings
	$useAutoResponder = "On";
	$messageAutoResponder = "Your booking has been submitted. Our manager will contact you shortly.";
	$siteName = "Your site name";

	if (isset($_POST["name"]) && isset($_POST["phone"]) && isset($_POST["email"]) && isset($_POST["people"]) && isset($_POST["date"]) && isset($_POST["time"]) && isset($_POST["message"])) {

		$content  = "Name: "     . $_POST["name"]    . "\r\n";
		$content .= "Phone: "    . $_POST["phone"]   . "\r\n";
		$content .= "Email: "    . $_POST["email"]   . "\r\n";
		$content .= "People: "   . $_POST["people"]  . "\r\n";
		$content .= "Date: "     . $_POST["date"]    . "\r\n";
		$content .= "Time: "     . $_POST["time"]    . "\r\n";
		$content .= "Message: "  . "\r\n" . $_POST["message"];

		if (mail($to, $subject, $content, $_POST["email"])) {

			if ($useAutoResponder == "On") {

				mail($_POST["email"], $subject, $messageAutoResponder, $siteName);
				$result = array(
					"message" => "Your booking has been submitted. Check your email.",
					"sendstatus" => 1
				);

			} else {

				$result = array(
					"message" => "Your booking has been submitted.",
					"sendstatus" => 1
				);

			}

			echo json_encode($result);

		} else {

			$result = array(
				"message" => "Sorry, something is wrong.",
				"sendstatus" => 0
			);

			echo json_encode($result);
		}

	}

?>