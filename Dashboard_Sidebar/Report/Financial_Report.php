<?php

require_once __DIR__ . '\../../vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth;
use PHPMailer\PHPMailer\PHPMailer;

$mpdf = new \Mpdf\Mpdf();
date_default_timezone_set('America/New_York');
$response = file_get_contents('php://input');
$res = json_decode($response, true);
if(isset($res)) {
    $factory = (new Factory)->withServiceAccount(__DIR__ . '\../../secret/plantopart-4c826-firebase-adminsdk-quxvu-242e63036c.json');
    $user = $factory->createAuth()->getUserByEmail($res['email'])->uid;
    $user_name = $factory->createAuth()->getUserByEmail($res['email'])->displayName;
    if($factory->createDatabase()->getReference('Users/' . $user . '/Financial_Data')->getSnapshot()) {
        $data = [];
        $data = $factory->createDatabase()->getReference('Users/' . $user . '/Financial_Data')->getValue();

        $mpdf->WriteHTML("<p style='text-align: center;'><img src='https://firebasestorage.googleapis.com/v0/b/plantopart-4c826.appspot.com/o/logo.PNG?alt=media&amp;token=e8510cfc-0080-4824-833f-04d5c8b7ce13' /></p>
<p style='text-align: left;'>Name: ". "$user_name" . "</p>
<p style='text-align: left;'>Date: " . date('Y-m-d') . "</p>
<table style='height: 90%; width: 100%; border-collapse: collapse; border-style: none; margin-left: auto; margin-right: auto;' border='1'>
<tbody>
<tr style='height: 73px;'>
<td style='border-style: hidden; width: 100%; text-align: center; height: 73px;' colspan='2'>
<h2 style='text-align: center;'><span style='color: #333399;'>Financial Report:<br /></span></h2>
</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px; background-color: #44b8db; text-align: left;' colspan='2'><strong>&nbsp;Banks:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>Your Bank</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'> ". $data['bank'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>Type of Account</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'> ".  $data['acctype'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>Account Number</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" .  $data['accNumber']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>Personal Contact</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['contact_bank']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>Speical Notes</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['notes'] . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 28px; border-style: hidden;'>
<td style='width: 100%; height: 28px; border-style: hidden; background-color: #44b8db;' colspan='2'><strong>&nbsp;Assests:</strong></td>
</tr>
<tr style='height: 20px; border-style: hidden;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>Assests name</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['asset']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Type of Account</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Asset_type'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Account Number</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['Asset_accNumber'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Personal Contact</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['contact_asset']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Special Notes</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['notes_asset']  . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 27px;'>
<td style='width: 100%; height: 27px; border-style: hidden; background-color: #44b8db;' colspan='2'><strong>&nbsp;Credit Cards:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Issuer</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['issuer']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Name on the card</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Credit_name']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Card Number</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['cardNumber']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>CVV Number</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['cvvNumber'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Special Notes</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['credit_notes']  . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 28px;'>
<td style='width: 100%; background-color: #44b8db; height: 28px; border-style: hidden;' colspan='2'><strong>&nbsp;Loans:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Loan Name</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['loan']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Type of Loan</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['loan_type']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Financial Institution</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['institution']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Account Number</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Loan_accNumber']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Special Notes</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Loan_notes']  . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 30px;'>
<td style='background-color: #44b8db; width: 100%; border-style: hidden; height: 30px;' colspan='2'><strong>&nbsp;Life Insurance:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Name of Insurance Company</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Insurance']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Type of policy</td>
<td style='width: 50.9961%; height: 20px; border-style: hidden; text-align: center;'>" . $data['Ins_type']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Policy number</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Ins_policy']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Name of insurer person</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Ins_issuer']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Start Date</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Ins_start']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Expiration Date</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Ins_exp']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Value of Death</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Ins_value']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Speacial Notes</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Ins_notes']  . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 29px;'>
<td style='background-color: #44b8db; width: 100%; border-style: hidden; height: 29px;' colspan='2'><strong>&nbsp;Other Important Possessions</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Other Possessions:</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['possession']  . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>&nbsp;</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>&nbsp;</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
</tbody>
</table>");

        $mpdf->SetTitle('User Report');
        $content = $mpdf->Output("", "S");


        try {
//Need to hide
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))->setUsername('plantopartservice@gmail.com')->setPassword('plantopart');

            $mailer = new Swift_Mailer($transport);
            $message = new Swift_Message();
            $message->setSubject('Financial Report');
            $message->setFrom(['plantopartservice@gmail.com' => 'Plan to Part']);
            $message->addTo($res['email'], $user_name);

            $attachment = new Swift_Attachment($content, 'filename.pdf', 'application/pdf');
            $attachment->setFilename('Financial_Report.pdf');
            $message->attach($attachment);

            $message->setBody("<table style='height: 309px; width: 100%; border-collapse: collapse; border-style: none; margin-left: auto; margin-right: auto;' border='0&quot;' cellspacing='0' cellpadding='10'>
<tbody>
<tr style='height: 105px;'>
<td style='background-color: #44b8db; height: 23px;' colspan='2'><img style='display: block; margin-left: auto; margin-right: auto;' src='https://firebasestorage.googleapis.com/v0/b/plantopart-4c826.appspot.com/o/logo.PNG?alt=media&amp;token=e8510cfc-0080-4824-833f-04d5c8b7ce13' alt='Creating Email Magic.' width='300' height='80' /></td>
</tr>
<tr style='height: 213px;'>
<td style='border-style: hidden; text-align: left; height: 216px; width: 100%;' colspan='2'>
<p>Dear " . "$user_name" . ",</p>
<p>Attached is the Fiancial report requested.</p>
<p>&nbsp;</p>
<p>Thanks,</p>
<p>Plan to Part Team</p>
<p>&nbsp;</p>
</td>
</tr>
<tr style='height: 53px;'>
<td style='height: 53px; width: 100%;' colspan='2'>
<p><strong>Note: Please do not share it with unauthorized person. If you did not requested this report. Please contact Plan to Part team.</strong></p>
</td>
</tr>
<tr style='height: 17px;'>
<td style='background-color: #44b8db; height: 17px; width: 72.6213%;'>&copy;Plan to Part</td>
<td style='background-color: #44b8db; width: 27.3787%; height: 17px;'><img style='float: left;' src='https://1000logos.net/wp-content/uploads/2016/11/Facebook-logo.png' width='37' height='30' /><img style='float: left;' src='https://www.getfoundquick.com/wp-content/uploads/2017/11/shutterstock_571681849.jpg' width='37' height='35' /></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>", 'text/html');

            $result = $mailer->send($message);
            echo "Done";
        } catch (Exception $e) {
            echo "Error";
        }
    }
    else{
        echo "Error";
    }
}
