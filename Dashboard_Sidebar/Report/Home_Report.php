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
    if($factory->createDatabase()->getReference('Users/' . $user . '/HomeProperty_Data')->getSnapshot()->exists()) {
        $data = [];
        $data = $factory->createDatabase()->getReference('Users/' . $user . '/HomeProperty_Data')->getValue();

        $mpdf->WriteHTML("<p style='text-align: center;'><img src='https://firebasestorage.googleapis.com/v0/b/plantopart-4c826.appspot.com/o/logo.PNG?alt=media&amp;token=e8510cfc-0080-4824-833f-04d5c8b7ce13' /></p>
<p style='text-align: left;'>Name: " . "$user_name". "</p>
<p style='text-align: left;'>Date: " . date('Y-m-d') . "</p>
<table style='height: 90%; width: 100%; border-collapse: collapse; border-style: none; margin-left: auto; margin-right: auto;' border='1'>
<tbody>
<tr style='height: 73px;'>
<td style='border-style: hidden; width: 100%; text-align: center; height: 73px;' colspan='2'>
<h2 style='text-align: center;'><span style='color: #333399;'>Home and Property&nbsp;Report:<br /></span></h2>
</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px; background-color: #44b8db; text-align: left;' colspan='2'><strong>&nbsp;Homes:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>Home name</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>". $data['label1'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>Address</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>". $data['address1'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>&nbsp;</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['address2'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>&nbsp;</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['city'] . " " . $data['state'] ."</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; height: 20px; border-style: hidden;'>&nbsp;</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>". $data['country'] ." ". $data['lname'] . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 28px; border-style: hidden;'>
<td style='width: 100%; height: 28px; border-style: hidden; background-color: #44b8db;' colspan='2'><strong>&nbsp;Home Insurance:</strong></td>
</tr>
<tr style='height: 42px; border-style: hidden;'>
<td style='width: 49.0039%; height: 42px; border-style: hidden;'>Insurance name</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Insurance'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Type of Home Insurance:</td>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>&nbsp;</td>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Homeowners</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['HomeOwners'] . "</td>
</tr>
<tr style='height: 20px;'>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Renters</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['Renters'] . "</td>
</tr>
<tr style='height: 20px;'>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Liability</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['Liability'] . "</td>
</tr>
<tr style='height: 20px;'>
</tr>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Mortgage</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['Mortgage'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Flood</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['Flood'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Earthquake</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['Earthquake'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Tornado</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['Tornado'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Other</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['Other'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>&nbsp;</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>&nbsp;</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Insurance&nbsp;account or policy number:</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['policy'] . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 27px;'>
<td style='width: 100%; height: 27px; border-style: hidden; background-color: #44b8db;' colspan='2'><strong>&nbsp;Other Real Estate:</strong></td>
</tr>
<tr style='height: 25px;'>
<td style='width: 49.0039%; border-style: hidden; height: 25px;'>Home name</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 25px;'>" . $data['basic'] . "</td>
</tr>
<tr style='height: 32px;'>
<td style='width: 49.0039%; border-style: hidden; height: 32px;'>Type of Property</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 32px;'>" . $data['proptype'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Address</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['esaddres1'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>&nbsp;</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['esaddres2'] . " " . $data['escity'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>&nbsp;</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['esstate'] . " " . $data['code_2'] . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 28px;'>
<td style='width: 100%; background-color: #44b8db; height: 28px; border-style: hidden;' colspan='2'><strong>&nbsp;Vehicles:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Type of Vehicle</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['cartype'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Make</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['make'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Model</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['model'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Year</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['year'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Color</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['carcolor'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>License Plate/Registration number:</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['carcolor'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>State of registration:</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['carstate'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'><label for='Vin'>Vin number/Serial Number:</label></td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['Vinnum'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Location of vehicle:</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['location'] . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 30px;'>
<td style='background-color: #44b8db; width: 100%; border-style: hidden; height: 30px;' colspan='2'><strong>&nbsp;Vehicle Insurance:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Name of Insurance Company</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['insuranceco'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Account number:</td>
<td style='width: 50.9961%; height: 20px; border-style: hidden; text-align: center;'>" . $data['accnum'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'><label for='paperwork'>Where do you keep the original policy paperwork?</label></td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['paperwork'] . "</td>
</tr>
<tr style='height: 22px;'>
<td style='width: 49.0039%; border-style: hidden; height: 22px;'>&nbsp;</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 22px;'>&nbsp;</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 29px;'>
<td style='background-color: #44b8db; width: 100%; border-style: hidden; height: 29px;' colspan='2'><strong>&nbsp;Storage Facility:</strong></td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'><label for='storage'>Name of storage facility:</label></td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['storage'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Unit Number:</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['unitnum'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Address:</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['straddres1'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>&nbsp;</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['straddres2'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>&nbsp;</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['strcity'] . " " . $data['strstate'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>&nbsp;</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['strcode'] . " " . $data['strcountry'] . "</td>
</tr>
<tr style='height: 20px; background-color: #44b8db;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'><strong>&nbsp;Safe Deposit Box:</strong></td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>&nbsp;</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Name of Bank</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['bank'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>Location of Bank</td>
<td style='width: 50.9961%; border-style: hidden; text-align: center; height: 20px;'>" . $data['boxaddres1'] . " " . $data['boxaddres2'] . " " . $data['boxcity'] . "</td>
</tr>
<tr style='height: 20px;'>
<td style='width: 49.0039%; border-style: hidden; height: 20px;'>&nbsp;</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['boxstate'] . " " . $data['boxcode'] . " " . $data['boxcountry'] . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 26px;'>
<td style='width: 100%; border-style: hidden; height: 26px;' colspan='2'>&nbsp;Account Number</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['boxaccnum'] . "</td>
</tr>
<tr style='height: 16.0637px;'>
<td style='width: 100%; border-style: hidden; height: 16.0637px;' colspan='2'>&nbsp;Box number:</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['boxnum'] . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;Location of key:</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['key'] . "</td>
</tr>
<tr style='height: 29px; background-color: #44b8db;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'><strong> Other Important Possessions:</strong></td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;Other Possessions</td>
<td style='width: 50.9961%; height: 20px; text-align: center; border-style: hidden;'>" . $data['possession'] . "</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
<tr style='height: 29px;'>
<td style='width: 100%; border-style: hidden; height: 29px;' colspan='2'>&nbsp;</td>
</tr>
</tbody>
</table>
<p></p>");

        $mpdf->SetTitle('User Report');
        $content = $mpdf->Output('', 'S');


        try {
            //Need to hide
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))->setUsername('plantopartservice@gmail.com')->setPassword('plantopart');

            $mailer = new Swift_Mailer($transport);
            $message = new Swift_Message();
            $message->setSubject('Home and Property Report');
            $message->setFrom(['plantopartservice@gmail.com' => 'Plan to Part']);
            $message->addTo($res['email'], $user_name);

            $attachment = new Swift_Attachment($content, 'filename.pdf', 'application/pdf');
            $attachment->setFilename('HomeProperty_Report.pdf');
            $message->attach($attachment);

            $message->setBody("<table style='height: 309px; width: 100%; border-collapse: collapse; border-style: none; margin-left: auto; margin-right: auto;' border='0&quot;' cellspacing='0' cellpadding='10'>
            <tbody>
            <tr style='height: 105px;'>
            <td style='background-color: #44b8db; height: 23px;' colspan='2'><img style='display: block; margin-left: auto; margin-right: auto;' src='https://firebasestorage.googleapis.com/v0/b/plantopart-4c826.appspot.com/o/logo.PNG?alt=media&amp;token=e8510cfc-0080-4824-833f-04d5c8b7ce13' alt='Creating Email Magic.' width='300' height='80' /></td>
            </tr>
            <tr style='height: 213px;'>
            <td style='border-style: hidden; text-align: left; height: 216px; width: 100%;' colspan='2'>
            <p>Dear " . "$user_name" . ",</p>
            <p>Attached is the Home and Property report requested.</p>
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
            echo 'Done';
        } catch (Exception $e) {
            echo '$e';
        }
    }
    else{
        echo 'Error1';
    }
}
else{
    echo 'Error2';
}

?>