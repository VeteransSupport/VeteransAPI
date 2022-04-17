<?php
namespace src\controllers;

use src\Firebase\JWT\JWT;
use src\Firebase\JWT\Key;
use src\gateways\UserGateway;
use src\PHPMailer\PHPMailer;
use src\responses\JSONResponse;

/**
 * Defines the "api/create_user" endpoints and returns the resultant data.
 *
 * @author Pervaiz Ahmad w18014333
 */
class ApiUpdateUserController extends Controller {

    /**
     * Sets the gateway as CreateUserGateway()
     */
    protected function setGateway() {
        $this->gateway = new UserGateway();
    }

    /**
     * Analysis the request to point to an API
     * endpoint and then returns the resultant data.
     *
     * @return string The results of the API
     *                endpoint called
     */
    protected function processRequest() {
        $email = $this->getRequest()->getParameter("username");
        $password = $this->getRequest()->getParameter("password");
        $charity_id = $this->getRequest()->getParameter("charity_id");
        $type_id = $this->getRequest()->getParameter("type_id");
        $new_password = $this->getRequest()->getParameter("new_password");
        $token = $this->getRequest()->getParameter("token");
        $request = $this->getRequest()->getParameter("request");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if ($request === "add") {
                if (!is_null($token)) {
                    $key = SECRET_KEY;
                    $decoded = JWT::decode($token, new Key($key, 'HS256'));
                    $user_id = $decoded->user_id;

                    $this->gateway->findTypeAndCharityById($user_id);
                    if (count($this->gateway->getResult()) == 1) {
                        $user_type_id = $this->gateway->getResult()[0]['type_id'];
                        if (($user_type_id !== '4' && $user_type_id !== '5') &&
                            (($user_type_id === '3' && $type_id === '4') ||
                            ($user_type_id === '2' && $type_id !== '1' && $type_id !== '2') ||
                             $user_type_id === '1')) {
                            if(!is_null($email) && !is_null($password) && !is_null($charity_id)) {
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                $this->gateway->addUser($email, $hashed_password, $type_id, $charity_id);
                            } else {
                                $this->gateway->setResult('');
                                $this->getResponse()->setMessage("Not Acceptable");
                                $this->getResponse()->setStatusCode(406);
                            }
                        } else {
                            $this->gateway->setResult('');
                            $this->getResponse()->setMessage("Unauthorized");
                            $this->getResponse()->setStatusCode(401);
                        }
                        return $this->gateway->getResult();
                    }
                    $this->gateway->setResult('');
                    $this->getResponse()->setMessage("Unauthorized");
                    $this->getResponse()->setStatusCode(401);
                }
            } else if ($request === "remove") {
                if(!is_null($email) && !is_null($password)) {
                    $this->gateway->findPassword($email);
                    if (count($this->gateway->getResult()) == 1) {
                        $hashPassword = $this->gateway->getResult()[0]['password'];

                        // Verify if the passwords match
                        // If so, remove user
                        if (password_verify($password, $hashPassword)) {
                            $this->gateway->removeUser($email);
                            $this->gateway->setResult('Password reset successfully');
                            return $this->gateway->getResult();
                        }
                    }
                    $this->gateway->setResult('Error: Password was not reset!');
                    return $this->gateway->getResult();
                }
                $this->gateway->setResult([]);
            } else if ($request === "reset_password_logged_in" && !is_null($email) &&
                !is_null($password) && !is_null($new_password) && !is_null($token)) {
                $key = SECRET_KEY;
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                $user_id = $decoded->user_id;

                $this->gateway->findPassword($email);
                if (count($this->gateway->getResult()) == 1) {
                    $hashPassword = $this->gateway->getResult()[0]['password'];
                    // Verify if the passwords match
                    // If so, remove user
                    if (password_verify($password, $hashPassword)) {
                        // Hashing new password
                        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $this->gateway->resetPassword($user_id, $new_hashed_password);
                    }
                }
            } else if($request === "reset_password_logged_out" && !is_null($email)) {
                // generate simple random password
                // from the following string
                $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                //$generated_password = substr(str_shuffle($string), 0, 8);
                $generated_password = "KLcXUsn990"; // remove and uncomment above

                $this->gateway->findPassword($email);
                if (count($this->gateway->getResult()) == 1) {
                    $user_id = $this->gateway->getResult()[0]['id'];
                    $new_hashed_password = password_hash($generated_password, PASSWORD_DEFAULT);
                    $this->gateway->resetPassword($user_id, $new_hashed_password);

                    // send email
                    $mail = new PHPMailer;

                    $mail->Host = 'smtp.gmail.com';                         // SMTP server
                    $mail->SMTPAuth = true;                                 // Enable SMTP Authentication
                    $mail->FromName = ''; // The Full Name
                    $mail->Username   = '';                                 // SMTP username
                    $mail->Password   = '';                                 // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // Enable implicit TLS encryption
                    $mail->Port = 587;                                      // TCP port to connect to

                    // Sender Info
                    $mail->setFrom(''); // Add Sender

                    // Recipient Info
                    $mail->addAddress($email);

                    // Content
                    $mail->isHTML(true);                              // Set email format to HTML
                    $mail->Subject = 'Veterans App Password Reset';
                    $bodyContent = '<h1>Your Password has been reset</h1>';
                    $bodyContent .= '<p1>Your new password is:</p1>';
                    $bodyContent .= '<p1>' . 'test123' . '</p1>';
                    $bodyContent .= '<p1>Please log into the Veterans App using this new password and reset your password within the app.</p1>';
                    $mail->Body = $bodyContent;
                    $mail->AltBody = 'Your Password has been reset. Your new password is: ' . 'test123 ' . ' Please log into the Veterans App using this new password and reset your password within the app.';

                    $sendMessage = '';
                    if(!$mail->send()) {
                        $sendMessage = 'ERROR! Email not sent: ' . $mail->ErrorInfo;
                    } else {
                        $sendMessage = 'Success! The email was sent. ::' . $mail->ErrorInfo;
                    }
                    $this->gateway->setResult($sendMessage);
                    return $this->gateway->getResult();
                }
                $this->gateway->setResult('Error: Password was not reset!');
                return $this->gateway->getResult();
            } else {
                if ($this->getResponse() instanceof JSONResponse) {
                    $this->getResponse()->setMessage("Unauthorized");
                    $this->getResponse()->setStatusCode(401);
                }
            }
        } else if ($this->getResponse() instanceof JSONResponse) {
            $this->getResponse()->setMessage("method not allowed");
            $this->getResponse()->setStatusCode(405);
        }

        return $this->gateway->getResult();
    }
}
