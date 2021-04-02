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
    $Data = $factory->createDatabase()->getReference('Users/' . $user . '/Questions')->getValue();
    $data = [];
    $X = [];

    $raw = [];
    foreach ($Data as $key => $value) {
        $k = preg_replace("/[^0-9\.]/", '', $key);
        $raw += [$k => $k];
    }

    for ($c = 1; $c < 27; $c++) {
        if (isset($raw["$c"])) {
            $X += ["$raw[$c]" => 'Yes'];
        } else {
            $X += ["$c" => 'No'];
        }
    }

    $mpdf->WriteHTML("<p style='text-align: center;'><img src='https://firebasestorage.googleapis.com/v0/b/plantopart-4c826.appspot.com/o/logo.PNG?alt=media&amp;token=e8510cfc-0080-4824-833f-04d5c8b7ce13' /></p>
<p style='text-align: left;'>Name: " . "$user_name" . "</p>
<p style='text-align: left;'>Date: " . date('Y-m-d') . "</p>
<table style='height: 90%; width: 100%; border-collapse: collapse; border-style: none; margin-left: auto; margin-right: auto;' border='1'>
<tbody>
<tr style='height: 73px;'>
<td style='border-style: hidden; width: 100%; text-align: center; height: 73px;' colspan='2'>
<h2 style='text-align: center;'><span style='color: #333399;'>Report:<br /></span></h2>
</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px; background-color: #44b8db; text-align: left;' colspan='2'><strong>Digital Footprint:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>My phone has a password</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . "$X[1]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>My Computer has a password</td>
<td style='width: 50.9961%; height: 20px; text-align: center;  border-style: hidden;'>" . "$X[2]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>I have a centralized list of passwords</td>
<td style='width: 50.9961%; height: 20px; text-align: center;  border-style: hidden;'>" . "$X[3]" . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>
</tr>
<tr style='height: 28px; border-style: hidden;'>
<td style='width: 100%; height: 28px; border-style: hidden; background-color: #44b8db;' colspan='2'><strong>No Place Like Home:</strong></td>
</tr>
<tr style='height: 20px; border-style: hidden;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>I am currently a homeowner</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[4]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I currently rent or lease my residence</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[5]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Other (Residence)</td>
<td style='width: 50.9961%; height: 20px; text-align: center;  border-style: hidden;'>" . "$X[6]" . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>
</tr>
<tr style='height: 27px;'>
<td style='width: 100%; height: 27px; border-style: hidden; background-color: #44b8db;' colspan='2'><strong>Guaranteed Protection:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have Health Insurance</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[7]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have Life Insurance</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[8]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have Disability Insurance</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[9]" . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>
</tr>
<tr style='height: 28px;'>
<td style='width: 100%; background-color: #44b8db; height: 28px; border-style: hidden;' colspan='2'><strong>Paying the Bills:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I am currently employed</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[10]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I am a currently unemployed</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[11]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I am a Business owner/Self-Employed</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[12]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I am happily retired</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[13]" . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>
</tr>
<tr style='height: 30px;'>
<td style='background-color: #44b8db; width: 100%; border-style: hidden; height: 30px;' colspan='2'><strong>Thinking Of The Future:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have a Will</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[14]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I appointed an Attorney to manage my finances</td>
<td style='width: 50.9961%; height: 20px; border-style: hidden; text-align: center; '>" . "$X[15]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have already created an Advance (Health) Directive</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[16]" . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>
</tr>
<tr style='height: 29px;'>
<td style='background-color: #44b8db; width: 100%; border-style: hidden; height: 29px;' colspan='2'><strong>Those Who Depend On Me:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have children under the age of 18</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[17]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have adult dependents</td>
<td style='width: 50.9961%; height: 20px; text-align: center;  border-style: hidden;'>" . "$X[18]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have pets</td>
<td style='width: 50.9961%; border-style: hidden;  text-align: center; height: 20px;'>" . "$X[19]" . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>
</tr>
<tr style='height: 31px;'>
<td style='background-color: #44b8db; width: 100%; border-style: hidden; height: 31px;' colspan='2'><strong>Relationships:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I am single</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[20]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have a partner or spouse</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[21]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have a different situation</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[22]" . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>
</tr>
<tr style='height: 31px;'>
<td style='background-color: #44b8db; width: 100%; border-style: hidden; height: 31px;' colspan='2'><strong>A Helping Hand:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have a financial planner</td>
<td style='width: 50.9961%; border-style: hidden;  text-align: center; height: 20px;'>" . "$X[23]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>I have an accountant</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center;  height: 20px;'>" . "$X[24]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>I have a power of attorney</td>
<td style='width: 50.9961%; height: 20px;  text-align: center; border-style: hidden;'>" . "$X[25]" . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>I have a legal guardian</td>
<td style='width: 50.9961%; height: 20px; text-align: center;  border-style: hidden;'>" . "$X[26]" . "</td>
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
        $message->setSubject('User Report');
        $message->setFrom(['plantopartservice@gmail.com' => 'Plan to Part']);
        $message->addTo($res['email'], $user_name);

        $attachment = new Swift_Attachment($content, 'filename.pdf', 'application/pdf');
        $attachment->setFilename('Report.pdf');
        $message->attach($attachment);

        $message->setBody("<table style='height: 309px; width: 100%; border-collapse: collapse; border-style: none; margin-left: auto; margin-right: auto;' border='0&quot;' cellspacing='0' cellpadding='10'>
<tbody>
<tr style='height: 105px;'>
<td style='background-color: #44b8db; height: 23px;' colspan='2'><img style='display: block; margin-left: auto; margin-right: auto;' src='https://firebasestorage.googleapis.com/v0/b/plantopart-4c826.appspot.com/o/logo.PNG?alt=media&amp;token=e8510cfc-0080-4824-833f-04d5c8b7ce13' alt='Creating Email Magic.' width='300' height='80' /></td>
</tr>
<tr style='height: 213px;'>
<td style='border-style: hidden; text-align: left; height: 216px; width: 100%;' colspan='2'>
<p>Dear " . "$user_name" . ",</p>
<p>Attached is the user report requested.</p>
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
