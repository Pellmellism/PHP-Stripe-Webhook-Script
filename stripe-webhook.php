<?php
/*******************************************************************************
 * 
 * Created 12/16/14 - contact John at pellmllism@gmail.com
 * 
 * INSTRUCTIONS
 * Host this page and take note of the URL
 * Log into Stripe.com and build a webhook for this new URL
 * Edit this file for each of the Stripe events you want to acknowledge
 * Some example uses are at the bottom of this document
 * 
 * *****************************************************************************/

		// This function is leveraged to search through the JSON for specific values
		function searchArrayValueByKey(array $array, $search) {
			foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($array)) as $key => $value) {
			    if ($search === $key)
				return $value;
			}
				return false;
			}

$input = @file_get_contents("php://input");			// this gets the POST data provided when the webhook pings this page

$event_json = json_decode($input, TRUE);			// decode the JSON, and TRUE turns it into a multidimensional array

$type = searchArrayValueByKey($event_json, 'type'); // Check the type of event sent from Stripe.com - example "charge.succeeded"

switch ($type) {									// depending on the event fired by Stripe, do something different. 
    case "account.updated":
		// do something
		
    case "balance.available":
		// do something
		
    case "charge.captured":
		// do something
		
    case "charge.refunded":
		// do something
		
    case "charge.succeeded":
		// do something
		
    case "charge.updated":
		// do something
		
    case "charge.failed":
		// do something
		
    case "charge.dispute.created":
		// do something
		
    case "charge.dispute.updated":
		// do something
		
    case "charge.dispute.closed":
		// do something
		
    case "coupon.created":
		// do something
		
    case "coupon.deleted":
		// do something
		
    case "customer.created":
		// do something
		
    case "customer.updated":
		// do something
		
    case "customer.deleted":
		// do something
		
    case "customer.card.created":
		// do something
		
    case "customer.card.updated":
		// do something
		
    case "customer.card.deleted":
		// do something
		
    case "customer.discount.created":
		// do something
		
    case "customer.discount.updated":
		// do something
		
    case "customer.discount.deleted":
		// do something
		
    case "customer.subscription.created":
		// do something
		
    case "customer.subscription.updated":
		// do something
		
    case "customer.subscription.deleted":
		// do something
		
    case "customer.subscription.trial_will_end":
		// do something
		
    case "invoice.created":
		// do something
		
    case "invoice.updated":
		// do something
		
    case "invoice.payment_succeeded":
		// do something
		
    case "invoice.payment_failed":
		// do something
		
    case "invoiceitem.created":
		// do something
		
    case "invoiceitem.updated":
		// do something
		
    case "invoiceitem.deleted":
		// do something
		
    case "plan.created":
		// do something
		
    case "plan.updated":
		// do something
		
    case "plan.deleted":
		// do something
		
    case "transfer.created":
		// do something
		
    case "transfer.updated":
		// do something
		
    case "transfer.paid":
		// do something
		
    case "transfer.failed":
		// do something
		
    default:
		// An error has occured, this was not a Stripe.com event - log into your Stripe.com account and check the log.
		
}

/*

DETAILED DESCRIPTION IN RELATIVELY PLAIN ENGLISH

Stripe webhooks allow you to know how about the status of a transaction. If you have a customer purchase a 
widget, you might consider recording that customers email and customerID in a database at the time of purchase
then use a webhooh to record how that transaction had proceeded. For example, waiting until a card is successfully 
charged before emailing a customer a downloadable file.

The webhook is a URL that Stripe sends information about the transaction to along the way, so for each event of the transaction
you will recieve a detailed descripton as it happens. For example, as a customer subscribes to a service there are various stages - 
First, the customer.created event occurs, followed by charge.succeeded, invoice.created, invroice.payment_succeeded, customer.card.created, and 
finally customer.subscription.created. You may decide that during one of those events that the customer should get an email, or that
a database should be updated to reflect new information.

The information that Stripe sends to the webhook is formatted in JSON and we use PHP to decode the data and then search the data for
specific information we can use to identify the transaction and details about how the transaction occured. The data will have different
information in it depending on which event occured, but there are some standard peices of information that are always included. If you 
head over to your stripe dashboard, you can test the webhooks and in the test sessions you can learn what informtion is sent with each event.
You can search the data by the descriptor, or the key value by running it through the searchArrayValueByKey() function.

A sample of the JSON data might look like this -->

						{
						  "created": 1326853468,
						  "livemode": false,
						  "id": "evt_00000000000000",
						  "type": "charge.succeeded",
						  "object": "event",
						  "request": null,
						  "pending_webhooks": 1,
						  "api_version": "2014-12-08",
						  "data": {
						    "object": {
						      "id": "ch_00000000000000",
						      "object": "charge",
						      "created": 1418689534,
						      "livemode": false,
						      "paid": true,
						      "amount": 100,
						      "currency": "usd",
						      "refunded": false,
						      "captured": true,
						      "card": {
						        "id": "card_00000000000000",
						        "object": "card",
						        "last4": "4242",
						        "brand": "Visa",
						        "funding": "credit",
						        "exp_month": 2,
						        "exp_year": 2022,
						        "fingerprint": "qj49tV3y7axAqjD3",
						        "country": "US",
						        "name": "demo@gmail.com",
						        "address_line1": null,
						        "address_line2": null,
						        "address_city": null,
						        "address_state": null,
						        "address_zip": null,
						        "address_country": null,
						        "cvc_check": "pass",
						        "address_line1_check": null,
						        "address_zip_check": null,
						        "dynamic_last4": null,
						        "customer": "cus_00000000000000"
						      },
						      "balance_transaction": "txn_00000000000000",
						      "failure_message": null,
						      "failure_code": null,
						      "amount_refunded": 0,
						      "customer": "cus_00000000000000",
						      "invoice": "in_00000000000000",
						      "description": null,
						      "dispute": null,
						      "metadata": {},
						      "statement_description": "test",
						      "fraud_details": {},
						      "receipt_email": "payinguser@example.com",
						      "receipt_number": null,
						      "shipping": null,
						      "refunds": {
						        "object": "list",
						        "total_count": 0,
						        "has_more": false,
						        "url": "/v1/charges/ch_15A96QL8CfRmpdofR6emWQyW/refunds",
						        "data": []
						      }
						    }
						  }
						}


Every use case will be different, but the nature of a webhook is to 
	1 - detect a specific event 
	2 - check who triggered the event 
	3 - do something.
	
We can easily identify the event, Stripe ensures each webhook is sent with the event type defined.
Depending on the event and the use case, we will want more information from that event.



*/



//Some examples of actions you might take when Stripe fires an event can be found below.
//Copy and past the code into the "//do something" sections for the event your interested in
//#################################################################################################
		/*
		EXAMPLE - SEND AN EMAIL
		
			//get some of the customers details from the webhook
			$customerID    = searchArrayValueByKey($event_json, 'customer');
			$customerName  = searchArrayValueByKey($event_json, 'name');
			$customerEmail = searchArrayValueByKey($event_json, 'receipt_email');
			//constuct the email
			$youremail= 'test@test.com'; 	// set your email address
			$subject  = 'Test webhooks';	// set the subject
			$headers  = "From: " . strip_tags($customerName) . "<" . strip_tags($customerEmail) . ">\r\n";
			$headers .= "Reply-To: ". strip_tags($customerEmail) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
			$message = 'The customer with ID "'.$customerID.'" just bought a really expensive widget';
			// actually send the email
			@mail($youremail, $subject, $message, $headers);
		
		*/
//#################################################################################################
		/*
		EXAMPLE - UPDATE A MYSQL DATABASE
			
			//get some of the customers details from the webhook
			$customerID    = searchArrayValueByKey($event_json, 'customer');
			$customerName  = searchArrayValueByKey($event_json, 'name');
			$customerEmail = searchArrayValueByKey($event_json, 'receipt_email');
			
			// your MySQL database credentials
			$servername = "localhost";
			$username = "username";
			$password = "password";
			$dbname = "myDB";
			
			$conn = mysqli_connect($servername, $username, $password, $dbname);		// connect to your database
			$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";					// build the query
			mysqli_query($conn, $sql);												// actually tap the database
			mysqli_close($conn);													// close the connection
		
		*/
//#################################################################################################
		/*
		EXAMPLE - SEND A TEXT MESSAGE WITH TWILIO.COM
			
			//in this example, we will have twilio send a text message to our phone whenever someone buys something
			//include the Twilio library, get it at https://github.com/twilio/twilio-php/archive/master.zip
			require_once($_SERVER['DOCUMENT_ROOT'].'/twilio-php-master/Services/Twilio.php'); 
			$twilioAccountSID = 'YOUR-TWILIO-ACCOUNT-SID-HERE';
			$twilioAuthKey    = 'YOUR-TWILIO-AUTH-KEY-HERE';
			$MyTwilioNumber   = '15557773333'; //this is your twilio SMS capable phone number
			$CellPhoneNumber  = '15553337777'; //this is your personal cell phone that you want to get the message
			$customer = searchArrayValueByKey($event_json, 'customer'); //get the customers identifier who made the purchase
			$message  = 'The customer "'.$customer.'"just ordered an expensive widget'; // build the body of the text message
			
			//actually send the message by calling the twilio library
			$client = new Services_Twilio($twilioAccountSID, $twilioAuthKey);
			$sms = $client->account->sms_messages->create(
				"$MyTwilioNumber",		// From this number
				"$CellPhoneNumber",		// To this number
				"$message"				// with this message
				);
			// the message is sent, check your phone
			
		*/
//#################################################################################################






//	GETTING WEBHOOK ERRORS??

//Depending on your hosting environment, you may want to serve an HTTP response code for Stripe.com
//If your webhooks fail for stripe, they may repeat until successful, but failure may occur if 
//an HTTP 200 isnt recieved by Stripe when they trigger the webhook. You may try ending this 
//script by uncomenting line below (remove the 2 slashes before the http_response_code(200);)

//http_response_code(200);
?>
